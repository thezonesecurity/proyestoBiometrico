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
        $nombre= ucwords($request->t_turno);
        $entrada->nombre = $nombre;
        $entrada->estado = 'Habilitado';
        $entrada->user_id = auth()->user()->id;
        //dd($entrada);
        $entrada->save();
        return redirect(route('listar.tipos.turnos'))->with('success', 'El tipo de turno se registro correctamente !!');
    }

    public function update(Request $request)
    {
        //dd($request);
        $id = $request->id;
        $entrada = TipoTurno::find($id);
        $nombre = ucwords($request->t_turno);
        $entrada->nombre =  $nombre;
        $entrada->user_id = auth()->user()->id;
        $entrada->save();
       // dd($entrada);
       return redirect(route('listar.tipos.turnos'))->with('success', 'El tipo turno se actualizo correctamente !!'); 
    }

    public function deshabilitar($id)
    {
         //dd($id);
         $t_turno = TipoTurno::find($id);
         $t_turno->estado = 'Inhabilitado';
         $t_turno->save();
         return redirect(route('listar.tipos.turnos'))->with('warning', 'El tipo turno se deshabilito correctamente !!'); 
    }
    public function habilitar($id)
    {
         $t_turno = TipoTurno::find($id);
         $t_turno->estado = 'Habilitado';
         $t_turno->save();
         return redirect(route('listar.tipos.turnos'))->with('success', 'El tipo turno se habilito correctamente !!'); 
    }
}
