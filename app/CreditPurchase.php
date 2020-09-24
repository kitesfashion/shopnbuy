<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CreditPurchase extends Model
{
    protected $table = 'credit_purchases';
    protected $fillable = [
        'credit_serial','vouchar_no','supplier_id','submission_date','purchase_by', 'total_qty', 'total_amount','discount','vat','net_amount','voucher_date','delivery_zone_id'
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
