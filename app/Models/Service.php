<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Service extends Model
{
    use HasFactory,HasTranslations;
    protected $guarded=[];
    public $translatable = ['name','description'];

    public function setImageAttribute($value){
        if ($value){
            $file = $value;
            $extension = $file->getClientOriginalExtension(); // getting image extension
            $filename =time().mt_rand(1000,9999).'.'.$extension;
            $file->move(public_path('images/services/'), $filename);
            $this->attributes['image'] =  'images/services/'.$filename;
        }
    }


    public function setLogoAttribute($value){
        if ($value){
            $file = $value;
            $extension = $file->getClientOriginalExtension(); // getting image extension
            $filename =time().mt_rand(1000,9999).'.'.$extension;
            $file->move(public_path('logo/services/'), $filename);
            $this->attributes['logo'] =  'logo/services/'.$filename;
        }
    }

    protected static function booted()
    {
        static::deleted(function ($service) {


            if ($service->image  && \Illuminate\Support\Facades\File::exists($service->image)) {
            unlink($service->image);
            }

            if ($service->logo  && \Illuminate\Support\Facades\File::exists($service->logo)) {
                unlink($service->logo);
                }

        });
    }

    public function category()
	{
		return $this->belongsTo(Category::class);
	}

    public function projects()
	{
		return $this->hasMany(Project::class);
	}
}
