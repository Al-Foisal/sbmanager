<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderProduct;
use App\Models\Product;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Contracts\Encryption\DecryptException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;

class CartController extends Controller {
    public function cart() {
        $data = [];

        $data['cart']     = Cart::content();
        $data['total']    = Cart::subtotal();
        $data['discount'] = session()->get('discount') ?? null;
        $order_cash       = Order::find(session('order'))->cash;

        if (session('payment_method') === 'Due') {
            $subtotal = Cart::subtotal() - $order_cash;
        } elseif (session()->get('discount') > 0) {
            $subtotal = Cart::subtotal() - session()->get('discount');
        } else {
            $subtotal = Cart::subtotal();
        }

        session(['subtotal' => $subtotal]);

        $data['subtotal'] = session()->get('subtotal');

        return view('customer.cart', $data);
    }

    public function cartOrder($id) {
        try {
            $id = Crypt::decryptString($id);
        } catch (DecryptException $e) {
            return back();
        }

        session()->forget('discount');
        session()->forget('subtotal');
        session()->forget('payment_method');
        session()->forget('order');
        Cart::destroy();

        $data = [];

        $t = Order::where('id', $id)->with('orderProduct')->first();

        if (CID() && SID() !== $t->shop_id) {
            return redirect()->back()->withToastError('Unauthorized access!!');
        }

        foreach ($t->orderProduct as $op) {
            $data['id']               = $op->product_id;
            $data['name']             = GET_PRODUCT_BY_ID($op->product_id)->name;
            $data['qty']              = $op->quantity;
            $data['price']            = GET_PRODUCT_BY_ID($op->product_id)->price;
            $data['weight']           = 1;
            $data['options']['image'] = GET_PRODUCT_BY_ID($op->product_id)->image;
            $data['options']['order'] = $id;

            Cart::add($data);
        }

        session([
            'discount'       => $t->discount,
            'subtotal'       => $t->subtotal,
            'payment_method' => $t->payment_method,
            'order'          => $id,
        ]);

        return redirect()->route('customer.cart');
    }

    public function addToCart(Request $request) {
        $data = [];

        $product = Product::where('id', $request->id)->first();

        if (!$product || $product->quantity === 0) {
            return response()->json([
                'status' => 'noSuccess',
            ]);
        }

        $data['id']               = $product->id;
        $data['name']             = $product->name;
        $data['qty']              = 1;
        $data['price']            = $product->price;
        $data['weight']           = 1;
        $data['options']['image'] = $product->image;

        Cart::add($data);

        return response()->json([
            'status'        => 'success',
            'cart_count'    => Cart::count(),
            'cart_content'  => Cart::content(),
            'cart_subtotal' => Cart::subtotal(),
        ]);
    }

    public function cc() {
        print_r(Cart::content());
    }

    public function removeFromCart($rowId) {

        if (session('order')) {
            $cart_data = Cart::get($rowId);
            OrderProduct::where('order_id', session('order'))->where('product_id', $cart_data->id)->first()->delete();
        }

        Cart::remove($rowId);

        return redirect()->back()->withToastSuccess('Product removed successfully!!');
    }

    public function updateCart(Request $request) {
        $row = [];

        foreach ($request->row_id as $key => $row) {
            $rowId = $row;
            $qty   = $request->quantity[$key];
            Cart::update($rowId, $qty);
        }

        return redirect()->back()->withToastSuccess('Cart updated successfully!!');
    }

    public function extraDiscount(Request $request) {

        if (session('payment_method') === 'Due') {
            session(['cash' => $request->due]);
        } else {
            session(['discount' => $request->discount, 'subtotal' => $request->subtotal]);
        }

        return response()->json();
    }

}
