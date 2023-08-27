<?php

namespace App\Http\Requests\Profile;

use App\Rules\MatchOldPassword;
use Illuminate\Foundation\Http\FormRequest;

class ChangePasswordRequest extends FormRequest
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
            'current_password' => [
                'required',
                new MatchOldPassword(),
            ],
            'password' => [
                'required',
                'min:8',
                'max:20',
                'different:current_password'
            ],
            'password_confirmation' => [
                'required',
                'same:password_confirmation',
            ]
        ];
    }
}
