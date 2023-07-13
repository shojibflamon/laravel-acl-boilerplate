<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreAdminRequest extends FormRequest
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
        return [
            'name' => [
                'required',
                Rule::unique('admins'),
                'min:3',
                'max:50',
            ],
            'email' => [
                'required',
                'email:'.config('theme.validationRules.email'),
                Rule::unique('admins'),
            ],
            'roles' => ['sometimes'],
            'password' => [
                'required',
                'confirmed',
                'min:8',
            ],
            'password_confirmation' => [
                'required',
            ]
        ];
    }
}
