<?php

namespace App\Models\areaservicio;

use Illuminate\Database\Eloquent\Model;

class AreaServicio extends Model
{
    //
    protected $table = 'repbio.areaservicio';

    protected $fillable = ['id', 'nombre', 'estado', 'servicio_id'];
    
    protected $dates = ['created_at','updated_at'];

    public function servicio(){
        return $this->belongsTo('App\Models\servicios\Servicio','servicio_id');
    }
    
}
