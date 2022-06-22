<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Subscription;
use App\Models\SubscriptionHistory;
use Illuminate\Http\Request;

class SubscriptionController extends Controller {
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        $data                  = [];
        $data['subscriptions'] = Subscription::all();

        return view('backend.subscription.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        return view('backend.subscription.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
        Subscription::create($request->all());

        return redirect()->route('admin.subscriptions.index')->withToastSuccess('New package created successfully!!');
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
    public function edit(Subscription $subscription) {
        return view('backend.subscription.edit', compact('subscription'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Subscription $subscription) {
        $subscription->update($request->all());

        return redirect()->route('admin.subscriptions.index')->withToastSuccess('Package updated successfully!!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {
        //
    }

    public function histories() {
        $histories = SubscriptionHistory::with('subscription','shop')->orderBy('id', 'desc')->paginate(100);

        return view('backend.subscription.histories', compact('histories'));
    }
}
