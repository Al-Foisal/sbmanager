<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use App\Models\Subcategory;
use Illuminate\Contracts\Encryption\DecryptException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class ProductController extends Controller {
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        $products = Product::where('shop_id', SID())->get();

        return view('customer.product.index', compact('products'));
    }

    public function indexList() {
        $data    = [];
        $product = Product::where('shop_id', SID());

        $sub                 = Product::where('shop_id', SID())->pluck('subcategory_id')->toArray();
        $data['subcategory'] = Subcategory::whereIn('id', $sub)->get();

        $subcategory = request()->id;

        if ($subcategory) {
            $product = $product->where('subcategory_id', $subcategory);
        }

        $data['products'] = $product->paginate(50);

        return view('customer.product.indexlist', $data);
    }

    function fetch_search_data(Request $request) {

        if ($request->ajax()) {
            $name = $request->get('name');
            $name = str_replace(" ", "%", $name);

            $products = DB::table('products')
                ->where('shop_id', SID())
                ->where('name', 'like', '%' . $name . '%')
                ->orderBy('name', 'ASC')
                ->paginate(50);

            return view('customer.product.product_search_paginate', compact('products'))->render();
        }

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        $data               = [];
        $data['categories'] = Category::where('status', 1)->get();

        return view('customer.product.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {

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

        Product::create([
            'shop_id'            => SID(),
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

        return redirect()->back()->withToastSuccess('Product added successfully!!');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id) {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id) {
        try {
            $id = Crypt::decryptString($id);
        } catch (DecryptException $e) {
            return back();
        }

        $product    = Product::find($id);
        $categories = Category::where('status', 1)->get();

        return view('customer.product.edit', compact('product', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product) {

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
                $product->update(
                    [
                        'image' => $final_name1,
                    ]
                );
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

        return redirect()->route('customer.products.index')->withToastSuccess('Product updated successfully!!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product) {
        $image_path = public_path($product->image);

        if (File::exists($image_path)) {
            File::delete($image_path);
        }

        $product->delete();

        return redirect()->back()->withToastSuccess('Product deleted successfully!!');
    }

    public function StockAlert() {
        $products = Product::where('shop_id', SID())->get();

        return view('customer.product.stock-alert', compact('products'));
    }

    public function updateQuantity(Request $request) {
        $product = Product::find($request->id);
        $product->update(['quantity' => $request->quantity]);

        return redirect()->back()->withToastSuccess('Product quantity updated');
    }

}
