<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RoleRequest extends FormRequest
{

    protected $condition;

    public function __construct()
    {
        $this->condition = $this->getMethod() === 'POST' ? 'required' : 'nullable';
    }

    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' =>  $this->condition . '|string|max:100',
            'permissions' => $this->condition . '|string'
        ];
    }
}
