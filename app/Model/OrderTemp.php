<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class OrderTemp extends Model
{
    var $table = "order_temps";
    protected $fillable = [
        'user_id',
        'data',
        'payment_id',
        'delivery_id',
        'address_id',
        'note',
        'code_discount'
    ];
    
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function delivery()
    {
        return $this->belongsTo(Delivery::class);
    }
    public function address()
    {
        return $this->belongsTo(Address::class);
    }    
}
