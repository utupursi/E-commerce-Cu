<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductFeatures extends Model
{
    use HasFactory;
    protected $fillable = [
        'feature_id',
        'product_id'
    ];
    public function product()
    {
        return $this->belongsTo('App\Models\Product', 'product_id');
    }
    public function feature()
    {
        return $this->belongsTo('App\Models\Feature', 'feature_id');
    }
}
