<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Slider extends Model
{
    use HasFactory;

    protected $fillable = [
        'position',
        'slug',
        'status',
        'redirect_url',
        'type'
    ];


    public function files()
    {
        return $this->morphMany(File::class, 'fileable');
    }

    public function language()
    {
        return $this->hasMany(SliderLanguage::class, 'slider_id');
    }

    public function availableLanguage()
    {
        return $this->language()->where('language_id', '=', Localization::getIdByName(app()->getLocale()));
    }

    public function scopeByLang($query)
    {
        $localizationID = Localization::getIdByName(app()->getLocale());
        return $query->whereHas('language', function ($query) use ($localizationID) {
            $query->where('language_id', $localizationID);
        });
    }
}
