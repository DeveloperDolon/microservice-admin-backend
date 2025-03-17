<?php

if (!function_exists('greet')) {
    function greet($name)
    {
        return "Hello, $name!";
    }
}

if (!function_exists('is_admin')) {
    function is_admin()
    {
        return 'Hello world';
        // return auth()->check() && auth()->user()->role === 'admin';
    }
}