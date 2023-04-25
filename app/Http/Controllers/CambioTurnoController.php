<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\servicios\Servicio;
use App\Models\areaservicio\AreaServicio;

use App\Models\personal\Persona;
use App\Models\rolturno\Rolturno;
use App\Models\rolturno\PersonaRolturno;
use App\Models\cambioturno\CambioTurno;
use DB;
use PDF;

class CambioTurnoController extends Controller
{

    public function index()
    {
        $cambio_turnos=CambioTurno::orderBy('id')->get();
        // $per_rolturnos=PersonaRolturno::orderBy('id')->get(); //ASI SE ORDENA POR SU ID
        $servicios = Servicio::where( 'estado', 'Habilitado')->pluck('nombre', 'id');
        //$personas = Persona::all(); 
       // $personas = Persona::where( 'estado_per', 'Habilitado')->pluck('nombres', 'id'); 
       // $per_rolturnos=PersonaRolturno::where('rolturno_id',$id)->get();
        return view('cambioTurno.listarCambioTurno')->with(compact('cambio_turnos', 'servicios'));
    }

    public function getGestion(Request $request)
    {
        if($request->ajax()){
            $rolturno = Rolturno::where('servicio_id', $request->datos1)->where('gestion', $request->datos2)->first();
           // return $rolturno;
            if(isset($rolturno) && $rolturno->gestion == $request->datos2) {
                if($rolturno->estado != 'Aceptado') return 'no aceptado';
                return 'acepatdo';
            }
            else return 'no existe';//$rolturno; //
        }else abort(404);
    }

    public function getPersonas(Request $request)
    {
        if($request->ajax()){
           // $servicio= Servicio::where('nombre', request()->input('servicio'))->get();  // $servicio[0]->id
            $personas = Persona::where('id_servicio', request()->input('servicio'))->where( 'estado_per', 'Habilitado')->pluck('nombres', 'id');
            return response()->json($personas);
        }else abort(404);
    }

    public function PersonaControl(Request $request)
    {
        if($request->ajax()){
            $rolturno = PersonaRolturno::where('persona_id', $request->per1)->where('fecha_inicio', $request->fecha)->first();
            if(isset($rolturno) && $rolturno->fecha_inicio == $request->fecha) return 'existe';
            else return 'no existe';//$rolturno; //
        }else abort(404);
    }

    public function store(Request $request)
    {
       //dd($request);
       $per_rolturnos = PersonaRolturno::where('persona_id', $request->persona1)->where('fecha_inicio', $request->fecha)->first();
       $per_rolturnos->persona_id = $request->persona2;
       //dd($per_rolturnos);
       $cambio_turno = new CambioTurno;
       $cambio_turno->per_saliente = $request->persona1;
       $cambio_turno->per_reemplazo = $request->persona2;
       $cambio_turno->fecha = $request->fecha;
       $cambio_turno->obs = $request->comentario;
       $cambio_turno->estado = 'Habilitado';
       $cambio_turno->user_id = auth()->user()->id;
       $cambio_turno->servicio_id = $request->servicio;
       $cambio_turno->per_rolturno_id = $per_rolturnos->id; ////???????
       $per_rolturnos->save();
       $cambio_turno->save();
       return  back(); //redirect(route('listar.cambio_turno'));
    }

    public function show($id)
    {
        //
        
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function delete(Request $request)
    {
        //

        dd($request);
    }
}
