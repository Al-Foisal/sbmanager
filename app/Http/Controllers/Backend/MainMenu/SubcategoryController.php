<?php

namespace App\Http\Controllers\Backend\MainMenu;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Subcategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class SubcategoryController extends Controller {
    public function subcategory() {
        $subcategories = Subcategory::with('category')->get();

        return view('backend.subcategory.index', compact('subcategories'));
    }

    public function createSubcategory() {
        $categories = Category::where('status', 1)->get();

        return view('backend.subcategory.create', compact('categories'));
    }

    public function storeSubcategory(Request $request) {
        $validator = Validator::make($request->all(), [
            'name' => 'required|unique:subcategories',
        ]);

        if ($validator->fails()) {
            return back()->with('toast_error', $validator->messages()->all())->withInput();
        }

        $store_data              = new Subcategory();
        $store_data->category_id = $request->category_id;
        $store_data->name        = $request->name;
        $store_data->status      = 1;
        $store_data->save();

        return redirect()->route('admin.subcategory')->withToastSuccess('Subcategory added successfully!!');
    }

    public function editSubcategory($id) {
        $subcategory = Subcategory::where('id', $id)->first();
        $categories  = Category::where('status', 1)->get();

        return view('backend.subcategory.edit', compact('subcategory', 'categories'));
    }

    public function updateSubcategory(Request $request, $id) {
        $validator = Validator::make($request->all(), [
            'name' => 'required|unique:subcategories,name,' . $id,
        ]);

        if ($validator->fails()) {
            return back()->with('toast_error', $validator->messages()->all())->withInput();
        }

        $subcategory = Subcategory::findOrFail($id);

        $subcategory->update([
            'category_id' => $request->category_id,
            'name'        => $request->name,
        ]);

        return redirect()->route('admin.subcategory')->withToastSuccess('Subcategory updated successfully!!');
    }

    public function activeSubcategory(Request $request, $id) {
        $subcategory = Subcategory::findOrFail($id);

        $subcategory->status = 1;
        $subcategory->save();

        return redirect()->route('admin.subcategory')->withToastSuccess('Subcategory activated successfully!!');
    }

    public function inactiveSubcategory(Request $request, $id) {
        $subcategory = Subcategory::findOrFail($id);

        $subcategory->status = 0;
        $subcategory->save();

        return redirect()->route('admin.subcategory')->withToastSuccess('Subcategory inactivated successfully!!');
    }
}
