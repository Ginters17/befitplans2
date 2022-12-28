<?php

namespace App\Models;
use App\Models\User;
use App\Models\Workout;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Exercise extends Model
{
    use HasFactory;
    public function workout() { 
        return $this->belongsTo(Workout::class);
    }
    public function user() { 
        return $this->belongsTo(User::class);
    }
    public function strava_activity() { 
        return $this->hasOne(Strava_activity::class);
    }
}
