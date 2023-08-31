<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Primage extends Model
{
    use HasFactory;
    protected $guarded=[];


    public function setImageAttribute($value){
        if ($value){
            $file = $value;
            $extension = $file->getClientOriginalExtension(); // getting image extension
            $filename =time().mt_rand(1000,9999).'.'.$extension;
            $file->move(public_path('images/projects/'), $filename);
            $this->attributes['image'] =  'images/projects/'.$filename;
        }
    }

    protected static function booted()
    {
        static::deleted(function ($partner) {
                if ($project->image  && \Illuminate\Support\Facades\File::exists($project->image)) {
                unlink($project->image);
            }
        });
    }

    public function project()
	{
		return $this->belongsTo(Project::class);
	}
}
