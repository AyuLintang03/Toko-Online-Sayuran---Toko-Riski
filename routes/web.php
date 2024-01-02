<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoryProductController;
use App\Http\Controllers\CategoryResepController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ResepController;
use App\Http\Controllers\CartProductController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\DeleteController;
use App\Http\Controllers\OrderOfflineController;
//use App\Http\Controllers\Auth\SocialiteController;
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

use Illuminate\Foundation\Auth\EmailVerificationRequest;



Route::get('/email/verify', function () {
    return view('auth.verify-email');
})->middleware('auth')->name('verification.notice');

Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
    $request->fulfill();

    return redirect('/home'); // Ganti '/home' dengan rute yang sesuai
})->middleware(['auth', 'signed'])->name('verification.verify');

Route::post('/email/verification-notification', function (\Illuminate\Http\Request $request) {
    $request->user()->sendEmailVerificationNotification();

    return back()->with('message', 'Verification link sent!');
})->middleware(['auth', 'throttle:6,1'])->name('verification.send');


Route::get('email/verify', 'Auth\VerificationController@show')->name('verification.notice');
Route::get('email/verify/{id}/{hash}', 'Auth\VerificationController@verify')->name('verification.verify');
Route::post('email/resend', 'Auth\VerificationController@resend')->name('verification.resend');
Route::post('/logout', 'Auth\LoginController@logout')->name('logout');


Route::get('/', [\App\Http\Controllers\HomeController::class, 'index'])->name('homepage');

Route::get('/notifications', [NotificationController::class, 'notifikasi'])->name('notifikasi');


Route::get('/auth/{provider}', [LoginController::class, 'redirectToProvider']);
Route::get('/auth/{provider}/callback', [LoginController::class, 'handleProviderCallback']);

//Route::get('/auth/google', [GoogleController::class, 'redirectToGoogle'])->name('google.login');
//Route::get('/auth/google/callback', [GoogleController::class, 'handleGoogleCallback'])->name('google.callback');;

// get user login
Route::get('api/users', [\App\Http\Controllers\UserController::class, 'index']);
// ==========
Route::post('/process-payment', [OrderController::class,'processPayment'])->name('process_payment');


Route::get('/product-list/{categoryproduct}', [ProductController::class, 'product_list'])->name('product_list');
Route::get('/product/{product}', [ProductController::class, 'product_detail'])->name('product_detail');


Route::post('/add_to_cart_resep/{resep}', [CartProductController::class, 'add_to_cart_resep'])->name('add_to_cart_resep');
Route::post('/add_to_cart_product/{product}', [CartProductController::class, 'add_to_cart_product'])->name('add_to_cart_product');
Route::get('/cart', [CartProductController::class, 'show_cart_product'])->name('show_cart_product');
Route::patch('/cart/{cartproduct}', [CartProductController::class, 'update_cart_product'])->name('update_cart_product');
Route::patch('/update_cart_resep/{cartresep}', [CartProductController::class, 'update_cart_resep'])->name('update_cart_resep');
Route::get('/cart/{cartproduct}', [CartProductController::class, 'delete_cart_product'])->name('delete_cart_product');
Route::get('/delete_cart_resep/{cartresep}', [CartProductController::class, 'delete_cart_resep'])->name('delete_cart_resep');
 
Route::get('/user/delivery', [OrderController::class, 'delivery'])->name('delivery');
Route::patch('/uaser/mark-order-received/{order}', [OrderController::class, 'markOrderReceived'])->name('markOrderReceived');

Route::get('/resep-list/{categoryresep}', [ResepController::class, 'resep_list'])->name('resep_list');
Route::get('/resep/{resep}', [ResepController::class, 'resep_detail'])->name('resep_detail');

Route::any('/user/myorder/{order}', [OrderController::class, 'delete_order_user'])->name('delete_order_user');

Route::any('/user/delivery{order}', [OrderController::class, 'delete_order_delivery'])->name('delete_order_delivery');

  

Route::post('/user/myorder', [OrderController::class, 'store_order'])->name('store_order');
Route::get('/user', [UserController::class,'showProfile'])->name('user_profile');
Route::get('/user/myorder', [OrderController::class,'order_user'])->name('order_user');
Route::get('/checkout/{order}', [OrderController::class,'redirectToCheckout'])->name('checkout');
Route::patch('/user/{user}',  [UserController::class,'update_profile'])->name('update_profile');
 Route::post('/order/update-status/{order}', [OrderController::class, 'respondToUser'])->name('respondToUser');
 
