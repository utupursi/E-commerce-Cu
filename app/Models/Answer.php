<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Answer extends Model
{
    use HasFactory;

    protected $fillable = [
        'position',
        'status',
        'slug'
    ];

    public function language()
    {
        return $this->hasMany('App\Models\AnswerLanguage', 'answer_id');
    }
    public function files()
    {
        return $this->morphMany(File::class, 'fileable');
    }

    public function feature()
    {
        return $this->hasOne('App\Models\FeatureAnswers', 'answer_id');
    }

    public function productAnswers()
    {
        return $this->hasMany('App\Models\ProductAnswers', 'answer_id');
    }

    public function product()
    {
        return $this->hasManyThrough(Product::class, ProductAnswers::class, 'answer_id', 'id', 'id', 'product_id');
    }

    public function hasProducts($id)
    {
        return $this->product()->where('products.category_id', '=', $id)->count();
    }

    public function availableLanguage()
    {
        return $this->language()->where('language_id', '=', Localization::getIdByName(app()->getLocale()));
    }
}
