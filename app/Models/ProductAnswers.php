<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductAnswers extends Model
{
    use HasFactory;
    protected $fillable = [
        'product_id',
        'feature_id',
        'answer_id'
    ];
    public function feature()
    {
        return $this->belongsTo('App\Models\Feature', 'feature_id');
    }
    public function product()
    {
        return $this->belongsTo('App\Models\Product', 'product_id');
    }
    public function answer()
    {
        return $this->belongsTo('App\Models\Answer', 'answer_id');
    }
}
