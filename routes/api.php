<?php

use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ReviewController;
use Illuminate\Support\Facades\Route;

Route::get('/products', [ProductController::class, 'index']);
Route::get('/product/{id}', [ProductController::class, 'show']);
Route::post('/product', [ProductController::class, 'createProduct']);

Route::middleware(['auth:sanctum'])
->controller(ReviewController::class)
->prefix('review')
->group(function () {
    Route::get('/show/{id}', 'show');
    Route::get('/list', 'list');
});

Route::middleware(['auth:sanctum'])
->controller(OrderController::class)
->prefix('order')
->group(function () {
    Route::get('/list', 'list');
    Route::get('/show/{id}', 'show');
});
