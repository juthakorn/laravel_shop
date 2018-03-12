<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Bank extends Model
{
    protected $fillable = [
        'ac_name',
        'bank_name',
        'bank_number',
        'branch',
        'bank_type',
        'active',
    ];
}
