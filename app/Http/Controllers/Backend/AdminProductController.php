<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class AdminProductController extends Controller {
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        $products = Product::where('shop_id', null)->paginate(50);

        return view('backend.product.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        $data               = [];
        $data['categories'] = Category::where('status', 1)->get();

        return view('backend.product.create', $data);
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
            'name'           => $request->name,
            'quantity'       => $request->quantity,
            'price'          => $request->price,
            'buying_price'   => $request->buying_price,
            'details'        => $request->details,
            'category_id'    => $request->category_id,
            'subcategory_id' => $request->subcategory_id,
            'image'          => $final_name1 ?? null,
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

        $product    = Product::where('id', $id)->where('shop_id', null)->first();
        $categories = Category::where('status', 1)->get();

        return view('backend.product.edit', compact('product', 'categories'));
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
            'name'           => $request->name,
            'quantity'       => $request->quantity,
            'price'          => $request->price,
            'buying_price'   => $request->buying_price,
            'details'        => $request->details,
            'category_id'    => $request->category_id,
            'subcategory_id' => $request->subcategory_id,
        ]);

        return redirect()->route('admin.products.index')->withToastSuccess('Product updated successfully!!');
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

}
