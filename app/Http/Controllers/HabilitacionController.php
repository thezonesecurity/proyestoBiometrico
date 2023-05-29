<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\servicios\Servicio;
use App\Models\areaservicio\AreaServicio;
use App\Models\personal\Persona;
use App\Models\rolturno\Rolturno;
use App\Models\rolturno\PersonaRolturno;
use DB;

class HabilitacionController extends Controller
{
    public function index()
    {
        //dd(auth()->user()->servicioUsers[0]->nombre); //$user->per_user->nombres
        $rolturnos = Rolturno::orderBy('id')->get();
        return view('habilitacionTurnos.listadoTurnos')->with(compact('rolturnos'));
    }
    
    public function habilitacion(Request $request)
    {
       // dd(auth()->user()->id);
       $validatedData = $request->validate([
        'id' => 'required',
        'accion' => 'required',
        'obsMH' => 'required|regex:/^[a-zA-Z0-9 ]{5,60}+$/',
      ]);
    //dd($request);
     if(isset($validatedData['id'])){
        $rolturno = Rolturno::findOrFail($validatedData['id']); 
        if($request->accion == 'Aceptado'){
              $rolturno->estado = $validatedData['accion']; // 'Aceptado';
              $rolturno->obsevacion = $validatedData['obsMH'];
        }else{
              $rolturno->estado = $validatedData['accion']; // 'Rechazado';
              $rolturno->obsevacion = $validatedData['obsMH'];   
        }
        $rolturno->save();
        return back()->with('success', 'La accion se realizo  correctamente !!');;//view('habilitacionTurnos.listadoTurnos');
      }else {
        return back()->with('error', 'La accion no se realizo correctamente !!');
      }
    }  

    public function CambioRolturno(Request $request)
    {
      //dd($request);
      $validatedData = $request->validate([
        'id' => 'required',
        'accion' => 'required',
        'obsMC' => 'required|regex:/^[a-zA-Z0-9 ]{5,60}+$/',
      ]);
      
      if(isset($validatedData['id'])){
        $rolturno = Rolturno::findOrFail($validatedData['id']);
        if($request->accion == 'CambioTurno'){
          $rolturno->estado = 'Temporal'; // 'Aceptado';
          $rolturno->obsevacion = $validatedData['obsMC'];
        }else{
              $rolturno->estado = 'Pendiente'; // 'Rechazado';
              $rolturno->obsevacion =$validatedData['obsMC'];
        }
        $rolturno->user_id = auth()->user()->id;
        $rolturno->save();
        return back()->with('success', 'La accion se realizo  correctamente !!');
      }else {
        return back()->with('error', 'La accion no se realizo correctamente !!');
      }
    }
   
}
