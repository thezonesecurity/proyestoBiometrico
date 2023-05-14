<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\tipo_contratos\TipoContrato;

class TipoContratosController extends Controller
{
 
    public function index()
    {
        $tipo_contratos = TipoContrato::orderBy('id')->get();
        return view('tipo_contratos.lista_tipoContratos')->with(compact('tipo_contratos'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'tipo_contrato' => ['required', 'regex:/^[a-zA-Z ]{5,50}$/'], //'required|min:5|max:50|alpha_num_spaces', //numeric|alpha|alpha_num_spaces,
        ]);
        
      // dd($request);
        $newtcontrato = new TipoContrato;
        $nombre= ucwords($validatedData['tipo_contrato']);
        $newtcontrato->nombre = $nombre;
        $newtcontrato->estado = 'Habilitado';
        $newtcontrato->user_id = auth()->user()->id;
        //dd($newtcontrato);
        $newtcontrato->save();
        return redirect(route('listar.tipos.contratos'))->with('success', 'El tipo de contrato se registro correctamente !!');
    }

    public function update(Request $request)
    {
        $validatedData = $request->validate([
            'id' => 'numeric',
            'tipo_contratoM' => ['required', 'regex:/^[a-zA-Z ]{5,50}$/'],
        ]);

        $t_contrato = TipoContrato::findOrFail($validatedData['id']);
        $nombre = ucwords($validatedData['tipo_contratoM']);
        $t_contrato->nombre =  $nombre;
        $t_contrato->user_id = auth()->user()->id;
        $t_contrato->save();
       // dd($t_contrato);
       return redirect(route('listar.tipos.contratos'))->with('success', 'El tipo de contrato se actualizo correctamente !!');
    }

    public function deshabilitar($id)
    {
         //dd($id);
         $t_contrato = TipoContrato::findOrFail($id);
         $t_contrato->estado = 'Inhabilitado';
         $t_contrato->save();
         return redirect(route('listar.tipos.contratos'))->with('success', 'El tipo turno se deshabilito correctamente !!'); 
    }
    public function habilitar($id)
    {
         $t_contrato = TipoContrato::findOrFail($id);
         $t_contrato->estado = 'Habilitado';
         $t_contrato->save();
         return redirect(route('listar.tipos.contratos'))->with('success', 'El tipo turno se habilito correctamente !!'); 
    }
}

/*
-----------del store-----------
dd($request);
        $newtcontrato = new TipoContrato;
        $nombre= ucwords($request->t_contrato);
        $newtcontrato->nombre = $nombre;
        $newtcontrato->estado = 'Habilitado';
        $newtcontrato->user_id = auth()->user()->id;
        //dd($newtcontrato);
        $newtcontrato->save();
-----------------update--------------
 $id = $request->id;
        $entrada = TipoContrato::findOrFail($id);
        $nombre = ucwords($request->t_contrato);
        $entrada->nombre =  $nombre;
        $entrada->user_id = auth()->user()->id;
        $entrada->save();
*/
