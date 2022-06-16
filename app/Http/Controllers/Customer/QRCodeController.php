<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\QRCode;
use Illuminate\Http\Request;

class QRCodeController extends Controller {
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        $info = QRCode::where('shop_id', SID())->first();

        return view('customer.qr-code', compact('info'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {

        if ($request->hasFile('bkash')) {

            $image_file = $request->file('bkash');

            if ($image_file) {

                $img_gen   = hexdec(uniqid());
                $image_url = 'images/qr/';
                $image_ext = strtolower($image_file->getClientOriginalExtension());

                $img_name = $img_gen . '.' . $image_ext;
                $bkash    = $image_url . $img_gen . '.' . $image_ext;

                $image_file->move($image_url, $img_name);
                QRCode::updateOrcreate(
                    ['shop_id' => SID()],
                    [
                        'bkash' => $bkash,
                    ]
                );
            }

        }

        if ($request->hasFile('nagad')) {

            $image_file = $request->file('nagad');

            if ($image_file) {

                $img_gen   = hexdec(uniqid());
                $image_url = 'images/qr/';
                $image_ext = strtolower($image_file->getClientOriginalExtension());

                $img_name = $img_gen . '.' . $image_ext;
                $nagad    = $image_url . $img_gen . '.' . $image_ext;

                $image_file->move($image_url, $img_name);
                QRCode::updateOrcreate(
                    ['shop_id' => SID()],
                    [
                        'nagad' => $nagad,
                    ]
                );
            }

        }

        if ($request->hasFile('rocket')) {

            $image_file = $request->file('rocket');

            if ($image_file) {

                $img_gen   = hexdec(uniqid());
                $image_url = 'images/qr/';
                $image_ext = strtolower($image_file->getClientOriginalExtension());

                $img_name = $img_gen . '.' . $image_ext;
                $rocket   = $image_url . $img_gen . '.' . $image_ext;

                $image_file->move($image_url, $img_name);
                QRCode::updateOrcreate(
                    ['shop_id' => SID()],
                    [
                        'rocket' => $rocket,
                    ]
                );
            }

        }

        if ($request->hasFile('others')) {

            $image_file = $request->file('others');

            if ($image_file) {

                $img_gen   = hexdec(uniqid());
                $image_url = 'images/qr/';
                $image_ext = strtolower($image_file->getClientOriginalExtension());

                $img_name = $img_gen . '.' . $image_ext;
                $others   = $image_url . $img_gen . '.' . $image_ext;

                $image_file->move($image_url, $img_name);
                QRCode::updateOrcreate(
                    ['shop_id' => SID()],
                    [
                        'others' => $others,
                    ]
                );
            }

        }

        return redirect()->back()->withToastSuccess('QR code updated !!');
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
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id) {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {
        //
    }

}
