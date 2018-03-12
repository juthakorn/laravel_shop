<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Reply extends Model
{    
    var $table = "reply";
    protected $fillable = [
        'user_id',
        'forum_id',
        'detail',
        'guest_name',
        'guest_email',
        'modified'
    ];
    
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function forum()
    {
        return $this->belongsTo(Forum::class);
    }
}
