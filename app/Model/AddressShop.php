<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class AddressShop extends Model
{
    protected $fillable = [
        'shop_name',
        'description',
        'address',
        'district',
        'city',
        'province',
        'postcode',
        'email',
        'tel',
        'image_store_id',
        'seo_title',
        'seo_keyword',
        'seo_description',
        'social_facebook',
        'social_line',
        'social_instagram',
        'google_map',
        
    ];
    public function image_logo()
    {
        return $this->hasOne('App\Model\ImageStore','id','image_store_id');
    }
}
