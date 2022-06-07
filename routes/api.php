<?php

use App\Http\Controllers\Api\AuthController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|$this->validate($request,[
'status'=>'required',
]);
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
return $request->user();
});
 */
Route::controller(AuthController::class)->group(function () {
    Route::post('/login', 'login');
    Route::post('/register', 'register');
    Route::post('/forget-password', 'storeForgotPassword');
    Route::post('/reset-password', 'storeResetPassword');
});

Route::controller(AuthController::class)->group(function () {
    Route::get('/profile/{id}', 'profile');
    Route::post('/logout', 'logout');
});