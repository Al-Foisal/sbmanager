<?php

namespace App\Http\Controllers\Backend\Auth;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Models\Shop;
use App\Models\User;

class BackendManagementController extends Controller {

    public function userList() {
        $users = user::orderBy('id', 'desc')->paginate(50);

        return view('backend.auth.user-list', compact('users'));
    }

    public function customerList() {
        $customers = Customer::orderBy('id', 'desc')->paginate(50);

        return view('backend.customer.customer-list', compact('customers'));
    }

    public function customerShopList(Customer $customer) {
        $data             = [];
        $data['customer'] = $customer;
        $data['shops']    = Shop::where('customer_id', $customer->id)->get();

        return view('backend.customer.customer-shop-list', $data);
    }
}
