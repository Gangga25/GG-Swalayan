<?php

use App\Http\Controllers\TransactionController;
use App\Http\Controllers\DetailController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\StuffController;
use App\Http\Controllers\UserController;

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

Route::get('/', function () {
    return view('home');
});

route::get('transaction', [TransactionController::class, 'index']);
route::get('transaction/add', [TransactionController::class, 'create']);

route::get('customer', [CustomerController::class, 'index']);
route::get('customer/add', [CustomerController::class, 'create']);

route::get('category', [CategoryController::class, 'index']);
route::get('category/add', [CategoryController::class, 'create']);

route::get('user', [UserController::class, 'index']);
route::get('user/add', [UserController::class, 'create']);

route::get('stuff', [StuffController::class, 'index']);
route::get('stuff/add', [StuffController::class, 'create']);


