<?php

namespace App\Http\Requests\Profile;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateProfileRequest extends FormRequest
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
        $id = auth('admin')->user()->id;
        
        return [
            'name' => [
                'required',
                Rule::unique('admins')->ignore($id),
                'min:3',
                'max:50',
            ],
            'email' => [
                'required',
                'email:rfc',
                Rule::unique('admins')->ignore($id),
//                'unique:admins,email,'.$id,
                'regex:/^[A-Za-z0-9.@]+$/'   // letters numbers and periods are allowed
            ],
        ];
    }
    
    /**
     * @return string[]
     */
    public function messages(): array
    {
        return [
            'email.regex' => 'Sorry, only letters(a-z|A-Z), numbers(0-9), periods(.) and @ are allowed.'
        ];
    }
}
