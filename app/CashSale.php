<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CashSale extends Model
{
    protected $table = 'cash_sales';

    protected $fillable = [
    	'invoice_no','invoice_date','invoice_amount','discount_as','discount_amount','vat_amount','net_amount','customer_paid','change_amount','payment_type','delivery_zone_id'
    ];

    protected $hidden = [
    	'created_at','updated_at'
    ];
}
