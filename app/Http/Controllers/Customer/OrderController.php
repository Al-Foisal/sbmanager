<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\DigitalPayment;
use App\Models\Order;
use App\Models\OrderProduct;
use App\Models\Product;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;

class OrderController extends Controller {
    public function placeOrder(Request $request) {

        if (Cart::count() <= 0) {
            return back();
        }

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
        $data['shop_id']        = SID();
        $data['consumer_id']    = $request->consumer_id;
        $data['employee_id']    = $request->employee_id;
        $data['total']          = Cart::subtotal();
        $data['subtotal']       = $request->subtotal;
        $data['discount']       = session()->get('discount');
        $data['cash']           = $cash;
        $data['payment_method'] = $request->payment_method;

        $order = Order::create($data);

        if ($request->payment_method === 'Digital Payment') {
            DigitalPayment::create([
                'shop_id' => SID(),
                'name'    => $order->consumer->name,
                'phone'   => $order->consumer->phone,
                'amount'  => $request->subtotal,
                'status'  => 'pending',
                'link'    => 'payment-link/' . SID() . bin2hex(random_bytes(5)) . time(),
            ]);
        }

        foreach (Cart::content() as $cart) {
            $order_product              = new OrderProduct();
            $order_product->shop_id     = SID();
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

        session()->forget('discount');
        session()->forget('subtotal');
        Cart::destroy();

        if ($request->payment_method === 'Due') {
            $data['consumer_id']    = Crypt::encryptString($request->consumer_id ?? 'Consumer');
            $data['amount']         = Crypt::encryptString($request->subtotal);

            return redirect()->route('customer.due.create', $data);
        }

        return redirect()->route('customer.products.index')->withToastSuccess('Order placed successfully!!');
    }

}
