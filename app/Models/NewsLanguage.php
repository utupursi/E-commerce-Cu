<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NewsLanguage extends Model
{
    use HasFactory;
    protected $fillable = [
        'news_id',
        'language_id',
        'title',
        'description',      
        'content',
        'section',
    ];
    
    public function news()
    {
        return $this->belongsTo('App\Models\News', 'news_id_id');
    }
    
    public function language()
    {
        return $this->belongsTo('App\Models\Localization', 'language_id');
    }
}
