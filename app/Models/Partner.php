<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Partner extends Model
{
    use HasFactory,HasTranslations;
    protected $guarded=[];
    public $translatable = ['name','description'];

    public function subcategory()
	{
		return $this->belongsTo(Subcategory::class);
	}

    public function user()
	{
		return $this->belongsTo(User::class);
	}

    public function area()
	{
		return $this->belongsTo(Area::class);
	}

    public function reviews()
    {
        return $this->hasMany(Review::class);
    }

    public function images()
    {
        return $this->hasMany(Pimage::class);
    }

    public function appointments()
    {
        return $this->hasMany(Appointment::class);
    }
}
