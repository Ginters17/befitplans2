<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Plan;
use App\Models\User;

class Workout extends Model
{
    use HasFactory;
    public function plan() { // FK relationship
        return $this->belongsTo(Plan::class);
    }
    public function user() { // FK relationship
        return $this->belongsTo(User::class);
    }
}
