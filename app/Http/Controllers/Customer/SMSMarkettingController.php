<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;

class SMSMarkettingController extends Controller {
    public function index() {
        $data = [];

        return view('customer.sms.index', $data);
    }
}
