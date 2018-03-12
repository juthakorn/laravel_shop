<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class CodeDiscount extends Model
{
    protected $fillable = [
        'code',
        'discount',
        'status',
        'start',
        'end',
    ];
}
