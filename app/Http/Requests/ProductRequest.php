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
            'discount' => $condition . '|numeric|min:0',
            'price' => $condition . '|numeric|min:0',
            'description' => $condition . '|string',
            'discount_type' => $condition . '|in:percentage,amount',
            'likes' => $condition . '|integer',
            'ingredients' => 'nullable|string',
            'shipping_cost' => $condition . '|integer',
            'benefit' => 'nullable|string',
            'seller_id' => $condition . '|string',
            'brand_id' => $condition . '|string',
            'variant_name.*' => $condition . '|string|max:255|min:5',
            'variant_price.*' => $condition . '|numeric|min:0',
            'variant_stock.*' => $condition . '|integer|min:0',
        ];
    }
}
