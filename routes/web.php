<?php

use App\Http\Controllers\CartController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::group(['prefix' => 'api/v1'], function () {
    Route::get('/categories/categories-all', [CategoryController::class, 'getAllCategories']);
    Route::get('/products', [ProductController::class, 'getListProducts']);
    Route::get('/products/{slug}', [ProductController::class, 'getProductDetail']);
    Route::get('/carts/get-cart', [CartController::class, 'getCart'])->middleware('auth:api');
    Route::post('/carts/add-cart', [CartController::class, 'addToCart'])->middleware('auth:api');
});
