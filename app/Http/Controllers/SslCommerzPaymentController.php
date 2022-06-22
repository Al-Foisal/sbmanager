<?php

namespace App\Http\Controllers;

use App\Library\SslCommerz\SslCommerzNotification;
use App\Models\DigitalAmount;
use App\Models\DigitalPayment;
use App\Models\Shop;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SslCommerzPaymentController extends Controller {

    public function exampleEasyCheckout() {
        return view('exampleEasycheckout');
    }

    public function exampleHostedCheckout() {
        return view('exampleHosted');
    }

    public function index(Request $request) {
        $consumer = DigitalPayment::where('link', $request->link)->first();

        if (!$consumer || $request->amount != $consumer->amount) {
            return redirect()->back()->withToastSuccess('Something went wrong');
        }

        #Before  going to initiate the payment order status need to insert or update as Pending.
        $consumer->update([
            'name'           => $request->name,
            'phone'          => $request->phone,
            'email'          => $request->email,
            'address'        => $request->address,
            'status'         => 'Pending',
            'transaction_id' => $consumer->shop_id . time() . uniqid(),
            'currency'       => 'BDT',
        ]);

        $post_data                 = [];
        $post_data['total_amount'] = $consumer->amount; # You cant not pay less than 10
        $post_data['currency']     = "BDT";
        $post_data['tran_id']      = $consumer->transaction_id;

// tran_id must be unique

        # CUSTOMER INFORMATION
        $post_data['cus_name']     = $consumer->name;
        $post_data['cus_email']    = $consumer->email;
        $post_data['cus_add1']     = $consumer->address;
        $post_data['cus_add2']     = "N/A";
        $post_data['cus_city']     = "N/A";
        $post_data['cus_state']    = "N/A";
        $post_data['cus_postcode'] = "N/A";
        $post_data['cus_country']  = "Bangladesh";
        $post_data['cus_phone']    = $consumer->phone;
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
        $post_data['success_url'] = '/success';
        $post_data['fail_url']    = '/fail';
        $post_data['cancel_url']  = '/cancel';

        $sslc = new SslCommerzNotification();
        # initiate(Transaction Data , false: Redirect to SSLCOMMERZ gateway/ true: Show all the Payement gateway here )
        $payment_options = $sslc->makePayment($post_data, 'hosted');

        if (!is_array($payment_options)) {
            print_r($payment_options);
            $payment_options = [];
        }

    }

    public function success(Request $request) {
        $data              = [];
        $data['trn_state'] = "Transaction is Successful";

        $tran_id  = $request->input('tran_id');
        $amount   = $request->input('amount');
        $currency = $request->input('currency');

        $sslc = new SslCommerzNotification();

        #Check order status in order tabel against the transaction id or order id.
        $order_detials = DB::table('digital_payments')
            ->where('transaction_id', $tran_id)
            ->select('shop_id', 'transaction_id', 'status', 'currency', 'amount')->first();

        if ($order_detials->status == 'Pending') {
            $validation = $sslc->orderValidate($request->all(), $tran_id, $amount, $currency);

            if ($validation == TRUE) {
                /*
                That means IPN did not work or IPN URL was not set in your merchant panel. Here you need to update order status
                in order table as Processing or Complete.
                Here you can also sent sms or email for successfull transaction to customer
                 */
                $update_digital_payment = DB::table('digital_payments')
                    ->where('transaction_id', $tran_id)
                    ->update(['status' => 'Processing', 'link' => null]);

                //updating total digital amount
                $digital = DigitalAmount::where('shop_id', $order_detials->shop_id)->first();

                if ($digital) {
                    $digital->update([
                        'amount' => $digital->amount + $order_detials->amount,
                    ]);
                } else {
                    DigitalAmount::create([
                        'shop_id' => $order_detials->shop_id,
                        'amount'  => $order_detials->amount,
                    ]);
                }

                $data['tran_state'] = "Transaction is successfully Completed";
            } else {
                /*
                That means IPN did not work or IPN URL was not set in your merchant panel and Transation validation failed.
                Here you need to update order status as Failed in order table.
                 */
                $update_digital_payment = DB::table('digital_payments')
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
        $data['shop']           = Shop::where('id', $order_detials->shop_id)->select(['name', 'image', 'phone', 'address'])->first();

        $data['online_market'] = false;

        return view('success', $data);

    }

    public function fail(Request $request) {
        $data    = [];
        $tran_id = $request->input('tran_id');

        $order_detials = DB::table('digital_payments')
            ->where('transaction_id', $tran_id)
            ->select('shop_id', 'transaction_id', 'status', 'currency', 'amount')->first();

        if ($order_detials->status == 'Pending') {
            $update_digital_payment = DB::table('digital_payments')
                ->where('transaction_id', $tran_id)
                ->update(['status' => 'Failed']);
            $data['tran_state'] = "Transaction is Falied";
        } elseif ($order_detials->status == 'Processing' || $order_detials->status == 'Complete') {
            $data['tran_state'] = "Transaction is already Successful";
        } else {
            $data['tran_state'] = "Transaction is Invalid";
        }

        $data['payment_status'] = $order_detials->status;
        $data['shop']           = Shop::where('id', $order_detials->shop_id)->select(['name', 'image', 'phone', 'address'])->first();

        $data['online_market'] = false;

        return view('fail', $data);
    }

    public function cancel(Request $request) {
        $data    = [];
        $tran_id = $request->input('tran_id');

        $order_detials = DB::table('digital_payments')
            ->where('transaction_id', $tran_id)
            ->select('shop_id', 'transaction_id', 'status', 'currency', 'amount')->first();

        if ($order_detials->status == 'Pending') {
            $update_digital_payment = DB::table('digital_payments')
                ->where('transaction_id', $tran_id)
                ->update(['status' => 'Canceled']);
            $data['tran_state'] = "Transaction is Cancel";
        } elseif ($order_detials->status == 'Processing' || $order_detials->status == 'Complete') {
            $data['tran_state'] = "Transaction is already Successful";
        } else {
            $data['tran_state'] = "Transaction is Invalid";
        }

        $data['payment_status'] = $order_detials->status;
        $data['shop']           = Shop::where('id', $order_detials->shop_id)->select(['name', 'image', 'phone', 'address'])->first();

        $data['online_market'] = false;

        return view('cancel', $data);

    }

    public function ipn(Request $request) {

        $data = [];

#Received all the payement information from the gateway
        if ($request->input('tran_id')) #Check transation id is posted or not.
        {

            $tran_id = $request->input('tran_id');

            #Check order status in order tabel against the transaction id or order id.
            $order_details = DB::table('digital_payments')
                ->where('transaction_id', $tran_id)
                ->select('transaction_id', 'status', 'currency', 'amount')->first();

            if ($order_details->status == 'Pending') {
                $sslc       = new SslCommerzNotification();
                $validation = $sslc->orderValidate($request->all(), $tran_id, $order_details->amount, $order_details->currency);

                if ($validation == TRUE) {
                    /*
                    That means IPN worked. Here you need to update order status
                    in order table as Processing or Complete.
                    Here you can also sent sms or email for successful transaction to customer
                     */
                    $update_digital_payment = DB::table('digital_payments')
                        ->where('transaction_id', $tran_id)
                        ->update(['status' => 'Processing']);

                    $data['tran_state'] = "Transaction is successfully Completed";
                } else {
                    /*
                    That means IPN worked, but Transation validation failed.
                    Here you need to update order status as Failed in order table.
                     */
                    $update_digital_payment = DB::table('digital_payments')
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
        $data['shop']           = Shop::where('id', $order_details->shop_id)->select(['name', 'image', 'phone', 'address'])->first();

        $data['online_market'] = false;

        return view('ipn', $data);

    }

}
