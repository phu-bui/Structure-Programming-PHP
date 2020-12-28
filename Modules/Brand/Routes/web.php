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
Route::group(['prefix' => '', 'namespace' => '\Modules\Brand\Http\Controllers'], function()
{
    Route::get('/brand/{brand_slug}', 'BrandController@show_brand_home')->name('web.brand_home');
});
