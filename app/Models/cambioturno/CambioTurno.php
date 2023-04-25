<?php

namespace App\Models\cambioturno;

use Illuminate\Database\Eloquent\Model;

class CambioTurno extends Model
{
    //
    protected $table = 'repbio.cambio_turnos';

    protected $fillable = ['id', 'per_saliente', 'per_reemplazo', 'fecha', 'obs', 'estado', 'user_id', 'servicio_id', 'per_rolturno_id'];
    
    protected $dates = ['created_at','updated_at'];

    public function cambioRoltuno(){
        return $this->belongsTo(\App\Models\rolturno\PersonaRolturno::class, 'per_rolturno_id');
    }

    public function cambioturno_servicio(){
        return $this->belongsTo(\App\Models\servicios\Servicio::class, 'servicio_id');
    }

   /* 
     public function user()//uno a muchos inversa
    {
        return $this->belongsTo(\App\Models\seguridad\users::class,'user_id');
    }
    */
}
