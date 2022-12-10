<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Category;
use App\Models\User;
use App\Models\Workout;

class Plan extends Model
{
    protected $plan = 'plan';
    use HasFactory;
    public function category() { // FK relationship
        return $this->belongsTo(Category::class);
    }
    public function user() { // FK relationship
        return $this->belongsTo(User::class);
    }
    public function workout() { // FK relationship
        return $this->hasMany(Workout::class);
    }
}
