<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Package;
use App\Models\PackageDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PackageController extends Controller {
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        $packages = Package::with('packageDetails')->get();

        return view('backend.package.index', compact('packages'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        return view('backend.package.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
        $validator = Validator::make($request->all(), [
            'name'     => 'required',
            'amount'   => 'required',
            'p_name'   => 'required',
            'p_name.*' => 'required',
        ]);

        if ($validator->fails()) {
            return back()->with('toast_error', $validator->messages()->all())->withInput();
        }

        $package = Package::create([
            'name'   => $request->name,
            'title'  => $request->title,
            'amount' => $request->amount,
        ]);

        foreach ($request->p_name as $name) {
            PackageDetail::create([
                'name'       => $name,
                'package_id' => $package->id,
            ]);
        }

        return redirect()->route('admin.packages.index')->withToastSuccess('New package added successfully!!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id) {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id) {
        $package = Package::where('id', $id)->with('packageDetails')->first();

        return view('backend.package.edit', compact('package'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id) {
        $package   = Package::where('id', $id)->with('packageDetails')->first();
        $validator = Validator::make($request->all(), [
            'name'     => 'required',
            'amount'   => 'required',
            'p_name'   => 'required',
            'p_name.*' => 'required',
        ]);

        if ($validator->fails()) {
            return back()->with('toast_error', $validator->messages()->all())->withInput();
        }

        $package->update([
            'name'   => $request->name,
            'title'  => $request->title,
            'amount' => $request->amount,
        ]);

        foreach ($package->packageDetails as $dd) {
            $dd->delete();
        }

        foreach ($request->p_name as $name) {
            PackageDetail::create([
                'name'       => $name,
                'package_id' => $package->id,
            ]);
        }

        return redirect()->route('admin.packages.index')->withToastSuccess('New package updated successfully!!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {
        $package = Package::where('id', $id)->with('packageDetails')->first();

        foreach ($package->packageDetails as $dd) {
            $dd->delete();
        }

        $package->delete();

        return redirect()->route('admin.packages.index')->withToastSuccess('Package deleted successfully!!');

    }

}
