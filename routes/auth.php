<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;

Route::prefix('user')->controller(AuthController::class)->group(function () {
    Route::post('/create', 'create');
});
