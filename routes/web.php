<?php

use App\Http\Controllers\Backend\AdminProductController;
use App\Http\Controllers\Backend\AreaController;
use App\Http\Controllers\Backend\Auth\AdminForgotPasswordController;
use App\Http\Controllers\Backend\Auth\AdminLoginController;
use App\Http\Controllers\Backend\Auth\AdminRegistrationController;
use App\Http\Controllers\Backend\Auth\AdminResetPasswordController;
use App\Http\Controllers\Backend\Auth\BackendManagementController;
use App\Http\Controllers\Backend\BankController;
use App\Http\Controllers\Backend\CompanyInfoController;
use App\Http\Controllers\Backend\DashboardController;
use App\Http\Controllers\Backend\DistrictController;
use App\Http\Controllers\Backend\DivisionController;
use App\Http\Controllers\Backend\EMITimeController;
use App\Http\Controllers\Backend\FeatureController;
use App\Http\Controllers\Backend\GeneralController;
use App\Http\Controllers\Backend\MainMenu\CategoryController;
use App\Http\Controllers\Backend\MainMenu\SubcategoryController;
use App\Http\Controllers\Backend\PackageController;
use App\Http\Controllers\Backend\PageController;
use App\Http\Controllers\Backend\ShopTypeController;
use App\Http\Controllers\Backend\SliderController;
use App\Http\Controllers\Backend\SubscriptionController;
use App\Http\Controllers\Customer\Auth\CustomerForgotPasswordController;
use App\Http\Controllers\Customer\Auth\CustomerLoginController;
use App\Http\Controllers\Customer\Auth\CustomerRegisterController;
use App\Http\Controllers\Customer\Auth\CustomerResetPasswordController;
use App\Http\Controllers\Customer\BuyController;
use App\Http\Controllers\Customer\CartController;
use App\Http\Controllers\Customer\CheckoutController;
use App\Http\Controllers\Customer\ConsumerController;
use App\Http\Controllers\Customer\CustomerController;
use App\Http\Controllers\Customer\DigitalPaymentController;
use App\Http\Controllers\Customer\DueController;
use App\Http\Controllers\Customer\EMIController;
use App\Http\Controllers\Customer\EmployeeController;
use App\Http\Controllers\Customer\ExpenseBookController;
use App\Http\Controllers\Customer\OrderController;
use App\Http\Controllers\Customer\ProductController;
use App\Http\Controllers\Customer\QRCodeController;
use App\Http\Controllers\Customer\QuickSellController;
use App\Http\Controllers\Customer\ShopController;
use App\Http\Controllers\Customer\SMSMarkettingController;
use App\Http\Controllers\Customer\SupplierController;
use App\Http\Controllers\Customer\TopupController;
use App\Http\Controllers\Customer\TransactionController;
use App\Http\Controllers\FrontendController;
use App\Http\Controllers\Payment\OnlineMarketPaymentController;
use App\Http\Controllers\Payment\SubscriptionPaymentController;
use App\Http\Controllers\SingleShopController;
use App\Http\Controllers\SslCommerzPaymentController;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
 */

Route::get('/', [FrontendController::class, 'homePage'])->name('home');
Route::post('/submit-contact', [FrontendController::class, 'submitContact'])->name('submitContact');

Route::controller(FrontendController::class)->group(function () {
    Route::get('/online-market', 'onlineMarket')->name('onlineMarket');
    Route::get('/online-market/category-product/{slug}', 'categoryProduct')->name('categoryProduct');
    Route::get('/online-market/product/{slug}', 'productDetails')->name('productDetails');
    Route::get('/online-market/cart', 'cartProduct')->name('cartProduct');

});

Route::controller(CartController::class)->group(function () {
    //cart
    Route::post('/add-to-cart', 'addToCart');
    // Route::post('/add-to-cart/discount', 'extraDiscount');
    // Route::get('/cart', 'cart')->name('cart');
    // Route::get('/cart/{order_id}', 'cartOrder')->name('cartOrder');
    // Route::post('/update-cart', 'updateCart')->name('updateCart');
    Route::get('/remove-from-cart/{rowId}', 'removeFromCart')->name('removeFromCart');
    // Route::get('destroy', function () {
    //     Cart::destroy();

    //     return redirect()->route('customer.cart');
    // });
});

