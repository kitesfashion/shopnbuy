<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Customer extends Authenticatable
{
    use Notifiable;

    protected $guard = 'customer';

    protected $fillable = [
        'name', 'email', 'mobile', 'dob', 'address', 'gender', 'password','confirmPassword','clientGroup','verify_token'
    ];

    public function checkouts()
    {
        return $this->haMany(Checkout::class);
    }
}
