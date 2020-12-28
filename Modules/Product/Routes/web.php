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

Route::group(['middleware' => 'web', 'prefix' => 'admin', 'namespace' => '\Modules\Product\Http\Controllers'], function()
{
    Route::get('/products', 'ProductController@index')->name('admin.products.list');
    Route::get ('/add-products', 'ProductController@add_product')->name('admin.add_product');
    Route::post('/save-products', 'ProductController@save_product')->name('admin.save_product');
    Route::get('/edit-products/{product_id}', 'ProductController@edit_product')->name('admin.edit_product');
    Route::post('/update-products/{product_id}', 'ProductController@update_product')->name('admin.update_product');
    Route::get('/delete-products/{product_id}', 'ProductController@delete_product')->name('admin.delete_product');
});

Route::group(['prefix' => '', 'namespace' => '\Modules\Product\Http\Controllers'], function()
{
    Route::post('/search', 'ProductController@search')->name('web.search');
});
