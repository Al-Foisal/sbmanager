<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class SearchController extends Controller {
    public function fetchProductData(Request $request) {
        $name = request()->name;
        $shop_id = request()->shop_id;
        $products = Product::query()
            ->where('shop_id', $shop_id)
            ->where('name', 'LIKE', "%{$name}%")
            ->get();

        return $products;
    }
}