Route::group(['middleware' => 'auth'], function() {
    
    Route::group(['middleware' => ['isAdmin'],'prefix' => 'admin', 'as' => 'admin.'], function() {
    Route::get('dashboard', [\App\Http\Controllers\Admin\DashboardController::class, 'index'])->name('dashboard');
    Route::get('user', [UserController::class, 'index_user'])->name('index_user'); 
    Route::get('user/search', [UserController::class, 'searchUser'])->name('searchUser');
    Route::get('/user/{user}', [UserController::class, 'delete_user'])->name('delete_user');
    Route::get('categoryproduct', [CategoryProductController::class, 'index_category_product'])->name('index_category_product');
    Route::get('/categoryproduct/search', [CategoryProductController::class, 'searchcategoryproduct'])->name('searchcategoryproduct');
    Route::get('/categoryproduct/create', [CategoryProductController::class, 'create_category_product'])->name('create_category_product');
    Route::post('/categoryproduct/create', [CategoryProductController::class, 'store_category_product'])->name('store_category_product');
    Route::get('/categoryproduct/{categoryproduct}/edit', [CategoryProductController::class, 'edit_category_product'])->name('edit_category_product');
    Route::patch('/categoryproduct/{categoryproduct}/update', [CategoryProductController::class, 'update_category_product'])->name('update_category_product');
    Route::any('/categoryproduct/{categoryproduct}', [CategoryProductController::class, 'delete_category_product'])->name('delete_category_product');
    Route::get('categoryresep', [CategoryResepController::class, 'index_category_resep'])->name('index_category_resep');
    Route::get('/categoryresep/search', [CategoryResepController::class, 'searchcategoryresep'])->name('searchcategoryresep');
    Route::get('/categoryresep/create', [CategoryResepController::class, 'create_category_resep'])->name('create_category_resep');
    Route::post('/categoryresep/create', [CategoryResepController::class, 'store_category_resep'])->name('store_category_resep');
    Route::get('/categoryresep/{categoryresep}/edit', [CategoryResepController::class, 'edit_category_resep'])->name('edit_category_resep');
    Route::patch('/categoryresep/{categoryresep}/update', [CategoryResepController::class, 'update_category_resep'])->name('update_category_resep');
    Route::any('/categoryresep/{categoryresep}', [CategoryResepController::class, 'delete_category_resep'])->name('delete_category_resep');
    

    
    Route::get('/resep/create', [ResepController::class, 'create_resep'])->name('create_resep');
    Route::post('/resep/create', [ResepController::class, 'store_resep'])->name('store_resep');
    Route::get('resep', [ResepController::class, 'index_resep'])->name('index_resep');
    Route::get('/resep/{resep}/edit', [ResepController::class, 'edit_resep'])->name('edit_resep');
    Route::patch('/resep/{resep}/update', [ResepController::class, 'update_resep'])->name('update_resep');
    Route::any('/resep/{resep}', [ResepController::class, 'delete_resep'])->name('delete_resep');
    Route::get('/reseps', [ResepController::class, 'searchresep'])->name('searchresep');
    
    
    Route::get('/product', [ProductController::class, 'index_product'])->name('index_product');
    Route::get('/product/create', [ProductController::class, 'create_product'])->name('create_product');
    Route::post('/product/create', [ProductController::class, 'store_product'])->name('store_product');
    Route::get('/product/{product}/edit', [ProductController::class, 'edit_product'])->name('edit_product');
    Route::patch('/product/{product}/update', [ProductController::class, 'update_product'])->name('update_product');
    Route::any('/product/{product}', [ProductController::class, 'delete_product'])->name('delete_product');
    Route::get('/productsearch', [ProductController::class, 'searchproduct'])->name('searchproduct');
     
    Route::get('/order', [OrderController::class, 'index_order'])->name('index_order');
    
    Route::get('/order/{order}', [OrderController::class, 'show_order'])->name('show_order');
    
   // Route::any('/order/{order}', [OrderController::class, 'deleteorder'])->name('deleteorder');
   Route::any('/orders/{order}', [DeleteController::class, 'destroy'])->name('destroy');
    
   Route::any('/ordersearch/search', [OrderController::class, 'searchOrder'])->name('searchOrder');
    Route::get('/deliverysearch', [DeleteController::class, 'searchdelivery'])->name('searchdelivery');
    Route::get('/delivery', [OrderController::class, 'index_delivery'])->name('index_delivery');
    Route::get('/report', [OrderController::class, 'generateReport'])->name('generateReport');
    Route::any('/delivery/{delivery}', [DeleteController::class, 'destroy_delivery'])->name('destroy_delivery');
    Route::any('/report/{order}', [DeleteController::class, 'destroy_laporan'])->name('destroy_laporan');
    
    Route::get('/report/order', [ReportController::class, 'generateReportOrder'])->name('generateReportOrder');

    Route::post('/print-laporan', [ReportController::class,'generatePDF'])->name('export');
   
    Route::get('/ordersearch', [ReportController::class, 'searchraport'])->name('searchraport');  
    Route::patch('/orders/{order}/update-status', [OrderController::class,'update_order_status'])->name('update_order_status'); 
    Route::get('/order/{order}/edit', [OrderController::class, 'edit_order'])->name('edit_order');
    Route::get('/createdelivery/create', [OrderController::class, 'createdelivery'])->name('createdelivery');
    Route::post('/store-delivery', [OrderController::class, 'storeDelivery'])->name('store_delivery');
    Route::patch('/updatedelivery/{delivery}', [OrderController::class,'update_delivery'])->name('update_delivery'); 
    Route::get('/delivery/{delivery}/edit', [OrderController::class, 'editdelivery'])->name('editdelivery');
    Route::get('/order_offline/create', [OrderOfflineController::class, 'create_order_offline'])->name('create_order_offline');
    Route::post('/order_offline/store', [OrderOfflineController::class, 'store_order_offline'] )->name('store_order_offline');
    Route::get('/order_offline', [OrderOfflineController::class, 'index_order_offline'] )->name('index_order_offline');
     Route::get('/order_offline/{orderoffline}/edit', [OrderOfflineController::class, 'edit_order_offline'])->name('edit_order_offline');
    Route::patch('/order_offline/{orderoffline}/update', [OrderOfflineController::class, 'update_order_offline'])->name('update_order_offline');
    Route::get('/order_offline/{orderoffline}', [OrderOfflineController::class, 'show_order_offline'])->name('show_order_offline');

    });
});



Auth::routes(['verify'=>true]);

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
