<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $fillable = [
        'position',
        'status',
        'slug',
        'parent_id'
    ];


    public function files()
    {
        return $this->morphMany(File::class, 'fileable');
    }

    public function language()
    {
        return $this->hasMany(CategoryLanguage::class, 'category_id');
    }

    public function availableLanguage()
    {
        return $this->language()->where('language_id', '=', Localization::getIdByName(app()->getLocale()));
    }

    public function childCategories()
    {
        return $this->hasMany(Category::class, 'parent_id');
    }

    public function getCategoryNameById($parentId)
    {
        $category = Category::where(['id' => $parentId])->first();

        return count($category->availableLanguage) > 0 ? $category->availableLanguage[0]->title : "";

    }

    public function productFeatures()
    {
        return $this->hasManyThrough(ProductFeatures::class, Product::class, 'category_id', 'product_id', 'id', 'id')
            ->groupBy('product_features.feature_id');
    }
}
