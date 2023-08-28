<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Question extends Model
{
    use HasFactory,HasTranslations;
    protected $guarded=[];
    public $translatable = ['question'];

    public function answers()
	{
		return $this->hasMany(Answer::class);
	}

    public function user()
	{
		return $this->belongsTo(User::class);
	}
}
