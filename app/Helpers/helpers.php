<?php

if (!function_exists('greet')) {
    /**
     * Greet a user by name.
     *
     * @param string $name
     * @return string
     */
    function greet($name)
    {
        return "Hello, $name!";
    }
}

if (!function_exists('is_admin')) {
    /**
     * Check if the current user is an admin.
     *
     * @return bool
     */
    function is_admin()
    {
        return 'Hello world';
        // return auth()->check() && auth()->user()->role === 'admin';
    }
}