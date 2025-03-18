<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class ProfileUpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return Auth::check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $condition = 'nullable';
        return [
            'name' => $condition . '|string|max:100|min:3',
            'email' => $condition . '|string|email|max:255|unique:users,email',
            'password' => $condition . '|string|min:8|max:16',
            'phone' => 'nullable|string|max:15',
            'profile_picture' => 'nullable|string',
        ];
    }
}
