<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Subcategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class ProductController extends Controller {
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($shop_id) {
        $products = Product::where('shop_id', $shop_id)->with('category', 'subcategory')->get();

        return $products;
    }

    public function commonProduct($shop_id) {
        $product = Product::where('shop_id', $shop_id);

        $sub                 = Product::where('shop_id', $shop_id)->pluck('subcategory_id')->toArray();
        $data['subcategory'] = Subcategory::whereIn('id', $sub)->get();

        $subcategory = request()->id;

        if ($subcategory) {
            $product = $product->where('subcategory_id', $subcategory);
        }

        $data['products'] = $product->with('category', 'subcategory')->paginate(50);

        return $data;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $shop_id) {

        if ($request->hasFile('image')) {

            $image_file = $request->file('image');

            if ($image_file) {

                $img_gen   = hexdec(uniqid());
                $image_url = 'images/product/';
                $image_ext = strtolower($image_file->getClientOriginalExtension());

                $img_name    = $img_gen . '.' . $image_ext;
                $final_name1 = $image_url . $img_gen . '.' . $image_ext;

                $image_file->move($image_url, $img_name);
            }

        }

        $product = Product::create([
            'shop_id'            => $shop_id,
            'name'               => $request->name,
            'quantity'           => $request->quantity,
            'price'              => $request->price,
            'buying_price'       => $request->buying_price,
            'details'            => $request->details,
            'category_id'        => $request->category_id,
            'subcategory_id'     => $request->subcategory_id,
            'online'             => $request->online,
            'unit'               => $request->unit,
            'wholesale_price'    => $request->wholesale_price,
            'wholesale_quantity' => $request->wholesale_quantity,
            'stock_alert'        => $request->stock_alert,
            'vat'                => $request->vat,
            'warranty'           => $request->warranty,
            'warranty_type'      => $request->warranty_type,
            'discount'           => $request->discount,
            'discount_type'      => $request->discount_type,
            'image'              => $final_name1 ?? null,
        ]);

        return response()->json(['status' => true, 'product' => $product]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id, Product $product) {
        return $product;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id, Product $product) {

        if ($request->hasFile('image')) {

            $image_file = $request->file('image');

            if ($image_file) {

                $image_path = public_path($product->image);

                if (File::exists($image_path)) {
                    File::delete($image_path);
                }

                $img_gen   = hexdec(uniqid());
                $image_url = 'images/product/';
                $image_ext = strtolower($image_file->getClientOriginalExtension());

                $img_name    = $img_gen . '.' . $image_ext;
                $final_name1 = $image_url . $img_gen . '.' . $image_ext;

                $image_file->move($image_url, $img_name);
                $product->image=$final_name1;
                $product->save();
            }

        }

        $product->update([
            'name'               => $request->name,
            'quantity'           => $request->quantity,
            'price'              => $request->price,
            'buying_price'       => $request->buying_price,
            'details'            => $request->details,
            'category_id'        => $request->category_id,
            'subcategory_id'     => $request->subcategory_id,
            'online'             => $request->online,
            'unit'               => $request->unit,
            'wholesale_price'    => $request->wholesale_price,
            'wholesale_quantity' => $request->wholesale_quantity,
            'stock_alert'        => $request->stock_alert,
            'vat'                => $request->vat,
            'warranty'           => $request->warranty,
            'warranty_type'      => $request->warranty_type,
            'discount'           => $request->discount,
            'discount_type'      => $request->discount_type,
        ]);

        return response()->json(['status' => true, 'product' => $product]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id, Product $product) {
        $image_path = public_path($product->image);

        if (File::exists($image_path)) {
            File::delete($image_path);
        }

        $product->delete();

        return response()->json(['status' => true]);
    }

}
