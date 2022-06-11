<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\EMITime;
use Illuminate\Http\Request;

class EMITimeController extends Controller {
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        $emi_time = EMITime::all();

        return view('backend.emi_time.index', compact('emi_time'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
        EMITime::create($request->all());

        return redirect()->back()->withToastSuccess('EMI time added successfully');
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
    public function edit(EMITime $emi_time) {
        return view('backend.emi_time.edit', compact('emi_time'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, EMITime $emi_time) {
        $emi_time->update($request->all());

        return redirect()->route('admin.emi_times.index')->withToastSuccess('EMI time updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(EMITime $emi_time) {
        $emi_time->delete();

        return redirect()->back()->withToastSuccess('EMI time deleted successfully');
    }
}
