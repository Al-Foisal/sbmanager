<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Supplier;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class SupplierController extends Controller {
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($shop_id) {
        $suppliers = Supplier::where('shop_id', $shop_id)->paginate(50);

        return $suppliers;
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
                $image_url = 'images/supplier/';
                $image_ext = strtolower($image_file->getClientOriginalExtension());

                $img_name    = $img_gen . '.' . $image_ext;
                $final_name1 = $image_url . $img_gen . '.' . $image_ext;

                $image_file->move($image_url, $img_name);
            }

        }

        $supplier = Supplier::create([
            'shop_id'        => $shop_id,
            'name'           => $request->name,
            'phone'          => $request->phone,
            'email'          => $request->email,
            'image'          => $final_name1 ?? null,
            'supply_product' => $request->supply_product,
            'address'        => $request->address,
        ]);

        return $supplier;
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
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id, Supplier $supplier) {
        if ($request->hasFile('image')) {

            $image_file = $request->file('image');

            if ($image_file) {

                $image_path = public_path($supplier->image);

                if (File::exists($image_path)) {
                    File::delete($image_path);
                }

                $img_gen   = hexdec(uniqid());
                $image_url = 'images/supplier/';
                $image_ext = strtolower($image_file->getClientOriginalExtension());

                $img_name    = $img_gen . '.' . $image_ext;
                $final_name1 = $image_url . $img_gen . '.' . $image_ext;

                $image_file->move($image_url, $img_name);
                $supplier->update(
                    [
                        'image' => $final_name1,
                    ]
                );
            }

        }

        $supplier->update([
            'name'           => $request->name,
            'phone'          => $request->phone,
            'email'          => $request->email,
            'address'        => $request->address,
            'supply_product' => $request->supply_product,
        ]);

        return $supplier;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id, Supplier $supplier) {
        $image_path = public_path($supplier->image);

        if (File::exists($image_path)) {
            File::delete($image_path);
        }

        $supplier->delete();

        return response()->json(['status'=>'ok']);
    }

}
