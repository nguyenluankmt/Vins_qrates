<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    protected $table='users';
    protected $primaryKey = 'id';
    protected $fillable = ['email','user_pass','remember_token'];

    protected $hidden = [
        'user_pass', 'remember_token',
    ];
    public  $timestamps=false;

}
