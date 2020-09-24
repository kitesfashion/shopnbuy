<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CreditSale extends Model
{
    protected $table = 'credit_sales';

    protected $fillable = [
    	'customer_id','invoice_no','invoice_date','invoice_amount','discount_as','discount_amount','vat_amount','net_amount','payment_type','delivery_zone_id'
    ];

    protected $hidden = [
    	'created_at','updated_at'
    ];
}
