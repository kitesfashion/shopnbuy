<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model{
    protected $table = 'orders';
    protected $fillable = [
        'customer_id', 'first_name', 'last_name','name', 'phone', 'email', 'shipping_address','delivery_zone_id','delivery_zone_name','shipping_location_id', 'shipping_location_name', 'shipping_charge', 'payment_method', 'total_amount', 'status',
    ];

    protected $hidden = [
        'created_at', 'updated_at',
    ];
}