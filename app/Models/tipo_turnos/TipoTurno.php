<?php

namespace App\Models\tipo_turnos;

use Illuminate\Database\Eloquent\Model;

class TipoTurno extends Model
{
    //
    protected $table = 'repbio.tipo_turnos';

    protected $fillable = ['id', 'nombre', 'estado', 'user_id'];

    protected $dates = ['created_at','updated_at'];

    public function rolturnos(){
        return $this->hasMany(\App\Models\rolturno\PersonaRolturno::class, 'turno_id');
    }
}
