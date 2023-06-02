<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\servicios\Servicio;
use App\Models\personal\Persona;
use App\Models\tipo_contratos\TipoContrato;
use App\Models\rolturno\Rolturno;
use App\Models\rolturno\PersonaRolturno;


class ReportesController extends Controller
{

    public function index()
    {
      //  return view('habilitacionTurnos.listadoTurnos')->with(compact('rolturnos'));
      $personas = Persona::where( 'estado_per', 'Habilitado')->pluck('nombres', 'id');
      $items=TipoContrato::orderBy('id')->where('estado', 'Habilitado')->pluck('nombre', 'id');
      return view('reportes.reporte1')->with(compact('personas', 'items'));;
    }
    
    public function reportOne(Request $request)
    {
       // dd(auth()->user()->id);
      // dd($request);
       
                if ($request->persona == 'all') {
                  $resultado = PersonaRolturno::where('fecha_inicio','>=',$request->fecha_inicio)->where('fecha_inicio','<=',$request->fecha_fin)->where('tipo_dia', 'DL')->get();
                  dd($resultado);
                }
                /*else{
                    $resultado=$resultado->whereHas('paciente',function($query) use($sexo){
                        return $query->where("genero","<>",$sexo);
                    })->where('fecha','>=',$request->start)->where('fecha','<=',$request->end)->where('sus','<>',$request->tipo)->where('hemo_id',$request->hemo)->get();
                }*/
    }
    public function index2()
    {
      return view('reportes.reportes2');
    }
    public function index3()
    {

      return view('reportes.reportes3');
    }

}
