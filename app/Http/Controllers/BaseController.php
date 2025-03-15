<?php

namespace App\Http\Controllers;

use Symfony\Component\HttpFoundation\Response;

class BaseController extends Controller
{
    public function sendSuccessResponse($data, $message = 'Success!', $status = Response::HTTP_OK)
    {
        $response = [
            'success' => true,
            '$status' => $status,
            'message' => $message,
            'data' => $data,
        ];

        return response()->json($response, $status);
    }

    public function sendErrorResponse($data = null, $message = 'Bad Request!', $status = Response::HTTP_BAD_REQUEST)
    {
        $response = [
            'success' => false,
            '$status' => $status,
            'message' => $message,
            'data' => $data,
        ];

        return response()->json($response, $status);
    }
}
