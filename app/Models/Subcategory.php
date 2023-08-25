<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Subcategory extends Model
{
    use HasFactory,HasTranslations;

    protected $guarded=[];
    public $translatable = ['name'];

    protected static function booted()
    {
        static::deleted(function ($subcategory) {
            if ($subcategory->partners()->count()>0)$subcategory->partners()->detach();
        });
    }

    public function category()
	{
		return $this->belongsTo(Category::class);
	}

    public function partners()
	{
		return $this->hasMany(Partner::class);
	}
}
