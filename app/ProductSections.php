<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductSections extends Model
{
    protected $fillable = [
        'productId','productSection','hotDiscount','hotDate','specialDiscount','specialDate','free_shipping','pre_order','pre_orderDuration','related_product'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'created_at', 'updated_at',
    ];

  

    
}