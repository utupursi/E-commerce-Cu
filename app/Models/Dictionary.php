<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dictionary extends Model
{
    use HasFactory;
    protected $fillable = [
        'key',
        'module'
    ];
    public function language()
    {
        return $this->hasMany('App\Models\DictionaryLanguage', 'dictionary_id');
    }
}
