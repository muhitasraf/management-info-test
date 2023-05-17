<?php

use App\Http\Controllers\CompanyController;
use App\Http\Controllers\CustomerController;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('company',[CompanyController::class,'index']);
Route::post('company/create',[CompanyController::class,'store']);
Route::post('company/edit/{id}',[CompanyController::class,'edit']);
Route::post('company/update/{id}',[CompanyController::class,'update']);
Route::post('company/delete/{id}',[CompanyController::class,'destroy']);

Route::get('customer',[CustomerController::class,'index']);
Route::post('customer/create',[CustomerController::class,'store']);
Route::post('customer/edit/{id}',[CustomerController::class,'edit']);
Route::post('customer/update/{id}',[CustomerController::class,'update']);
Route::post('customer/delete/{id}',[CustomerController::class,'destroy']);
