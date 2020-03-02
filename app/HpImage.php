<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class HpImage extends Model
{
    protected $guarded = array('id');
    
    public static $rules = [
        'user_id' => 'required',
        'blog_url' => 'required',
        'image_url' => 'required|unique:hp_images,image_url'
    ];
        
    protected $casts = [
        'is_favorite' => 'boolean'
    ];    
}
