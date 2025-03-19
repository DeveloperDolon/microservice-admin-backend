<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\RoleController;
use Illuminate\Support\Facades\Route;

Route::prefix('user')->controller(AuthController::class)->group(function () {
    Route::post('/create', 'register');
    Route::get('/login', 'login')->name('login');

    Route::middleware(['auth:sanctum'])->group(function () {
        Route::get('/profile', 'userProfile');
        Route::put('/update/{id}', 'updateUser');

        Route::middleware('super_admin')->group(function () {
            Route::get('/list', 'userList');
            Route::delete('/delete/{id}', 'deleteUser');
            Route::put('/role-update/{id}', 'updateRole');
        });
    });
});

Route::prefix('role')->middleware(['auth:sanctum', 'super_admin'])->controller(RoleController::class)->group(function () {
    Route::post('/create', 'create');
    Route::put('/update/{id}', 'update');
});
