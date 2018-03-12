<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class TypeProduct extends Model
{
    protected $fillable = [
        'type_name',
        'seo_title',
        'seo_keyword',
        'seo_description',
        'active',
        'detail', 
        'position',
        'category_id',
        'image_store_id'
    ];
    
    public function image_logo()
    {
        return $this->hasOne(ImageStore::class,'id','image_store_id');
    }
//    public function TypeProductchild() 
//    {
//      return $this->hasMany('App\TypeProduct','parent_id');
//    }
}
