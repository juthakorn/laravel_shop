<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Delivery extends Model
{
    var $table = "delivery";
    protected $fillable = [
        'name',
        'price',
    ];
    
}
