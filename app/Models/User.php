<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'phone',
        'lat',
        'long',
        'type',
        'active',
        'is_block',
        'reason',
        'image',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];


    public function setImageAttribute($value){
        if ($value){
            $file = $value;
            $extension = $file->getClientOriginalExtension(); // getting image extension
            $filename =time().mt_rand(1000,9999).'.'.$extension;
            $file->move(public_path('img/user/'), $filename);
            $this->attributes['image'] =  'img/user/'.$filename;
        }
    }


    protected static function booted()
    {
        static::deleted(function ($user) {
            if ($user->image  && \Illuminate\Support\Facades\File::exists($user->image)) {
                unlink($user->image);
            }
        });
    }


    public function favorites(){
        return $this->belongsToMany(Partner::class,'favorites','user_id','partner_id');
    }

    public function pagfavorites(){
        return $this->belongsToMany(Partner::class,'favorites','user_id','partner_id')->paginate(10);
    }

      public function reviews(){
        return $this->HasMany(Review::class);
    }


    public function partners(){
        return $this->HasMany(Partner::class);
    }

    public function notifications(){
        return $this->hasMany(Notification::class);
    }
}
