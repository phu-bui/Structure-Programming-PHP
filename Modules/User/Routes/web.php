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

Route::group(['middleware' => 'web', 'prefix' => 'admin', 'namespace' => '\Modules\User\Http\Controllers'], function()
{
    Route::group(['middleware' => 'guest:admin,admin.index'], function() {
        Route::get('/login', 'AdminController@showLoginForm')->name('admin.login');
        Route::post('/login', 'AdminController@login')->name('admin.post-login');
    });

    Route::group(['middleware' => 'auth.admin'], function() {
        Route::get('/', 'AdminController@index')->name('admin.index');
        Route::get('/logout', 'AdminController@logout')->name('admin.logout');
    });
});

Route::group(['prefix' => '', 'namespace' => '\Modules\User\Http\Controllers'], function() {
    Route::get('/login', 'UserController@showLoginForm')->name('web.login');
    Route::post('/login', 'UserController@login')->name('web.post-login');
    Route::post('/register', 'UserController@register')->name('web.post-register');
    Route::get('/logout', 'UserController@logout')->name('web.logout');
});
