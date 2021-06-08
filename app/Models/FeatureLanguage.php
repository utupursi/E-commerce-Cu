<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FeatureLanguage extends Model
{
    use HasFactory;
    protected $fillable = [
        'product_id',
        'language_id',
        'title',
    ];
    public function feature()
    {
        return $this->belongsTo('App\Models\Feature', 'feature_id');
    }
    
    public function language()
    {
        return $this->belongsTo('App\Models\Localization', 'language_id');
    }
}
