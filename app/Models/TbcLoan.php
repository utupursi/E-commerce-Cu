<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TbcLoan extends Model
{
    use HasFactory;
    protected $fillable = [
        'session_id',
    ];
    public function tbcloanable()
    {
        return $this->morphTo();
    }
}
