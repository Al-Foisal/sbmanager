<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\ExpenseBook;
use App\Models\ExpenseBookDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class ExpenseBookController extends Controller 
{
    public function expenseBook($shop_id) {
        $data                  = [];
        $data['expenses']      = $e      = ExpenseBook::where('shop_id', $shop_id)->orWhere('shop_id', null)->withSum('expenseBookDetails', 'amount')->get();
        $data['total_balance'] = ExpenseBookDetail::where('shop_id', $shop_id)->whereYear('created_at', '=', now())
            ->whereMonth('created_at', '=', now())
            ->select('amount')
            ->sum('amount');

        return $data;
    }

    public function storeExpenseBook(Request $request) {

        if ($request->hasFile('image')) {

            $image_file = $request->file('image');

            if ($image_file) {

                $img_gen   = hexdec(uniqid());
                $image_url = 'images/expense/';
                $image_ext = strtolower($image_file->getClientOriginalExtension());

                $img_name    = $img_gen . '.' . $image_ext;
                $final_name1 = $image_url . $img_gen . '.' . $image_ext;

                $image_file->move($image_url, $img_name);
            }

        }

        ExpenseBook::create([
            'shop_id' => $request->shop_id,
            'image'   => $final_name1 ?? null,
            'name'    => $request->name,
        ]);

        return response()->json(['status' => true, 'message' => 'Expense book created!!']);
    }

    public function updateExpenseBook(Request $request, ExpenseBook $expense) {

        if ($expense->shop_id === null) {
            return response()->json(['status' => false]);
        }

        if ($request->hasFile('image')) {

            $image_file = $request->file('image');

            if ($image_file) {

                $image_path = public_path($expense->image);

                if (File::exists($image_path)) {
                    File::delete($image_path);
                }

                $img_gen   = hexdec(uniqid());
                $image_url = 'images/expense/';
                $image_ext = strtolower($image_file->getClientOriginalExtension());

                $img_name    = $img_gen . '.' . $image_ext;
                $final_name1 = $image_url . $img_gen . '.' . $image_ext;

                $image_file->move($image_url, $img_name);
                $expense->image = $final_name1;
                $expense->save();
            }

        }

        $expense->update([
            'name' => $request->name,
        ]);

        return response()->json(['status' => true, 'message' => 'Expense book updated successfully!!']);
    }

    public function deleteExpenseBook(Request $request, ExpenseBook $expense) {
        $image_path = public_path($expense->image);

        if (File::exists($image_path)) {
            File::delete($image_path);
        }

        $expense->delete();

        return response()->json(['status' => true]);
    }

    public function expenseBookList(Request $request, $shop_id) {
        $data             = [];
        $data['expenses'] = ExpenseBookDetail::where('shop_id', $shop_id)
            ->with('expenseBook')
            ->latest()
            ->paginate(500);

        $data['total_balance'] = ExpenseBookDetail::where('shop_id', $shop_id)
            ->select('amount')
            ->sum('amount');

        return $data;
    }

    public function storeExpenseBookList(Request $request) {

        if ($request->hasFile('image')) {

            $image_file = $request->file('image');

            if ($image_file) {

                $img_gen   = hexdec(uniqid());
                $image_url = 'images/expense/';
                $image_ext = strtolower($image_file->getClientOriginalExtension());

                $img_name    = $img_gen . '.' . $image_ext;
                $final_name1 = $image_url . $img_gen . '.' . $image_ext;

                $image_file->move($image_url, $img_name);
            }

        }

        ExpenseBookDetail::create([
            'shop_id'         => $request->shop_id,
            'expense_book_id' => $request->expense_book_id,
            'image'           => $final_name1 ?? null,
            'name'            => $request->name,
            'reason'          => $request->reason,
            'amount'          => $request->amount,
            'details'         => $request->details,
            'created_at'      => $request->current_date ?? now(),
        ]);

        return response()->json(['status' => true, 'message' => 'Expense updated successfully!!']);
    }

}
