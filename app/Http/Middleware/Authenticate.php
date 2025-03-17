<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Http\Request;

class Authenticate extends Middleware
{
    /**
     * Handle unauthorized requests by returning a JSON response instead of redirecting.
     */

    protected function unauthenticated($request, array $guards)
    {
        abort(response()->json([
            'success' => false,
            'message' => 'Unauthorized access. Authentication required.',
        ], 401));
    }

    protected function redirectTo(Request $request)
    {
        if (!$request->expectsJson()) {
            abort(response()->json([
                'success' => false,
                'message' => 'Unauthorized. Please log in to access this resource.',
            ], 401));
        }
    }
}
