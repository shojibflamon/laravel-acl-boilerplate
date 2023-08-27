<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateAdminRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }
    
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $id = $this->route('admin')->id; // Assuming you have a route parameter for the role ID
        
        return [
            'name' => [
                'required',
                Rule::unique('admins')->ignore($id),
                'min:3',
                'max:50',
            ],
            'email' => [
                'required',
                'email:'.config('theme.validationRules.email'),
                Rule::unique('admins')->ignore($id),
            ],
            'roles' => ['sometimes'],
            'permissions' => ['sometimes'],
        ];
    }
}
