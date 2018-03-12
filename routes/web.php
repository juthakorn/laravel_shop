<?php

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


//Route::get('/', function () {
//        return view('welcome');
//    });
Route::get('/', 'FrontController@index');    
Route::get('product/get_stock/{id}', 'FrontController@get_stock');
Route::post('product/add_to_cart', 'CartController@add_to_cart');
Route::get('product/remove_cart/{id}', 'CartController@remove_cart');
Route::get('product/{id}/{name}', 'FrontController@product');
Route::get('product/{id}', 'FrontController@product');
Route::get('products', 'FrontController@product_all');
//******************* User *****************
Route::get('login/', 'Auth\LoginController@showLoginForm');
Route::post('login/', 'Auth\LoginController@login');
Route::get('register/', 'Auth\RegisterController@showRegistrationForm');
Route::post('register/', 'Auth\RegisterController@register');

//Route profile
Route::get('customer/', 'UserController@profile');
Route::post('customer/user_upload_image/', 'UserController@user_upload_image');
Route::post('customer/profile_update/', ['uses' => 'UserController@profile_update', 'as' => 'user.update']);

Route::group(['middleware' => ['auth']], function () {
Route::get('customer/order/', 'OrderController@index');
Route::get('customer/order/{id}', 'OrderController@detail');
Route::get('customer/track/{track}', 'OrderController@track');
Route::post('order/cancel_order/', ['uses' => 'OrderController@cancel_order', 'as' => 'order.cancel']);
Route::get('order/print/{id}', 'OrderController@print_pdf');
Route::get('payment/info/{id}', 'OrderController@payment_info');
});

Route::any('payment/', 'OrderController@payment');

//Route Address
Route::get('customer/address/', 'UserController@address');
Route::post('customer/address_create/', ['uses' => 'UserController@address_create', 'as' => 'address.create']);
Route::delete('customer/address_remove/{id}/', ['uses' => 'UserController@address_remove', 'as' => 'address.remove']);
Route::get('customer/address_edit/{id}', 'UserController@address_edit');
Route::post('customer/address_update/{id}', ['uses' => 'UserController@address_update', 'as' => 'address.update']);

//Route Change password
Route::get('customer/password/', 'Auth\UpdatePasswordController@index');
Route::post('customer/password_update/', ['uses' => 'Auth\UpdatePasswordController@update', 'as' => 'password.update']);

//article
Route::get('article/', 'BlogController@front_index');
Route::get('article/tag/{tag}', 'BlogController@show_tag');
Route::get('article/date/{date}', 'BlogController@show_date');
Route::get('article/{id}/{name}', 'BlogController@show');
Route::get('article/{id}', 'BlogController@show');

//contact
Route::get('contactus/', 'ContactController@index');
Route::post('contactus/', 'ContactController@action');

//forums
Route::get('forums/', 'ForumController@index');
Route::get('forums/show_thread/{id}', 'ForumController@show_thread');
Route::get('forums/new_thread', 'ForumController@new_thread');
Route::get('forums/edit_thread/{id}', 'ForumController@edit_thread');
Route::get('forums/new_reply/{id}', 'ForumController@new_reply');
Route::get('forums/edit_reply/{id}', 'ForumController@edit_reply');
Route::delete('forums/question_remove/{id}', ['uses' => 'ForumController@question_remove', 'as' => 'forum.question_remove']);
Route::delete('forums/remove_reply/{id}', ['uses' => 'ForumController@reply_remove', 'as' => 'forum.reply_remove']);
Route::post('forums/question_create/', ['uses' => 'ForumController@question_create', 'as' => 'forum.question_create']);
Route::put('forums/question_update/{id}', ['uses' => 'ForumController@question_update', 'as' => 'forum.question_update']);   
Route::post('forums/reply_create/{id}', ['uses' => 'ForumController@reply_create', 'as' => 'forum.reply_create']);
Route::put('forums/reply_update/{id}', ['uses' => 'ForumController@reply_update', 'as' => 'forum.reply_update']);
Route::post('forums/upload_media', ['uses' => 'ForumController@upload_media', 'as' => 'forum.upload_media']);

// Cart & CheckOut
Route::get('checkout/cart', 'CartController@index');
Route::post('checkout/action_cart/', 'CartController@action_cart');
Route::post('checkout/set_delivery', 'CartController@set_delivery');
Route::post('checkout/set_payment', 'CartController@set_payment');
Route::post('checkout/check_discounts', 'CartController@check_discounts');
Route::any('checkout/stap2', 'CartController@write_cookie'); //write cookie for Guest
Route::get('checkout/address', 'CheckoutController@address');
Route::get('checkout/form_address/{id}', 'CheckoutController@form_address');
Route::get('checkout/form_address/', 'CheckoutController@form_address');
Route::post('checkout/save_address', 'CheckoutController@save_address');
Route::delete('checkout/remove_address/{id}', 'CheckoutController@remove_address');
Route::any('checkout/verify/', 'CheckoutController@verify');
Route::any('checkout/success/', 'CheckoutController@success');
//ไม่ต้อง login ก่อน
//Route::group(['middleware' => ['web']], function () {
//    
//});

//ต้อง login ก่อน
Route::group(['middleware' => ['auth']], function () {
   Route::get('/home1', 'HomeController@test');   
   Route::resource('admin/blog', 'BlogController',['except' => ['show']]);
   
});

Route::resource('admin/bank', 'BankController', [
	'except' => ['show']
]);
Route::resource('admin/code_discount', 'CodeDiscountController', [
	'except' => ['show']
]);
Route::post('admin/type_product/position', ['uses' => 'TypeProductController@position', 'as' => 'type_product.position']);
Route::resource('admin/type_product', 'TypeProductController', [
	'except' => ['show']
]);


Route::resource('admin/product', 'ProductController');

Route::resource('admin/profile', 'ProfileController');

Route::any('admin/category/position', ['uses' => 'CategoryController@position', 'as' => 'category.position']);
Route::resource('admin/category', 'CategoryController', [
	'except' => ['show']
]);


// Route Image 
Route::post('admin/image/saveimg', 'ImageController@saveimg');
Route::post('admin/image/removeimg', 'ImageController@removeimg');
Route::post('admin/image/save_album', 'ImageController@save_album');
Route::get('admin/image/load_album/{id}', 'ImageController@load_album');


//admin order
Route::any('admin/order/', 'OrderAdminController@index');
Route::get('admin/order/detail/{id}', 'OrderAdminController@detail');  
Route::post('admin/order/delivery/{id}', ['uses' => 'OrderAdminController@delivery', 'as' => 'adminorder.delivery']);
Route::get('admin/payment/info/{id}', 'OrderAdminController@payment_info');
Route::post('admin/payment/action', ['uses' => 'OrderAdminController@payment_action', 'as' => 'OrderAdmin.payment_action']);
Route::post('admin/order/cancel_order/', ['uses' => 'OrderAdminController@cancel_order', 'as' => 'adminorder.cancel']);
Route::delete('admin/order/{id}', ['uses' => 'OrderAdminController@destroy', 'as' => 'adminorder.destroy']);


//Route::auth();
Route::get('logout', function (){
    Auth::logout();
    return redirect('/');
});

Route::get('check-connect',function(){
 if(DB::connection()->getDatabaseName())
 {
 return "Yes! successfully connected to the DB: " . DB::connection()->getDatabaseName();
 }else{
 return 'Connection False !!';
 }
});