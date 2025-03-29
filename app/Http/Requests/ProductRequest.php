<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class ProductRequest extends FormRequest
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
            'images.*' => $condition . '|file|mimes:jpeg,png,jpg,gif|max:2048',
            'discount' => $condition . '|numeric',
            'price' => $condition . '|numeric',
            'description' => $condition . 'string',
            'discount_type' => $condition . '|in:percentage,amount',
            'likes' => $condition . '|integer',
            'ingredients' => 'nullable|string',
            'shipping_cost' => $condition . '|integer',
            'benefit' => 'nullable|string',
            'seller_id' => $condition . '|string',
        ];
    }
}
