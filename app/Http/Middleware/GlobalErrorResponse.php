<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;
use Illuminate\Routing\Controllers\Middleware;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpKernel\Exception\HttpException;

class GlobalErrorResponse
{
    public function handle(Request $request, Closure $next)
    {
        try {
            return $next($request);
        } catch (\Exception $e) {
            return $this->handleException($e);
        }
    }

    protected function handleException(\Exception $e): JsonResponse
    {
        $statusCode = $this->getStatusCode($e);
        $response = [
            'success' => false,
            'message' => $e->getMessage(),
            'errors' => [],
        ];

        if ($e instanceof ValidationException) {
            $response['errors'] = $e->errors();
        }

        return response()->json($response, $statusCode);
    }

    protected function getStatusCode(\Exception $e): int
    {
        if ($e instanceof HttpException) {
            return $e->getStatusCode();
        }

        if ($e instanceof ValidationException) {
            return 422;
        }

        return 500;
    }
}