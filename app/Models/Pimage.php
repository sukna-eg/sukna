<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pimage extends Model
{
    use HasFactory;
    protected $guarded=[];


    public function setImageAttribute($value){
        if ($value){
            $file = $value;
            $extension = $file->getClientOriginalExtension(); // getting image extension
            $filename =time().mt_rand(1000,9999).'.'.$extension;
            $file->move(public_path('images/partners/'), $filename);
            $this->attributes['image'] =  'images/partners/'.$filename;
        }
    }

    // protected static function booted()
    // {
    //     static::deleted(function ($partner) {
    //             if ($partner->image  && \Illuminate\Support\Facades\File::exists($partner->image)) {
    //             unlink($partner->image);
    //         }
    //     });
    // }

    protected static function booted()
    {
        static::deleted(function ($partner) {


            if ($partner->images){
                foreach ($partner->images as $image) {
                    unlink($image->image);
                }
                $partner->images()->delete();
            }



        });

        static::deleted(function ($pimage) {


            if ($pimage->image  && \Illuminate\Support\Facades\File::exists($pimage->image)) {
            unlink($pimage->image);
            }
        });
    }



    public function partner()
	{
		return $this->belongsTo(Partner::class);
	}
}
