<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\Buy;
use App\Models\BuyProduct;
use App\Models\Product;
use App\Models\Supplier;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Contracts\Encryption\DecryptException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;

class BuyController extends Controller {
    public function index() {

        $products = Product::where('shop_id', SID())->get();

        return view('customer.buy.index', compact('products'));
    }

    public function cart() {
        $data = [];

        $data['cart']     = Cart::content();
        $data['total']    = Cart::subtotal();
        $data['discount'] = session()->get('discount') ?? null;

        if (session()->get('discount') > 0) {
            $subtotal = Cart::subtotal() - session()->get('discount');
        } else {
            $subtotal = Cart::subtotal();
        }

        session(['subtotal' => $subtotal]);

        $data['subtotal'] = session()->get('subtotal');

        return view('customer.buy.cart', $data);
    }

    public function cartOrder($id) {
        try {
            $id = Crypt::decryptString($id);
        } catch (DecryptException $e) {
            return back();
        }

        session()->forget('discount');
        session()->forget('subtotal');
        session()->forget('buy');
        Cart::destroy();

        $data = [];

        $t = Buy::where('id', $id)->with('buyProduct')->first();

        if (CID() && SID() !== $t->shop_id) {
            return redirect()->back()->withToastError('Unauthorized access!!');
        }

        foreach ($t->buyProduct as $op) {
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
            'discount' => $t->discount,
            'subtotal' => $t->subtotal,
            'buy'      => $id,
        ]);

        return redirect()->route('customer.buy.cart');
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
        $data['price']            = $product->buying_price;
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
        session(['discount' => $request->discount, 'subtotal' => $request->subtotal]);

        return response()->json();
    }

    public function checkout() {

        if (session()->get('buy')) {
            $session_buy = Buy::find(session()->get('buy'));

            if ($session_buy->payment_method === 'Cash') {
                $cash = Cart::subtotal();
            } else {
                $cash = 0;
            }

            $session_buy->update([
                'total'    => Cart::subtotal(),
                'discount' => session()->get('discount'),
                'subtotal' => session()->get('subtotal'),
                'cash'     => $cash,
            ]);

            foreach (Cart::content() as $cart) {
                $check = BuyProduct::where('buy_id', session()->get('buy'))->where('product_id', $cart->id)->first();

                if ($check) {
                    $check->update(['quantity' => $cart->qty]);
                } else {
                    BuyProduct::create([
                        'product_id' => $cart->id,
                        'buy_id'     => session()->get('buy'),
                        'quantity'   => $cart->qty,
                        'price'      => $cart->price,
                    ]);
                }

            }

            session()->forget('discount');
            session()->forget('subtotal');
            session()->forget('buy');
            Cart::destroy();

            return redirect()->route('customer.buy.book')->withToastSucce('Buy book updated successfully');
        }

        $data              = [];
        $data['subtotal']  = session()->get('subtotal');
        $data['suppliers'] = Supplier::all();

        return view('customer.buy.checkout', $data);
    }

    public function placeOrder(Request $request) {

        if (Cart::count() <= 0) {
            return back();
        }

        if ($request->cash === null && $request->payment_method === 'Cash' && ($request->cash - $request->subtotal) < 0) {
            return redirect()->back()->withToastError('Cash payment input error.');
        }

        if ($request->payment_method === 'Cash') {
            $cash = $request->subtotal;
        } else {
            $cash = 0;
        }

        $data                   = [];
        $data['shop_id']        = SID();
        $data['supplier_id']    = $request->supplier_id;
        $data['total']          = Cart::subtotal();
        $data['subtotal']       = $request->subtotal;
        $data['discount']       = session()->get('discount');
        $data['cash']           = $cash;
        $data['payment_method'] = $request->payment_method;

        $buy = Buy::create($data);

        foreach (Cart::content() as $cart) {
            $order_product             = new BuyProduct();
            $order_product->buy_id     = $buy->id;
            $order_product->product_id = $cart->id;
            $order_product->quantity   = $cart->qty;
            $order_product->price      = $cart->price;
            $order_product->save();

            $product          = Product::find($cart->id);
            $updated_quantity = $product->quantity + $cart->qty;
            $product->update([
                'quantity' => $updated_quantity,
            ]);
        }

        session()->forget('discount');
        session()->forget('subtotal');
        Cart::destroy();

        if ($request->payment_method === 'Due') {
            $data['supplier_id'] = Crypt::encryptString($request->supplier_id ?? 'Supplier');
            $data['amount']      = Crypt::encryptString($request->subtotal);

            return redirect()->route('customer.due.create', $data);
        }

        return redirect()->route('customer.products.index')->withToastSuccess('New product added successfully!!');
    }

    public function buyBook() {
        $buys              = Buy::where('shop_id', SID())->orderBy('id', 'DESC')->whereMonth('created_at', now())->paginate(50);
        $total_transaction = 0;
        $count             = 0;

        foreach ($buys as $item) {
            $total_transaction += $item->subtotal;
        }

        return view('customer.buy.buy-book', compact('buys', 'total_transaction', 'count'));
    }

    public function buyBookDetails($id) {
        try {
            $id = Crypt::decryptString($id);
        } catch (DecryptException $e) {
            return back();
        }

        $data                = [];
        $data['transaction'] = $t = buy::where('id', $id)->with('buyProduct')->first();

        if (!$t || SID() !== $t->shop_id) {
            return redirect()->back()->withToastError('Unauthorized access!!');
        }

        return view('customer.buy.buy-book-details', $data);
    }

}
