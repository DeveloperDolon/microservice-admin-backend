<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpKernel\Exception\HttpException;

class GlobalErrorResponse
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        try {
            dd('Hello world');
            return $next($request);
        } catch (\Exception $e) {
            return $this->handleException($e);
        }
    }

    /**
     * Handle the exception and return a consistent JSON response.
     *
     * @param  \Exception  $e
     * @return \Illuminate\Http\JsonResponse
     */
    protected function handleException(\Exception $e): JsonResponse
    {
        $statusCode = $this->getStatusCode($e);
        $response = [
            'success' => false,
            'message' => $e->getMessage(),
            'errors' => [],
        ];

        // Add validation errors if the exception is a ValidationException
        if ($e instanceof ValidationException) {
            $response['errors'] = $e->errors();
        }

        return response()->json($response, $statusCode);
    }

    /**
     * Get the HTTP status code for the exception.
     *
     * @param  \Exception  $e
     * @return int
     */
    protected function getStatusCode(\Exception $e): int
    {
        if ($e instanceof HttpException) {
            return $e->getStatusCode();
        }

        if ($e instanceof ValidationException) {
            return 422; // Unprocessable Entity
        }

        return 500; // Internal Server Error
    }
}