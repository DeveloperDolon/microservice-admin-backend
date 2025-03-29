<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class IsSuperAdmin
{
    public function handle(Request $request, Closure $next): Response
    {
        if(Auth::user() && Auth::user()->role->name == 'Super Admin')
        {
            return $next($request);
        }

        abort(401, 'Unauthrized');
    }
}
