<?php

namespace App\Http\Controllers;

use Symfony\Component\HttpFoundation\Response;

class BaseController extends Controller
{
    public function sendSuccessResponse($data, $message = 'Success!', $status = Response::HTTP_OK)
    {
        return [
            'success' => true,
            '$status' => $status,
            'message' => $message,
            'data' => $data,
        ];
    }

    public function sendErrorResponse($data = null, $message = 'Bad Request!', $status = Response::HTTP_BAD_REQUEST)
    {
        return [
            'success' => false,
            '$status' => $status,
            'message' => $message,
            'data' => $data,
        ];
    }
}
