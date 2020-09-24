<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DeliveryZone extends Model
{
    protected $table = 'zone';
    protected $fillable = [
        'name',
    ];

   
    protected $hidden = [
        'created_at', 'updated_at',
    ];

}