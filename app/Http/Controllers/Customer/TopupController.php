<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\Topup;

class TopupController extends Controller {
    public function index() {
        $data = [];

        return view('customer.topup.index', $data);
    }

    public function details() {
        $data          = [];
        $data['topup'] = Topup::where('shop_id', SID())->orderBy('id', 'desc')->get();

        return view('customer.topup.details', $data);
    }
}
