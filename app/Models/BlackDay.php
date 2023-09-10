<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BlackDay extends Model
{
    use HasFactory;

    protected $guarded=[];



    public function partner()
	{
		return $this->belongsTo(Partner::class);
	}

    public function user()
	{
		return $this->belongsTo(User::class);
	}

    public function appointment()
	{
		return $this->belongsTo(Appointment::class);
	}
}
