<?php

namespace App\Models\rolturno;

use Illuminate\Database\Eloquent\Model;

class Rolturno extends Model
{
    //
    protected $table = 'repbio.rolturnos';

    protected $fillable = ['id','fecha_inicio', 'fecha_fin', 'hora_inicio', 'hora_fin','tipo_dia', 'turno', 'area', 'obs', 'estado', 'id_persona'];

    protected $dates = ['created_at','updated_at'];

    public function rolturnosPersonas(){
        return $this->belongsTo('App\Models\personal\Persona', 'id_persona');
    }
    /*
    public function personas(){
        return $this->belongsToMany('App\Models\personal\Persona', 'persona_rolturno') //,'id_servicio');
                    ->withPivot('id', 'fecha_inicio', 'fecha_fin', 'hora_inicio', 'hora_fin','tipo_dia', 'turno', 'estado', 'id_persona', 'id_rolturno');// 'created_at', 'ipdated_at');

    }
    /*public function personas(){
        return $this->belongsToMany('App\Models\personal\Persona', 'persona_rolturno', 'id_persona', 'id_rolturno') //,'id_servicio');
                    ->withPivot('id', 'fecha_inicio', 'fecha_fin', 'hora_inicio', 'hora_fin', 'id_persona', 'id_rolturno');// 'created_at', 'ipdated_at');

    }*/

    
}

