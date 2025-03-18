<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\RoleController;
use Illuminate\Support\Facades\Route;

Route::prefix('user')->controller(AuthController::class)->group(function () {
    Route::post('/create', 'register');
    Route::get('/login', 'login')->name('login');
    
    Route::get('/profile', 'userProfile')->middleware('auth:sanctum');

    Route::middleware(['auth:sanctum', 'super_admin'])->group(function () {
        Route::put('/update/{id}', 'updateUser');
        Route::get('/list', 'userList');
    });
});

Route::prefix('role')->middleware(['auth:sanctum', 'super_admin'])->controller(RoleController::class)->group(function () {
    Route::post('/create', 'create');
});
