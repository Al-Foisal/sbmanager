<?php

namespace App\Http\Controllers;

use App\Models\Division;
use App\Models\OnlineOrder;
use App\Models\OnlineOrderProduct;
use App\Models\Product;
use App\Models\Shop;
use App\Models\Slider;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;

class SingleShopController extends Controller {
    public function singleShopIndex($link) {
        $data         = [];
        $data['shop'] = $shop = Shop::where('online_market_link', $link)->first();

        if (!$shop) {
            return back();
        }

        $shop_id = $shop->id;

        $data['slider']   = Slider::where('shop_id', $shop_id)->get();
        $data['products'] = Product::where('shop_id', $shop_id)->whereNotNull('category_id')->paginate(10);

        return view('single_shop.index', $data);
    }

    public function singleShopDetails($link, $slug) {
        $data         = [];
        $data['shop'] = $shop = Shop::where('online_market_link', $link)->first();

        if (!$shop) {
            return back();
        }

        $shop_id = $shop->id;

        $data['product'] = Product::where('slug', $slug)->first();

        return view('single_shop.details', $data);

    }

    public function singleShopCart($link) {
        $data         = [];
        $data['shop'] = $shop = Shop::where('online_market_link', $link)->first();

        if (!$shop) {
            return back();
        }

        $data['carts'] = Cart::content();

        return view('single_shop.cart', $data);
    }

    public function singleShopCheckout($link) {
        $data         = [];
        $data['shop'] = $shop = Shop::where('online_market_link', $link)->first();

        if (!$shop) {
            return back();
        }

        $data['carts']     = Cart::content();
        $data['divisions'] = Division::all();
        $data['total']     = Cart::subtotal() + $shop->shipping_charge;

        return view('single_shop.checkout', $data);
    }

    public function singleShopPlaceOrder(Request $request, $link) {
        // dd($request->all());
        $order = OnlineOrder::create($request->all());

        foreach (Cart::content() as $cart) {
            OnlineOrderProduct::create([
                'online_order_id' => $order->id,
                'product_id'      => $cart->id,
                'quantity'        => $cart->qty,
                'price'           => $cart->price,
            ]);
        }

        Cart::destroy();

        return redirect()->route('shop.singleShopOrderConfirm', [$link, $order->id]);

    }

    public function singleShopOrderConfirm($link, $id) {
        $data          = [];
        $data['shop']  = Shop::where('online_market_link', $link)->first();
        $data['order'] = OnlineOrder::with('onlineOrderProducts')->where('id', $id)->first();

        return view('single_shop.confirm-order', $data);
    }

}
