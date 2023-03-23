<?php

namespace App\Models\rolturno;

use Illuminate\Database\Eloquent\Model;

class PersonaRolturno extends Model
{
    //
    protected $table = 'repbio.persona_rolturno';

    protected $fillable = ['id', 'fecha_inicio', 'fecha_fin', 'hora_inicio', 'hora_fin','tipo_dia', 'turno', 'estado', 'id_persona', 'id_rolturno']; //cambiar id_per por id

    protected $dates = ['created_at','updated_at'];
}
