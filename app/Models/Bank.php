<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bank extends Model
{
    use HasFactory;
    protected $fillable = [
        'title',
        'config_path',
    ];

    public function paymentType(){
        return $this->hasOne(PaymentType::class,'payment_type_id');
    }
}
