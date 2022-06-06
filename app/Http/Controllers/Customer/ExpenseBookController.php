<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\Employee;
use App\Models\ExpenseBook;
use App\Models\ExpenseBookDetail;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class ExpenseBookController extends Controller {
    public function expenseBook() {
        $data                  = [];
        $data['expenses']      = ExpenseBook::where('shop_id', SID())->orWhere('shop_id', null)->get();
        $data['total_balance'] = ExpenseBookDetail::where('shop_id', SID())->whereYear('created_at', '=', now())
            ->whereMonth('created_at', '=', now())
            ->select('amount')
            ->sum('amount');

        return view('customer.expense.expense-book', $data);
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
            'shop_id' => SID(),
            'image'   => $final_name1 ?? null,
            'name'    => $request->name,
        ]);

        return redirect()->back()->withToastSuccess('Expense book created!!');
    }

    public function editExpenseBook(ExpenseBook $expense) {
        return view('customer.expense.edit-expense-book', compact('expense'));
    }

    public function updateExpenseBook(Request $request, ExpenseBook $expense) {

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
            'name' => $request->name,
        ]);

        return redirect()->route('customer.expense.expenseBook')->withToastSuccess('Expense book updated successfully!!');
    }

    public function deleteExpenseBook(Request $request, ExpenseBook $expense) {
        $image_path = public_path($expense->image);

        if (File::exists($image_path)) {
            File::delete($image_path);
        }
        
        $expense->delete();

        return redirect()->back()->withToastSuccess('Expense book deleted successfully!!');
    }

    public function expenseBookList(Request $request) {
        $data = [];
        $type = request()->type;
// dd($request->selected_date);
        // if ($request->selected_date) {
        //     $data['expenses'] = ExpenseBookDetail::where('shop_id', SID())->whereYear('created_at', '=', $request->selected_date)
        //     ->whereMonth('created_at', '=', $request->selected_date)
        //         ->with('expenseBook')
        //         ->get();
                
        //         $data['total_balance'] = ExpenseBookDetail::where('shop_id', SID())->whereYear('created_at', '=', $request->selected_date)
        //         ->whereMonth('created_at', '=', $request->selected_date)
        //         ->select('amount')
        //         ->sum('amount');
        //         dd($data);
        // } else
        if ($type === 'today') {
            $data['expenses'] = ExpenseBookDetail::where('shop_id', SID())->whereDay('created_at', '=', now())
                ->with('expenseBook')
                ->get();

            $data['total_balance'] = ExpenseBookDetail::where('shop_id', SID())->whereDay('created_at', '=', now())
                ->select('amount')
                ->sum('amount');
        } elseif ($type === 'week') {
            $data['expenses'] = ExpenseBookDetail::where('shop_id', SID())->whereBetween('created_at', [
                Carbon::now()->startOfWeek(Carbon::SUNDAY),
                Carbon::now()->endOfWeek(Carbon::SATURDAY),
            ])
                ->with('expenseBook')
                ->get();

            $data['total_balance'] = ExpenseBookDetail::where('shop_id', SID())->whereBetween('created_at', [
                Carbon::now()->startOfWeek(Carbon::SUNDAY),
                Carbon::now()->endOfWeek(Carbon::SATURDAY),
            ])
                ->select('amount')
                ->sum('amount');
        } elseif ($type === 'month') {
            $data['expenses'] = ExpenseBookDetail::where('shop_id', SID())->whereMonth('created_at', '=', now())
                ->with('expenseBook')
                ->get();

            $data['total_balance'] = ExpenseBookDetail::where('shop_id', SID())->whereMonth('created_at', '=', now())
                ->select('amount')
                ->sum('amount');
        } elseif ($type === 'year') {
            $data['expenses'] = ExpenseBookDetail::where('shop_id', SID())->whereYear('created_at', '=', now())
                ->with('expenseBook')
                ->get();

            $data['total_balance'] = ExpenseBookDetail::where('shop_id', SID())->whereYear('created_at', '=', now())
                ->select('amount')
                ->sum('amount');
        } else {

            $data['expenses'] = ExpenseBookDetail::where('shop_id', SID())->whereYear('created_at', '=', now())
                ->whereMonth('created_at', '=', now())
                ->with('expenseBook')
                ->get();

            $data['total_balance'] = ExpenseBookDetail::where('shop_id', SID())->whereYear('created_at', '=', now())
                ->whereMonth('created_at', '=', now())
                ->select('amount')
                ->sum('amount');
        }

        $data['type'] = $type ?? null;
        $data['selected_date'] = $request->selected_date ?? null;
        return view('customer.expense.expense-book-list', $data);
    }

    public function createExpenseBookList(ExpenseBook $expense_book) {
        $data                 = [];
        $data['expense_book'] = $expense_book;
        $data['employees']    = Employee::where('shop_id', SID())->get();

        return view('customer.expense.create-expense-book-list', $data);
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
            'shop_id'         => SID(),
            'expense_book_id' => $request->expense_book_id,
            'image'           => $final_name1 ?? null,
            'name'            => $request->name,
            'reason'          => $request->reason,
            'amount'          => $request->amount,
            'details'         => $request->details,
            'created_at'      => $request->current_date ?? now(),
        ]);

        return redirect()->route('customer.expense.expenseBook')->withToastSuccess('Expense updated successfully!!');
    }

}
