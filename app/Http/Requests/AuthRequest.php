<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AuthRequest extends FormRequest
{   
    protected $condition;

    public function __construct()
    {
        $this->condition = $this->getMethod() === 'POST' ? 'required' : 'nullable';
    }

    public function authorize(): bool
    {
        return false;
    }

    public function rules(): array
    {
        return [
            'name' => $this->condition . '|string|max:100|min:3',
            'email' => $this->condition . '|string|email|max:255|unique:users,email',
            'password' => $this->condition . '|string|min:8|max:16',
            'phone' => 'nullable|string|max:15',
            'role_id' => $this->condition . '|string',
            'profile_picture' => 'nullable|string',
        ];
    }
}
