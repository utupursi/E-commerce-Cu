<?php

namespace App\Http\Request\Admin;

use Illuminate\Foundation\Http\FormRequest;

class DictionaryRequest extends FormRequest
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
        return [
            'key' => 'required|string|max:255|unique:dictionaries',
        ];
    }
}
