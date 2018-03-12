<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Forum extends Model
{    
    protected $fillable = [
        'user_id',
        'question',
        'detail',
        'view',
        'guest_name',
        'guest_email',
        'modified'
    ];
    
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function Reply()
    {
        return $this->hasMany(Reply::class);
    }
}
