<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Partner extends Model
{
    use HasFactory,HasTranslations;
    protected $guarded=[];
    // public $translatable = ['address','description'];

    public function setMusicAttribute($value){
        if ($value){
            $file = $value;
            $extension = $file->getClientOriginalExtension(); // getting file extension
            $filename =time().mt_rand(1000,9999).'.'.$extension;
            $file->move(public_path('music/partners/'), $filename);
            $this->attributes['music'] =  'music/partners/'.$filename;
        }
    }

    protected static function booted()
    {
        static::deleted(function ($partner) {


            // if ($partner->images){
            //     foreach ($partner->images as $image) {
            //         unlink($image->image);
            //     }
            //     $partner->images()->delete();
            // }


            if ($partner->music  && \Illuminate\Support\Facades\File::exists($partner->music)) {
                unlink($partner->music);
            }
        });
    }

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

    public function blacks()
    {
        return $this->hasMany(BlackDay::class);
    }

    public function paginatedblacks()
    {
        return $this->hasMany(BlackDay::class)->paginate(10);
    }
}
