<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Library\SslCommerz\SslCommerzSubscriptionNotification;
use App\Models\Shop;
use App\Models\Subscription;
use App\Models\SubscriptionHistory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SubscriptionPaymentController extends Controller {
    public function subscriptionPayment(Request $request) {
        $subscription = Subscription::find($request->subscription_id);
        $shop         = Shop::find($request->shop_id);

        if (!$subscription) {
            return redirect()->back()->withToastError('Something went wrong');
        }

        if ($subscription->discount > 0) {
            $price = $subscription->discount_price;
        } else {
            $price = $subscription->price;
        }

        #Before  going to initiate the payment order status need to insert or update as Pending.
        $subscription_history = SubscriptionHistory::create([
            'shop_id'         => $shop->id,
            'subscription_id' => $subscription->id,
            'transaction_id'  => $subscription->shop_id . time() . uniqid(),
            'status'          => 'Pending',
            'amount'          => $price,
            'currency'        => 'BDT',
        ]);

        $post_data                 = [];
        $post_data['total_amount'] = $subscription_history->amount;
        $post_data['currency']     = "BDT";
        $post_data['tran_id']      = $subscription_history->transaction_id;

// tran_id must be unique

        # CUSTOMER INFORMATION
        $post_data['cus_name']     = $shop->name;
        $post_data['cus_email']    = "N/A";
        $post_data['cus_add1']     = $shop->address ?? "N/A";
        $post_data['cus_add2']     = "N/A";
        $post_data['cus_city']     = $shop->district ?? "N/A";
        $post_data['cus_state']    = "N/A";
        $post_data['cus_postcode'] = "N/A";
        $post_data['cus_country']  = "Bangladesh";
        $post_data['cus_phone']    = $shop->phone ?? '017896325';
        $post_data['cus_fax']      = "N/A";

        # SHIPMENT INFORMATION
        $post_data['ship_name']     = "N/A";
        $post_data['ship_add1']     = "N/A";
        $post_data['ship_add2']     = "N/A";
        $post_data['ship_city']     = "N/A";
        $post_data['ship_state']    = "N/A";
        $post_data['ship_postcode'] = "N/A";
        $post_data['ship_phone']    = "N/A";
        $post_data['ship_country']  = "N/A";

        $post_data['shipping_method']  = "N/A";
        $post_data['product_name']     = "N/A";
        $post_data['product_category'] = "N/A";
        $post_data['product_profile']  = "N/A";

        # OPTIONAL PARAMETERS
        $post_data['value_a'] = "N/A";
        $post_data['value_b'] = "N/A";
        $post_data['value_c'] = "N/A";
        $post_data['value_d'] = "N/A";

        //url
        $post_data['subscription_success_url'] = '/subscription_success';
        $post_data['subscription_fail_url']    = '/subscription_fail';
        $post_data['subscription_cancel_url']  = '/subscription_cancel';

        $sslc = new SslCommerzSubscriptionNotification();
        # initiate(Transaction Data , false: Redirect to SSLCOMMERZ gateway/ true: Show all the Payement gateway here )
        $payment_options = $sslc->makePayment($post_data, 'hosted');

        if (!is_array($payment_options)) {
            print_r($payment_options);
            $payment_options = [];
        }

    }

    public function subscriptionSuccess(Request $request) {
        $data              = [];
        $data['trn_state'] = "Transaction is Successful";

        $tran_id  = $request->input('tran_id');
        $amount   = $request->input('amount');
        $currency = $request->input('currency');

        $sslc = new SslCommerzSubscriptionNotification();

        #Check order status in order tabel against the transaction id or order id.
        $order_detials = DB::table('subscription_histories')
            ->where('transaction_id', $tran_id)
            ->select('shop_id', 'subscription_id', 'transaction_id', 'status', 'currency', 'amount')->first();

        if ($order_detials->status == 'Pending') {
            $validation = $sslc->orderValidate($request->all(), $tran_id, $amount, $currency);

            if ($validation == TRUE) {
                /*
                That means IPN did not work or IPN URL was not set in your merchant panel. Here you need to update order status
                in order table as Processing or Complete.
                Here you can also sent sms or email for successfull transaction to customer
                 */
                $update_digital_payment = DB::table('subscription_histories')
                    ->where('transaction_id', $tran_id)
                    ->update(['status' => 'Processing']);
                $sub = Subscription::find($order_detials->subscription_id);

                if ($sub->life_time_type === 'Day') {
                    $next_date = date("Y-m-d", strtotime('+' . $sub->life_time . ' days'));
                } elseif ($sub->life_time_type === 'Month') {
                    $next_date = date("Y-m-d", strtotime('+' . $sub->life_time . ' months'));
                } elseif ($sub->life_time_type === 'Year') {
                    $next_date = date("Y-m-d", strtotime('+' . $sub->life_time . ' years'));
                }

                $shop           = Shop::find($order_detials->shop_id);
                $shop->end_date = $next_date;
                $shop->save();

                $data['tran_state'] = "Transaction is successfully Completed";
            } else {
                /*
                That means IPN did not work or IPN URL was not set in your merchant panel and Transation validation failed.
                Here you need to update order status as Failed in order table.
                 */
                $update_digital_payment = DB::table('subscription_histories')
                    ->where('transaction_id', $tran_id)
                    ->update(['status' => 'Failed']);
                $data['tran_state'] = "validation Fail";
            }

        } elseif ($order_detials->status == 'Processing' || $order_detials->status == 'Complete') {
            /*
            That means through IPN Order status already updated. Now you can just show the customer that transaction is completed. No need to udate database.
             */
            $data['tran_state'] = "Transaction is successfully Completed";
        } else {
            #That means something wrong happened. You can redirect customer to your product page.
            $data['tran_state'] = "Invalid Transaction";
        }

        $data['payment_status'] = $order_detials->status;
        $data['shop']           = Shop::where('id', $order_detials->shop_id)->select(['id', 'name', 'image', 'phone', 'address'])->first();

        $data['online_market'] = true;

        return $data;

    }

    public function subscriptionFail(Request $request) {
        $data    = [];
        $tran_id = $request->input('tran_id');

        $order_detials = DB::table('subscription_histories')
            ->where('transaction_id', $tran_id)
            ->select('shop_id', 'transaction_id', 'status', 'currency', 'amount')->first();

        if ($order_detials->status == 'Pending') {
            $update_digital_payment = DB::table('subscription_histories')
                ->where('transaction_id', $tran_id)
                ->update(['status' => 'Failed']);
            $data['tran_state'] = "Transaction is Falied";
        } elseif ($order_detials->status == 'Processing' || $order_detials->status == 'Complete') {
            $data['tran_state'] = "Transaction is already Successful";
        } else {
            $data['tran_state'] = "Transaction is Invalid";
        }

        $data['payment_status'] = $order_detials->status;
        $data['shop']           = Shop::where('id', $order_detials->shop_id)->select(['id', 'name', 'image', 'phone', 'address'])->first();

        $data['online_market'] = true;

        return $data;
    }

    public function subscriptionCancel(Request $request) {
        $data    = [];
        $tran_id = $request->input('tran_id');

        $order_detials = DB::table('subscription_histories')
            ->where('transaction_id', $tran_id)
            ->select('shop_id', 'transaction_id', 'status', 'currency', 'amount')->first();

        if ($order_detials->status == 'Pending') {
            $update_digital_payment = DB::table('subscription_histories')
                ->where('transaction_id', $tran_id)
                ->update(['status' => 'Canceled']);
            $data['tran_state'] = "Transaction is Cancel";
        } elseif ($order_detials->status == 'Processing' || $order_detials->status == 'Complete') {
            $data['tran_state'] = "Transaction is already Successful";
        } else {
            $data['tran_state'] = "Transaction is Invalid";
        }

        $data['payment_status'] = $order_detials->status;
        $data['shop']           = Shop::where('id', $order_detials->shop_id)->select(['id', 'name', 'image', 'phone', 'address'])->first();

        $data['online_market'] = true;

        return $data;

    }

    public function subscriptionIpn(Request $request) {

        $data = [];

#Received all the payement information from the gateway
        if ($request->input('tran_id')) #Check transation id is posted or not.
        {

            $tran_id = $request->input('tran_id');

            #Check order status in order tabel against the transaction id or order id.
            $order_details = DB::table('subscription_histories')
                ->where('transaction_id', $tran_id)
                ->select('transaction_id', 'status', 'currency', 'amount')->first();

            if ($order_details->status == 'Pending') {
                $sslc       = new SslCommerzSubscriptionNotification();
                $validation = $sslc->orderValidate($request->all(), $tran_id, $order_details->amount, $order_details->currency);

                if ($validation == TRUE) {
                    /*
                    That means IPN worked. Here you need to update order status
                    in order table as Processing or Complete.
                    Here you can also sent sms or email for successful transaction to customer
                     */
                    $update_digital_payment = DB::table('subscription_histories')
                        ->where('transaction_id', $tran_id)
                        ->update(['status' => 'Processing']);

                    $data['tran_state'] = "Transaction is successfully Completed";
                } else {
                    /*
                    That means IPN worked, but Transation validation failed.
                    Here you need to update order status as Failed in order table.
                     */
                    $update_digital_payment = DB::table('subscription_histories')
                        ->where('transaction_id', $tran_id)
                        ->update(['status' => 'Failed']);

                    $data['tran_state'] = "validation Fail";
                }

            } elseif ($order_details->status == 'Processing' || $order_details->status == 'Complete') {

                #That means Order status already updated. No need to udate database.

                $data['tran_state'] = "Transaction is already successfully Completed";
            } else {
                #That means something wrong happened. You can redirect customer to your product page.

                $data['tran_state'] = "Invalid Transaction";
            }

        } else {
            $data['tran_state'] = "Invalid Data";
        }

        $data['payment_status'] = $order_details->status;
        $data['shop']           = Shop::where('id', $order_details->shop_id)->select(['id', 'name', 'image', 'phone', 'address'])->first();

        $data['online_market'] = true;

        return $data;

    }

}
