<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'category_id',
        'p_name',
        'p_price',
        'p_quantity',
        'p_active',
        'p_sell_status', 
        'p_recommend',
        'p_best_sell',
        'p_new',
        'type_option',
        'name_option1',
        'name_option2',
        'p_detail',
        'seo_title',
        'seo_keyword',
        'seo_description',
        'p_tags',
        'slug_url',
        'size_id'
    ];
    
    public function category_product()
    {
        return $this->hasOne('App\Model\Category','id', 'category_id');
    }
    
    public function size()
    {
        return $this->hasOne(Size::class, 'id', 'size_id');
    }
    
    public function product_images()
    {
        return $this->hasMany(ProductImage::class);
    }
    
    public function product_attr()
    {
        return $this->hasMany(ProductAttribute::class)->orderBy('product_attributes.id', 'asc');
    }
        
    //many to many
    public function image_stores()
    {
        return $this->belongsToMany(ImageStore::class,'product_images')
            ->withPivot('id', 'product_id', 'image_store_id');
    }
}
