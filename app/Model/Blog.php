<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    protected $fillable = [
        'blog_name',
        'seo_title',
        'seo_keyword',
        'seo_description',
        'active',
        'detail', 
        'tags',
        'slug_url',
        'image_store_id'
    ];
    
    public function image_logo()
    {
        return $this->hasOne('App\Model\ImageStore','id','image_store_id');
    }
}

