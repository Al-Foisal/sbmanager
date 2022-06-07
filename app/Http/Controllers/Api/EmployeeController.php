<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Employee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class EmployeeController extends Controller {
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($shop_id) {
        $employees = Employee::where('shop_id', $shop_id)->paginate(50);

        return response()->json(['employees' => $employees]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $shop_id) {

        if ($request->hasFile('image')) {

            $image_file = $request->file('image');

            if ($image_file) {

                $img_gen   = hexdec(uniqid());
                $image_url = 'images/employee/';
                $image_ext = strtolower($image_file->getClientOriginalExtension());

                $img_name    = $img_gen . '.' . $image_ext;
                $final_name1 = $image_url . $img_gen . '.' . $image_ext;

                $image_file->move($image_url, $img_name);
            }

        }

        $employee = Employee::create([
            'shop_id'     => $shop_id,
            'name'        => $request->name,
            'phone'       => $request->phone,
            'email'       => $request->email,
            'image'       => $final_name1 ?? null,
            'designation' => $request->designation,
            'employee_id' => $request->employee_id,
            'salary'      => $request->salary,
            'address'     => $request->address,
        ]);

        return $employee;
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
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id, Employee $employee) {
        if ($request->hasFile('image')) {

            $image_file = $request->file('image');

            if ($image_file) {

                $image_path = public_path($employee->image);

                if (File::exists($image_path)) {
                    File::delete($image_path);
                }

                $img_gen   = hexdec(uniqid());
                $image_url = 'images/employee/';
                $image_ext = strtolower($image_file->getClientOriginalExtension());

                $img_name    = $img_gen . '.' . $image_ext;
                $final_name1 = $image_url . $img_gen . '.' . $image_ext;

                $image_file->move($image_url, $img_name);
                $employee->update(
                    [
                        'image' => $final_name1,
                    ]
                );
            }

        }

        $employee->update([
            'name'        => $request->name,
            'phone'       => $request->phone,
            'email'       => $request->email,
            'designation' => $request->designation,
            'employee_id' => $request->employee_id,
            'salary'      => $request->salary,
            'address'     => $request->address,
        ]);

        return $employee;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id, Employee $employee) {
        $image_path = public_path($employee->image);

        if (File::exists($image_path)) {
            File::delete($image_path);
        }

        $employee->delete();

        return response()->json(['status'=>'ok']);
    }

}
