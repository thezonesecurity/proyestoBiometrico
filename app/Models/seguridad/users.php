<?php

namespace App\Models\seguridad;

use Illuminate\Foundation\Auth\User as Authenticatable;

class users extends Authenticatable
{
    //
    protected $remember_token = 'false';
    protected $table = 'public.users';
    protected $fillable = ['email', 'password', 'persona_id'];
    protected $guarded = ['id'];

    public function rolturno() {
        return $this->hasMany(\App\Models\rolturno\Rolturno::class);
    }

    public function per_user(){
        return $this->belongsTo(\App\Models\seguridad\PersonaUser::class, 'persona_id');
    }

    public function servicios(){
        return $this->hasMany(\App\Models\servicios\Servicio::class);
    }
  
}
