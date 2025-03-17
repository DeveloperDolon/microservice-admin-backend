<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\RoleController;
use Illuminate\Support\Facades\Route;

Route::prefix('user')->controller(AuthController::class)->group(function () {
    Route::post('/create', 'register');
    Route::get('/login-user', 'login')->name('login');
});

Route::prefix('role')->middleware(['auth:sanctum', 'global'])->controller(RoleController::class)->group(function () {
    Route::post('/create', 'create');
});
