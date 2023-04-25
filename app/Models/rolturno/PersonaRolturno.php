<?php

namespace App\Models\rolturno;

use Illuminate\Database\Eloquent\Model;

class PersonaRolturno extends Model
{
    //
    protected $table = 'repbio.persona_rolturno';

    protected $fillable = ['id', 'fecha_inicio', 'fecha_fin', 'hora_inicio', 'hora_fin','tipo_dia', 'turno_id', 'area_id', 'obs', 'cambio_turno', 'estado', 'persona_id', 'rolturno_id', 'created_at', 'updated_at'];

    protected $dates = ['created_at','updated_at'];

    public function per_rolturno(){
        return $this->belongsTo(\App\Models\rolturno\Rolturno::class, 'rolturno_id');
    }

    public function rolturno_per(){
        return $this->belongsTo(\App\Models\personal\Persona::class, 'persona_id');
    }
    
    public function area(){
        return $this->belongsTo(\App\Models\areas\Area::class, 'area_id');
    }

    public function tipoTurno(){
        return $this->belongsTo(\App\Models\tipo_turnos\TipoTurno::class, 'turno_id');
    }
}
