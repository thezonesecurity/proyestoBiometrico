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
        //}
        $rolturnos = Rolturno::orderBy('id')->get();
        return view('habilitacionTurnos.listadoTurnos')->with(compact('rolturnos'));
    }
    
    public function habilitacion(Request $request)
    {
       // dd(auth()->user()->id);
     //dd($request);
       $rolturno = Rolturno::find($request->id); 
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
   
}
