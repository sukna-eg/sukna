<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
// use Spatie\Translatable\HasTranslations;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Answer extends Model
{
    use HasFactory;

    protected $guarded=[];
    // public $translatable = ['answer'];

    public function question()
	{
		return $this->belongsTo(Question::class);
	}

    public function user()
	{
		return $this->belongsTo(User::class);
	}
}
