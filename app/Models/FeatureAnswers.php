<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FeatureAnswers extends Model
{
    use HasFactory;
    protected $fillable = [
        'feature_id',
        'answer_id'
    ];
    public function answer()
    {
        return $this->belongsTo('App\Models\Answer', 'answer_id');
    }
    public function feature()
    {
        return $this->belongsTo('App\Models\Feature', 'feature_id');
    }

    public function answerLanguage(){
        return $this->hasMany(AnswerLanguage::class,'answer_id','answer_id');
    }
}
