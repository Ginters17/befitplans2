<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Strava_activity extends Model
{
    use HasFactory;
    public function exercise() { 
        return $this->belongsTo(Exercise::class);
    }
    public function user() { 
        return $this->belongsTo(User::class);
    }
}
