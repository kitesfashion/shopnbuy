<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OrderList extends Model{
    protected $table = 'order_list';
    protected $fillable = [
        'order_id', 'customer_id', 'product_id','name','code', 'price', 'qty','total','delivery_zone_id','delivery_zone_name', 'status'
    ];

    protected $hidden = [
        'created_at', 'updated_at',
    ];
}