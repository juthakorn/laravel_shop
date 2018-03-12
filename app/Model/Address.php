<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    var $table = "address";
    protected $fillable = [
        'firstname',
        'lastname',
        'address',
        'sub_district',
        'district',        
        'province',
        'postcode',
        'tel',        
        'user_id'
    ];
    
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
