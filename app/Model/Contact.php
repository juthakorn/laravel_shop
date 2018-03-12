<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{    
    protected $fillable = [
        'user_id',
        'name',
        'email',
        'subject',
        'message'
    ];
    
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
