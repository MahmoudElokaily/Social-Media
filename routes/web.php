<?php

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

############################## Auth #################################################

Route::group(['prefix' => 'auth' , 'namespace' => 'App\Http\Controllers\Auth'] , function () {
    Route::get('login', 'AuthController@login')->name('auth.login');
    Route::post('check' ,'AuthController@check')->name('auth.check');
    Route::get('register' , 'AuthController@register')->name('auth.register');
    Route::post('store' , 'AuthController@store')->name('auth.store');
    Route::get('send-email-verification' , 'AuthController@sendEmailVerification');
    Route::get('verification-email/{id}' , 'AuthController@verificationEmail')->name('auth.verification');
    Route::get('forget-password' , 'AuthController@forgetPassword')->name('auth.forget');
    Route::post('send-password-mail' , 'AuthController@sendPasswordMail')->name('auth.send_password_mail');
    Route::get('reset-password/{id}' , 'AuthController@resetPassword')->name('auth.reset_password');
    Route::post('rest-password-done' , 'AuthController@updatePassword')->name('auth.update_password');
});


############################## End Auth #################################################
