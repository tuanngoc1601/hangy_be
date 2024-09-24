<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::group(['prefix' => 'api/v1'], function () {
    Route::get('/categories/categories-all', [CategoryController::class, 'getAllCategories']);
    Route::get('/products', [ProductController::class, 'getListProducts']);
});
