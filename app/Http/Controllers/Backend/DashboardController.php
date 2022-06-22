<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\Contact;
use App\Models\Customer;
use App\Models\DigitalAmount;
use App\Models\OnlineOrder;
use App\Models\Order;
use App\Models\Product;
use App\Models\Shop;
use App\Models\WithdrawTracker;
use Illuminate\Http\Request;

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

    public function withdraw() {
        $withdraw = DigitalAmount::orderBy('updated_at', 'desc')->paginate(100);

        return view('backend.withdraw', compact('withdraw'));
    }

    public function storeWithdraw(Request $request) {
        // dd($request->all());
        $amount  = $request->amount;
        $id      = $request->id;
        $digital = DigitalAmount::find($id);

        if ($amount > $digital->amount) {
            return redirect()->back()->withToastError('Invalid amount input!!');
        }

        WithdrawTracker::create([
            'shop_id'      => $digital->shop_id,
            'amount'       => $request->amount,
            'account_type' => $digital->account_type,
            'phone'        => $digital->phone,
        ]);

        $digital->update([
            'amount'        => $digital->amount - $amount,
            'last_withdraw' => now(),
        ]);

        return redirect()->back()->withToastSuccess('Withdraw successfull');
    }

    public function withdrawTracking() {
        $withdraw = WithdrawTracker::orderBy('id', 'desc')->paginate(100);

        return view('backend.withdraw-tracking', compact('withdraw'));
    }

}
