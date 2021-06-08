<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AnswerLanguage extends Model
{
    use HasFactory;
    protected $fillable = [
        'answer_id',
        'language_id',
        'title'
    ];
    
    public function answer()
    {
        return $this->belongsTo('App\Models\answer', 'answer_id');
    }
    
    public function language()
    {
        return $this->belongsTo('App\Models\Localization', 'language_id');
    }
}
