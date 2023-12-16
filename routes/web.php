<?php

use App\Http\Controllers\AttributeValueController;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductContoller;
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

Route::get('/', [DashboardController::class, 'index']);

Route::get('/brands', function () {
    return view('brands');
});
Route::get('/category', function () {
    return view('category');
});
Route::get('/stores', function () {
    return view('stores');
});

Route::get('/attributes', function () {
    return view('attributes');
});

Route::get('/attribute-values/{id}', function () {
    return view('attribute-values');
});

Route::get('/attribute-values/{id}', [AttributeValueController::class, 'index']);

Route::get('/products', [ProductContoller::class, 'index']);

Route::get('/company', [CompanyController::class, 'index']);

Route::get('/users', function () {
    return view('users');
});

Route::get('/orders', [OrderController::class, 'index']);