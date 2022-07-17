<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\EMI;
use App\Models\Product;
use Illuminate\Http\Request;

class SearchController extends Controller {
    public function fetchProductData(Request $request) {
        $name     = request()->name;
        $shop_id  = request()->shop_id;
        $products = Product::query()
            ->where('shop_id', $shop_id)
            ->where('name', 'LIKE', "%{$name}%")
            ->get();

        return $products;
    }

    public function fetchEMIData(Request $request) {
        $name     = request()->name;
        $phone    = request()->phone;
        $shop_id  = request()->shop_id;
        $products = EMI::query()
            ->where('shop_id', $shop_id)
            ->orWhere('name', 'LIKE', "%{$name}%")
            ->orWhere('phone', 'LIKE', "%{$phone}%")
            ->get();

        return $products;
    }
}
