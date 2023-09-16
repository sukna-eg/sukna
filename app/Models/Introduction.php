<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Introduction extends Model
{
    use HasFactory,HasTranslations;
    protected $guarded=[];
    public $translatable = ['title','body'];

    public function setVideoAttribute($value){
        if ($value){
            $file = $value;
            $extension = $file->getClientOriginalExtension(); // getting file extension
            $filename =time().mt_rand(1000,9999).'.'.$extension;
            $file->move(public_path('intro/videos/'), $filename);
            $this->attributes['video'] =  'intro/videos/'.$filename;
        }
    }

    public function setImageAttribute($value){
        if ($value){
            $file = $value;
            $extension = $file->getClientOriginalExtension(); // getting file extension
            $filename =time().mt_rand(1000,9999).'.'.$extension;
            $file->move(public_path('intro/images/'), $filename);
            $this->attributes['image'] =  'intro/images/'.$filename;
        }
    }


    protected static function booted()
    {
        static::deleted(function ($introduction) {


            if ($introduction->image  && \Illuminate\Support\Facades\File::exists($introduction->image)) {
            unlink($introduction->image);
            }

            if ($introduction->video  && \Illuminate\Support\Facades\File::exists($introduction->video)) {
                unlink($introduction->video);
                }

        });
    }

}
