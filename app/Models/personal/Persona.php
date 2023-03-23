<?php

namespace App\Models\personal;

use Illuminate\Database\Eloquent\Model;

class Persona extends Model
{
    //
    protected $table = 'repbio.personas';

    protected $fillable = ['id_per', 'area', 'item', 'estado_per', 'idper_db', 'id_servicio']; //cambiar id_per por id

    protected $dates = ['created_at','updated_at'];

    public function servicio(){
        return $this->belongsTo('App\Models\servicios\Servicio','id_servicio');
    }
    
    public function personaRolturnos(){
        return $this->hasMany('App\Models\rolturno\Rolturno');
    }
    /*
    public function rolturnos(){
        return $this->belongsToMany('App\Models\rolturno\Rolturno', 'persona_rolturno', 'id_persona') //'id_persona', 'id_rolturno')
                    ->withPivot('id', 'fecha_inicio', 'fecha_fin', 'hora_inicio', 'hora_fin','tipo_dia', 'turno', 'estado', 'id_persona', 'id_rolturno');// 'created_at', 'ipdated_at');

    }
    /*
    public function rolturnos(){
        return $this->belongsToMany('App\Models\rolturno\Rolturno', 'persona_rolturno', 'id_persona', 'id_rolturno') //,'id_servicio');
                    ->withPivot('id', 'fecha_inicio', 'fecha_fin', 'hora_inicio', 'hora_fin', 'id_persona', 'id_rolturno');// 'created_at', 'ipdated_at');

    }
    */
}
