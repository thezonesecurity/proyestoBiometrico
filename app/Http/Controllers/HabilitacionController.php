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
        //dd(auth()->user()->servicioUsers[0]->nombre);
        $rolturnos = Rolturno::orderBy('id')->get();
        return view('habilitacionTurnos.listadoTurnos')->with(compact('rolturnos'));
    }
    
    public function habilitacion(Request $request)
    {
       // dd(auth()->user()->id);
     //dd($request);
       $rolturno = Rolturno::findOrFail($request->id); 
       if($request->accion == 'Aceptado'){
            $rolturno->estado = $request->accion; // 'Aceptado';
            $rolturno->obsevacion = $request->obs;
           // dd($rolturno);
            $rolturno->save();
       }else{
            $rolturno->estado = $request->accion; // 'Rechazado';
            $rolturno->obsevacion = $request->obs;
           // dd($rolturno);
            $rolturno->save();
       }
       return back();//view('habilitacionTurnos.listadoTurnos');
    }  
    public function anualcionRolturno($id)
    {
      if(isset($id)){
            //$id = $request->id;
            $rolturno = Rolturno::findOrFail($id);
            $rolturno->estado = 'Pendiente';
            //$rolturno->user_id = auth()->user()->id;
            $rolturno->save();
            return back()->with('success', 'La accion se realizo  correctamente !!');
        }else {
          return back()->with('error', 'La accion no se realizo correctamente !!');
        }
    }
   
}
