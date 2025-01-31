<?php

use Illuminate\Support\Facades\Route;

Route::get('/sanctum/csrf-cookie', '\Laravel\Sanctum\Http\Controllers\CsrfCookieController@show');

Route::get('/', function () {
    return view('home');
});

Route::get('/example', function () {
    return view('example');
});
