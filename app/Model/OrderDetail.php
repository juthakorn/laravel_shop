<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class OrderDetail extends Model
{
    var $table = "order_details";
    protected $fillable = [
        'order_id',
        'product_id',
        'product_attribute_id',
        'p_name',
        'p_price',
        'p_quantity',
        'sum',
        'option1',
        'option2',
        'image_store_id'
    ];
    
    public function order()
    {
        return $this->belongsTo(Order::class);
    }  
    
    public function image_store()
    {
        return $this->hasOne(ImageStore::class, 'id', 'image_store_id');
    } 
}
