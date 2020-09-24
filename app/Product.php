<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'category_id','root_category', 'name', 'description1','description2', 'deal_code', 'phone_no', 'qty','stockUnit', 'price', 'weight', 'discount', 'status','youtubeLink','productSection','tag','metaTitle','metaKeyword','metaDescription','orderBy'
    ];

    
    protected $hidden = [
        'created_at', 'updated_at',
    ];

}