<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\RoleController;
use Illuminate\Support\Facades\Route;

Route::prefix('user')->controller(AuthController::class)->group(function () {
    Route::post('/create', 'register');
    Route::get('/login', 'login')->name('login');
    Route::put('/update/{id}', 'updateUser')->middleware('auth:sanctum');
});

Route::prefix('role')->middleware(['auth:sanctum'])->controller(RoleController::class)->group(function () {
    Route::post('/create', 'create');
});
