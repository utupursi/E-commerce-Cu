<?php
/**
 *  app/Http/Request/Admin/UserRequest.php
 *
 * User:
 * Date-Time: 15.12.20
 * Time: 13:57
 * @author Vito Makhatadze <vitomaxatadze@gmail.com>
 */

namespace App\Http\Request\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return Auth()->user()->can('isAdmin');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $rules = [
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => ['required','email', Rule::unique('users', 'email')->ignore($this->user)],
            'password' => 'required|between:6,255|confirmed',
            'password_confirmation' => 'required',
            'phone' => 'required|string|max:255',
            'id_number' => 'required|digits:11',
            'address' => 'required|string|max:550',
            'role' => 'required|integer',
        ];

        if ($this->method() == 'PUT') {
            $rules['password'] = 'nullable|between:6,255|confirmed';
            $rules['password_confirmation'] = 'nullable';
        }

        return $rules;
    }
}
