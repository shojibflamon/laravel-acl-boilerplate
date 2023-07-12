<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateRoleRequest extends FormRequest
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
        $roleId = $this->route('role')->id; // Assuming you have a route parameter for the role ID
        
        return [
            'name' => [
                'required',
                Rule::unique('roles')->ignore($roleId),
                'min:3',
                'max:50',
            ],
            'permissions' => 'required',
        ];
        
        /*
         * Same as above
         * */
        /*return  [
            'name' => 'required|min:3|max:50|unique:roles,id,'.$roleId,
            'permissions' => 'required',
        ];*/
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
