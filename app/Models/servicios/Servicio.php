<?php

namespace App\Models\servicios;

use Illuminate\Database\Eloquent\Model;

class Servicio extends Model
{
    //protected $table = 'NombreSCHEMA.NombreTABLA';
    protected $table = 'repbio.servicios';

    protected $fillable = ['id', 'nombre', 'estado'];

    protected $dates = ['created_at','updated_at'];

    public function rolturno(){
        return $this->hasMany(\App\Models\rolturno\Rolturno::class);
    }

    public function areas(){
        return $this->hasMany(\App\Models\areaservicio\AreaServicio::class);
    }

}
