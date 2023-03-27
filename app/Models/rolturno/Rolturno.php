<?php

namespace App\Models\rolturno;

use Illuminate\Database\Eloquent\Model;

class Rolturno extends Model
{
    //
    protected $table = 'repbio.rolturnos';

    protected $fillable = ['id', 'user_id', 'servicio_id', 'estado'];

    protected $dates = ['created_at','updated_at'];

    public function servicios(){
        return $this->belongsTo('App\Models\servicios\Servicio','id_servicio');
    }

    
    public function personas(){
        return $this->belongsToMany('App\Models\personal\Persona', 'persona_rolturno','persona_id') //,'id_servicio');
                    ->withPivot('id', 'fecha_inicio', 'fecha_fin', 'hora_inicio', 'hora_fin','tipo_dia', 'turno', 'area_id', 'obs', 'estado', 'persona_id', 'rolturno_id', 'created_at', 'ipdated_at');
    }
    /*
    /*public function personas(){
        return $this->belongsToMany('App\Models\personal\Persona', 'persona_rolturno', 'id_persona', 'id_rolturno') //,'id_servicio');
                    ->withPivot('id', 'fecha_inicio', 'fecha_fin', 'hora_inicio', 'hora_fin', 'id_persona', 'id_rolturno');// 'created_at', 'ipdated_at');

    }*/

    
}

