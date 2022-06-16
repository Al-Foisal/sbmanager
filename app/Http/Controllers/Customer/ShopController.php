<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Models\Division;
use App\Models\OnlineOrder;
use App\Models\Order;
use App\Models\OrderProduct;
use App\Models\Product;
use App\Models\Shop;
use App\Models\ShopType;
use App\Models\Slider;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class ShopController extends Controller {
    public function onlineShop() {
        $data                = [];
        $data['socialShare'] = \Share::page(
            route('shop.singleShopIndex', SHOP()->online_market_link),
            'Make your digital payment through this link.',
        )
            ->facebook()
            ->twitter()
            ->reddit()
            ->linkedin()
            ->whatsapp()
            ->telegram();

        $data['active_order']   = OnlineOrder::where('shop_id', SID())->where('status', '!=', 5)->count();
        $data['online_product'] = Product::where('shop_id', SID())->whereNotNull('category_id')->count();
        $data['earn']           = OnlineOrder::where('shop_id', SID())->where('status', 5)->select(['total'])->sum('total');

        return view('customer.shop.online-shop', $data);
    }

    public function list() {
        $data = [];
        
        //reset all session
        session()->forget('discount');
        session()->forget('subtotal');
        session()->forget('shop_id');
        Cart::destroy();

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
            'online_market_link' => Str::slug($request->name),
        ]);

        return redirect()->back()->withToastSuccess('New shop created successfu;;y!!');
    }

    public function editStore() {
        $data = [];

        $data['shop']      = Shop::where('id', SID())->where('customer_id', CID())->first();
        $data['shop_type'] = ShopType::all();
        $data['divisions'] = Division::all();
        $data['slider']    = Slider::where('shop_id', SID())->get();

        return view('customer.shop.shop-edit', $data);
    }

    public function updateStoreInformation(Request $request, Shop $shop) {
        $shop->update($request->all());

        return redirect()->back()->withToastSuccess('Store information updated successfully!!');
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
                $shop->update(
                    [
                        'image' => $final_name1,
                    ]
                );
            }

        }

        return redirect()->back()->withToastSuccess('Store logo updated successfully!!');

    }

    public function updateStoreSocial(Request $request, Shop $shop) {
        $shop->update($request->all());

        return redirect()->back()->withToastSuccess('Store social link updated successfully!!');
    }

    public function updateStoreOML(Request $request, Shop $shop) {
        $link = Str::slug($request->online_market_link);

        $shops = Shop::select('online_market_link')->get();

        foreach ($shops as $ss) {

            if ($ss === $link) {
                return redirect()->back()->withToastInfo('The link you are trying, other people has used that link before. Make some change in your link and try again.');
            }

        }

        $shop->update(['online_market_link' => $link]);

        return redirect()->back()->withToastSuccess('Store online market link updated successfully!!');
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
            'shop_id' => SID(),
            'image'   => $final_name1,
        ]);

        return redirect()->back()->withToastSuccess('Store banner created successfully!!');

    }

    public function deleteShopBanner(Request $request, $id) {
        $slider     = Slider::find($id);
        $image_path = public_path($slider->image);

        if (File::exists($image_path)) {
            File::delete($image_path);
        }

        $slider->delete();

        return redirect()->back()->withToastSuccess('Store banner deleted successfully!!');

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

    public function onlineOrderList() {
        $data           = [];
        $data['orders'] = OnlineOrder::where('shop_id', SID())->orderBy('id', 'desc')->with('onlineOrderProducts')->paginate(50);

        return view('customer.shop.online-order-list', $data);
    }

    public function onlineOrderListDetails($id) {
        $data          = [];
        $data['order'] = $order = OnlineOrder::where('id', $id)->first();

        if (!$order || $order->shop_id !== SID()) {
            return back();
        }

        $data['shop'] = SHOP();
        // $data['orderProduct'] = OnlineOrderProduct::where('online_order_id', $order->id)->get();

        return view('customer.shop.online-order-details', $data);
    }

    public function onlineOrderStatus(Request $request, $id) {
        $order         = OnlineOrder::find($id);
        $order->status = $request->status;
        $order->save();

        return redirect()->back()->withToastSuccess('Order status updated!!');
    }

    public function onlineOrderDelete(Request $request) {
        $order = OnlineOrder::find($request->id);
        $order->delete();

        return redirect()->route('customer.shop.onlineOrderList')->withToastSuccess('Order Deleted!!');
    }

    public function onlineProduct() {
        $products = Product::where('shop_id', SID())->where('online', 1)->paginate(50);

        return view('customer.shop.online-product', compact('products'));
    }

}
