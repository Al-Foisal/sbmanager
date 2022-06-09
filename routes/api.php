<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\ConsumerController;
use App\Http\Controllers\Api\CustomerController;
use App\Http\Controllers\Api\DigitalPaymentController;
use App\Http\Controllers\Api\DueController;
use App\Http\Controllers\Api\EmployeeController;
use App\Http\Controllers\Api\ExpenseBookController;
use App\Http\Controllers\Api\ProductController;
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
    Route::post('/checkCustomer', 'checkCustomer');
    Route::post('/checkOTP', 'checkOTP');
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

//due
Route::controller(DueController::class)->prefix('/due')->group(function () {
    Route::get('/get-category/{category}/{shop_id}', 'category');
    Route::get('/{shop_id}', 'index');
    Route::post('/store', 'store');
    Route::get('/show/{id}', 'show');
    Route::put('/update', 'update');
    Route::delete('/delete/{id}', 'delete');
    Route::post('/storeDueDeposit', 'storeDueDeposit');
});

//expense
Route::controller(ExpenseBookController::class)->prefix('/expense')->group(function () {
    Route::get('/{shop_id}', 'expenseBook');
    Route::post('/store', 'storeExpenseBook');
    Route::put('/update/{expense}', 'updateExpenseBook');
    Route::delete('/delete/{expense}', 'deleteExpenseBook');

    //expense list
    Route::get('/list/{shop_id}', 'expenseBookList');
    Route::post('/list/store', 'storeExpenseBookList');
});

Route::apiResource('shops.consumers', ConsumerController::class);
Route::apiResource('shops.employees', EmployeeController::class);
Route::apiResource('shops.suppliers', SupplierController::class);
Route::apiResource('shops.products', ProductController::class);
Route::apiResource('shops.digital_payments', DigitalPaymentController::class);
