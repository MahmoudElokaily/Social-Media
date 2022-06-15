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
    Route::get('send-email' , 'AuthController@sendEmailVerification');
    Route::get('verification-email/{id}' , 'AuthController@verificationEmail')->name('auth.verification');
});

Route::get('send-email' , function (){
    $mailData = [
        'name' => 'Mahmoud',
        'dob' => '27/11/2000',
    ];
    \Illuminate\Support\Facades\Mail::to('hello@example.com')->send(new \App\Mail\TestEmail($mailData));
    dd("Mail send successfully");
});

############################## End Auth #################################################
