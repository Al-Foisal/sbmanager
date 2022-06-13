<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderProduct;
use App\Models\Product;
use App\Models\Shop;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ShopController extends Controller {
    public function onlineShop() {
        $data                = [];
        $data['socialShare'] = \Share::page(
            SHOP()->online_market_link,
            'Make your digital payment through this link.',
        )
            ->facebook()
            ->twitter()
            ->reddit()
            ->linkedin()
            ->whatsapp()
            ->telegram();

        return view('customer.shop.online-shop', $data);
    }

    public function list() {
        $data = [];

        $data['shops'] = Shop::where('customer_id', Auth::id())->get();

        return view('customer.shop.list', $data);
    }

    public function store(Request $request) {

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
            'customer_id'        => Auth::id(),
            'name'               => $request->name,
            'image'              => $final_name1,
            'payment_link'       => 'https://abc.com/digital_payment',
            'online_market_link' => 'https://abc.cm/online-market',
        ]);

        return redirect()->back()->withToastSuccess('New shop created successfu;;y!!');
    }

    public function orderList() {
        $data           = [];
        $data['orders'] = Order::where('shop_id', SID())->orderBy('id', 'desc')->with('orderProduct')->paginate(50);

        return view('customer.shop.order-list', $data);
    }

    public function orderDetails($id) {
        $data          = [];
        $data['order'] = $order = Order::find($id);

        if (!$order || $order->shop_id !== SID()) {
            return back();
        }

        $data['orderProduct'] = OrderProduct::where('order_id', $order->id)->get();

        return view('customer.shop.order-details', $data);
    }

    public function onlineProduct()
    {
        $products = Product::where('shop_id',SID())->where('online',1)->paginate(50);

        return view('customer.shop.online-product',compact('products'));
    }

}
