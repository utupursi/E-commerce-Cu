<?php
/**
 *  app/Http/Request/Admin/UserCabinetRequest.php
 *
 * User:
 * Date-Time: 18.12.20
 * Time: 17:52
 * @author Vito Makhatadze <vitomaxatadze@gmail.com>
 */

namespace App\Http\Request\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class UserCabinetRequest extends FormRequest
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
        $rules  = [];
        $user = Auth()->user();

        if ($this->method() == 'PUT') {
            $rules = [
                'first_name' => 'required|string|max:255',
                'last_name' => 'required|string|max:255',
                'email' => ['required', 'email', Rule::unique('users', 'email')->ignore($user)],
                'phone' => 'required|string|max:255',
                'id_number' => 'required|digits:11',
                'birthday' => 'required|date|after:1971-1-1|before:today',
                'address' => 'required|string|max:550'
            ];

            if ($this->password != null) {
                $rules['current_password'] = ['required', function ($attribute, $value, $fail) use ($user) {
                    if (!Hash::check($value, $user->password)) {
                        return $fail(__('The current password is incorrect.'));
                    }
                }];
                $rules['password'] = 'nullable|between:6,255|confirmed';
                $rules['password_confirmation'] = 'nullable';
            }

        }
        return $rules;


    }
}
