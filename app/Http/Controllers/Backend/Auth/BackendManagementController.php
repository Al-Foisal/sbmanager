<?php

namespace App\Http\Controllers\Backend\Auth;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Models\Shop;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BackendManagementController extends Controller {

    public function userList() {
        $users = user::orderBy('id', 'desc')->paginate(50);

        return view('backend.auth.user-list', compact('users'));
    }

    public function customerList() {
        // auth()->guard('customer')->logout();
        $customers = Customer::orderBy('id', 'desc')->paginate(50);

        return view('backend.customer.customer-list', compact('customers'));
    }

    public function customerShopList(Customer $customer) {
        $data             = [];
        $data['customer'] = $customer;
        $data['shops']    = Shop::where('customer_id', $customer->id)->get();

        return view('backend.customer.customer-shop-list', $data);
    }

    public function adminLoginToCustomer(Request $request) {
        $customer = Customer::where('phone', $request->phone)->first();

        if ($customer) {
            Auth::guard('customer')->login($customer);

            return redirect()->route('customer.shop.list')->withToastSuccess('Login Successfull!!');
        } else {
            return back();
        }

    }
}
