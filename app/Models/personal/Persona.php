<?php

namespace App\Models\personal;

use Illuminate\Database\Eloquent\Model;

class Persona extends Model
{
    //
    protected $table = 'repbio.personas';

    protected $fillable = ['id', 'nombres', 'ci', 'item_id', 'estado_per', 'idper_db', 'id_servicio', 'user_id']; //cambiar id_per por id

    protected $dates = ['created_at','updated_at'];

   /* public function personasRolturnos(){
        return $this->belongsToMany('App\Models\rolturno\Rolturno', 'persona_rolturno', 'persona_id', 'rolturno_id') //,'id_servicio');
                    ->withPivot('id', 'fecha_inicio', 'fecha_fin', 'hora_inicio', 'hora_fin','tipo_dia', 'turno', 'area_id', 'obs', 'estado', 'persona_id', 'rolturno_id', 'created_at', 'ipdated_at');
    }*/

    public function rolturnos_per(){
        return $this->hasMany(\App\Models\rolturno\PersonaRolturno::class);
    }
    public function PersonaItem()//uno a muchos inversa
    {
        return $this->belongsTo(\App\Models\tipo_contratos\TipoContrato::class,'item_id');
    }

}
