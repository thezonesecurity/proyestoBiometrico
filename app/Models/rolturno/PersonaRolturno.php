<?php

namespace App\Models\rolturno;

use Illuminate\Database\Eloquent\Model;

class PersonaRolturno extends Model
{
    //
    protected $table = 'repbio.persona_rolturno';

    protected $fillable = ['id', 'fecha_inicio', 'fecha_fin', 'hora_inicio', 'hora_fin','tipo_dia', 'turno', 'area_id', 'obs', 'estado', 'persona_id', 'rolturno_id', 'created_at', 'ipdated_at'];

    protected $dates = ['created_at','updated_at'];
}
