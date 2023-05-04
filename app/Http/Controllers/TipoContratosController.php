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
      // dd($request);
        $entrada = new TipoContrato;
        $nombre= ucwords($request->t_contrato);
        $entrada->nombre = $nombre;
        $entrada->estado = 'Habilitado';
        $entrada->user_id = auth()->user()->id;
        //dd($entrada);
        $entrada->save();
        return redirect(route('listar.tipos.contratos'))->with('success', 'El tipo de contrato se registro correctamente !!');
    }

    public function update(Request $request)
    {
        //dd($request);
        $id = $request->id;
        $entrada = TipoContrato::find($id);
        $nombre = ucwords($request->t_contrato);
        $entrada->nombre =  $nombre;
        $entrada->user_id = auth()->user()->id;
        $entrada->save();
       // dd($entrada);
       return redirect(route('listar.tipos.contratos'))->with('success', 'El tipo de contrato se actualizo correctamente !!');
    }

    public function deshabilitar($id)
    {
         //dd($id);
         $t_contrato = TipoContrato::find($id);
         $t_contrato->estado = 'Inhabilitado';
         $t_contrato->save();
         return redirect(route('listar.tipos.contratos'))->with('warning', 'El tipo turno se deshabilito correctamente !!'); 
    }
    public function habilitar($id)
    {
         $t_contrato = TipoContrato::find($id);
         $t_contrato->estado = 'Habilitado';
         $t_contrato->save();
         return redirect(route('listar.tipos.contratos'))->with('success', 'El tipo turno se habilito correctamente !!'); 
    }
}
