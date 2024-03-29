<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Buy;
use App\Models\BuyProduct;
use App\Models\DigitalAmount;
use App\Models\DigitalPayment;
use App\Models\Due;
use App\Models\DueDetail;
use App\Models\ExpenseBookDetail;
use App\Models\OnlineOrder;
use App\Models\Order;
use App\Models\OrderProduct;
use App\Models\Product;
use App\Models\QRCode;
use App\Models\Shop;
use App\Models\Slider;
use App\Models\Subscription;
use App\Models\SubscriptionHistory;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class CustomerController extends Controller {
    public function getQRCode($shop_id) {
        $qr = QRCode::where('shop_id', $shop_id)->first();

        return $qr;
    }

    public function storeQRCode(Request $request) {

        if ($request->hasFile('bkash')) {

            $image_file = $request->file('bkash');

            if ($image_file) {

                $img_gen   = hexdec(uniqid());
                $image_url = 'images/qr/';
                $image_ext = strtolower($image_file->getClientOriginalExtension());

                $img_name = $img_gen . '.' . $image_ext;
                $bkash    = $image_url . $img_gen . '.' . $image_ext;

                $image_file->move($image_url, $img_name);
                QRCode::updateOrcreate(
                    ['shop_id' => $request->shop_id],
                    [
                        'bkash' => $bkash,
                    ]
                );
            }

        }

        if ($request->hasFile('nagad')) {

            $image_file = $request->file('nagad');

            if ($image_file) {

                $img_gen   = hexdec(uniqid());
                $image_url = 'images/qr/';
                $image_ext = strtolower($image_file->getClientOriginalExtension());

                $img_name = $img_gen . '.' . $image_ext;
                $nagad    = $image_url . $img_gen . '.' . $image_ext;

                $image_file->move($image_url, $img_name);
                QRCode::updateOrcreate(
                    ['shop_id' => $request->shop_id],
                    [
                        'nagad' => $nagad,
                    ]
                );
            }

        }

        if ($request->hasFile('rocket')) {

            $image_file = $request->file('rocket');

            if ($image_file) {

                $img_gen   = hexdec(uniqid());
                $image_url = 'images/qr/';
                $image_ext = strtolower($image_file->getClientOriginalExtension());

                $img_name = $img_gen . '.' . $image_ext;
                $rocket   = $image_url . $img_gen . '.' . $image_ext;

                $image_file->move($image_url, $img_name);
                QRCode::updateOrcreate(
                    ['shop_id' => $request->shop_id],
                    [
                        'rocket' => $rocket,
                    ]
                );
            }

        }

        if ($request->hasFile('others')) {

            $image_file = $request->file('others');

            if ($image_file) {

                $img_gen   = hexdec(uniqid());
                $image_url = 'images/qr/';
                $image_ext = strtolower($image_file->getClientOriginalExtension());

                $img_name = $img_gen . '.' . $image_ext;
                $others   = $image_url . $img_gen . '.' . $image_ext;

                $image_file->move($image_url, $img_name);
                QRCode::updateOrcreate(
                    ['shop_id' => $request->shop_id],
                    [
                        'others' => $others,
                    ]
                );
            }

        }

        return response()->json(['status' => true]);
    }

    public function buyBook($shop_id) {
        $data = [];
        $buys = Buy::where('shop_id', $shop_id);

        if (request()->type == 1) {
            $date = Carbon::parse(request()->selected_date)->format('Y-m-d');
            $buys = $buys->whereDate('created_at', $date);
        } elseif (request()->type == 2) {
            $year  = Carbon::parse(request()->selected_date)->format('Y');
            $month = Carbon::parse(request()->selected_date)->format('m');
            $buys  = $buys->whereYear('created_at', $year)->whereMonth('created_at', $month);
        } elseif (request()->type == 3) {
            $date_from = Carbon::parse(request()->date_from)->format('Y-m-d');
            $date_to   = Carbon::parse(request()->date_to)->format('Y-m-d');
            $buys      = $buys->whereBetween('created_at', [$date_from . " 00:00:00", $date_to . " 23:59:59"]);
        } elseif (request()->type == 4) {
            $date = Carbon::parse(request()->selected_date)->format('Y-m-d');
            $buys = $buys->whereYear('created_at', $date);
        }

        $data['buys'] = $buys = $buys->with(['supplier', 'buyProduct.prod' => function ($query) {
            return $query->select('id', 'name');
        },
        ])
            ->orderBy('updated_at', 'DESC')
            ->paginate(500);
        $total_transaction = 0;
        $count             = 0;

        foreach ($buys as $item) {
            $total_transaction += $item->subtotal;
        }

        $data['total_transaction'] = $total_transaction;
        $data['count']             = $count;

        return $data;
    }

    public function buyBookDetails($id) {

        $data                = [];
        $data['transaction'] = buy::where('id', $id)->with(['supplier', 'buyProduct.prod' => function ($query) {
            return $query->select('id', 'name');
        },
        ])->first();

        return $data;
    }

    public function onlineShop($shop_id) {
        $data = [];

        $data['active_order']   = OnlineOrder::where('shop_id', $shop_id)->where('status', '!=', 5)->count();
        $data['online_product'] = Product::where('shop_id', $shop_id)->whereNotNull('category_id')->count();
        $data['earn']           = OnlineOrder::where('shop_id', $shop_id)->where('status', 5)->select(['total'])->sum('total');

        return $data;
    }

    public function shopList($customer_id) {
        $data = [];

        $data['shops'] = Shop::where('customer_id', $customer_id)->with('division', 'district', 'area', 'shopType')->get();

        return $data;
    }

    public function shopDetails($id) {
        $shop = Shop::where('id', $id)->with('division', 'district', 'area', 'shopType')->first();

        return $shop;
    }

    public function digitalBalance($shop_id) {
        $balance = DigitalAmount::where('shop_id', $shop_id)->first();

        return $balance ?? [];
    }

    public function storeWithdraw(Request $request) {
        $digital = DigitalAmount::where('shop_id', $request->shop_id)->first();

        if (!$digital || $digital->amount < 200) {
            return response()->json(['status' => false, 'message' => 'Insufficient digital balance.']);
        }

        $digital->update(['account_type' => $request->account_type, 'phone' => $request->phone]);

        return response()->json(['status' => true]);
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
            'customer_id'        => $request->customer_id,
            'name'               => $request->name,
            'division_id'        => $request->division_id,
            'district_id'        => $request->district_id,
            'area_id'            => $request->area_id,
            'shop_type_id'       => $request->shop_type_id,
            'image'              => $final_name1,
            'payment_link'       => Str::slug($request->name),
            'online_market_link' => Str::slug($request->name),
            'end_date'           => date("Y-m-d", strtotime('+15 days')),
        ]);

        return response()->json(['status' => true, 'message' => 'New shop created successfully!!']);
    }

    public function dashboard(Request $request) {
        $data           = [];
        $data['sales']  = Order::whereDay('created_at', today())->where('shop_id', $request->shop_id)->select('subtotal')->sum('subtotal');
        $dues           = Due::where('shop_id', $request->shop_id)->with('dueDetails')->get();
        $total_due      = 0;
        $total_deposite = 0;

        foreach ($dues as $due) {

            foreach ($due->dueDetails as $d) {

                if ($d->due_type === 'Due' && $d->created_at == today()) {
                    $total_due += $d->amount;
                } elseif ($d->due_type === 'Deposit' && $d->created_at == today()) {
                    $total_deposite += $d->amount;
                }

            }

        }

        $data['expenses'] = ExpenseBookDetail::where('shop_id', $request->shop_id)->whereDay('created_at', '=', today())
            ->select('amount')
            ->sum('amount');
        $data['due']     = $total_due;
        $data['balance'] = $total_deposite;

        return $data;
    }

    public function updateStoreInformation(Request $request, Shop $shop) {
        $shop->update($request->all());

        return response()->json(['status' => true, 'message' => 'Store information updated successfully!!']);
    }

    public function updateStoreLogo(Request $request, Shop $shop) {

        if ($request->hasFile('image')) {

            $image_file = $request->file('image');

            if ($image_file) {

                $image_path = public_path($shop->image);

                if (File::exists($image_path)) {
                    File::delete($image_path);
                }

                $img_gen   = hexdec(uniqid());
                $image_url = 'images/shop/';
                $image_ext = strtolower($image_file->getClientOriginalExtension());

                $img_name    = $img_gen . '.' . $image_ext;
                $final_name1 = $image_url . $img_gen . '.' . $image_ext;

                $image_file->move($image_url, $img_name);

                $shop->image = $final_name1;
                $shop->save();

                return response()->json(['status' => true, 'message' => 'Shop image updated!']);
            }

        }

    }

    public function updateStoreSocial(Request $request, Shop $shop) {
        $shop->update($request->all());

        return response()->json(['status' => true, 'message' => 'Store social link updated successfully!!']);
    }

    public function updateStoreOML(Request $request, Shop $shop) {
        $link = Str::slug($request->online_market_link);

        $shops = Shop::select('online_market_link')->get();

        foreach ($shops as $ss) {

            if ($ss === $link) {
                return response()->json(['status' => false, 'message' => 'The link you are trying, other people has used that link before. Make some change in your link and try again.']);
            }

        }

        $shop->update(['online_market_link' => $link]);

        return response()->json(['status' => true, 'message' => 'Store online market link updated successfully!!']);
    }

    public function storeShopBanner(Request $request) {

        if ($request->hasFile('image')) {

            $image_file = $request->file('image');

            if ($image_file) {

                $img_gen   = hexdec(uniqid());
                $image_url = 'images/banner/';
                $image_ext = strtolower($image_file->getClientOriginalExtension());

                $img_name    = $img_gen . '.' . $image_ext;
                $final_name1 = $image_url . $img_gen . '.' . $image_ext;

                $image_file->move($image_url, $img_name);
            }

        } else {
            return back();
        }

        Slider::create([
            'shop_id' => $request->shop_id,
            'image'   => $final_name1,
        ]);

        return response()->json(['status' => true, 'message' => 'Store banner created successfully!!']);

    }

    public function deleteShopBanner(Request $request, $id) {
        $slider     = Slider::find($id);
        $image_path = public_path($slider->image);

        if (File::exists($image_path)) {
            File::delete($image_path);
        }

        $slider->delete();

        return response()->json(['status' => true, 'message' => 'Store banner deleted successfully!!']);

    }

    public function sliderList($shop_id) {
        $slider = Slider::where('shop_id', $shop_id)->get();

        return $slider;
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

        return response()->json(['status' => true, 'order' => $order]);
    }

    public function orderSave(Request $request) {

        $data = [];

        if ($request->cash === null && $request->payment_method === 'Cash' && ($request->cash - $request->subtotal) < 0) {
            return 'Cash payment input error.';
        }

        if ($request->payment_method === 'Digital Payment' && $request->consumer_id === null) {
            return 'Customer information is needed for digital payment';
        }

        if ($request->payment_method === 'Due') {
            $cash = $request->cash;
        } else {
            $cash = $request->subtotal;
        }

        if ($request->discount && $request->discount_type == 1) {
            $discount = ($request->subtotal * $request->discount) / 100;
        } else {
            $discount = $request->discount;
        }

        $data                    = [];
        $data['shop_id']         = $request->shop_id;
        $data['consumer_id']     = $request->consumer_id;
        $data['employee_id']     = $request->employee_id;
        $data['total']           = $request->total;
        $data['subtotal']        = $request->subtotal - $discount;
        $data['discount']        = $discount;
        $data['cash']            = $cash;
        $data['payment_method']  = $request->payment_method;
        $data['delivery_charge'] = $request->delivery_charge;

        $order = Order::create($data);

        if ($request->payment_method === 'Digital Payment') {
            $data['digital_payment'] = DigitalPayment::create([
                'shop_id' => $request->shop_id,
                'name'    => $order->consumer->name,
                'phone'   => $order->consumer->name,
                'amount'  => $request->subtotal,
                'status'  => 'pending',
                'link'    => $request->shop_id . bin2hex(random_bytes(5)) . time(),
            ]);
        }

        $carts = $request->cart;

        foreach ($carts as $cart) {
            $order_product              = new OrderProduct();
            $order_product->shop_id     = $request->shop_id;
            $order_product->consumer_id = $request->consumer_id;
            $order_product->order_id    = $order->id;
            $order_product->product_id  = $cart["id"];
            $order_product->quantity    = $cart["qty"];
            $order_product->price       = $cart["price"];
            $order_product->save();

            $product          = Product::find($cart["id"]);
            $updated_quantity = $product->quantity - $cart["qty"];
            $product->update([
                'quantity' => $updated_quantity,
            ]);
        }

        $data['order'] = Order::where('id', $order->id)->with('orderProduct', 'orderProduct.prod')->first();

        return response()->json(['status' => true, 'message' => 'Order placed successfully!!', 'order' => $data]);
    }

    public function deleteOrderProduct(Request $request) {

        $op = OrderProduct::whereIn('id', $request->id)->get();

        foreach ($op as $p) {
            $p->delete();
        }

        return response()->json(['status' => true]);
    }

    public function transactionUpdate(Request $request) {
/**
 * order_id
 * cash
 * cart_subtotal
 * cart
 */

        $session_order = Order::where('id', $request->order_id)->with(['orderProduct.prod' => function ($query) {
            return $query->select(['id', 'name']);
        },
        ])->first();

// return $session_order;

        if ($session_order->payment_method === 'Due') {
            $cash = $session_order->cash + $request->cash;
            $due  = Due::where('due_to', 'Consumer')->where('due_to_id', $session_order->consumer_id)->first();

            if ($session_order->subtotal < $request->cart_subtotal) {
                DueDetail::create([
                    'due_id'   => $due->id,
                    'amount'   => $request->cart_subtotal - $session_order->subtotal,
                    'due_type' => 'Due',
                ]);
            } elseif ($session_order->subtotal > $request->cart_subtotal) {

                if ($request->cash > 0) {
                    DueDetail::create([
                        'due_id'   => $due->id,
                        'amount'   => $session_order->subtotal + $request->cash - $request->cart_subtotal,
                        'due_type' => 'Due',
                    ]);
                } else {
                    DueDetail::create([
                        'due_id'   => $due->id,
                        'amount'   => $session_order->subtotal - $request->cart_subtotal,
                        'due_type' => 'Deposit',
                    ]);
                }

            }

            if ($request->cash > 0) {
                DueDetail::create([
                    'due_id'   => $due->id,
                    'amount'   => $request->cash,
                    'due_type' => 'Deposit',
                ]);
            }

            $subtotal = $request->cart_subtotal;
        } else {
            $subtotal = $request->cart_subtotal;
            $cash     = $request->cart_subtotal;
        }

        if ($request->discount && $request->discount_type == 1) {
            $discount = ($subtotal * $request->discount) / 100;
        } else {
            $discount = $request->discount;
        }

        $session_order->update([
            'total'           => $subtotal + $request->delivery_charge,
            'discount'        => $discount,
            'delivery_charge' => $request->delivery_charge,
            'subtotal'        => $subtotal + $request->delivery_charge - $discount,
            'cash'            => $cash,
        ]);

        if ($request->cart) {

            foreach ($request->cart as $cart) {
                $check = OrderProduct::where('order_id', $request->order_id)->where('product_id', $cart["id"])->first();

                if ($check) {
                    $check->quantity = $cart["qty"];
                    $check->save();

                    $product          = Product::find($cart["id"]);
                    $updated_quantity = $product->quantity - $cart["qty"];
                    $product->update([
                        'quantity' => $updated_quantity,
                    ]);
                } else {
                    OrderProduct::create([
                        'product_id' => $cart["id"],
                        'order_id'   => $request["order_id"],
                        'quantity'   => $cart["qty"],
                        'price'      => $cart["price"],
                    ]);

                    $product          = Product::find($cart["id"]);
                    $updated_quantity = $product->quantity - $cart["qty"];
                    $product->update([
                        'quantity' => $updated_quantity,
                    ]);
                }

            }

        }

        return response()->json(['status' => true]);
    }

    public function transactionDelete($id) {
        $order = Order::where('id', $id)->with('orderProduct')->first();

        if ($order->payment_method === 'Due') {
            $due = Due::where('due_to', 'Consumer')->where('due_to_id', $order->consumer_id)->first();
            DueDetail::create([
                'due_id'   => $due->id,
                'amount'   => $order->subtotal - $order->cash,
                'due_type' => 'Deposit',
            ]);
        }

        foreach ($order->orderProduct as $p) {
            $p->delete();
        }

        $order->delete();

        return response()->json(['status' => true]);
    }

    public function buyOrderSave(Request $request) {

        if ($request->payment_method === 'Due') {
            $cash = $request->cash;
        } else {
            $cash = $request->subtotal;
        }

        if ($request->discount && $request->discount_type == 1) {
            $discount = ($request->subtotal * $request->discount) / 100;
        } else {
            $discount = $request->discount;
        }

        $data                    = [];
        $data['shop_id']         = $request->shop_id;
        $data['supplier_id']     = $request->supplier_id;
        $data['total']           = $request->total;
        $data['subtotal']        = $request->subtotal - $discount;
        $data['discount']        = $discount;
        $data['cash']            = $cash;
        $data['payment_method']  = $request->payment_method;
        $data['delivery_charge'] = $request->delivery_charge;

        $buy = Buy::create($data);

        $carts = $request->cart;

        foreach ($carts as $cart) {
            $order_product             = new BuyProduct();
            $order_product->buy_id     = $buy->id;
            $order_product->product_id = $cart["id"];
            $order_product->quantity   = $cart["qty"];
            $order_product->price      = $cart["price"];
            $order_product->save();

            $product          = Product::find($cart["id"]);
            $updated_quantity = $product->quantity + $cart["qty"];
            $product->update([
                'quantity' => $updated_quantity,
            ]);
        }

        return response()->json(['status' => true, 'message' => 'Order placed successfully!!']);
    }

    public function buyOrderUpdate(Request $request) {

        $buy = Buy::find($request->id);

        if ($request->payment_method === 'Due') {
            $cash = $buy->cash + $request->cash;
        } else {
            $cash = $request->subtotal;
        }

        if ($request->discount && $request->discount_type == 1) {
            $discount = ($request->subtotal * $request->discount) / 100;
        } else {
            $discount = $request->discount;
        }

        $data                    = [];
        $data['supplier_id']     = $request->supplier_id;
        $data['total']           = $request->total;
        $data['subtotal']        = $request->subtotal - $discount;
        $data['discount']        = $discount;
        $data['cash']            = $cash;
        $data['payment_method']  = $request->payment_method;
        $data['delivery_charge'] = $request->delivery_charge;

        $buy->update($data);

        $carts = $request->cart;

        if ($carts) {
            foreach ($carts as $cart) {
                $check = BuyProduct::where('buy_id', $request->id)->where('product_id', $cart["id"])->first();

                if ($check) {
                    $check->quantity = $cart["qty"];
                    $check->save();

                    $product          = Product::find($cart["id"]);
                    $updated_quantity = $product->quantity + $cart["qty"];
                    $product->update([
                        'quantity' => $updated_quantity,
                    ]);
                } else {
                    BuyProduct::create([
                        'product_id' => $cart["id"],
                        'buy_id'     => $request["id"],
                        'quantity'   => $cart["qty"],
                        'price'      => $cart["price"],
                    ]);

                    $product          = Product::find($cart["id"]);
                    $updated_quantity = $product->quantity + $cart["qty"];
                    $product->update([
                        'quantity' => $updated_quantity,
                    ]);
                }

            }

        }

        return response()->json(['status' => true, 'pre_subtotal' => $buy->subtotal, 'data' => $buy]);
    }

    public function buyProductDelete(Request $request) {

        $op = BuyProduct::whereIn('id', $request->id)->get();

        foreach ($op as $p) {
            $p->delete();
        }

        return response()->json(['status' => true]);
    }

    public function buyOrderdelete($id) {
        $buy = Buy::where('id', $id)->with('buyProduct')->first();

        if ($buy->payment_method === 'Due') {
            $due = Due::where('due_to', 'Supplier')->where('due_to_id', $buy->supplier_id)->first();
            DueDetail::create([
                'due_id'   => $due->id,
                'amount'   => $buy->subtotal - $buy->cash,
                'due_type' => 'Deposit',
            ]);
        }

        foreach ($buy->buyProduct as $p) {
            $p->delete();
        }

        $buy->delete();

        return response()->json(['status' => true]);
    }

    public function transaction($shop_id) {

        $data   = [];
        $orders = Order::where('shop_id', $shop_id);

        if (request()->type == 1) {
            $date   = Carbon::parse(request()->selected_date)->format('Y-m-d');
            $orders = $orders->whereDate('created_at', $date);
        } elseif (request()->type == 2) {
            $year   = Carbon::parse(request()->selected_date)->format('Y');
            $month  = Carbon::parse(request()->selected_date)->format('m');
            $orders = $orders->whereYear('created_at', $year)->whereMonth('created_at', $month);
        } elseif (request()->type == 3) {
            $date_from = Carbon::parse(request()->date_from)->format('Y-m-d');
            $date_to   = Carbon::parse(request()->date_to)->format('Y-m-d');
            $orders    = $orders->whereBetween('created_at', [$date_from . " 00:00:00", $date_to . " 23:59:59"]);
        } elseif (request()->type == 4) {
            $date   = Carbon::parse(request()->selected_date)->format('Y-m-d');
            $orders = $orders->whereYear('created_at', $date);
        }

        $data['orders'] = $orders = $orders->where('shop_id', $shop_id)
            ->with(['consumer', 'employee', 'orderProduct.prod' => function ($query) {
                return $query->select('id', 'name', 'buying_price');
            },
            ])->orderBy('id', 'DESC')->paginate(500);

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
        $data['transaction'] = Order::where('id', $id)->with(['consumer', 'employee', 'orderProduct.prod' => function ($query) {
            return $query->select(['id', 'name'])->get();
        },
        ])->first();

        return $data;
    }

    public function orderList($shop_id) {
        $data           = [];
        $data['orders'] = Order::where('shop_id', $shop_id)->orderBy('id', 'desc')->with(['orderProduct', 'orderProduct.prod' => function ($query) {
            return $query->select(['id', 'name']);
        },
        ])->paginate(500);

        return $data;
    }

    public function orderDetails($id) {
        $data          = [];
        $data['order'] = $order = Order::find($id);

        $data['orderProduct'] = OrderProduct::with(['prod' => function ($query) {
            return $query->select(['id', 'name']);
        },

        ])->where('order_id', $order->id)->get();

        return $data;
    }

    public function onlineProduct($shop_id) {
        $products = Product::where('shop_id', $shop_id)->where('online', 1)->whereNotNull('category_id')->paginate(500);

        return $products;
    }

    public function onlineProductDetails($id) {
        $product = Product::find($id);

        if ($product->online !== 1 && $product->category_id === null) {
            return response()->json(['status' => false]);
        }

        return $product;
    }

    public function onlineOrderList($shop_id) {
        $data                 = [];
        $data['online_order'] = OnlineOrder::where('shop_id', $shop_id)
            ->with(['division', 'district', 'area', 'onlineOrderProducts.prod' => function ($query) {
                return $query->select('id', 'name', 'buying_price');
            },
            ])
            ->orderBy('id', 'desc')
            ->paginate(500);

        return $data;
    }

    public function onlineOrderDetails($order_id) {
        $data                 = [];
        $data['online_order'] = OnlineOrder::where('id', $order_id)
            ->with(['division', 'district', 'area', 'onlineOrderProducts.prod' => function ($query) {
                return $query->select('id', 'name', 'buying_price');
            },
            ])->first();

        return $data;
    }

    public function onlineOrderStatus(Request $request, $id) {
        $order         = OnlineOrder::find($id);
        $order->status = $request->status;
        $order->save();

        return response()->json(['status' => true, 'message' => 'Order status updated successfully!!']);
    }

    public function searchOnlineOrderList(Request $request) {

        $search           = $request->input('phone');
        $data             = [];
        $data['products'] = OnlineOrder::query()
            ->where('shop_id', $request->shop_id)
            ->where('phone', 'LIKE', "%{$search}%")
            ->orWhere('status', $request->status)
            ->paginate(500);
        $data['search'] = $search;

        return $data;
    }

    public function subscriptionList($type) {
        $subscription = Subscription::where('package_type', $type)->get();

        return $subscription;
    }

    public function subscriptionHistory($shop_id) {
        $histories = SubscriptionHistory::where('shop_id', $shop_id)->where('status', '!=', 'Pending')->orderBy('id', 'desc')->with('subscription')->get();

        return $histories;
    }

    public function presentSubscription($shop_id) {
        $access = SubscriptionHistory::with('subscription')->where('shop_id', $shop_id)->orderBy('id', 'desc')->first();

        return $access;
    }

    public function updateQuantity(Request $request) {
        foreach ($request->id as $key => $value) {
            $product = Product::find($value);
            $product->update(['quantity' => $request->quantity[$key]]);

        }

        return response()->json(['status' => true]);
    }

}
