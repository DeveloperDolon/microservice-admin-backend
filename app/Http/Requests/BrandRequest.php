<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class BrandRequest extends FormRequest
{
    public function authorize(): bool
    {
        return Auth::check();
    }

    public function rules(): array
    {
        $condition = $this->getMethod() === 'POST' ? 'required' : 'nullable';
        return [
            'name' => $condition . '|string|max:255|min:5',
            'banner' => 'string|max:255|min:5',
            'logo' => $condition . '|string|max:255|min:5',
            'title' => $condition . '|string|max:255|min:5',
            'description' => 'string|max:255|min:5',
            'location' => 'string|max:255|min:5',
        ];
    }
}
