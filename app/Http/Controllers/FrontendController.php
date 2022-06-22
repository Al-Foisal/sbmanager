<?php

namespace App\Http\Controllers;

use App\Models\AdminOrder;
use App\Models\Category;
use App\Models\Contact;
use App\Models\Feature;
use App\Models\Package;
use App\Models\Product;
use App\Models\Slider;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;

class FrontendController extends Controller {
    public function homePage() {
        $data             = [];
        $data['slider']   = Slider::where('shop_id', null)->get();
        $data['features'] = Feature::all();
        $data['packages'] = Package::with('packageDetails')->get();

        return view('frontend.master', $data);
    }

    public function submitContact(Request $request) {
        Contact::create([
            'name'    => $request->name,
            'email'   => $request->email,
            'phone'   => $request->phone,
            'subject' => $request->subject,
            'message' => $request->message,
            'status'  => 0,
        ]);

        return redirect()->back()->withToastSuccess('Your message has been submitted, an admin will contact with you soon!!');
    }

    public function onlineMarket() {
        session(['online_market_shop' => request()->shop_id]);
        $data               = [];
        $data['categories'] = Category::where('online', 1)->get();
        $data['products']   = Product::whereNull('shop_id')->get();

        return view('market.online-market', $data);
    }

    public function categoryProduct($slug) {
        $category = Category::where('slug', $slug)->first();
        $products = Product::where('category_id', $category->id)->get();

        return view('market.category-product', compact('products', 'category'));
    }

    public function productDetails($slug) {
        $product = Product::where('slug', $slug)->first();

        return view('market.product-details', compact('product'));
    }

    public function cartProduct() {
        $carts    = Cart::content();
        $products = AdminOrder::where('shop_id', session()->get('online_market_shop'))->orderBy('id', 'desc')->get();

        return view('market.cart-product', compact('carts', 'products'));
    }
}
