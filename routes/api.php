<?php

use App\Http\Controllers\BookingController;
use App\Http\Controllers\CollectionController;
use App\Http\Controllers\CommonController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\DesignationController;
use App\Http\Controllers\DistrictController;
use App\Http\Controllers\DivisionController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\EmployeeSalaryController;
use App\Http\Controllers\MowzaController;
use App\Http\Controllers\PurchaseController;
use App\Http\Controllers\RegistrationController;
use App\Http\Controllers\ReportsController;
use App\Http\Controllers\SalesController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\ThanaController;
use App\Http\Controllers\UnionController;
use App\Http\Controllers\UnitController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Laravel\Fortify\Http\Controllers\AuthenticatedSessionController;
use Laravel\Fortify\Http\Controllers\RegisteredUserController;

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

Route::get('user/list',[UserController::class,'index']);
Route::get('user/edit/{id}',[UserController::class,'edit']);
Route::post('user/update/{id}',[UserController::class,'update']);
Route::post('user/delete/{id}',[UserController::class,'destroy']);

Route::post('resister',[RegisteredUserController::class,'store']);
Route::post('login',[AuthenticatedSessionController::class,'store']);
Route::post('logout',[AuthenticatedSessionController::class,'destroy']);

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

Route::get('designation',[DesignationController::class,'index']);
Route::post('designation/create',[DesignationController::class,'store']);
Route::get('designation/edit/{id}',[DesignationController::class,'edit']);
Route::post('designation/update/{id}',[DesignationController::class,'update']);
Route::post('designation/delete/{id}',[DesignationController::class,'destroy']);

Route::get('department',[DepartmentController::class,'index']);
Route::post('department/create',[DepartmentController::class,'store']);
Route::get('department/edit/{id}',[DepartmentController::class,'edit']);
Route::post('department/update/{id}',[DepartmentController::class,'update']);
Route::post('department/delete/{id}',[DepartmentController::class,'destroy']);

Route::get('district',[DistrictController::class,'index']);
Route::post('district/create',[DistrictController::class,'store']);
Route::get('district/edit/{id}',[DistrictController::class,'edit']);
Route::post('district/update/{id}',[DistrictController::class,'update']);
Route::post('district/delete/{id}',[DistrictController::class,'destroy']);

Route::get('division',[DivisionController::class,'index']);
Route::post('division/create',[DivisionController::class,'store']);
Route::get('division/edit/{id}',[DivisionController::class,'edit']);
Route::post('division/update/{id}',[DivisionController::class,'update']);
Route::post('division/delete/{id}',[DivisionController::class,'destroy']);

Route::get('thana',[ThanaController::class,'index']);
Route::post('thana/create',[ThanaController::class,'store']);
Route::get('thana/edit/{id}',[ThanaController::class,'edit']);
Route::post('thana/update/{id}',[ThanaController::class,'update']);
Route::post('thana/delete/{id}',[ThanaController::class,'destroy']);

Route::get('union',[UnionController::class,'index']);
Route::post('union/create',[UnionController::class,'store']);
Route::get('union/edit/{id}',[UnionController::class,'edit']);
Route::post('union/update/{id}',[UnionController::class,'update']);
Route::post('union/delete/{id}',[UnionController::class,'destroy']);

Route::get('mowza',[MowzaController::class,'index']);
Route::post('mowza/create',[MowzaController::class,'store']);
Route::get('mowza/edit/{id}',[MowzaController::class,'edit']);
Route::post('mowza/update/{id}',[MowzaController::class,'update']);
Route::post('mowza/delete/{id}',[MowzaController::class,'destroy']);

Route::get('booking',[BookingController::class,'index']);
Route::post('booking/create',[BookingController::class,'store']);
Route::get('booking/view/{id}',[BookingController::class,'show']);
Route::get('booking/edit/{id}',[BookingController::class,'edit']);
Route::post('booking/update/{id}',[BookingController::class,'update']);
Route::post('booking/delete/{id}',[BookingController::class,'destroy']);
Route::get('booking_no',[BookingController::class,'booking_no']);

Route::get('employee_salary',[EmployeeSalaryController::class,'index']);
Route::post('employee_salary/create',[EmployeeSalaryController::class,'store']);
Route::get('employee_salary/view/{id}',[EmployeeSalaryController::class,'show']);
Route::get('employee_salary/edit/{id}',[EmployeeSalaryController::class,'edit']);
Route::post('employee_salary/update/{id}',[EmployeeSalaryController::class,'update']);
Route::post('employee_salary/delete/{id}',[EmployeeSalaryController::class,'destroy']);

Route::get('registration',[RegistrationController::class,'index']);
Route::post('registration/create',[RegistrationController::class,'store']);
Route::get('registration/view/{id}',[RegistrationController::class,'show']);
Route::get('registration/edit/{id}',[RegistrationController::class,'edit']);
Route::post('registration/update/{id}',[RegistrationController::class,'update']);
Route::post('registration/delete/{id}',[RegistrationController::class,'destroy']);
Route::get('registration_no',[RegistrationController::class,'registration_no']);

Route::get('collection',[CollectionController::class,'index']);
Route::post('collection/create',[CollectionController::class,'store']);
Route::get('collection/view/{id}',[CollectionController::class,'show']);
Route::get('collection/edit/{id}',[CollectionController::class,'edit']);
Route::post('collection/update/{id}',[CollectionController::class,'update']);
Route::post('collection/delete/{id}',[CollectionController::class,'destroy']);
Route::get('collection_no',[CollectionController::class,'registration_no']);

Route::get('purchase',[PurchaseController::class,'index']);
Route::post('purchase/create',[PurchaseController::class,'store']);
Route::get('purchase/view/{id}',[PurchaseController::class,'show']);
Route::get('purchase/edit/{id}',[PurchaseController::class,'edit']);
Route::post('purchase/update/{id}',[PurchaseController::class,'update']);
Route::post('purchase/delete/{id}',[PurchaseController::class,'destroy']);

Route::get('sales',[SalesController::class,'index']);
Route::post('sales/create',[SalesController::class,'store']);
Route::get('sales/view/{id}',[SalesController::class,'show']);
Route::get('sales/edit/{id}',[SalesController::class,'edit']);
Route::post('sales/update/{id}',[SalesController::class,'update']);
Route::post('sales/delete/{id}',[SalesController::class,'destroy']);

Route::post('monthly_purchase',[ReportsController::class,'monthly_purchase']);
Route::post('monthly_sales',[ReportsController::class,'monthly_sales']);

Route::get('get_data/{table}/{column}/{id}',[CommonController::class,'getData']);
Route::get('get_data/{table}/{column}',[CommonController::class,'getData']);
Route::get('get_data/{table}',[CommonController::class,'getData']);

Route::post('download_pdf',[CommonController::class,'download_pdf']);
Route::get('download_xl',[CommonController::class,'download_xl']);
