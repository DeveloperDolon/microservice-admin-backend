<?php

use App\Http\Controllers\BrandController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ReviewController;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth:sanctum', 'admin'])
->controller(ProductController::class)
->prefix('product')
->group(function () {
    Route::post('/create', 'create');
    Route::put('/update/{id}', 'update');
    Route::delete('/delete/{id}', 'delete');
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
    Route::get('/', 'list');
    Route::get('/show/{id}', 'show');
});

Route::get('/images/brands/{filename}', function ($filename) {
    $path = storage_path('app/public/images/brands/' . $filename);
    
    if (!file_exists($path)) {
        return response()->json([
            "success" => false,
            "message" => "File not found",
            "status" => 404
        ], 404);
    }

    return Response::file($path);
});