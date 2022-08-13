<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\Consumer;
use App\Models\Due;
use App\Models\DueDetail;
use App\Models\Employee;
use App\Models\Order;
use App\Models\OrderProduct;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;

class CheckoutController extends Controller {
    public function checkout(Request $request) {

        if (session()->get('order')) {
            $session_order = Order::find(session()->get('order'));

            if (session('payment_method') === 'Due') {
                $cash = $session_order->cash + session('cash');
                $due  = Due::where('due_to', 'Consumer')->where('due_to_id', $session_order->consumer_id)->first();

                if ($session_order->subtotal < Cart::subtotal()) {
                    DueDetail::create([
                        'due_id'   => $due->id,
                        'amount'   => session()->get('subtotal')-$session_order->subtotal,
                        'due_type' => 'Due',
                    ]);
                } elseif ($session_order->subtotal > Cart::subtotal()) {

                    if (session('cash') > 0) {
                        DueDetail::create([
                            'due_id'   => $due->id,
                            'amount'   => session()->get('subtotal') - $session_order->subtotal + session()->get('cash'),
                            'due_type' => 'Due',
                        ]);
                    } else {
                        DueDetail::create([
                            'due_id'   => $due->id,
                            'amount'   => $session_order->subtotal - Cart::subtotal(),
                            'due_type' => 'Deposit',
                        ]);
                    }

                }

                if (session('cash') > 0) {
                    DueDetail::create([
                        'due_id'   => $due->id,
                        'amount'   => session()->get('cash'),
                        'due_type' => 'Deposit',
                    ]);
                }

                $subtotal = $session_order->cash + session()->get('subtotal');
            } else {
                $subtotal = Cart::subtotal();
                $cash = Cart::subtotal();
            }

            $session_order->update([
                'total'    => Cart::subtotal(),
                'discount' => session()->get('discount'),
                'subtotal' => $subtotal,
                'cash'     => $cash,
            ]);

            foreach (Cart::content() as $cart) {
                $check = OrderProduct::where('order_id', session()->get('order'))->where('product_id', $cart->id)->first();

                if ($check) {
                    $check->update(['quantity' => $cart->qty]);
                } else {
                    OrderProduct::create([
                        'product_id' => $cart->id,
                        'order_id'   => session()->get('order'),
                        'quantity'   => $cart->qty,
                        'price'      => $cart->price,
                    ]);
                }

            }

            session()->forget('discount');
            session()->forget('subtotal');
            session()->forget('payment_method');
            session()->forget('cash');
            session()->forget('order');
            Cart::destroy();

            return redirect()->route('customer.transaction')->withToastSuccess('Order updated successfully');
        }

        $data              = [];
        $data['subtotal']  = session()->get('subtotal');
        $data['consumers'] = Consumer::all();
        $data['employees'] = Employee::all();

        return view('customer.checkout', $data);
    }

}
