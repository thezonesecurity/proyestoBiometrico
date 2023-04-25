<?php

namespace App\Models\servicios;

use Illuminate\Database\Eloquent\Model;

class Servicio extends Model
{
    //protected $table = 'NombreSCHEMA.NombreTABLA';
    protected $table = 'repbio.servicios';

    protected $fillable = ['id', 'nombre', 'estado', 'id_responsable'];

    protected $dates = ['created_at','updated_at'];

    public function rolturno(){
        return $this->hasMany(\App\Models\rolturno\Rolturno::class);
    }

    public function areas(){
        return $this->hasMany(\App\Models\areas\Area::class);
    }

    public function cambioturno_servicios(){
        return $this->hasMany(\App\Models\cambioturno\CambioTurno::class);
    }

    public function user()//uno a muchos inversa
    {
        return $this->belongsTo(\App\Models\seguridad\users::class,'id_responsable');
    }
}
