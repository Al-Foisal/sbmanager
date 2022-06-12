<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Consumer;
use App\Models\Due;
use App\Models\DueDetail;
use App\Models\Employee;
use App\Models\Supplier;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class DueController extends Controller {
    public function category($category, $shop_id) {

        if ($category === 'Consumer') {
            $person = Consumer::where('shop_id', $shop_id)->get();
        } elseif ($category === 'Supplier') {
            $person = Supplier::where('shop_id', $shop_id)->get();
        } elseif ($category === 'Employee') {
            $person = Employee::where('shop_id', $shop_id)->get();
        }

        return response()->json($person);
    }

    public function index($shop_id) {
        $data         = [];
        $data['dues'] = $dues = Due::where('shop_id', $shop_id)->orderBy('id', 'desc')->with('dueDetails')->paginate(50);

        $data['consumer'] = Due::where('shop_id', $shop_id)->where('due_to', 'Consumer')->count();
        $data['supplier'] = Due::where('shop_id', $shop_id)->where('due_to', 'Supplier')->count();
        $data['employee'] = Due::where('shop_id', $shop_id)->where('due_to', 'Employee')->count();

        $total_due     = 0;
        $total_deposit = 0;

        foreach ($dues as $due) {

            foreach ($due->dueDetails as $d) {

                if ($d->due_type === 'Due') {
                    $total_due += $d->amount;
                } else {
                    $total_deposit += $d->amount;
                }

            }

        }

        $data['total_due']     = $total_due;
        $data['total_deposit'] = $total_deposit;

        return $data;
    }

    public function store(Request $request) {

        if ($request->due_to === 'Consumer') {
            $person = Consumer::find($request->due_to_id);

            if (!$person) {
                $person = Consumer::create([
                    'shop_id' => $request->shop_id,
                    'name'    => $request->due_to_id,
                    'phone'   => $request->phone,
                ]);
            }

        } elseif ($request->due_to === 'Supplier') {
            $person = Supplier::find($request->due_to_id);

            if (!$person) {
                $person = Supplier::create([
                    'shop_id' => $request->shop_id,
                    'name'    => $request->due_to_id,
                    'phone'   => $request->phone,
                ]);
            }

        } elseif ($request->due_to === 'Employee') {
            $person = Employee::find($request->due_to_id);

            if (!$person) {
                $person = Employee::create([
                    'shop_id' => $request->shop_id,
                    'name'    => $request->due_to_id,
                    'phone'   => $request->phone,
                ]);
            }

        }

        $due = Due::where('due_to', $request->due_to)->where('due_to_id', $person->id)->where('shop_id', $request->shop_id)->first();

        if (!$due) {
            $due = Due::create([
                'shop_id'      => $request->shop_id,
                'due_to'       => $request->due_to,
                'due_to_id'    => $person->id,
                'due_to_name'  => $person->name,
                'due_to_phone' => $person->phone,
            ]);

            if ($request->hasFile('image')) {

                $image_file = $request->file('image');

                if ($image_file) {

                    $img_gen   = hexdec(uniqid());
                    $image_url = 'images/due/';
                    $image_ext = strtolower($image_file->getClientOriginalExtension());

                    $img_name    = $img_gen . '.' . $image_ext;
                    $final_name1 = $image_url . $img_gen . '.' . $image_ext;

                    $image_file->move($image_url, $img_name);
                }

            }

            DueDetail::create([
                'due_id'     => $due->id,
                'amount'     => $request->amount,
                'due_type'   => $request->due_type,
                'details'    => $request->details,
                'image'      => $final_name1 ?? null,
                'created_at' => $request->current_date ?? now(),
            ]);
        } else {

            if ($request->hasFile('image')) {

                $image_file = $request->file('image');

                if ($image_file) {

                    $img_gen   = hexdec(uniqid());
                    $image_url = 'images/due/';
                    $image_ext = strtolower($image_file->getClientOriginalExtension());

                    $img_name    = $img_gen . '.' . $image_ext;
                    $final_name1 = $image_url . $img_gen . '.' . $image_ext;

                    $image_file->move($image_url, $img_name);
                }

            }

            DueDetail::create([
                'due_id'     => $due->id,
                'amount'     => $request->amount,
                'due_type'   => $request->due_type,
                'details'    => $request->details,
                'image'      => $final_name1 ?? null,
                'created_at' => $request->current_date ?? now(),
            ]);
        }

        return response()->json(['status' => true, 'message' => 'Due book added!!']);
    }

    public function show($id) {
        $data        = [];
        $data['due'] = $due = Due::where('id', $id)->with('dueDetails')->first();

        $total_due     = 0;
        $total_deposit = 0;

        foreach ($due->dueDetails as $d) {

            if ($d->due_type === 'Due') {
                $total_due += $d->amount;
            } else {
                $total_deposit += $d->amount;
            }

        }

        $data['due_status'] = $total_due - $total_deposit;

        return $data;
    }

    public function update(Request $request) {
        $dueDetails = DueDetail::where('id', $request->due_details_id)->with('due')->first();

        if ($request->due_to === 'Consumer') {
            $person = Consumer::find($request->due_to_id);

            if (!$person) {
                $person = Consumer::create([
                    'shop_id' => $request->shop_id,
                    'name'    => $request->due_to_id,
                    'phone'   => $request->phone,
                ]);
            }

        } elseif ($request->due_to === 'Supplier') {
            $person = Supplier::find($request->due_to_id);

            if (!$person) {
                $person = Supplier::create([
                    'shop_id' => $request->shop_id,
                    'name'    => $request->due_to_id,
                    'phone'   => $request->phone,
                ]);
            }

        } elseif ($request->due_to === 'Employee') {
            $person = Employee::find($request->due_to_id);

            if (!$person) {
                $person = Employee::create([
                    'shop_id' => $request->shop_id,
                    'name'    => $request->due_to_id,
                    'phone'   => $request->phone,
                ]);
            }

        }

        $due = Due::where('due_to', $request->due_to)->where('due_to_id', $person->id)->where('shop_id', $request->shop_id)->first();

        if (!$due) {
            $due = Due::create([
                'shop_id'      => $request->shop_id,
                'due_to'       => $request->due_to,
                'due_to_id'    => $person->id,
                'due_to_name'  => $person->name,
                'due_to_phone' => $person->phone,
            ]);

            if ($request->hasFile('image')) {

                $image_file = $request->file('image');

                if ($image_file) {

                    $image_path = public_path($dueDetails->image);

                    if (File::exists($image_path)) {
                        File::delete($image_path);
                    }

                    $img_gen   = hexdec(uniqid());
                    $image_url = 'images/due/';
                    $image_ext = strtolower($image_file->getClientOriginalExtension());

                    $img_name    = $img_gen . '.' . $image_ext;
                    $final_name1 = $image_url . $img_gen . '.' . $image_ext;

                    $image_file->move($image_url, $img_name);
                }

            }

            $dueDetails->update([
                'due_id'     => $due->id,
                'amount'     => $request->amount,
                'due_type'   => $request->due_type,
                'details'    => $request->details,
                'image'      => $final_name1 ?? null,
                'created_at' => $request->current_date ?? now(),
            ]);
        } else {

            if ($request->hasFile('image')) {

                $image_file = $request->file('image');

                if ($image_file) {

                    $image_path = public_path($dueDetails->image);

                    if (File::exists($image_path)) {
                        File::delete($image_path);
                    }

                    $img_gen   = hexdec(uniqid());
                    $image_url = 'images/due/';
                    $image_ext = strtolower($image_file->getClientOriginalExtension());

                    $img_name    = $img_gen . '.' . $image_ext;
                    $final_name1 = $image_url . $img_gen . '.' . $image_ext;

                    $image_file->move($image_url, $img_name);
                }

            }

            $dueDetails->update([
                'due_id'     => $due->id,
                'amount'     => $request->amount,
                'due_type'   => $request->due_type,
                'details'    => $request->details,
                'image'      => $final_name1 ?? null,
                'created_at' => $request->current_date ?? now(),
            ]);
        }

        return response()->json(['status' => true, 'message' => 'Due book updated!!']);
    }

    public function delete(Request $request, $id) {
        $details    = DueDetail::find($id);
        $image_path = public_path($details->image);

        if (File::exists($image_path)) {
            File::delete($image_path);
        }

        $details->delete();

        return response()->json(['status' => true, 'message' => 'Data deleted successfully!!']);
    }

    public function storeDueDeposit(Request $request) {
        $check = Due::where('id', $request->due_id)->first();

        if (!$check) {
            return redirect()->back()->withToastError('Access denied');
        }

        if ($request->hasFile('image')) {

            $image_file = $request->file('image');

            if ($image_file) {

                $img_gen   = hexdec(uniqid());
                $image_url = 'images/due/';
                $image_ext = strtolower($image_file->getClientOriginalExtension());

                $img_name    = $img_gen . '.' . $image_ext;
                $final_name1 = $image_url . $img_gen . '.' . $image_ext;

                $image_file->move($image_url, $img_name);
            }

        }

        DueDetail::create([
            'due_id'     => $request->due_id,
            'amount'     => $request->amount,
            'due_type'   => $request->due_type,
            'details'    => $request->details,
            'image'      => $final_name1 ?? null,
            'created_at' => $request->current_date ?? now(),
        ]);

        return response()->json(['status' => true]);
    }

}
