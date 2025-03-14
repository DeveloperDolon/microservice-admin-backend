<?php

namespace App\Http\Controllers;

use App\Http\Requests\AuthRequest;
use App\Models\User;

class AuthController extends BaseController
{
    public function register(AuthRequest $request)
    {
        $userInfo = $request->validated();
        $data = User::create($userInfo);

        return $this->sendSuccessResponse($data);
    }
}
