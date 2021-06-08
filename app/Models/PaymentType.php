<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaymentType extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'status'
    ];

    public function banks(){
        return $this->hasMany(Bank::class,'payment_type_id');
    }
}
