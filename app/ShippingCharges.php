<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ShippingCharges extends Model
{
    protected $fillable = [
        'delivery_zone_id','delivery_area_id','shippingCharge','orderBy','shippingStatus',
    ];

    protected $hidden = [
        'created_at', 'updated_at',
    ];

    
}