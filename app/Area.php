<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Area extends Model
{
    protected $table = 'area';
    protected $fillable = [
        'name','delivery_zone_id'
    ];

   
    protected $hidden = [
        'created_at', 'updated_at',
    ];

}