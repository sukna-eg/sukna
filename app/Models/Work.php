<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Work extends Model
{
    use HasFactory,HasTranslations;
    protected $guarded=[];
    public $translatable = ['name','description','duration'];


    public function setUrlAttribute($value){
        if ($value){
            $file = $value;
            $extension = $file->getClientOriginalExtension(); // getting file extension
            $filename =time().mt_rand(1000,9999).'.'.$extension;
            $file->move(public_path('smarts/works/'), $filename);
            $this->attributes['url'] =  'smarts/works/'.$filename;
        }
    }

    protected static function booted()
    {
        static::deleted(function ($work) {


            if ($work->url  && \Illuminate\Support\Facades\File::exists($work->url)) {
                unlink($work->url);
                }

        });
    }


    public function smart()
	{
		return $this->belongsTo(Smart::class);
	}


}
