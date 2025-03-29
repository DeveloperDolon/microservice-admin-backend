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
            'images' => $condition . '|string',
            'discount' => $condition . '|numeric',
            'price' => $condition . '|numeric',
            'description' => $condition . 'string',
            'discount_type' => $condition . '|enum:percentage,amount',
            'likes' => $condition . '|integer',
            'ingredients' => 'nullable|string',
            'shipping_cost' => $condition . '|integer',
            'benefit' => 'nullable|string',
            'seller_id' => $condition . '|string',
        ];
    }
}
