<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\ExpenseBook;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class ExpenseBookController extends Controller {
    public function expenseBook() {
        $data             = [];
        $data['expenses'] = ExpenseBook::where('shop_id', SID())->get();

        return view('customer.expense.expense-book', $data);
    }

    public function storeExpenseBook(Request $request)
    {
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
            'shop_id'  => SID(),
            'image'    => $final_name1 ?? null,
            'name'     => $request->name,
        ]);

        return redirect()->back()->withToastSuccess('Expense book created!!');
    }

    public function editExpenseBook(ExpenseBook $expense)
    {
        return view('customer.expense.edit-expense-book',compact('expense'));
    }

    public function updateExpenseBook(Request $request, ExpenseBook $expense)
    {
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
                $expense->update(
                    [
                        'image' => $final_name1,
                    ]
                );
            }

        }

        $expense->update([
            'name'     => $request->name,
        ]);

        return redirect()->route('customer.expense.expenseBook')->withToastSuccess('Expense book updated successfully!!');
    }

    public function deleteExpenseBook(Request $request, ExpenseBook $expense)
    {
        $image_path = public_path($expense->image);

        if (File::exists($image_path)) {
            File::delete($image_path);
        }

        $expense->delete();

        return redirect()->back()->withToastSuccess('Expense book deleted successfully!!');
    }
}
