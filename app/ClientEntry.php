<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ClientEntry extends Model
{
    protected $table = 'customers';

    protected $fillable = [
    	'name','dob','gender','mobile','email','password','delivery_zone_id'
    ];

    protected $hidden = [
    	'created_at','updated_at'
    ];
}
