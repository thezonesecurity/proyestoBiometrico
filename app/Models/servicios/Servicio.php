<?php

namespace App\Models\servicios;

use Illuminate\Database\Eloquent\Model;

class Servicio extends Model
{
    //protected $table = 'NombreSCHEMA.NombreTABLA';
    protected $table = 'repbio.servicios';

    protected $fillable = ['id', 'nombre', 'estado'];
    protected $dates = ['created_at','updated_at'];

    public function personas(){
        return $this->hasMany('App\Models\personal\Persona');
    }
}
