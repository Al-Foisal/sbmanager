<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\FAQ;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;

class FAQController extends Controller {
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        $faq = FAQ::all();

        return view('backend.faq.index', compact('faq'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        return view('backend.faq.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
        ]);

        if ($validator->fails()) {
            return back()->with('toast_error', $validator->messages()->all())->withInput();
        }

        if ($request->video === null && $request->details === null) {
            return redirect()->back()->withToastError('A video or a text is needed');
        }

        if ($request->hasFile('video')) {

            $image_file = $request->file('video');

            if ($image_file) {

                $img_gen   = hexdec(uniqid());
                $image_url = 'images/faq/';
                $image_ext = strtolower($image_file->getClientOriginalExtension());

                $img_name    = $img_gen . '.' . $image_ext;
                $final_name1 = $image_url . $img_gen . '.' . $image_ext;

                $image_file->move($image_url, $img_name);
            }

        }

        FAQ::create([
            'name'    => $request->name,
            'video'   => $final_name1??null,
            'details' => $request->details,
        ]);

        return redirect()->back()->withToastSuccess('New faq added successfully!!');

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
    public function edit(FAQ $faq) {
        return view('backend.faq.edit', compact('faq'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, FAQ $faq) {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
        ]);

        if ($validator->fails()) {
            return back()->with('toast_error', $validator->messages()->all())->withInput();
        }

        if ($request->hasFile('video')) {

            $image_file = $request->file('video');

            if ($image_file) {

                $image_path = public_path($faq->video);

                if ($image_path) {
                    File::exists($image_path);
                    File::delete($image_path);
                }

                $img_gen   = hexdec(uniqid());
                $image_url = 'images/faq/';
                $image_ext = strtolower($image_file->getClientOriginalExtension());

                $img_name    = $img_gen . '.' . $image_ext;
                $final_name1 = $image_url . $img_gen . '.' . $image_ext;

                $image_file->move($image_url, $img_name);
                $faq->update(['video' => $final_name1]);
            }

        }

        $faq->update(['name' => $request->name, 'details' => $request->details]);

        return redirect()->route('admin.faqs.index')->withToastSuccess('faq updated successfully!!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(FAQ $faq) {
        $image_path = public_path($faq->video);

        if ($image_path) {
            File::exists($image_path);
            File::delete($image_path);
        }

        $faq->delete();

        return redirect()->route('admin.faq.index')->withToastSuccess('Faq deleted successfully!!');
    }

}
