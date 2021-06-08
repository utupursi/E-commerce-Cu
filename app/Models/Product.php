<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'category_id',
        'position',
        'status',
        'slug',
        'price',
        'vip',
        'sale',
        'sale_price',
        'view'
    ];


    public function files()
    {
        return $this->morphMany('App\Models\File', 'fileable');
    }

    public function language()
    {
        return $this->hasMany('App\Models\ProductLanguage', 'product_id');
    }

    public function features()
    {
        return $this->hasMany('App\Models\ProductFeatures', 'product_id');
    }

    public function answers()
    {
        return $this->hasMany('App\Models\ProductAnswers', 'product_id');
    }

    public function availableLanguage()
    {
        return $this->language()->where('language_id', '=', Localization::getIdByName(app()->getLocale()));
    }

    public function category()
    {
        return $this->hasOne(Category::class, 'id', 'category_id');
    }

    public function categoryLanguage()
    {
        return $this->hasMany(CategoryLanguage::class, 'category_id', 'category_id')
            ->where('language_id', '=', Localization::getIdByName(app()->getLocale()));
    }

    public function scopeByLang($query)
    {
        $localizationID = Localization::getIdByName(app()->getLocale());
        return $query->whereHas('language', function ($query) use ($localizationID) {
            $query->where('language_id', $localizationID);
        });
    }
}
