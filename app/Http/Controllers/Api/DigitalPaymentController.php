<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Consumer;
use App\Models\DigitalPayment;
use Illuminate\Http\Request;

class DigitalPaymentController extends Controller {
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($shop_id) {
        $data = [];

        $data['payments']  = DigitalPayment::where('shop_id', $shop_id)->paginate(500);
        $data['consumers'] = Consumer::where('shop_id', $shop_id)->paginate(500);

        return $data;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
        $payment = DigitalPayment::create([
            'shop_id' => $request->shop_id,
            'name'    => $request->name,
            'phone'   => $request->phone,
            'amount'  => $request->amount,
            'status'  => 'pending',
            'link'    => $request->shop_id . bin2hex(random_bytes(5)) . time(),
        ]);

        return response()->json(['status' => true, 'payment' => $payment]);
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
    public function update(Request $request, $id) {
        $payment = DigitalPayment::find($id);
        $payment->update([
            'name'    => $request->name,
            'phone'   => $request->phone,
            'amount'  => $request->amount,
            'email'   => $request->email,
            'address' => $request->address,
        ]);

        return response()->json(['status' => true, 'payment' => $payment]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {
        DigitalPayment::find($id)->delete();

        return response()->json(['status' => true]);
    }
}
