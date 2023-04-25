<?php

namespace App\Models\areas;

use Illuminate\Database\Eloquent\Model;

class Area extends Model
{
    //
    protected $table = 'repbio.areas';

    protected $fillable = ['id', 'nombre', 'estado', 'servicio_id'];
    
    protected $dates = ['created_at','updated_at'];

    public function servicio(){
        return $this->belongsTo(\App\Models\servicios\Servicio::class, 'servicio_id');
    }

    public function person_rolturno(){
        return $this->hasMany(\App\Models\rolturno\PersonaRolturno::class);
    }
}
