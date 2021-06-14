<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PurchaseRequest extends FormRequest
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

        $requiredRules=[
            'name'=>'required|string|max:255',
            'surname'=>'required|string|max:255',
            'email'=>'required|email|max:50',
            'phone'=>'required|string|max:255',
            'address'=>'required|string|max:255',
            'payment_method'=>"required|string|max:50"
        ];

        return $requiredRules;
    }
}
