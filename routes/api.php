<?php

use App\Http\Controllers\AttributeController;
use App\Http\Controllers\AttributeValueController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductContoller;
use App\Http\Controllers\StoreController;
use App\Http\Controllers\UserController;
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

//Brands
Route::get('/brands', [BrandController::class, 'get_all_brands']);
Route::get('/brands/{id}', [BrandController::class, 'get_brand']);
Route::post('/brands', [BrandController::class, 'store']);
Route::put('/brands', [BrandController::class, 'update']);
Route::delete('/brands/{id}', [BrandController::class, 'delete']);

//Categories
Route::get('/categories', [CategoryController::class, 'get_all_categories']);
Route::get('/categories/{id}', [CategoryController::class, 'get_category']);
Route::post('/categories', [CategoryController::class, 'store']);
Route::put('/categories', [CategoryController::class, 'update']);
Route::delete('/categories/{id}', [CategoryController::class, 'delete']);

//Stores
Route::get('/stores', [StoreController::class, 'get_all_stores']);
Route::get('/stores/{id}', [StoreController::class, 'get_store']);
Route::post('/stores', [StoreController::class, 'store']);
Route::put('/stores', [StoreController::class, 'update']);
Route::delete('/stores/{id}', [StoreController::class, 'delete']);

//Attributes
Route::get('/attributes', [AttributeController::class, 'get_all_attributes']);
Route::get('/attributes/{id}', [AttributeController::class, 'get_attribute']);
Route::post('/attributes', [AttributeController::class, 'store']);
Route::put('/attributes', [AttributeController::class, 'update']);
Route::delete('/attributes/{id}', [AttributeController::class, 'delete']);

//Attribute-Values
Route::get('/attribute-values/{id}', [AttributeValueController::class, 'get_attribute']);
Route::get('/attribute-value/{id}', [AttributeValueController::class, 'get_attribute_value']);
Route::post('/attribute-values', [AttributeValueController::class, 'store']);
Route::put('/attribute-values', [AttributeValueController::class, 'update']);
Route::delete('/attribute-values/{id}', [AttributeValueController::class, 'delete']);

//Products
Route::get('/products', [ProductContoller::class, 'get_all_products']);
Route::get('/products/{id}', [ProductContoller::class, 'get_product']);
Route::post('/products', [ProductContoller::class, 'store']);
Route::put('/products', [ProductContoller::class, 'update']);
Route::delete('/products/{id}', [ProductContoller::class, 'delete']);

//Company
Route::put('/company', [CompanyController::class, 'update']);


//Users
Route::get('/users', [UserController::class, 'get_all_users']);
Route::get('/users/{id}', [UserController::class, 'get_user']);
Route::post('/users', [UserController::class, 'store']);
Route::put('/users', [UserController::class, 'update']);
Route::delete('/users/{id}', [UserController::class, 'delete']);

//Orders
Route::get('/orders', [OrderController::class, 'get_all_orders']);
Route::get('/orders/{id}', [OrderController::class, 'get_order']);
Route::post('/orders', [OrderController::class, 'store']);
Route::put('/orders', [OrderController::class, 'update']);
Route::delete('/orders/{id}', [OrderController::class, 'delete']);


Route::post('/login', [AuthController::class, 'login']);

