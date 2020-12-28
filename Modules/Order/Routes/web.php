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

Route::group(['prefix' => '', 'namespace' => '\Modules\Order\Http\Controllers'], function()
{
    Route::get('/cart', 'OrderController@cart')->name('web.cart');
    Route::get('/addcart/{id}', 'OrderController@user_addCart')->name('web.add_cart');
    Route::get('/Delete-Item-Cart/{id}', 'OrderController@user_DeleteItemCart')->name('web.delete_item_cart');
    Route::get('/checkout', 'OrderController@checkout')->name('web.checkout');
    Route::get('/save-checkout-customer', 'OrderController@save_checkout_customer')->name('web.save-checkout-customer');
    Route::get('/payment', 'OrderController@payment')->name('web.payment');
    Route::get('/order-place', 'OrderController@order_place')->name('web.order-place');
});
