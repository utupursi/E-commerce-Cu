<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Feature extends Model
{
    use HasFactory;

    protected $fillable = [
        'position',
        'status',
        'slug',
        'type',
    ];

    public function language()
    {
        return $this->hasMany('App\Models\FeatureLanguage', 'feature_id');
    }

    public function products()
    {
        return $this->hasMany('App\Models\ProductFreatures', 'feature_id');
    }

    public function answers()
    {
        return $this->hasMany('App\Models\FeatureAnswers', 'feature_id');
    }

    public function answer()
    {
        return $this->belongsToMany(Answer::class, 'feature_answers');
    }

    public function availableLanguage()
    {
        return $this->language()->where('language_id', '=', Localization::getIdByName(app()->getLocale()));
    }
}
