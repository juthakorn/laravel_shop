<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    var $table = "orders";
    protected $fillable = [
        'order_id',
        'user_id',
        'product_price',
        'delivery_price',
        'payment_price',
        'sum_product_delivery',
        'discount',
        'discount_price',
        'final_sum',
        'status',
        'code_discount',
        'delivery_firstname',
        'delivery_lastname',
        'delivery_address',
        'delivery_sub_district',
        'delivery_district',
        'delivery_province',
        'delivery_postcode',
        'delivery_tel',
        'delivery_name',
        'payment_name',
        'note',
        'limit_pay_date',
        'cancel_detail',
        'delivery_number'
    ];
    
    public function user()
    {
        return $this->belongsTo(User::class);
    }
//    public function delivery()
//    {
//        return $this->belongsTo(Delivery::class);
//    }
//    public function address()
//    {
//        return $this->belongsTo(Address::class);
//    } 
    public function order_detail()
    {
        return $this->hasMany(OrderDetail::class);
    }

    //many to many
    public function payment()
    {
        return $this->belongsToMany(Payment::class,'payment_orders')
            ->withPivot('id', 'order_id', 'payment_id')->orderBy('id', 'desc');
    }
    
    //many to many
    public function check_has_payment()
    {
        return $this->belongsToMany(Payment::class,'payment_orders')->where('status' , 0)
            ->withPivot('id', 'order_id', 'payment_id');
    }
}
