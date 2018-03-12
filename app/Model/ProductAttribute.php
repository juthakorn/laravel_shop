<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class ProductAttribute extends Model
{
    protected $fillable = [
        'product_id',
        'p_price',
        'option1',
        'option2',
        'p_quantity'
    ];
    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
