<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Consumer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class ConsumerController extends Controller {
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($shop_id) {
        $consumers = Consumer::where('shop_id', $shop_id)->paginate(50);

        return response()->json(['consumers' => $consumers]);
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
                $image_url = 'images/consumer/';
                $image_ext = strtolower($image_file->getClientOriginalExtension());

                $img_name    = $img_gen . '.' . $image_ext;
                $final_name1 = $image_url . $img_gen . '.' . $image_ext;

                $image_file->move($image_url, $img_name);
            }

        }

        $consumer = Consumer::create([
            'shop_id' => $shop_id,
            'name'    => $request->name,
            'phone'   => $request->phone,
            'email'   => $request->email,
            'image'   => $final_name1 ?? null,
            'address' => $request->address,
        ]);

        return $consumer;
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
    public function update(Request $request, $id, Consumer $consumer) {

        if ($request->hasFile('image')) {

            $image_file = $request->file('image');

            if ($image_file) {

                $image_path = public_path($consumer->image);

                if (File::exists($image_path)) {
                    File::delete($image_path);
                }

                $img_gen   = hexdec(uniqid());
                $image_url = 'images/consumer/';
                $image_ext = strtolower($image_file->getClientOriginalExtension());

                $img_name    = $img_gen . '.' . $image_ext;
                $final_name1 = $image_url . $img_gen . '.' . $image_ext;

                $image_file->move($image_url, $img_name);
                $consumer->update(
                    [
                        'image' => $final_name1,
                    ]
                );
            }

        }

        $consumer->update([
            'name'    => $request->name,
            'phone'   => $request->phone,
            'email'   => $request->email,
            'address' => $request->address,
        ]);

        return response()->json(['status' => true, 'consumer' => $consumer]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id, Consumer $consumer) {
        $image_path = public_path($consumer->image);

        if (File::exists($image_path)) {
            File::delete($image_path);
        }

        $consumer->delete();

        return response()->json(['status' => true]);
    }

}
