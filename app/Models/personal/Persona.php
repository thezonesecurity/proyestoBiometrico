<?php

namespace App\Models\personal;

use Illuminate\Database\Eloquent\Model;

class Persona extends Model
{
    //
    protected $table = 'repbio.personas';

    protected $fillable = ['id_per', 'cargo', 'item', 'estado_per', 'idper_db', 'id_servicio'];

    protected $dates = ['created_at','updated_at'];
    public function servicio(){
        return $this->belongsTo('App\Models\servicios\Servicio','id_servicio');
    }
}
