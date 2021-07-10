<?php

namespace App\Http\Request;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Hash;
class PasswordRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'password' => [
                'required',
                function ($attribute, $value, $fail) {
                    if (!Hash::check($value, auth()->user()->password)) {
                        $fail(__('Currenct password is incorrect'));
                    }
                },
                'max:100'
            ],
            'new_password' => 'required|string|min:6',
            'new_password_repeat'=>'required|string|min:6|same:new_password'
        ];
    }
}
