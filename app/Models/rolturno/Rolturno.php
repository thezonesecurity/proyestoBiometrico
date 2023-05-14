<?php

namespace App\Models\rolturno;

use Illuminate\Database\Eloquent\Model;

class Rolturno extends Model
{
    //
    protected $table = 'repbio.rolturnos';

    protected $fillable = ['id', 'gestion', 'user_id', 'servicio_id', 'estado'];

    protected $dates = ['created_at','updated_at'];

    public function servicios(){
        return $this->belongsTo(\App\Models\servicios\Servicio::class, 'servicio_id');
    }
    /*
    public function personas(){
        return $this->belongsToMany('App\Models\personal\Persona', 'repbio.persona_rolturno', 'rolturno_id', 'persona_id') //,'id_servicio');
                    ->withPivot('id', 'fecha_inicio', 'fecha_fin', 'hora_inicio', 'hora_fin','tipo_dia', 'turno', 'area_id', 'obs', 'estado', 'persona_id', 'rolturno_id', 'created_at', 'ipdated_at');
    }*/

    public function user()//uno a muchos inversa
    {
        return $this->belongsTo(\App\Models\seguridad\users::class,'user_id');
    }
    
    public function per_rolturnos(){
        return $this->hasMany(\App\Models\rolturno\PersonaRolturno::class);
    }
    
}

