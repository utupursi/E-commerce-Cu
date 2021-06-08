<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DictionaryLanguage extends Model
{
    use HasFactory;
    protected $fillable = [
        'dictionary_id',
        'language_id',
        'value'
    ];
    public function dictionary()
    {
        return $this->belongsTo('App\Models\Dictionary', 'dictionary_id');
    }
    
    public function language()
    {
        return $this->belongsTo('App\Models\Localization', 'language_id');
    }
}
