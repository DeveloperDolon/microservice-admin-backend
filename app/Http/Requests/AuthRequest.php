<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class AuthRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $condition = $this->getMethod() === 'POST' ? 'required' : 'nullable';
        return [
            'name' => $condition . '|string|max:100|min:3',
            'email' => $condition . '|string|email|max:255|unique:users,email',
            'password' => $condition . '|string|min:8|max:16',
            'phone' => 'nullable|string|max:15',
            'role_id' => $condition . '|string',
            'profile_picture' => 'nullable|string',
        ];
    }
}
