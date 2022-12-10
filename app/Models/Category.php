<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $category = 'category';
    use HasFactory;
    public function plan() { // FK relationship
        return $this->hasMany(Plan::class);
    }
}
