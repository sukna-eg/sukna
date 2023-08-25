<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Category extends Model
{
    use HasFactory,HasTranslations;
    protected $guarded=[];
    public $translatable = ['name'];

    public function setImageAttribute($value){
        if ($value){
            $file = $value;
            $extension = $file->getClientOriginalExtension(); // getting image extension
            $filename =time().mt_rand(1000,9999).'.'.$extension;
            $file->move(base_path('../img/categories/'), $filename);
            $this->attributes['image'] =  'img/categories/'.$filename;
        }
    }

    protected static function booted()
    {
        static::deleted(function ($category) {
            if ($category->subcategories)$category->subcategories()->delete();

            if ($category->image  && \Illuminate\Support\Facades\File::exists($category->image)) {
            unlink($category->image);
            }
        });
    }

    public function subcategories()
	{
		return $this->hasMany(Subcategory::class);
	}
}
