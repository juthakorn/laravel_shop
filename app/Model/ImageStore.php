<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class ImageStore extends Model
{
    protected $fillable = [
        'new_name',
        'new_name150',
        'new_name350',
        'name',
        'alt',
        'size',
        'album_id'
    ];
    
}
