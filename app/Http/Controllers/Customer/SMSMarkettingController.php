<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SMSMarkettingController extends Controller {
    public function index() {
        $data = [];

        return view('customer.sms.index', $data);
    }

    public function store(Request $request) {

        return;
    }
}
