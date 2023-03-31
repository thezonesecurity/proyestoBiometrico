<?php

namespace App\Models\seguridad;

use Illuminate\Database\Eloquent\Model;

class PersonaUser extends Model
{
    //
    protected $table = 'public.personas';

    protected $fillable = ['id', 'nombres', 'apellidos', 'ci'];

    protected $dates = ['created_at','updated_at'];

    public function user_per(){
        return $this->hasOne(\App\Models\seguridad\users::class);
    }
}
