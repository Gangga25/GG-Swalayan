<?php

use App\Http\Controllers\TransactionController;
use App\Http\Controllers\DetailController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\StuffController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('generateDate', [AuthController::class, 'generateData']);

Route::get('/', function () {
    return view('home');
})->middleware('is.auth');

Route::get('login', [AuthController::class, 'showLogin'])->middleware('is.not.auth');
Route::post('login', [AuthController::class, 'actionLogin'])->middleware('is.not.auth');

Route::middleware(['is.auth'])->group(function () {
    Route::get('logout', [AuthController::class, 'actionLogout']);

    Route::get('transactions', [TransactionController::class, 'index']);
    Route::get('transactions/create', [TransactionController::class, 'create']);

    Route::resource('customers', CustomerController::class);
    Route::resource('categories', CategoryController::class);
    Route::resource('users', UserController::class);
    Route::resource('stuffs', StuffController::class);

});




// route::get('customer', [CustomerController::class, 'index']);
// route::get('customer/add', [CustomerController::class, 'create']);
// route::get('customer', [CustomerController::class, 'store']);
// route::get('customer/{customer}', [CustomerController::class, 'destory']);

// route::get('category', [CategoryController::class, 'index']);
// route::get('category/add', [CategoryController::class, 'create']);

// route::get('user', [UserController::class, 'index']);
// route::get('user/add', [UserController::class, 'create']);

// route::get('stuff', [StuffController::class, 'index']);
// route::get('stuff/add', [StuffController::class, 'create']);


