<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserLanguage extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'language_id',
        'first_name',
        'last_name',
        'address'
    ];
    public function user()
    {
        return $this->belongsTo('App\Models\User', 'user_id');
    }
    public function language()
    {
        return $this->belongsTo('App\Models\Localization', 'language_id');
    }
}
