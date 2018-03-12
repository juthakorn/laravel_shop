<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class PaymentOrder extends Model
{
    var $table = "payment_orders";
    public $timestamps = false;
    protected $fillable = [
        'payment_id',
        'order_id',
    ];
     
}
