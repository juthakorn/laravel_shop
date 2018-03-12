<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    var $table = "category";
    protected $fillable = [
        'parent_id',
        'cat_name',
        'seo_title',
        'seo_keyword',
        'seo_description',
        'active',
        'detail', 
        'position',
        'image_store_id'
    ];
    
    public function image_logo()
    {
        return $this->hasOne('App\Model\ImageStore', 'id', 'image_store_id');
    }
    
    public function TypeProduct() 
    {
      return $this->hasMany('App\Model\TypeProduct');
    }
    
    public function MainCategory() 
    {
      return $this->hasOne('App\Model\Category', 'id', 'parent_id');
    }
    
    public function SubCategory() 
    {
      return $this->hasMany('App\Model\Category', 'parent_id', 'id')->orderBy('position');
    }
    
}
