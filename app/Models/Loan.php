<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Loan extends Model
{
    use HasFactory;
    protected $fillable = [
        'first_name',
        'last_name',
        'personal_number',
        'phone',
        'jurisdiction_address',
        'actual_address',
        'job',
        'job_address',
        'job_phone',
        'income',
        'additional_income',
        'liabilities',
        'family_full_name',
        'family_phone',
        'family_1_full_name',
        'family_2_phone',
        'employee_full_name',
        'employee_phone',
        'friend_full_name',
        'friend_phone',
        'payment_day',
        'month_total',
    ];
    public function loanable()
    {
        return $this->morphTo();
    }

}
