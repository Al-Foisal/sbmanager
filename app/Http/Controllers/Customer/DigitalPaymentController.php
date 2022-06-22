<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\Consumer;
use App\Models\DigitalPayment;
use App\Models\Shop;
use Illuminate\Http\Request;

class DigitalPaymentController extends Controller {
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        $data = [];

        $data['payments']    = DigitalPayment::where('shop_id', SID())->paginate();
        $data['consumers']   = Consumer::where('shop_id', SID())->get();
        $data['socialShare'] = \Share::page(
            'https://abc.com/digitalpayment',
            'Make your digital payment through this link.',
        )
            ->facebook()
            ->twitter()
            ->reddit()
            ->linkedin()
            ->whatsapp()
            ->telegram();

        $data['shop'] = Shop::find(SID());
        // dd($data['shop']);

        return view('customer.digital_payment.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
        DigitalPayment::create([
            'shop_id' => SID(),
            'name'    => $request->name,
            'phone'   => $request->phone,
            'amount'  => $request->amount,
            'status'  => 'pending',
            'link'    => SID() . bin2hex(random_bytes(5)) . time(),
        ]);

        return redirect()->back()->withToastSuccess('New payment link created.');
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
        $data = [];

        $data['payment']   = DigitalPayment::find($id);
        $data['consumers'] = Consumer::where('shop_id', SID())->get();

        return view('customer.digital_payment.edit', $data);
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

        return redirect()->route('customer.digital_payments.index')->withToastSuccess('Payment information updated.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {
        $payment = DigitalPayment::find($id)->delete();

        return redirect()->route('customer.digital_payments.index')->withToastSuccess('Payment deleted.');
    }
}
