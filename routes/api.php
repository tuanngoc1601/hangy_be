<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\FacebookAuthController;
use App\Http\Controllers\GoogleAuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:sanctum');

Route::group([
    'middleware' => 'api',
    'prefix' => 'v1/auth'
], function () {
    Route::post('/register', [AuthController::class, 'register'])->name('register');
    Route::post('/login', [AuthController::class, 'login'])->name('login');
    Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth:api')->name('logout');
    Route::post('/refresh', [AuthController::class, 'refresh'])->middleware('auth:api')->name('refresh');
    Route::get('/me', [AuthController::class, 'me'])->middleware('auth:api')->name('me');
});

Route::group([
    'prefix' => 'v1/auth'
], function () {
    Route::get('/google-auth/redirect', [GoogleAuthController::class, 'redirect']);
    Route::get('/google-auth/callback', [GoogleAuthController::class, 'callback']);
    Route::get('/facebook-auth/redirect', [FacebookAuthController::class, 'redirect']);
    Route::get('/facebook-auth/callback', [FacebookAuthController::class, 'callback']);
});
