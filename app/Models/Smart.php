<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Smart extends Model
{
    use HasFactory,HasTranslations;
    protected $guarded=[];
    public $translatable = ['name','description'];

    public function setLinkAttribute($value){
        if ($value){
            $file = $value;
            $extension = $file->getClientOriginalExtension(); // getting file extension
            $filename =time().mt_rand(1000,9999).'.'.$extension;
            $file->move(public_path('smarts/videos/'), $filename);
            $this->attributes['link'] =  'smarts/videos/'.$filename;
        }
    }

    protected static function booted()
    {
        static::deleted(function ($smart) {


            if ($smart->link  && \Illuminate\Support\Facades\File::exists($smart->link)) {
                unlink($smart->link);
                }

        });
    }

    public function works()
	{
		return $this->hasMany(Work::class);
	}
}
