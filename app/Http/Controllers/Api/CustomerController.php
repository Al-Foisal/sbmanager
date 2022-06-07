<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderProduct;
use App\Models\Product;
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

    public function storeQuicksell(Request $request, $shop_id) {
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

        return response()->json(['status' => true]);
    }

    public function updateQuicksell(Request $request, $id) {
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

        return response()->json(['status' => true]);
    }

    public function orderSave(Request $request) {

        if ($request->cash === null && $request->payment_method === 'Cash' && ($request->cash - $request->subtotal) < 0) {
            return redirect()->back()->withToastError('Cash payment input error.');
        }

        if ($request->payment_method === 'Digital Payment' && $request->consumer_id === null) {
            return redirect()->back()->withToastError('Customer information is needed for digital payment');
        }

        if ($request->payment_method === 'Cash') {
            $cash = $request->subtotal;
        } else {
            $cash = 0;
        }

        $data                   = [];
        $data['shop_id']        = $request->shop_id;
        $data['consumer_id']    = $request->consumer_id;
        $data['employee_id']    = $request->employee_id;
        $data['total']          = $request->total;
        $data['subtotal']       = $request->subtotal;
        $data['discount']       = $request->discount;
        $data['cash']           = $cash;
        $data['payment_method'] = $request->payment_method;

        $order = Order::create($data);

        if ($request->payment_method === 'Digital Payment') {
            $order->payment_link = 'routename/' . $order->id;
            $order->save();
        }

        foreach ($request->cart as $cart) {
            $order_product              = new OrderProduct();
            $order_product->shop_id     = $request->shop_id;
            $order_product->consumer_id = $request->consumer_id;
            $order_product->order_id    = $order->id;
            $order_product->product_id  = $cart->id;
            $order_product->quantity    = $cart->qty;
            $order_product->price       = $cart->price;
            $order_product->save();

            $product          = Product::find($cart->id);
            $updated_quantity = $product->quantity - $cart->qty;
            $product->update([
                'quantity' => $updated_quantity <= 0 ? 0 : $updated_quantity,
            ]);
        }

        return response()->json(['status' => false, 'message' => 'Order placed successfully!!']);
    }

    public function transaction($shop_id) {
        $data              = [];
        $data['orders']    = $orders    = Order::where('shop_id', $shop_id)->orderBy('id', 'DESC')->paginate(50);
        $total_transaction = 0;
        $count             = 0;

        foreach ($orders as $item) {
            $total_transaction += $item->subtotal;
        }

        $data['total_transaction'] = $total_transaction;
        $data['count']             = $count;

        return $data;
    }

    public function transactionDetails($id) {
        $data                = [];
        $data['transaction'] = Order::where('id', $id)->with('orderProduct')->first();

        return $data;
    }

}
