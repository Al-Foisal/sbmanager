<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\ConsumerController;
use App\Http\Controllers\Api\CustomerController;
use App\Http\Controllers\Api\EmployeeController;
use App\Http\Controllers\Api\SupplierController;
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
    Route::get('/profile/{id}', 'profile');
    Route::post('/logout', 'logout');
});

Route::controller(CustomerController::class)->group(function () {
    Route::get('shop-list/{customer_id}', 'shopList');
    Route::post('shop-list', 'storeShop');
    Route::post('/dashboard', 'dashboard');

    //quicksell
    Route::post('/store-quicksell-order/{shop_id}', 'storeQuicksell');
    Route::put('/update-quicksell-order/{id}', 'updateQuicksell');

    //save order
    Route::post('/order-save', 'orderSave');

    //transaction
    Route::get('/transaction/{shop_id}', 'transaction');
    Route::get('/transaction-details/{id}', 'transactionDetails');
});

Route::apiResource('shops.consumers', ConsumerController::class);
Route::apiResource('shops.employees', EmployeeController::class);
Route::apiResource('shops.suppliers', SupplierController::class);
