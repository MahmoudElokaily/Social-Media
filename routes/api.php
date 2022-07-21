<?php

use App\Http\Controllers\Auth\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::get('users' , [AuthController::class , 'index']);
Route::post('register' , [AuthController::class , 'register']);
Route::post('login' , [AuthController::class , 'login']);
Route::get('user/{id}' , [AuthController::class , 'show']);

Route::group(['middleware' => ['auth:sanctum']] , function (){
    Route::put('update/{id}' , [AuthController::class , 'update']);
    Route::delete('delete/{id}' ,[AuthController::class , 'delete']);
    Route::post('logout' , [AuthController::class , 'logout']);
});


Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

