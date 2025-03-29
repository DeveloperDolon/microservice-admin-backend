<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class IsAdmin
{
    public function handle(Request $request, Closure $next): Response
    {
        if (Auth::user() && Auth::user()->role !== null && in_array(Auth::user()->role->name, ['Admin', 'Super Admin']))
        {
            return $next($request);
        }
        return $next($request);
    }
}
