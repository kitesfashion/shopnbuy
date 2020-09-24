<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CashPurchaseItem extends Model
{   protected $table = 'cash_purchase_item';
    protected $fillable = [
        'cash_puchase_id','product_id','qty','rate','amount','delivery_zone_id'
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

