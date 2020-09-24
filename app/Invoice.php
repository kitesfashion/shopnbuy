<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    protected $fillable = [
        'invoiceId','orderId','productCode', 'productName', 'productQuantity','productPrice', 'productAmount','delivery_zone_id','delivery_zone_name'
    ];

    protected $hidden = [
        'created_at', 'updated_at',
    ];
}