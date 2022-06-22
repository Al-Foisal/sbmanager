<?php

namespace App\Http\Controllers\Payment;

use App\Http\Controllers\Controller;
use App\Library\SslCommerz\SslCommerzOnlineMarketNotification;
use App\Models\AdminOrder;
use App\Models\Product;
use App\Models\Shop;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OnlineMarketPaymentController extends Controller {

    public function exampleEasyCheckout() {
        return view('exampleEasycheckout');
    }

    public function exampleHostedCheckout() {
        return view('exampleHosted');
    }

    public function onlineMarketPayment(Request $request) {
        $shop    = Shop::find($request->shop_id);
        $product = Product::find($request->product_id);

        if (!$shop || !$product) {
            return redirect()->back()->withToastSuccess('Something went wrong');
        }

#Before  going to initiate the payment order status need to insert or update as Pending.
        if ($product->discount > 0) {
            $price = $product->discount_price;
        } else {
            $price = $product->price;
        }

        $online_market = AdminOrder::create([
            'shop_id'        => $shop->id,
            'product_id'     => $product->id,
            'quantity'       => $request->quantity,
            'amount'         => $price,
            'status'         => 'Pending',
            'transaction_id' => $shop->id . $product->id . time() . uniqid(),
            'currency'       => 'BDT',
        ]);

        $post_data                 = [];
        $post_data['total_amount'] = $price; # You cant not pay less than 10
        $post_data['currency']     = "BDT";
        $post_data['tran_id']      = $online_market->transaction_id;

// tran_id must be unique

        # CUSTOMER INFORMATION
        $post_data['cus_name']     = $shop->name;
        $post_data['cus_email']    = "N/A";
        $post_data['cus_add1']     = $shop->address;
        $post_data['cus_add2']     = "N/A";
        $post_data['cus_city']     = "N/A";
        $post_data['cus_state']    = "N/A";
        $post_data['cus_postcode'] = "N/A";
        $post_data['cus_country']  = "Bangladesh";
        $post_data['cus_phone']    = $shop->phone;
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
        $post_data['online_market_success_url'] = '/online_market_success';
        $post_data['online_market_fail_url']    = '/online_market_fail';
        $post_data['online_market_cancel_url']  = '/online_market_cancel';

        $sslc = new SslCommerzOnlineMarketNotification();
        # initiate(Transaction Data , false: Redirect to SSLCOMMERZ gateway/ true: Show all the Payement gateway here )
        $payment_options = $sslc->makePayment($post_data, 'hosted');

        if (!is_array($payment_options)) {
            print_r($payment_options);
            $payment_options = [];
        }

    }

    public function onlineMarketSuccess(Request $request) {
        $data              = [];
        $data['trn_state'] = "Transaction is Successful";

        $tran_id  = $request->input('tran_id');
        $amount   = $request->input('amount');
        $currency = $request->input('currency');

        $sslc = new SslCommerzOnlineMarketNotification();

        #Check order status in order tabel against the transaction id or order id.
        $order_detials = DB::table('admin_orders')
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
                $update_digital_payment = DB::table('admin_orders')
                    ->where('transaction_id', $tran_id)
                    ->update(['status' => 'Processing']);

                $data['tran_state'] = "Transaction is successfully Completed";
            } else {
                /*
                That means IPN did not work or IPN URL was not set in your merchant panel and Transation validation failed.
                Here you need to update order status as Failed in order table.
                 */
                $update_digital_payment = DB::table('admin_orders')
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

        return view('success', $data);

    }

    public function onlineMarketFail(Request $request) {
        $data    = [];
        $tran_id = $request->input('tran_id');

        $order_detials = DB::table('admin_orders')
            ->where('transaction_id', $tran_id)
            ->select('shop_id', 'transaction_id', 'status', 'currency', 'amount')->first();

        if ($order_detials->status == 'Pending') {
            $update_digital_payment = DB::table('admin_orders')
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

        return view('fail', $data);
    }

    public function onlineMarketCancel(Request $request) {
        $data    = [];
        $tran_id = $request->input('tran_id');

        $order_detials = DB::table('admin_orders')
            ->where('transaction_id', $tran_id)
            ->select('shop_id', 'transaction_id', 'status', 'currency', 'amount')->first();

        if ($order_detials->status == 'Pending') {
            $update_digital_payment = DB::table('admin_orders')
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

        return view('cancel', $data);

    }

    public function onlineMarketIpn(Request $request) {

        $data = [];

#Received all the payement information from the gateway
        if ($request->input('tran_id')) #Check transation id is posted or not.
        {

            $tran_id = $request->input('tran_id');

            #Check order status in order tabel against the transaction id or order id.
            $order_details = DB::table('admin_orders')
                ->where('transaction_id', $tran_id)
                ->select('transaction_id', 'status', 'currency', 'amount')->first();

            if ($order_details->status == 'Pending') {
                $sslc       = new SslCommerzOnlineMarketNotification();
                $validation = $sslc->orderValidate($request->all(), $tran_id, $order_details->amount, $order_details->currency);

                if ($validation == TRUE) {
                    /*
                    That means IPN worked. Here you need to update order status
                    in order table as Processing or Complete.
                    Here you can also sent sms or email for successful transaction to customer
                     */
                    $update_digital_payment = DB::table('admin_orders')
                        ->where('transaction_id', $tran_id)
                        ->update(['status' => 'Processing']);

                    $data['tran_state'] = "Transaction is successfully Completed";
                } else {
                    /*
                    That means IPN worked, but Transation validation failed.
                    Here you need to update order status as Failed in order table.
                     */
                    $update_digital_payment = DB::table('admin_orders')
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

        return view('ipn', $data);

    }

}
