<?php

use App\Http\Controllers\BrandController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ReviewController;
use Illuminate\Support\Facades\Route;

Route::middleware(['admin'])
->controller(ProductController::class)
->prefix('product')
->group(function () {
    Route::get('/create', 'create');
    Route::post('/update/{id}', 'update');
    Route::post('/delete/{id}', 'delete');
});

Route::middleware(['auth:sanctum', 'admin'])
->controller(ReviewController::class)
->prefix('review')
->group(function () {
    Route::get('/show/{id}', 'show');
    Route::get('/list', 'list');
});

Route::middleware(['auth:sanctum', 'admin'])
->controller(OrderController::class)
->prefix('order')
->group(function () {
    Route::get('/list', 'list');
    Route::get('/show/{id}', 'show');
});

Route::middleware(['auth:sanctum', 'admin'])
->controller(BrandController::class)
->prefix('brand')
->group(function () {
    Route::post('/create', 'create');
    Route::put('/update/{id}', 'update');
    Route::delete('/delete/{id}', 'delete');
});
