<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CashPurchase extends Model
{
    protected $table = 'cash_purchase';
    protected $fillable = [
        'cash_serial','voucher_no','supplier_id','voucher_date','total_qty','total_amount', 'orderBy', 'voucherStatus','delivery_zone_id'
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

