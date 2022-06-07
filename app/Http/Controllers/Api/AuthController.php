<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Mail\CustomerResetPasswordLink;
use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rules;

class AuthController extends Controller {
    public function login(Request $request) {

        $validator = Validator::make($request->all(), [
            'phone'    => 'required',
            'password' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(['status' => false]);
        }

        if (Auth::guard('customer')->attempt(['phone' => $request->phone, 'password' => $request->password])) {
            return response()->json(['status' => true, 'profile' => auth()->guard('customer')->user()]);
        }

        return response()->json(['status' => false]);

    }

    public function register(Request $request) {
        $validator = Validator::make($request->all(), [
            'name'    => 'required',
            'phone'   => 'required|unique:customers',
            'email'   => 'required|email|unique:customers,email',
            'address' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(['status' => false]);
        }

        $customer = Customer::create([
            'name'     => $request->name,
            'email'    => $request->email,
            'password' => bcrypt($request->password),
            'phone'    => $request->phone,
            'address'  => $request->address,
        ]);

        return response()->json(['status' => true, 'customer' => $customer]);
    }

    public function profile($id) {
        $profile = Customer::find($id);

        return response()->json(['status' => true, 'profile' => $profile]);
    }

    public function storeForgotPassword(Request $request) {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
        ]);

        if ($validator->fails()) {
            return response()->json(['status' => false]);
        }

        $customer = Customer::where('email', $request->email)->first();

        if (!$customer) {
            return response()->json(['status' => false, 'message' => 'This email is no longer with our records!!']);
        }

        $token = bin2hex(random_bytes(20));
        DB::table('password_resets')->insert([
            'token'      => $token,
            'email'      => $request->email,
            'created_at' => now(),
        ]);

        $url = route('customer.resetPassword', [$token, 'email' => $request->email]);

        Mail::to($request->email)->send(new CustomerResetPasswordLink($url));

        return response()->json(['status' => true, 'message' => 'We have sent a fresh reset password link!!']);
    }

    public function storeResetPassword(Request $request) {

        $validator = Validator::make($request->all(), [
            'token'    => 'required',
            'email'    => 'required|email',
            'password' => 'required|confirmed|min:8', Rules\Password::defaults(),
        ]);

        if ($validator->fails()) {
            return response()->json(['status' => false]);
        }

        $password = DB::table('password_resets')->where('email', $request->email)->where('token', $request->token)->first();

        if (!$password) {
            return response()->json(['status' => false, 'message' => 'Something went wrong, Invalid token or email!!']);
        }

        $customer = Customer::where('email', $request->email)->first();

        if ($customer && $password) {
            $customer->update(['password' => bcrypt($request->password)]);

            $password = DB::table('password_resets')->where('email', $request->email)->delete();

            return response()->json(['status' => true, 'message' => 'New password reset successfully!!']);
        } else {
            return response()->json(['status' => false, 'message' => 'The email is no longer our record!!']);
        }

    }

}
