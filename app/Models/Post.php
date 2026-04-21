<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $fillable = [
    'title',
    'content',
    'event_date',
    'images'
    ];
    
    public function images()
    {
        return $this->hasMany(PostImage::class);
    }
}
