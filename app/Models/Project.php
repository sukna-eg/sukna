<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Project extends Model
{
    use HasFactory,HasTranslations;
    protected $guarded=[];
    public $translatable = ['name','description','duration'];

    protected static function booted()
    {
        static::deleted(function ($project) {


            if ($project->images){
                foreach ($project->images as $image) {
                    unlink($image->image);
                }
                $project->images()->delete();
            }



        });
    }



    public function service()
	{
		return $this->belongsTo(Service::class);
	}

    public function images()
    {
        return $this->hasMany(Primage::class);
    }
}
