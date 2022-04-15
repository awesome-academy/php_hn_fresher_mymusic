<?php

namespace App\Http\Requests\Api;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends ApiRequest
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
            'email' => ['required', 'email', 'unique:users,email'],
            'password' => ['required', 'min:6', 'max:32'],
            'password_confirmation' => ['required', 'min:6', 'max:32', 'same:password'],
            'first_name' => ['required', 'max:255'],
            'last_name' => ['required', 'max:255'],
            'avatar' => ['nullable', 'mimes:png,jpg,jpeg'],
        ];
    }
}
