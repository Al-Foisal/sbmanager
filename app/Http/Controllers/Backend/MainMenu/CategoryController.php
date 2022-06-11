<?php

namespace App\Http\Controllers\Backend\MainMenu;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller {
    public function category() {
        $categories = Category::withCount('subcategories')->paginate(50);

        return view('backend.category.index', compact('categories'));
    }

    public function createCategory() {
        return view('backend.category.create');
    }

    public function storeCategory(Request $request) {
        $validator = Validator::make($request->all(), [
            'name'  => 'required|unique:categories',
        ]);

        if ($validator->fails()) {
            return back()->with('toast_error', $validator->messages()->all())->withInput();
        }

        $category           = new Category();
        $category->name     = $request->name;
        $category->status   = 1;
        $category->save();

        return redirect()->route('admin.category')->withToastSuccess('Category added successfully!!');
    }

    public function editCategory($id) {
        $category = Category::where('id', $id)->first();

        return view('backend.category.edit', compact('category'));
    }

    public function updateCategory(Request $request, $id) {
        $validator = Validator::make($request->all(), [
            'name' => 'required|unique:categories,name,' . $id,
        ]);

        if ($validator->fails()) {
            return back()->with('toast_error', $validator->messages()->all())->withInput();
        }

        $category = Category::findOrFail($id);

        $category->update([
            'name' => $request->name,
        ]);

        return redirect()->route('admin.category')->withToastSuccess('Category updated successfully!!');
    }

    public function activeCategory(Request $request, $id) {
        $category = Category::findOrFail($id);

        $category->status = 1;
        $category->save();

        return redirect()->route('admin.category')->withToastSuccess('Category activated successfully!!');
    }

    public function inactiveCategory(Request $request, $id) {
        $category = Category::findOrFail($id);

        $category->status = 0;
        $category->save();

        return redirect()->route('admin.category')->withToastSuccess('Category inactivated successfully!!');
    }
}
