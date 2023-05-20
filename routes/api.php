<?php

use App\Http\Controllers\CompanyController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\UnitController;
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
Route::post('customer/view/{id}',[CustomerController::class,'show']);
Route::post('customer/edit/{id}',[CustomerController::class,'edit']);
Route::post('customer/update/{id}',[CustomerController::class,'update']);
Route::post('customer/delete/{id}',[CustomerController::class,'destroy']);

Route::get('supplier',[SupplierController::class,'index']);
Route::post('supplier/create',[SupplierController::class,'store']);
Route::post('supplier/view/{id}',[SupplierController::class,'show']);
Route::post('supplier/edit/{id}',[SupplierController::class,'edit']);
Route::post('supplier/update/{id}',[SupplierController::class,'update']);
Route::post('supplier/delete/{id}',[SupplierController::class,'destroy']);

Route::get('employee',[EmployeeController::class,'index']);
Route::post('employee/create',[EmployeeController::class,'store']);
Route::post('employee/view/{id}',[EmployeeController::class,'show']);
Route::get('employee/edit/{id}',[EmployeeController::class,'edit']);
Route::post('employee/update/{id}',[EmployeeController::class,'update']);
Route::post('employee/delete/{id}',[EmployeeController::class,'destroy']);

Route::get('unit',[UnitController::class,'index']);
Route::post('unit/create',[UnitController::class,'store']);
Route::get('unit/edit/{id}',[UnitController::class,'edit']);
Route::post('unit/update/{id}',[UnitController::class,'update']);
Route::post('unit/delete/{id}',[UnitController::class,'destroy']);