Route::controller(SingleShopController::class)->prefix('/shop')->as('shop.')->group(function () {
    Route::get('/{shop_link}', 'singleShopIndex')->name('singleShopIndex');
    Route::get('/{shop_link}/{slug}', 'singleShopDetails')->name('singleShopDetails');
    Route::get('/{shop_link}/online/cart', 'singleShopCart')->name('singleShopCart');
    Route::get('/{shop_link}/online/checkout', 'singleShopCheckout')->name('singleShopCheckout');
    Route::post('/{shop_link}/online/place-order', 'singleShopPlaceOrder')->name('singleShopPlaceOrder');
    Route::get('/{shop_link}/online/order-confirm/{id}', 'singleShopOrderConfirm')->name('singleShopOrderConfirm');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

require __DIR__ . '/auth.php';

Route::prefix('/customer')->as('customer.')->middleware('guest:customer')->group(function () {
    Route::get('/register', [CustomerRegisterController::class, 'register'])->name('register');
    Route::post('/register', [CustomerRegisterController::class, 'storeRegister']);

    Route::get('/login', [CustomerLoginController::class, 'login'])->name('login');
    Route::post('/login', [CustomerLoginController::class, 'storeLogin']);

    Route::get('/forgot-password', [CustomerForgotPasswordController::class, 'forgotPassword'])->name('forgotPassword');
    Route::post('/forgot-password', [CustomerForgotPasswordController::class, 'storeForgotPassword'])->name('storeForgotPassword');

    Route::get('/reset-password/{token}', [CustomerResetPasswordController::class, 'resetPassword'])->name('resetPassword');
    Route::post('/reset-password', [CustomerResetPasswordController::class, 'storeResetPassword'])->name('storeResetPassword');
});

Route::prefix('/customer')->as('customer.')->middleware(['auth:customer'])->group(function () {

    Route::controller(CustomerController::class)->group(function () {

        Route::post('/logout', 'logout')->name('logout');
        Route::post('/dashboard', 'dashboard')->name('dashboard');
        Route::get('/pages/{slug}', 'pageDetails')->name('pageDetails');
        Route::get('/withdraw', 'withdraw')->name('withdraw');
        Route::post('/withdraw/store', 'storeWithdraw')->name('storeWithdraw');
    });

    Route::controller(BuyController::class)->prefix('/buy')->as('buy.')->group(function () {
        Route::get('/', 'index')->name('index');
        Route::get('/cart', 'cart')->name('cart');
        Route::post('/add-to-cart', 'addToCart');
        Route::get('/checkout', 'checkout')->name('checkout');
        Route::post('/placeOrder', 'placeOrder')->name('placeOrder');
        Route::get('/buyBook', 'buyBook')->name('book');
        Route::get('/buyBookDetails/{id}', 'buyBookDetails')->name('buyBookDetails');
        Route::get('/cartOrder/{id}', 'cartOrder')->name('cartOrder');
    });

    Route::controller(ShopController::class)->prefix('/shop')->as('shop.')->group(function () {
        Route::get('/list', 'list')->name('list');
        Route::post('/store', 'store')->name('store');
        Route::get('/order-list', 'orderList')->name('orderList');
        Route::get('/order-details/{id}', 'orderDetails')->name('orderDetails');

        //paid access//
        Route::get('/online-shop', 'onlineShop')->name('onlineShop')->middleware('checkAccess');
        Route::get('/edit-store', 'editStore')->name('editStore')->middleware('checkAccess');
        Route::put('/update-store-information/{shop}', 'updateStoreInformation')->name('updateStoreInformation')->middleware('checkAccess');
        Route::put('/update-store-logo/{shop}', 'updateStoreLogo')->name('updateStoreLogo')->middleware('checkAccess');
        Route::put('/update-store-social/{shop}', 'updateStoreSocial')->name('updateStoreSocial')->middleware('checkAccess');
        Route::put('/update-store-oml/{shop}', 'updateStoreOML')->name('updateStoreOML')->middleware('checkAccess');
        Route::post('/store-shop-banner', 'storeShopBanner')->name('storeShopBanner')->middleware('checkAccess');
        Route::delete('/delete-shop/banner/{id}', 'deleteShopBanner')->name('deleteShopBanner')->middleware('checkAccess');
        Route::get('/online-order-list', 'onlineOrderList')->name('onlineOrderList')->middleware('checkAccess');
        Route::get('/online-order-list/{id}', 'onlineOrderListDetails')->name('onlineOrderListDetails')->middleware('checkAccess');
        Route::post('/online-order-staus/{id}', 'onlineOrderStatus')->name('onlineOrderStatus')->middleware('checkAccess');
        Route::delete('/online-order-delete', 'onlineOrderDelete')->name('onlineOrderDelete')->middleware('checkAccess');
        Route::get('/online-product', 'onlineProduct')->name('onlineProduct')->middleware('checkAccess');
        //--paid access//

        Route::get('/display-qr-code', 'displayQRCode')->name('displayQRCode');
        Route::post('/store-qr-code', 'storeQRCode')->name('storeQRCode');

        //subscription
        Route::get('/subscription-list', 'subscriptionList')->name('subscriptionList');
        Route::get('/subscription-booking/{id}', 'subscriptionBooking')->name('subscriptionBooking');
    });

    Route::get('/product/list', [ProductController::class, 'indexList'])->name('products.index.list');
    Route::get('/product/list/fetch_data', [ProductController::class, 'fetch_search_data']);

    Route::resource('/consumers', ConsumerController::class);
    Route::resource('/suppliers', SupplierController::class);
    Route::resource('/employees', EmployeeController::class);
    Route::resource('/qrcodes', QRCodeController::class);

    Route::controller(CartController::class)->group(function () {
        //cart
        Route::post('/add-to-cart', 'addToCart');
        Route::post('/add-to-cart/discount', 'extraDiscount');
        Route::get('/cart', 'cart')->name('cart');
        Route::get('/cart/{order_id}', 'cartOrder')->name('cartOrder');
        Route::post('/update-cart', 'updateCart')->name('updateCart');
        Route::get('/remove-from-cart/{rowId}', 'removeFromCart')->name('removeFromCart');
        Route::get('destroy', function () {
            Cart::destroy();

            return redirect()->route('customer.cart');
        });
    });

    Route::controller(QuickSellController::class)->prefix('/quicksell')->group(function () {
        Route::get('/', 'quicksell')->name('quicksell');
        Route::post('/store', 'storeQuicksell')->name('storeQuicksell');
        Route::get('/edit/{order_id}', 'editQuicksell')->name('editQuicksell');
        Route::post('/update/{order_id}', 'updateQuicksell')->name('updateQuicksell');
    });

    Route::controller(CheckoutController::class)->group(function () {
        Route::get('/checkout', 'checkout')->name('checkout');
    });
    Route::controller(OrderController::class)->group(function () {
        Route::post('/placeOrder', 'placeOrder')->name('placeOrder');
    });
    Route::controller(TransactionController::class)->prefix('transaction')->group(function () {
        Route::get('/', 'transaction')->name('transaction');
        Route::get('/details/{id}', 'transactionDetails')->name('transactionDetails');
    });

    Route::controller(DueController::class)->prefix('/due')->as('due.')->group(function () {
        Route::get('/', 'index')->name('index');
        Route::get('/create', 'create')->name('create');
        Route::post('/store', 'store')->name('store');
        Route::get('/show/{id}', 'show')->name('show');
        Route::get('/edit/{id}', 'edit')->name('edit');
        Route::put('/update/{id}', 'update')->name('update');
        Route::delete('/delete/{id}', 'delete')->name('delete');
        Route::get('/due-or-deposit/{id}/{text}', 'showDueDeposit')->name('showDueDeposit');
        Route::post('/store/due-or-deposit', 'storeDueDeposit')->name('storeDueDeposit');
    });

    Route::controller(ExpenseBookController::class)->prefix('/expense')->as('expense.')->group(function () {
        Route::get('/', 'expenseBook')->name('expenseBook');
        Route::post('/store', 'storeExpenseBook')->name('storeExpenseBook');
        Route::get('/edit/{expense}', 'editExpenseBook')->name('editExpenseBook');
        Route::put('/update/{expense}', 'updateExpenseBook')->name('updateExpenseBook');
        Route::delete('/delete/{expense}', 'deleteExpenseBook')->name('deleteExpenseBook');

        //expense list
        Route::get('/list', 'expenseBookList')->name('expenseBookList');
        Route::get('/list/create/{expense_book}', 'createExpenseBookList')->name('createExpenseBookList');
        Route::post('/list/store', 'storeExpenseBookList')->name('storeExpenseBookList');
    });

    Route::middleware('checkAccess')->group(function () {
        Route::resource('/products', ProductController::class);
        Route::get('/product/stock-alert', [ProductController::class, 'stockAlert'])->name('products.stockAlert');
        Route::put('/product/update-quantity', [ProductController::class, 'updateQuantity'])->name('products.updateQuantity');

        Route::resource('/digital_payments', DigitalPaymentController::class);

        Route::controller(EMIController::class)->prefix('/emi')->as('emi.')->group(function () {
            Route::get('/', 'index')->name('index');
            Route::get('/create', 'create')->name('create');
            Route::post('/month', 'month')->name('month');
            Route::post('/store', 'store')->name('store');
            Route::get('/details/{id}', 'details')->name('details');
        });

        //sms
        Route::controller(SMSMarkettingController::class)->prefix('/sms')->as('sms.')->group(function () {
            Route::get('/', 'index')->name('index');
            Route::post('/store', 'store')->name('store');
        });

        //topup
        Route::controller(TopupController::class)->prefix('/topup')->as('topup.')->group(function () {
            Route::get('/', 'index')->name('index');
            Route::get('/details', 'details')->name('details');
        });
    });
});

//backend
Route::prefix('/admin')->as('admin.')->middleware('guest:admin')->group(function () {
    Route::get('/login', [AdminLoginController::class, 'login'])->name('login');
    Route::post('/store-login', [AdminLoginController::class, 'storeLogin'])->name('storeLogin');

    Route::get('/forgot-password', [AdminForgotPasswordController::class, 'forgotPassword'])->name('forgotPassword');
    Route::post('/forgot-password', [AdminForgotPasswordController::class, 'storeForgotPassword'])->name('storeForgotPassword');

    Route::get('/reset-password/{token}', [AdminResetPasswordController::class, 'resetPassword'])->name('resetPassword');
    Route::post('/reset-password', [AdminResetPasswordController::class, 'storeForgotPassword'])->name('storeResetPassword');
});

Route::prefix('/admin')->as('admin.')->middleware('auth:admin')->group(function () {
    Route::post('/logout', [AdminLoginController::class, 'logout'])->name('logout');
    Route::get('/dashboard', [DashboardController::class, 'dashboard'])->name('dashboard');

    // Route::resource('/blogs', BlogController::class);

    Route::prefix('web')->group(function () {

        //slider
        Route::controller(SliderController::class)->group(function () {
            Route::get('/slider', 'allSlider')->name('allSlider');
            Route::get('/create-slider', 'createSlider')->name('createSlider');
            Route::post('/store-slider', 'storeSlider')->name('storeSlider');
            Route::get('/edit-slider/{slider}', 'editSlider')->name('editSlider');
            Route::put('/update-slider/{slider}', 'updateSlider')->name('updateSlider');
            Route::delete('/delete-slider/{slider}', 'deleteSlider')->name('deleteSlider');
        });

    });
    //admin management
    // ->middleware('admin_user')
    Route::controller(AdminRegistrationController::class)->group(function () {
        Route::get('/admin-list', 'adminList')->name('adminList');
        Route::get('/create-admin', 'createAdmin')->name('createAdmin');
        Route::post('/store-admin', 'storeAdmin')->name('storeAdmin');
        Route::get('/edit-admin/{admin}', 'editAdmin')->name('editAdmin');
        Route::post('/update-admin/{admin}', 'updateAdmin')->name('updateAdmin');
        Route::post('/admin/active-admin/{admin}', 'activeAdmin')->name('activeAdmin');
        Route::post('/admin/inactive-admin/{admin}', 'inactiveAdmin')->name('inactiveAdmin');
        Route::delete('/delete-admin/{admin}', 'deleteAdmin')->name('deleteAdmin');

    });
    Route::controller(BackendManagementController::class)->group(function () {

        Route::get('/user-list', 'userList')->name('userList');
        Route::get('/customer-list', 'customerList')->name('customerList');
    });

    //category
    Route::controller(CategoryController::class)->group(function () {
        Route::get('/category', 'category')->name('category');
        Route::get('/create-category', 'createCategory')->name('createCategory');
        Route::post('/store-category', 'storeCategory')->name('storeCategory');
        Route::get('/edit-category/{id}', 'editCategory')->name('editCategory');
        Route::patch('/update-category/{id}', 'updateCategory')->name('updateCategory');
        Route::post('/active-category/{id}', 'activeCategory')->name('activeCategory');
        Route::post('/inactive-category/{id}', 'inactiveCategory')->name('inactiveCategory');

        Route::post('/set-online-category/{id}', 'setOnlineCategory')->name('setOnlineCategory');
        Route::post('/remove-online-category/{id}', 'removeOnlineCategory')->name('removeOnlineCategory');
    });

    //subcategory
    Route::controller(SubcategoryController::class)->group(function () {
        Route::get('/subcategory', 'subcategory')->name('subcategory');
        Route::get('/create-subcategory', 'createSubcategory')->name('createSubcategory');
        Route::post('/store-subcategory', 'storeSubcategory')->name('storeSubcategory');
        Route::get('/edit-subcategory/{id}', 'editSubcategory')->name('editSubcategory');
        Route::patch('/update-subcategory/{id}', 'updateSubcategory')->name('updateSubcategory');
        Route::post('/active-subcategory/{id}', 'activeSubcategory')->name('activeSubcategory');
        Route::post('/inactive-subcategory/{id}', 'inactiveSubcategory')->name('inactiveSubcategory');
    });

    //website
    Route::resource('/features', FeatureController::class);
    Route::resource('/packages', PackageController::class);

    Route::resource('/shop_types', ShopTypeController::class);
    Route::resource('/divisions', DivisionController::class);
    Route::resource('/districts', DistrictController::class);
    Route::resource('/areas', AreaController::class);
    Route::resource('/emi_times', EMITimeController::class);
    Route::resource('/banks', BankController::class);
    Route::resource('/subscriptions', SubscriptionController::class);
    Route::get('/subscription/s/histories', [SubscriptionController::class, 'histories'])->name('subscriptions.histories');
    Route::resource('/products', AdminProductController::class);

    //customer or user contact route
    Route::controller(DashboardController::class)->group(function () {

        Route::get('/contatc', 'showContact')->name('showContact');
        Route::post('/contact/update/{contact}', 'updateContact')->name('updateContact');
        Route::delete('/contact/delete/{contact}', 'deleteContact')->name('deleteContact');
        Route::get('/withdraw', 'withdraw')->name('withdraw');
        Route::get('/withdraw/tracking', 'withdrawTracking')->name('withdrawTracking');
        Route::post('/withdraw/store', 'storeWithdraw')->name('storeWithdraw');
    });

    Route::controller(CompanyInfoController::class)->group(function () {
        Route::get('/company-info', 'showCompanyInfo')->name('showCompanyInfo');
        Route::post('/store-company-info', 'storeCompanyInfo')->name('storeCompanyInfo');
    });
    //pages
    Route::controller(PageController::class)->group(function () {
        Route::get('/pages', 'pageList')->name('pageList');
        Route::get('/create-pages', 'pageCreate')->name('pageCreate');
        Route::post('/store-pages', 'pageStore')->name('pageStore');
        Route::get('/edit-pages/{page}', 'pageEdit')->name('pageEdit');
        Route::put('/update-pages/{page}', 'pageUpdate')->name('pageUpdate');
        Route::delete('/delete-pages/{page}', 'pageDelete')->name('pageDelete');
        Route::post('/active-pages/{page}', 'pageActive')->name('pageActive');
        Route::post('/inactive-pages/{page}', 'pageInactive')->name('pageInactive');
    });
});

Route::get('/cc', [CartController::class, 'cc']);
Route::get('/get-category/{category}', [DueController::class, 'category']);
Route::get('/get-consumer', [GeneralController::class, 'getConsumer']);
Route::get('/get-subcategory/{id}', [GeneralController::class, 'getSubcategory']);
Route::get('/get-district/{id}', [GeneralController::class, 'getDistrict']);
Route::get('/get-area/{id}', [GeneralController::class, 'getArea']);

//payment
Route::post('/pay', [SslCommerzPaymentController::class, 'index']);
Route::post('/success', [SslCommerzPaymentController::class, 'success']);
Route::post('/fail', [SslCommerzPaymentController::class, 'fail']);
Route::post('/cancel', [SslCommerzPaymentController::class, 'cancel']);
Route::post('/ipn', [SslCommerzPaymentController::class, 'ipn']);

//subscription payment
Route::post('/subscription-payment', [SubscriptionPaymentController::class, 'subscriptionPayment'])->name('subscriptionPayment');
Route::post('/subscription_success', [SubscriptionPaymentController::class, 'subscriptionSuccess']);
Route::post('/subscription_fail', [SubscriptionPaymentController::class, 'subscriptionFail']);
Route::post('/subscription_cancel', [SubscriptionPaymentController::class, 'subscriptionCancel']);
Route::post('/subscription-ipn', [SubscriptionPaymentController::class, 'subscriptionIpn']);

//online-market payment
Route::post('/online-market-payment', [OnlineMarketPaymentController::class, 'onlineMarketPayment'])->name('onlineMarketPayment');
Route::post('/online_market_success', [OnlineMarketPaymentController::class, 'onlineMarketSuccess']);
Route::post('/online_market_fail', [OnlineMarketPaymentController::class, 'onlineMarketFail']);
Route::post('/online_market_cancel', [OnlineMarketPaymentController::class, 'onlineMarketCancel']);
// Route::post('/online-market-ipn', [OnlineMarketPaymentController::class, 'onlineMarketIpn']);
//SSLCOMMERZ END

Route::get('/payments/{link}', [GeneralController::class, 'consumerPayment'])->name('payment.consumerPayment');