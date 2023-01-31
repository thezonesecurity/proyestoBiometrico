<?php

namespace App\Models\seguridad;

use Illuminate\Foundation\Auth\User as Authenticatable;

class users extends Authenticatable
{
    //
    protected $remember_token = 'false';
    protected $table = 'users';
    protected $fillable = ['email', 'password'];
    protected $guarded = ['id'];
}
