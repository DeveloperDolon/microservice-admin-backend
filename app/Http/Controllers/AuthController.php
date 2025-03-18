<?php

namespace App\Http\Controllers;

use App\Http\Requests\AuthRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends BaseController
{
    public function register(AuthRequest $request)
    {
        $userInfo = $request->validated();
        $data = User::create($userInfo);

        return $this->sendSuccessResponse($data);
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (!Auth::attempt($request->only('email', 'password'))) {
            return response()->json([
                'success' => false,
                'message' => 'Invalid credentials',
            ], 401);
        }

        $user = User::where('email', $request->email)->first();
        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json([
            'success' => true,
            'token' => $token,
            'user' => $user
        ]);
    }

    public function updateUser($id, AuthRequest $request) 
    {
        if ($request->user()) {
            $user = User::where('email', $request->user()->email)->first();
            $user->update($request->validated());

            return $this->sendSuccessResponse($user);
        }
        throw new \Exception('Unauthorized');
    }
}
