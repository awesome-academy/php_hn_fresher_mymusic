<?php

namespace App\Http\Requests\User;

use App\Rules\SameWithCurrentPassword;
use Illuminate\Foundation\Http\FormRequest;

class AccountChangePasswordRequest extends FormRequest
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
            'current_password' => ['required', 'min:6', 'max:32', new SameWithCurrentPassword()],
            'new_password' => 'required|min:6|max:32',
            'password_confirmation' => 'required|min:6|max:32|same:new_password',
        ];
    }
}
