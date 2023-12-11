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
            'tipo_contrato' => ['required', 'regex:/^[a-zA-ZÑñ ]{2,40}$/'], //'required|min:5|max:50|alpha_num_spaces', //numeric|alpha|alpha_num_spaces,
        ]);
        
      // dd($request);
        $newtcontrato = new TipoContrato;
        $newtcontrato->nombre = ucfirst(strtolower($validatedData['tipo_contrato'])); 
        $newtcontrato->estado = 'Habilitado';
        $newtcontrato->user_id = auth()->user()->id;
        //dd($newtcontrato);
        $newtcontrato->save();
        return redirect(route('listar.tipos.contratos'))->with('success', 'El tipo de contrato se registro correctamente !!');
    }

    public function update(Request $request)
    {
        //return response()->json($request);
        $validatedData = $request->validate([
            'id' => 'numeric',
            'tipo_contratoM' => ['required', 'regex:/^[a-zA-ZÑñ ]{2,40}$/'],
        ]);
        $t_contrato = TipoContrato::findOrFail($validatedData['id']);
        $t_contrato->nombre =  $validatedData['tipo_contratoM'];
        $t_contrato->user_id = auth()->user()->id;
        $t_contrato->save();
        return redirect(route('listar.tipos.contratos'))->with('success', 'El tipo de contrato se edito correctamente !!');
    }

    public function deshabilitar(Request $request)
    {
         //dd($request);
         $id = $request->id;
         $t_contrato = TipoContrato::findOrFail($id);
         if($request->accion == 'D'){
            $t_contrato->estado = 'Deshabilitado';
            $t_contrato->save();
            return redirect(route('listar.tipos.contratos'))->with('success', 'El tipo turno se deshabilito correctamente !!'); 
         }else{
            $t_contrato->estado = 'Habilitado';
            $t_contrato->save();
            return redirect(route('listar.tipos.contratos'))->with('success', 'El tipo turno se habilito correctamente !!'); 
         }
    }
    /*public function habilitar($id)
    {
         $t_contrato = TipoContrato::findOrFail($id);
         $t_contrato->estado = 'Habilitado';
         $t_contrato->save();
        
          $t_contrato = TipoContrato::findOrFail($id);
         $t_contrato->estado = 'Inhabilitado';
         $t_contrato->save();
         return redirect(route('listar.tipos.contratos'))->with('success', 'El tipo turno se deshabilito correctamente !!'); 
    }*/
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
    ------------otro uptado ajax
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
*/
