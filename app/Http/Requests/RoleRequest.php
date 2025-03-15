<?php
namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RoleRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        // Determine condition based on HTTP method
        $condition = $this->isMethod('post') ? 'required' : 'nullable';

        return [
            'name' =>  $condition . '|string|max:100',
            'permissions' => $condition . '|string'
        ];
    }
}
