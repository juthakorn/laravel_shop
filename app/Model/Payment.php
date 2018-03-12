<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    var $table = "payments";
    protected $fillable = [
        'user_id',
        'status',
        'bank_info',
        'transfer_date',
        'transfer_time',
        'transfer_pay',
        'transfer_file',
        'transfer_note'
        
    ];
    
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    
    public function payment_order()
    {
        return $this->hasMany(PaymentOrder::class);
    }
    
    //many to many
    public function order()
    {
        return $this->belongsToMany(Order::class,'payment_orders')
            ->withPivot('id', 'payment_id', 'order_id');
    }
}
