<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Gloudemans\Shoppingcart\Facades\Cart;

class FrontendController extends Controller {
    public function onlineMarket() {
        $data               = [];
        $data['categories'] = Category::where('online', 1)->get();
        $data['products']   = Product::whereNotNull('category_id')->get();

        return view('market.online-market', $data);
    }

    public function categoryProduct($slug) {
        $category = Category::where('slug', $slug)->first();
        $products = Product::where('category_id', $category->id)->get();

        return view('market.category-product', compact('products','category'));
    }

    public function productDetails($slug) {
        $product = Product::where('slug', $slug)->first();

        return view('market.product-details', compact('product'));
    }

    public function cartProduct() {
        $carts = Cart::content();

        return view('market.cart-product', compact('carts'));
    }
}
