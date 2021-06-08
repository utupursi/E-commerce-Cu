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
            'details'=>'nullable|string|max:255',
        ];
        if($this->product_delivery==='location'){
            $requiredRules['delivery_address']='required|string|max:255';
        }
        if($this->payment_method==="Loan" && $this->installment_bank=="Volta Loan"){
            $requiredRules['loan_firstname']='required|string|max:255';
            $requiredRules['loan_lastname']='required|string|max:255';
            $requiredRules['loan_phone']='required|string|max:255';
            $requiredRules['loan_personal_number']='required|digits:11';
            $requiredRules['loan_jurisdiction_address']='required|string|max:255';
            $requiredRules['loan_actual_address']='required|string|max:255';
            $requiredRules['loan_job']='required|string|max:255';
            $requiredRules['loan_job_address']='required|string|max:255';
            $requiredRules['loan_job_phone']='required|string|max:255';
            $requiredRules['loan_income']='required|numeric';
            $requiredRules['loan_additional_income']='required|numeric';
            $requiredRules['loan_liabilities']='required|string|max:255';
            $requiredRules['loan_family_full_name']='required|string|max:255';
            $requiredRules['loan_family_phone']='required|string|max:255';
            $requiredRules['loan_family_1_full_name']='required|string|max:255';
            $requiredRules['loan_family_2_phone']='required|string|max:255';
            $requiredRules['loan_employee_full_name']='required|string|max:255';
            $requiredRules['loan_employee_phone']='required|string|max:255';
            $requiredRules['loan_friend_full_name']='required|string|max:255';
            $requiredRules['loan_friend_phone']='required|string|max:255';
            $requiredRules['loan_payment_day']='required|numeric';
            $requiredRules['loan_month_total']='required|numeric';
        }
        return $requiredRules;
    }
}
