<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Personnel extends Model
{
        protected $fillable = [
        'name',
        'position',
        'email',
        'phone',
        'staff_image',
    ];

    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }
}
