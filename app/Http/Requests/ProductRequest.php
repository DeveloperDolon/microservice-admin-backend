<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
{
    protected $condition;

    public function __construct()
    {
        $this->condition = $this->getMethod() === 'POST' ? 'required' : 'nullable';
    }

    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => $this->condition . '|string|max:255|min:5',
            'images' => $this->condition . '|string',
            'discount' => $this->condition . '|numeric',
            'price' => $this->condition . '|numeric',
            'description' => $this->condition . 'string',
            'discount_type' => $this->condition . '|enum:percentage,amount',
            'likes' => $this->condition . '|integer',
            'ingredients' => 'nullable|string',
            'shipping_cost' => $this->condition . '|integer',
            'benefit' => 'nullable|string',
            'seller_id' => $this->condition . '|string',
        ];
    }
}
