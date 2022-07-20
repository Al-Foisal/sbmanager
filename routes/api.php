<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\ConsumerController;
use App\Http\Controllers\Api\CustomerController;
use App\Http\Controllers\Api\DigitalPaymentController;
use App\Http\Controllers\Api\DueController;
use App\Http\Controllers\Api\EMIController;
use App\Http\Controllers\Api\EmployeeController;
use App\Http\Controllers\Api\ExpenseBookController;
use App\Http\Controllers\Api\GeneralController;
use App\Http\Controllers\Api\IncomeBookController;
use App\Http\Controllers\Api\ProductController;
use App\Http\Controllers\Api\SearchController;
use App\Http\Controllers\Api\SubscriptionPaymentController;
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
    Route::get('shop-details/{shop_id}', 'shopDetails');
    Route::post('shop-list', 'storeShop');

    Route::put('/update-store-information/{shop}', 'updateStoreInformation')->name('updateStoreInformation');
    Route::put('/update-store-logo/{shop}', 'updateStoreLogo')->name('updateStoreLogo');
    Route::put('/update-store-social/{shop}', 'updateStoreSocial')->name('updateStoreSocial');
    Route::put('/update-store-oml/{shop}', 'updateStoreOML')->name('updateStoreOML');
    Route::post('/store-shop-banner', 'storeShopBanner')->name('storeShopBanner');
    Route::delete('/delete-shop/banner/{id}', 'deleteShopBanner')->name('deleteShopBanner');
    Route::get('/shop/slider-list/{shop_id}', 'sliderList');
    Route::post('/withdraw/store', 'storeWithdraw');
    Route::get('/digital-balance/{shop_id}', 'digitalBalance');

    //online shop
    Route::get('/online-shop/{shop_id}', 'onlineShop');
    Route::get('/order-list/{shop_id}', 'orderList');
    Route::get('/order-details/{id}', 'orderDetails');
    Route::get('/online-product/{shop_id}', 'onlineProduct');
    Route::get('/online-product-details/{id}', 'onlineProductDetails');

    Route::post('/dashboard', 'dashboard');

    //quicksell
    Route::post('/store-quicksell-order/{shop_id}', 'storeQuicksell');
    Route::put('/update-quicksell-order/{id}', 'updateQuicksell');

    //save order
    Route::post('/order-save', 'orderSave');

    //buy
    Route::get('/buy-book/{shop_id}', 'buyBook');
    Route::get('/buy-book-details/{shop_id}', 'buyBookDetails');
    Route::post('/buy-order-save', 'buyOrderSave');

    //transaction
    Route::get('/transaction/{shop_id}', 'transaction');
    Route::get('/transaction-details/{id}', 'transactionDetails');

    //online order
    Route::get('/online-order-list/{shop_id}', 'onlineOrderList');
    Route::get('/online-order-details/{order_id}', 'onlineOrderDetails');
    Route::post('/search-online-order-list', 'searchOnlineOrderList');
    Route::post('/online-order-status/{order_id}','onlineOrderStatus');

    //subscription
    Route::get('/subscription-list', 'subscriptionList');
    Route::get('/subscription-history', 'subscriptionHistory');

    Route::put('/product/update-quantity', 'updateQuantity');

    Route::post('/store-qr-code', 'storeQRCode');
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

//income
Route::controller(IncomeBookController::class)->prefix('/income')->group(function () {
    Route::get('/{shop_id}', 'incomeBook');
    Route::post('/store', 'storeIncomeBook');
    Route::put('/update/{income}', 'updateIncomeBook');
    Route::delete('/delete/{income}', 'deleteIncomeBook');

    //income list
    Route::get('/list/{shop_id}', 'incomeBookList');
    Route::post('/list/store', 'storeIncomeBookList');
});

//emi
Route::controller(EMIController::class)->prefix('/emi')->group(function () {
    Route::get('/bank', 'bank');
    Route::get('/emi_time', 'emiTime');
    Route::get('/{shop_id}', 'index')->name('index');
    Route::post('/store', 'store')->name('store');
    Route::get('/details/{id}', 'details')->name('details');
});

Route::apiResource('shops.consumers', ConsumerController::class);
Route::apiResource('shops.employees', EmployeeController::class);
Route::apiResource('shops.suppliers', SupplierController::class);
Route::apiResource('shops.products', ProductController::class);
Route::apiResource('shops.digital_payments', DigitalPaymentController::class);
Route::get('/common/{shop_id}/products', [ProductController::class, 'commonProduct']);

Route::controller(SearchController::class)->prefix('/search')->group(function () {
    Route::get('/product/fetch_data', 'fetchProductData');
    Route::get('/emi/fetch_data', 'fetchEMIData');
});

Route::controller(GeneralController::class)->group(function () {
    Route::get('/category', 'category');
    Route::get('/category/{id}', 'subcategory');
    Route::get('/shop_type', 'shopType');
    Route::get('/division', 'division');
    Route::get('/district', 'district');
    Route::get('/area', 'area');
    Route::get('/get_district/{division_id}', 'districtByDivision');
    Route::get('/get_area/{district_id}', 'areaByDistrict');
    Route::get('/payments/{link}', 'consumerPayment');

    Route::get('/consumer/orders/{shop_id}', 'consumerOrders');
    Route::get('/employee/orders/{shop_id}', 'employeeOrders');
    Route::get('/supplier-report/{shop_id}', 'supplierReport');
    Route::get('/stock-report/{shop_id}', 'stockReport');
    Route::get('/product-report/{shop_id}', 'productReport');
    Route::get('/PL-report/{shop_id}', 'plReport'); //parameter: "date_time"
});

//subscription payment
Route::post('/subscription-payment', [SubscriptionPaymentController::class, 'subscriptionPayment']);
/**
 * subscription_id
 * shop_id
 */
Route::post('/subscription_success', [SubscriptionPaymentController::class, 'subscriptionSuccess']);
/**
 * tran_id
 * amount
 * currency
 */
Route::post('/subscription_fail', [SubscriptionPaymentController::class, 'subscriptionFail']);
/**
 * tran_id
 */
Route::post('/subscription_cancel', [SubscriptionPaymentController::class, 'subscriptionCancel']);
/**
 * tran_id
 */
Route::post('/subscription-ipn', [SubscriptionPaymentController::class, 'subscriptionIpn']);
/**
 * tran_id
 */
//--subscription payment