<?php

use App\Http\Controllers\API\CompanyController;
use App\Http\Controllers\API\EmployeeController;
use App\Http\Controllers\API\LoginController;
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

Route::resource('company',CompanyController::class)->only(['index','store','show','update','destroy']);
Route::resource('employee',EmployeeController::class)->only(['index','store','show','update','destroy']);
Route::get('/getCompanies', [EmployeeController::class,'getCountries'])->name('countries');
Route::post('login', [LoginController::class,'login'])->name('login');
