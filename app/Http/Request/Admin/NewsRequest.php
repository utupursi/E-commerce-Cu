<?php

namespace App\Http\Request\Admin;

use Illuminate\Foundation\Http\FormRequest;

class NewsRequest extends FormRequest
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
            'title' => 'required|string|max:255',
            'description' => 'nullable|string|max:255',
            'file' => 'nullable|image|mimes:jpg,jpeg,png',
            'content' => 'nullable|string',
            'position' => 'nullable|string|max:255',  
            'status' => 'required|integer',
            'slug' => 'required|unique:news',
        ];
    }
}
