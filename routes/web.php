<?php

use Illuminate\Support\Facades\Route;
use Spatie\Sitemap\Sitemap;
use Spatie\Sitemap\Tags\Url;

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

Route::any('/ckfinder/connector', '\CKSource\CKFinderBridge\Controller\CKFinderController@requestAction')
    ->name('ckfinder_connector');

Route::any('/ckfinder/browser', '\CKSource\CKFinderBridge\Controller\CKFinderController@browserAction')
    ->name('ckfinder_browser');

Route::group(['prefix' => 'auth', 'namespace' => 'App\\Http\\Controllers\\Admin'], function () {
    Route::get('login', function () {
        return view('auth.login');
    })->name('auth.getLogin');
    Route::post('login', 'LoginController@login')->name('auth.postLogin');
    Route::get('logout', 'LoginController@logout')->name('auth.postLogout');

    Route::get('forgot-password', function () {
        return view('auth.forgot-password');
    })->name('auth.getForgotPassword');
    Route::post('forgot-password', 'ForgotPasswordController@resetPassword')->name('auth.sendMail');

    Route::get('reset-password/{token}', 'ForgotPasswordController@getFormResetPassword')->name('auth.getRecoverPassword');
    Route::post('reset-password/{token}', 'ForgotPasswordController@resetPasswordChange')->name('auth.postRecoverPassword');
});
Route::group(['namespace' => 'App\\Http\\Controllers\\Admin', 'middleware' => ['auth','check-ip'], 'prefix' => '/admin'], function () {
    Route::get('/', 'AdminController@index')->name('admin.dashboard');

    Route::group(['prefix' => 'news'], function () {
        Route::get('/', 'NewController@index')->name('admin.news.list');
        Route::get('/detail', 'NewController@detail')->name('admin.news.detail');
        Route::get('/form', 'NewController@getForm')->name('admin.news.form.get');
        Route::post('/form', 'NewController@saveForm')->name('admin.news.form.post');
        Route::get('/edit/{id}', 'NewController@editForm')->name('admin.news.form.edit');
        Route::post('/update/{id}', 'NewController@updateForm')->name('admin.news.form.update');
        Route::get('/delete/{id}', 'NewController@delete')->name('admin.news.delete');
    });

    Route::group(['prefix' => 'voucher'], function () {
        Route::get('/', 'VoucherController@index')->name('admin.voucher.list');
        Route::get('/detail', 'VoucherController@detail')->name('admin.voucher.detail');
        Route::get('/form', 'VoucherController@getForm')->name('admin.voucher.form.get');
        Route::post('/form', 'VoucherController@saveForm')->name('admin.voucher.form.post');
        Route::get('/edit/{id}', 'VoucherController@editForm')->name('admin.voucher.form.edit');
        Route::post('/update/{id}', 'VoucherController@updateForm')->name('admin.voucher.form.update');
        Route::get('/delete/{id}', 'VoucherController@delete')->name('admin.voucher.delete');
    });

    Route::group(['namespace' => 'User', 'prefix' => 'users'], function () {
        Route::get('/', 'UserController@index')->name('admin.user.list');
        Route::get('/detail', 'UserController@detail')->name('admin.user.detail');
        Route::get('/form', 'UserController@getForm')->name('admin.user.form.get');
        Route::post('/form', 'UserController@saveForm')->name('admin.user.form.post');
        Route::get('/edit/{id}', 'UserController@editForm')->name('admin.user.form.edit');
        Route::post('/update/{id}', 'UserController@updateForm')->name('admin.user.form.update');
        Route::get('/delete/{id}', 'UserController@delete')->name('admin.user.delete');
    });

    Route::group(['namespace' => 'User', 'prefix' => 'users'], function () {
        Route::get('/', 'UserController@index')->name('admin.user.list');
        Route::get('/detail', 'UserController@detail')->name('admin.user.detail');
        Route::get('/form', 'UserController@getForm')->middleware('check-admin-permission')->name('admin.user.form.get');
        Route::post('/form', 'UserController@saveForm')->middleware('check-admin-permission')->name('admin.user.form.post');
        Route::get('/edit/{id}', 'UserController@editForm')->name('admin.user.form.edit');
        Route::post('/update/{id}', 'UserController@updateForm')->name('admin.user.form.update');
        Route::get('/delete/{id}', 'UserController@delete')->middleware('check-admin-permission')->name('admin.user.delete');
    });
});
