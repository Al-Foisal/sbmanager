<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class SearchController extends Controller {
    public function fetchProductData(Request $request) {

        $products = Product::query()
            ->where('shop_id', $request->shop_id)
            ->where('name', 'LIKE', "%{$request->name}%")
            ->get();

        return $products;
    }
}
