<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\Contact;
use App\Models\Customer;
use App\Models\OnlineOrder;
use App\Models\Order;
use App\Models\Product;
use App\Models\Shop;

class DashboardController extends Controller {
    public function dashboard() {
        $data                        = [];
        $data['customer']            = Customer::count();
        $data['unverified_customer'] = Customer::where('otp', '!==', null)->count();

        $data['shop'] = Shop::count();

        $data['admin'] = Admin::count();

        $data['order']        = Order::count();
        $data['online_order'] = OnlineOrder::count();

        $data['product']        = Product::count();
        $data['online_product'] = Product::where('online', 1)->count();

        return view('backend.dashboard', $data);
    }

    //contact
    public function showContact() {
        $data                   = [];
        $data['contact_people'] = Contact::orderBy('status', 'asc')->paginate(50);

        return view('backend.contact', $data);
    }

    public function updateContact(Contact $contact) {
        $contact->status = 1;
        $contact->save();

        return redirect()->back()->withToastSuccess('Contact Message Marked Successfully!!');
    }

    public function deleteContact(Contact $contact) {
        $contact->delete();

        return redirect()->back()->withToastSuccess('Contact Message Deleted Successfully!!');
    }
}
