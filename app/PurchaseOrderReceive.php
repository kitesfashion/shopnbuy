<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PurchaseOrderReceive extends Model
{
    protected $table = 'purchase_order_receives';
    protected $fillable = [
       'purchaseOrderNo','receive_date', 'total_qty','total_amount','delivery_zone_id'
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