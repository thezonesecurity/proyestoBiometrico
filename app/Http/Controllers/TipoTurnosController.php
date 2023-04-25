<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\tipo_turnos\TipoTurno;

class TipoTurnosController extends Controller
{
    public function index()
    {
        $tipo_turnos = TipoTurno::orderBy('id')->get();
        return view('tipo_turnos.lista_tipoTurnos')->with(compact('tipo_turnos'));
    }

    public function store(Request $request)
    {
       // dd($request);
        $entrada = new TipoTurno;
        $nombre= ucwords($request->t_contrato);
        $entrada->nombre = $nombre;
        $entrada->estado = 'Habilitado';
        $entrada->user_id = auth()->user()->id;
        //dd($entrada);
        $entrada->save();
        return redirect(route('listar.tipos.turnos'))->with('creado', 'El tipo de turno se creo satisfactoriamente ...');
    }

    public function update(Request $request)
    {
       // dd($request);
        $id = $request->id;
        $entrada = TipoTurno::find($id);
        $nombre = ucwords($request->t_turno);
        $entrada->nombre =  $nombre;
        $entrada->estado = 'Habilitado';
        $entrada->user_id = auth()->user()->id;
        $entrada->save();
       // dd($entrada);
       return redirect(route('listar.tipos.turnos'));
    }

    public function deshabilitar($id)
    {
         //dd($id);
         $t_contrato = TipoTurno::find($id);
         $t_contrato->estado = 'Inhabilitado';
         $t_contrato->save();
         return redirect(route('listar.tipos.turnos'));
    }
    public function habilitar($id)
    {
         $t_contrato = TipoTurno::find($id);
         $t_contrato->estado = 'Habilitado';
         $t_contrato->save();
         return redirect(route('listar.tipos.turnos'));
    }
}
