<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Place extends Model
{
    use HasFactory;
    
    public function prefecture()
    {
        return $this->belongsTo(Prefecture::class);
    }
    public function posts()   
    {
        return $this->hasMany(Post::class);  
    }
}
