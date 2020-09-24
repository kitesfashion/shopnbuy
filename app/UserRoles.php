<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class UserRoles extends Authenticatable
{
    use Notifiable;

    protected $guard = 'admin';

    protected $fillable = [
        'name','parentRole','level','status','permission','actionPermission',
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];
}
