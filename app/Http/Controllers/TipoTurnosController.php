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
        //dd($request);
        $validatedData = $request->validate([
            'tipo_turno' => ['required', 'regex:/^[a-zA-Z0-9ñ. ]{5,50}$/'], //'required|min:5|max:50|alpha_num_spaces', //numeric|alpha|alpha_num_spaces,
        ]);
    
        $newT_turno = new TipoTurno();
        $nombre = ucwords($validatedData['tipo_turno']);
        $newT_turno->nombre = $nombre;
        $newT_turno->estado = 'Habilitado';
        $newT_turno->user_id = auth()->user()->id;
        $newT_turno->save();
        return redirect(route('listar.tipos.turnos'))->with('success', 'El tipo de turno se registro correctamente !!');
    }

    public function update(Request $request)
    {
       // dd($request);
        $validatedData = $request->validate([
            'id' => 'numeric',
            'tipo_turnoM' => ['required', 'regex:/^[a-zA-Z0-9ñ. ]{5,50}$/'],
        ]);

        $tipoT = TipoTurno::findOrFail($validatedData['id']);
        $nombre = ucwords($validatedData['tipo_turnoM']);
        $tipoT->nombre =  $nombre;
        $tipoT->user_id = auth()->user()->id;
        $tipoT->save();
        //dd($tipoT);
       return redirect(route('listar.tipos.turnos'))->with('success', 'El tipo turno se actualizo correctamente !!'); 
    }

    public function deshabilitar($id)
    {
         //dd($id);
         $t_turno = TipoTurno::findOrFail($id);
         $t_turno->estado = 'Inhabilitado';
         $t_turno->save();
         return redirect(route('listar.tipos.turnos'))->with('success', 'El tipo turno se deshabilito correctamente !!'); 
    }
    public function habilitar($id)
    {
         $t_turno = TipoTurno::findOrFail($id);
         $t_turno->estado = 'Habilitado';
         $t_turno->save();
         return redirect(route('listar.tipos.turnos'))->with('success', 'El tipo turno se habilito correctamente !!'); 
    }
}
/*
-------------store---------------------
  
        $entrada = new TipoTurno;
        $nombre= ucwords($request->t_turno);
        $entrada->nombre = $nombre;
        $entrada->estado = 'Habilitado';
        $entrada->user_id = auth()->user()->id;
        //dd($entrada);
        $entrada->save();
---------------update---------------
 //dd($request);
        $id = $request->id;
        $entrada = TipoTurno::find($id);
        $nombre = ucwords($request->t_turno);
        $entrada->nombre =  $nombre;
        $entrada->user_id = auth()->user()->id;
        $entrada->save();
        
*/
