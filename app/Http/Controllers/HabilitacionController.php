<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\rolturno\Rolturno;

class HabilitacionController extends Controller
{
    public function index()
    {
        //dd(auth()->user()->servicioUsers[0]->nombre); //$user->per_user->nombres // dd(auth()->user()->id);
        $rolturnos = Rolturno::orderBy('id')->get();
        return view('habilitacionTurnos.listadoTurnos')->with(compact('rolturnos'));
    }
    
    public function habilitacion(Request $request)
    {
      //dd($request);
       $validatedData = $request->validate([
        'id' => 'required',
        'accion' => 'required',
        'comentario' => 'required|regex:/^[a-zA-ZÑñ0-9 ]{5,99}+$/',
      ]);
      if(isset($validatedData['id'])){
        $rolturno = Rolturno::findOrFail($validatedData['id']); 
        if($validatedData['accion'] == 'Cambio_turno'){
          $rolturno->estado = 'Temporal'; 
          $rolturno->obsevacion = $validatedData['comentario'];
          $rolturno->save();
        }else if($validatedData['accion'] == 'Anular_accion'){
          $rolturno->estado = 'Pendiente'; 
          $rolturno->obsevacion = $validatedData['comentario'];
          $rolturno->save();
         }else{
          $rolturno->estado = $validatedData['accion']; // 'Aceptado' o 'Rechazado';
          $rolturno->obsevacion = $validatedData['comentario'];   
          $rolturno->save();
         }
        return back()->with('success', 'La accion se realizo  correctamente !!');
      }else {
        return back()->with('error', 'La accion no se realizo correctamente !!');
      }
    }  
   
}
