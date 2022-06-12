<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Bank;
use App\Models\Consumer;
use App\Models\EMI;
use App\Models\EMITime;
use Illuminate\Http\Request;

class EMIController extends Controller {
    public function bank() {
        $data         = [];
        $data['bank'] = Bank::all();

        return $data;
    }

    public function emiTime() {
        $data             = [];
        $data['emi_time'] = EMITime::all();

        return $data;
    }

    public function index($shop_id) {
        $data         = [];
        $data['emis'] = EMI::where('shop_id', $shop_id)->orderBy('id', 'DESC')->get();

        return $data;
    }

// public function create() {

//     $data              = [];

//     $data['consumers'] = Consumer::where('shop_id', SID())->get();

//     $data['banks']     = Bank::all();

//     return view('customer.emi.create', $data);

// }

// public function month(Request $request) {

//     $data             = [];

//     $data['request']  = $request->all();

//     $data['emi_time'] = EMITime::all();

//     return view('customer.emi.month', $data);
    // }

    public function store(Request $request) {
        // dd($request->all());
        $consumer = Consumer::find($request->name);

        if (!$consumer) {
            $consumer          = new Consumer();
            $consumer->shop_id = $request->shop_id;
            $consumer->name    = $request->name;
            $consumer->phone   = $request->phone;
            $consumer->address = $request->address;
            $consumer->save();
        }

        $emi          = new EMI();
        $emi->shop_id = $request->shop_id;
        $emi->name    = $consumer->name;

        if (!$consumer) {
            $emi->phone   = $consumer->phone;
            $emi->address = $consumer->address;
        } else {
            $emi->phone   = $consumer->phone;
            $emi->address = $request->address;
        }

        $emi->amount             = $request->amount;
        $emi->bank_id            = $request->bank_id;
        $emi->emi_month          = $request->emi_month;
        $emi->emi_parcentage     = $request->emi_parcentage;
        $emi->emi_extra          = $request->emi_extra;
        $emi->emi_monthly_amount = $request->emi_monthly_amount;
        $emi->emi_paid_amount    = $request->emi_paid_amount;
        $emi->link               = 'https://url.com/' . $request->shop_id . bin2hex(random_bytes(5)) . time();
        $emi->status             = 'Pending';
        $emi->save();

        return $emi;
    }

    public function details($id) {
        $emi = EMI::where('id', $id)->first();

// $socialShare = \Share::page(

//     $emi->link,

//     'Make your digital payment through this link.',

// )

// ->facebook()

// ->twitter()

// ->reddit()

// ->linkedin()

// ->whatsapp()
        // ->telegram();

        return $emi;
    }

}
