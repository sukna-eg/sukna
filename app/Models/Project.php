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

    public function service()
	{
		return $this->belongsTo(Service::class);
	}

    public function images()
    {
        return $this->hasMany(Primage::class);
    }
}
