<?php

use App\Http\Controllers\CartController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::group(['prefix' => 'api/v1'], function () {
    Route::get('/categories/categories-all', [CategoryController::class, 'getAllCategories']);
    Route::get('/products/get-products', [ProductController::class, 'getListProducts']);
    Route::get('/products/get-best-sellings', [ProductController::class, 'getBestSellings']);
    Route::get('/products/{slug}', [ProductController::class, 'getProductDetail']);
    Route::get('/carts/get-cart', [CartController::class, 'getCart'])->middleware('auth:api');
    Route::post('/carts/add-cart', [CartController::class, 'addToCart'])->middleware('auth:api');
    Route::put('/carts/update/{type}/{productId}/{subProductId}', [CartController::class, 'updateQuantityCart'])->middleware('auth:api');
    Route::put('/carts/update/{productId}/{subProductId}', [CartController::class, 'updateSubProductCart'])->middleware('auth:api');
    Route::delete('/carts/delete/{cartItemId}', [CartController::class, 'deleteCartItem'])->middleware('auth:api');
    Route::post('/carts/delete/all-carts', [CartController::class, 'deleteAllCartItems'])->middleware('auth:api');
    Route::post('/carts/get-selected-items', [CartController::class, 'getSelectedItems'])->middleware('auth:api');
    Route::post('/contact/create', [ContactController::class, 'storeContact']);
    Route::post('/orders/store', [OrderController::class, 'createOrder'])->middleware('auth:api');
    Route::get('/orders/get-orders', [OrderController::class, 'getOrderPlaces'])->middleware('auth:api');
    Route::get('/orders/get-just-order', [OrderController::class, 'getOrderJustPlace'])->middleware('auth:api');
    Route::post('/orders/re-order', [OrderController::class, 'reOrderPlace'])->middleware('auth:api');
    Route::get('/orders/get-status', [OrderController::class, 'getStatuses'])->middleware('auth:api');
});
