<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SliderLanguage extends Model
{
    use HasFactory;

    protected $fillable = [
        'slider_id',
        'language_id',
        'title',
        'description',
    ];

    public function slider()
    {
        return $this->belongsTo('App\Models\Slider', 'slider_id');
    }

    public function language()
    {
        return $this->belongsTo('App\Models\Localization', 'language_id');
    }
}
