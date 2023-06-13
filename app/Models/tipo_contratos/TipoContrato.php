<?php

namespace App\Models\tipo_contratos;

use Illuminate\Database\Eloquent\Model;

class TipoContrato extends Model
{
    //
    protected $table = 'repbio.tipo_contratos';

    protected $fillable = ['id', 'nombre', 'estado', 'user_id'];

    protected $dates = ['created_at','updated_at'];

    public function itemPersona(){
        return $this->hasOne(\App\Models\personal\Persona::class, 'item_id');
    }

}
