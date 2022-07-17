<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\IncomeBook;
use App\Models\IncomeBookDetail;
use Illuminate\Contracts\Encryption\DecryptException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\File;

class IncomeBookController extends Controller {
    public function incomeBook() {
        $data            = [];
        $data['incomes'] = IncomeBook::where('shop_id', SID())
            ->get();
        $data['total_balance'] = IncomeBookDetail::where('shop_id', SID())->whereYear('created_at', '=', now())
            ->whereMonth('created_at', '=', now())
            ->select('amount')
            ->sum('amount');

        return view('customer.income.income-book', $data);
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
            'shop_id' => SID(),
            'image'   => $final_name1 ?? null,
            'name'    => $request->name,
        ]);

        return redirect()->back()->withToastSuccess('Income book created!!');
    }

    public function editIncomeBook($id) {

        try {
            $id = Crypt::decryptString($id);
        } catch (DecryptException $e) {
            return back();
        }

        $income = IncomeBook::find($id);

        return view('customer.income.edit-income-book', compact('income'));
    }

    public function updateIncomeBook(Request $request, $id) {

        try {
            $id = Crypt::decryptString($id);
        } catch (DecryptException $e) {
            return back();
        }

        $income = IncomeBook::find($id);

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
                $income->update(
                    [
                        'image' => $final_name1,
                    ]
                );
            }

        }

        $income->update([
            'name' => $request->name,
        ]);

        return redirect()->route('customer.income.expenseBook')->withToastSuccess('Income book updated successfully!!');
    }

    public function deleteIncomeBook(Request $request, $id) {
        try {
            $id = Crypt::decryptString($id);
        } catch (DecryptException $e) {
            return back();
        }

        $income = IncomeBook::find($id);

        $image_path = public_path($income->image);

        if (File::exists($image_path)) {
            File::delete($image_path);
        }

        $income->delete();

        return redirect()->back()->withToastSuccess('Expense book deleted successfully!!');
    }

    public function incomeBookList(Request $request) {
        $data             = [];
        $data['incomes'] = IncomeBookDetail::where('shop_id', SID())
            ->with('incomeBook')
            ->latest()
            ->paginate(500);

        $data['total_balance'] = IncomeBookDetail::where('shop_id', SID())
            ->select('amount')
            ->sum('amount');

        return view('customer.income.income-book-list', $data);
    }

    public function createIncomeBookList($id) {
        try {
            $id = Crypt::decryptString($id);
        } catch (DecryptException $e) {
            return back();
        }

        $income_book = IncomeBook::find($id);

        $data                = [];
        $data['income_book'] = $income_book;

        return view('customer.income.create-income-book-list', $data);
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
            'shop_id'        => SID(),
            'income_book_id' => $request->income_book_id,
            'image'          => $final_name1 ?? null,
            'reason'         => $request->reason,
            'amount'         => $request->amount,
            'details'        => $request->details,
            'created_at'     => $request->current_date ?? now(),
        ]);

        return redirect()->route('customer.income.incomeBook')->withToastSuccess('Income updated successfully!!');
    }

}
