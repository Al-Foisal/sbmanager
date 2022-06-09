<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\Due;
use App\Models\ExpenseBookDetail;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CustomerController extends Controller {

    public function dashboard(Request $request) {

        session([
            'customer_id' => Auth::guard('customer')->user()->id,
            'shop_id'     => (int) $request->shop_id,
        ]);
        $data           = [];
        $data['sales']  = Order::whereDay('created_at', today())->where('shop_id', SID())->select('subtotal')->sum('subtotal');
        $dues           = Due::where('shop_id', SID())->with('dueDetails')->get();
        $total_due      = 0;
        $total_deposite = 0;

        foreach ($dues as $due) {

            foreach ($due->dueDetails as $d) {

                if ($d->due_type === 'Due' && $d->created_at == today()) {
                    $total_due += $d->amount;
                } elseif($d->due_type === 'Deposit' && $d->created_at == today()) {
                    $total_deposite += $d->amount;
                }

            }

        }

        $data['expenses'] = ExpenseBookDetail::where('shop_id', SID())->whereDay('created_at', '=', today())
            ->select('amount')
            ->sum('amount');
        $data['due']     = $total_due;
        $data['balance'] = $total_deposite;

        return view('customer.dashboard', $data);
    }

    public function logout(Request $request) {
        Auth::guard('customer')->logout();

        return redirect()
            ->route('customer.login')
            ->withToastSuccess('Logout Successful!!');
    }

}
