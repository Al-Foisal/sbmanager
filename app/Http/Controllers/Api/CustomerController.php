<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Shop;
use Illuminate\Http\Request;

class CustomerController extends Controller {
    public function shopList($customer_id) {
        $data = [];

        $data['shops'] = Shop::where('customer_id', $customer_id)->get();

        return $data;
    }

    public function storeShop(Request $request) {

        if ($request->hasFile('image')) {

            $image_file = $request->file('image');

            if ($image_file) {

                $img_gen   = hexdec(uniqid());
                $image_url = 'images/shop/';
                $image_ext = strtolower($image_file->getClientOriginalExtension());

                $img_name    = $img_gen . '.' . $image_ext;
                $final_name1 = $image_url . $img_gen . '.' . $image_ext;

                $image_file->move($image_url, $img_name);
            }

        }

        Shop::create([
            'customer_id' => $request->customer_id,
            'name'        => $request->name,
            'image'       => $final_name1,
        ]);

        return response()->json(['status' => true, 'message' => 'New shop created successfully!!']);
    }

    public function dashboard(Request $request) {
        $data             = [];
        $data['sales']    = 1;
        $data['expenses'] = 2;
        $data['due']      = 3;
        $data['balance']  = 4;

        return $data;
    }

    public function storeQuicksell(Request $request, $shop_id)
    {
        $data                   = [];
        $data['shop_id']        = $shop_id;
        $data['consumer_id']    = $request->consumer_id;
        $data['total']          = $request->subtotal;
        $data['subtotal']       = $request->subtotal;
        $data['cash']           = $request->subtotal;
        $data['payment_method'] = 'Quick Sell';
        $data['note']           = $request->note;
        $data['profit']         = $request->profit;

        $order = Order::create($data);

        if ($request->hasFile('receipt')) {

            $image_file = $request->file('receipt');

            if ($image_file) {

                $img_gen   = hexdec(uniqid());
                $image_url = 'images/quicksell/';
                $image_ext = strtolower($image_file->getClientOriginalExtension());

                $img_name    = $img_gen . '.' . $image_ext;
                $final_name1 = $image_url . $img_gen . '.' . $image_ext;

                $image_file->move($image_url, $img_name);

                $order->receipt = $final_name1;
                $order->save();
            }

        }

        return response()->json(['status'=>true]);
    }

    public function updateQuicksell(Request $request, $id)
    {
        $order                  = Order::find($id);
        $data                   = [];
        $data['shop_id']        = $order->shop_id;
        $data['consumer_id']    = $request->consumer_id;
        $data['total']          = $request->subtotal;
        $data['subtotal']       = $request->subtotal;
        $data['cash']           = $request->subtotal;
        $data['payment_method'] = 'Quick Sell';
        $data['note']           = $request->note;
        $data['profit']         = $request->profit;
        $data['created_at']     = $request->current_date;

        $order->update($data);

        if ($request->hasFile('receipt')) {

            $image_file = $request->file('receipt');

            if ($image_file) {

                $img_gen   = hexdec(uniqid());
                $image_url = 'images/quicksell/';
                $image_ext = strtolower($image_file->getClientOriginalExtension());

                $img_name    = $img_gen . '.' . $image_ext;
                $final_name1 = $image_url . $img_gen . '.' . $image_ext;

                $image_file->move($image_url, $img_name);

                $order->receipt = $final_name1;
                $order->save();
            }

        }

        return response()->json(['status'=>true]);
    }


}
