<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Spatie\Permission\Models\Permission;

class StoreRoleRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'name' => 'required|unique:roles|min:3|max:50',
            'permissions' => 'required',
        ];
    }
    
    /**
     * @return string[]
     */
    public function messages(): array
    {
        return [
            'permissions.required' => 'Please select at least one permission.',
        ];
    }
}
