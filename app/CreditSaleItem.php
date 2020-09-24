<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CreditSaleItem extends Model
{
    protected $table = 'credit_sale_items';

    protected $fillable = [
    	'cash_sale_id','invoice_no','item_id','item_quantity','item_rate','item_price','delivery_zone_id'
    ];

    protected $hidden = [
    	'created_at','updated_at'
    ];
}
