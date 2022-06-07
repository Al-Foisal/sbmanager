<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Shop;
use Illuminate\Http\Request;

class CustomerController extends Controller {
    public function shopList($customer_id) {
        $data = [];

        $data['shops'] = Shop::where('customer_id', $customer_id)->get();

        return $data;
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
            'customer_id' => $request->customer_id,
            'name'        => $request->name,
            'image'       => $final_name1,
        ]);

        return response()->json(['status' => true, 'message' => 'New shop created successfully!!']);
    }

    public function dashboard(Request $request) {
        $data             = [];
        $data['sales']    = 1;
        $data['expenses'] = 2;
        $data['due']      = 3;
        $data['balance']  = 4;

        return $data;
    }


}
