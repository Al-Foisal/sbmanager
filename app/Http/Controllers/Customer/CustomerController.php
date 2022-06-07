<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CustomerController extends Controller {

    public function dashboard(Request $request) {

        session([
            'customer_id' => Auth::guard('customer')->user()->id,
            'shop_id'     => (int) $request->shop_id,
        ]);
        $data             = [];
        $data['sales']    = 1;
        $data['expenses'] = 2;
        $data['due']      = 3;
        $data['balance']  = 4;

        return view('customer.dashboard', $data);
    }

    public function logout(Request $request) {
        Auth::guard('customer')->logout();

        return redirect()
            ->route('customer.login')
            ->withToastSuccess('Logout Successful!!');
    }
}
