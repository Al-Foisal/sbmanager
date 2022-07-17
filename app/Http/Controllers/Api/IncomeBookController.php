<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\IncomeBook;
use App\Models\IncomeBookDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class IncomeBookController extends Controller {
    public function incomeBook($shop_id) {
        $data                  = [];
        $data['incomes']       = $e       = IncomeBook::where('shop_id', $shop_id)->withSum('incomeBookDetails', 'amount')->get();
        $data['total_balance'] = (int) IncomeBookDetail::where('shop_id', $shop_id)->whereYear('created_at', '=', now())
            ->whereMonth('created_at', '=', now())
            ->select('amount')
            ->sum('amount');

        return $data;
    }

    public function storeIncomeBook(Request $request) {

        if ($request->hasFile('image')) {

            $image_file = $request->file('image');

            if ($image_file) {

                $img_gen   = hexdec(uniqid());
                $image_url = 'images/income/';
                $image_ext = strtolower($image_file->getClientOriginalExtension());

                $img_name    = $img_gen . '.' . $image_ext;
                $final_name1 = $image_url . $img_gen . '.' . $image_ext;

                $image_file->move($image_url, $img_name);
            }

        }

        IncomeBook::create([
            'shop_id' => $request->shop_id,
            'image'   => $final_name1 ?? null,
            'name'    => $request->name,
        ]);

        return response()->json(['status' => true, 'message' => 'Income book created!!']);
    }

    public function updateIncomeBook(Request $request, IncomeBook $income) {

        if ($income->shop_id === null) {
            return response()->json(['status' => false]);
        }

        if ($request->hasFile('image')) {

            $image_file = $request->file('image');

            if ($image_file) {

                $image_path = public_path($income->image);

                if (File::exists($image_path)) {
                    File::delete($image_path);
                }

                $img_gen   = hexdec(uniqid());
                $image_url = 'images/income/';
                $image_ext = strtolower($image_file->getClientOriginalExtension());

                $img_name    = $img_gen . '.' . $image_ext;
                $final_name1 = $image_url . $img_gen . '.' . $image_ext;

                $image_file->move($image_url, $img_name);
                $income->image = $final_name1;
                $income->save();
            }

        }

        $income->update([
            'name' => $request->name,
        ]);

        return response()->json(['status' => true, 'message' => 'Income book updated successfully!!']);
    }

    public function deleteIncomeBook(Request $request, IncomeBook $income) {
        $image_path = public_path($income->image);

        if (File::exists($image_path)) {
            File::delete($image_path);
        }

        $income->delete();

        return response()->json(['status' => true]);
    }

    public function incomeBookList(Request $request, $shop_id) {
        $data            = [];
        $data['incomes'] = IncomeBookDetail::where('shop_id', $shop_id)
            ->with('incomeBook')
            ->latest()
            ->paginate(500);

        $data['total_balance'] = IncomeBookDetail::where('shop_id', $shop_id)
            ->select('amount')
            ->sum('amount');

        return $data;
    }

    public function storeIncomeBookList(Request $request) {

        if ($request->hasFile('image')) {

            $image_file = $request->file('image');

            if ($image_file) {

                $img_gen   = hexdec(uniqid());
                $image_url = 'images/income/';
                $image_ext = strtolower($image_file->getClientOriginalExtension());

                $img_name    = $img_gen . '.' . $image_ext;
                $final_name1 = $image_url . $img_gen . '.' . $image_ext;

                $image_file->move($image_url, $img_name);
            }

        }

        IncomeBookDetail::create([
            'shop_id'        => $request->shop_id,
            'income_book_id' => $request->income_book_id,
            'image'          => $final_name1 ?? null,
            'reason'         => $request->reason,
            'amount'         => $request->amount,
            'details'        => $request->details,
            'created_at'     => $request->current_date ?? now(),
        ]);

        return response()->json(['status' => true, 'message' => 'Income updated successfully!!']);
    }

}
