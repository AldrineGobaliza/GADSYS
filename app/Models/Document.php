<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Document extends Model
{
        protected $fillable = [
        'file_name',
        'file_path',
        'file_size',
        'user_id',
        'folder_id'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function folder()
    {
        return $this->belongsTo(Folder::class);
    }
}

