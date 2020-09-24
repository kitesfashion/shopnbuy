<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductImage extends Model
{
    protected $fillable = [
        'productId','originalImageId','section', 'images'
    ];

    protected $hidden = [
        'created_at', 'updated_at',
    ];

}