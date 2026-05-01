<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $fillable = [
    'title',
    'content',
    'event_date',
    'images',
    'user_id'
    ];
    
    public function images()
    {
        return $this->hasMany(PostImage::class);
    }
}
