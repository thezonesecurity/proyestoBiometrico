<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\servicios\Servicio;
use App\Models\areas\Area;

use App\Models\personal\Persona;
use App\Models\rolturno\Rolturno;
use App\Models\rolturno\PersonaRolturno;
use App\Models\tipo_turnos\TipoTurno;
use PDF;
use DB;
use Carbon\Carbon;

//return back()->with('status', 'el mensaje es esto');

class RolturnoController extends Controller
{
    public function index()//Request $request
    {
       //return $request;
        $servicios = Servicio::where( 'estado', 'Habilitado')->pluck('nombre', 'id');
        $personas = Persona::where('estado_per', 'Habilitado')->pluck('nombres', 'id'); 
        $turnos = TipoTurno::where('estado', 'Habilitado')->pluck('nombre', 'id');
        $nombreServicio = auth()->user()->servicioUsers[0]->nombre;
        return view('rolturnos.Rolturno')->with(compact('servicios', 'personas', 'turnos', 'nombreServicio'));
    }

    //funcion para saber k areas pertecencen a cada servicio
    public function getAreasTest()
    {
        $servicio= Servicio::where('nombre', request()->input('servicio_id'))->get(); 
        $data = $servicio[0]->id;
        //dd($data);
        $areas = Area::where('servicio_id', $servicio[0]->id)->where( 'estado', 'Habilitado')->pluck('nombre', 'id');
       /* $areas = Area::when(request()->input('servicio_id'), function($query){
            $query->where('servicio_id', request()->input('servicio_id'))->where( 'estado', 'Habilitado');
        })->pluck('nombre', 'id');*/
        return response()->json($areas);

    }
    public function getAreas()
    {
        $servicio= Servicio::where('nombre', request()->input('nombreServicio'))->get(); 
        //return response()->json($servicio[0]->id);
        $areas = Area::where('servicio_id', $servicio[0]->id)->where('estado', 'Habilitado')->pluck('nombre', 'id');
       /* $areas = Area::when(request()->input('servicio_id'), function($query){
            $query->where('servicio_id', request()->input('servicio_id'))->where( 'estado', 'Habilitado');
        })->pluck('nombre', 'id');*/
        return response()->json($areas);
    }

    public function store(Request $request)
    { 
        //return $request;
        $servicio= Servicio::where('nombre',$request->servicio )->first(); 
        if(isset($servicio)){
            if($request->m){
                $rolturno = new Rolturno;
                $rolturno->gestion = $request->gestion;
                $rolturno->user_id = auth()->user()->id;
                $rolturno->servicio_id = $servicio->id; //$request->servicio;
                $rolturno->estado = 'Temporal';
                $rolturno->save();
                $pos=0;
                foreach ($request->m as $rolturno_id) {
                    $per_rolturno = new PersonaRolturno;
                   //$request->l[$pos];
                        $per_rolturno->fecha_inicio = $request->f_ini[$pos];
                        $per_rolturno->fecha_fin = $request->f_fin[$pos]; //
                        $per_rolturno->hora_inicio = $request->h_ini[$pos];
                        $per_rolturno->hora_fin = $request->h_fin[$pos];
                        $per_rolturno->tipo_dia = $request->tdia[$pos];
                        $per_rolturno->turno_id = $request->t[$pos];
                        $per_rolturno->obs = $request->obs[$pos];
                        $per_rolturno->cambio_turno = 'F';
                        $per_rolturno->estado = 'Habilitado';
                        $per_rolturno->user_id = auth()->user()->id;
                        $per_rolturno->area_id = $request->area_per[$pos];
                        $per_rolturno->persona_id = $request->m[$pos];;
                        $per_rolturno->rolturno_id = $rolturno->id;
                        //dd($per_rolturno);
                       $per_rolturno->save();
                        $pos++;
                    }
                    return 'ok';
               }
               else {return 'error';}
        }else{ return 'error'; }
    }
    
    public function storetest(Request $request)
    {
       //return $request;
       $nom_servi = Servicio::where('nombre', $request->servicioM)->pluck('id');
       if(isset($nom_servi)) {
            $existe_rolturno = Rolturno::where('servicio_id', $nom_servi[0])->where('gestion', $request->gestionM)->first();
            //dd($existe_rolturno);
            $pos=0;
            if(isset($existe_rolturno) && $existe_rolturno->gestion == $request->gestionM){ //isset($existe_rolturno)){
                $existe_rolturno->user_id = auth()->user()->id;
                // $existe_rolturno->gestion = $request->gestionM;
                // $existe_rolturno->servicio_id = $request->servicio; //$request->servicio; //;
                $existe_rolturno->estado = 'Temporal';
                $existe_rolturno->save();
                
                foreach ($request->m as $rolturno_id) {
                // $nom_servi = $request->servi[$pos];
                    $per_rolturno = new PersonaRolturno;
                    //$request->l[$pos];
                        $per_rolturno->fecha_inicio = $request->f_ini[$pos];
                        $per_rolturno->fecha_fin = $request->f_fin[$pos]; //
                        $per_rolturno->hora_inicio = $request->h_ini[$pos];
                        $per_rolturno->hora_fin = $request->h_fin[$pos];
                        $per_rolturno->tipo_dia = $request->tdia[$pos];
                        $per_rolturno->turno_id = $request->t[$pos];
                        $per_rolturno->cambio_turno = $request->cambio_turno[$pos];
                        $per_rolturno->obs = $request->obs[$pos];
                        $per_rolturno->estado = 'Habilitado';
                        $per_rolturno->user_id = auth()->user()->id;
                        $per_rolturno->area_id = $request->area_per[$pos];
                        $per_rolturno->persona_id = $request->m[$pos];;
                        $per_rolturno->rolturno_id = $existe_rolturno->id;
                        //dd($per_rolturno);
                        $per_rolturno->save();
                        $pos++;
                    }  
                return 'ok';
            }
            else { return 'error'; }
        } else { return 'error'; }
    }

    public function lista()
    {
       // dd(auth()->user()->id);
       //$nombreServicio = auth()->user()->servicioUsers[0]->nombre;
        $id_servicio = auth()->user()->servicioUsers[0]->id;
        $rolturnos = Rolturno::orderBy('id')->where('servicio_id', $id_servicio)->get();
        return view('rolturnos.ListarRolturnos')->with(compact('rolturnos'));
    }
      
    public function print($id)
    {
        $data = PersonaRolturno::orderBy('fecha_inicio')->where('rolturno_id',$id)->get();
        $extras = [ 'servicio' => $data[0]->per_rolturno->servicios->nombre, 'gestion' => $data[0]->per_rolturno->gestion ];
        $personas = [];
        $vacaciones = [];
        // Agrupar por área y fecha de inicio
        foreach ($data as $row) {
            $area = $row->area_id;
            $fecha = $row->fecha_inicio;

            if (!isset($personas[$area][$fecha])) {
                $personas[$area][$fecha] = [];
            }
            // Verificar si es una persona en vacaciones
            if ($row->fecha_inicio !== null && $row->fecha_fin != $row->fecha_inicio && $row->fecha_fin !== null) {
                $vacaciones[] = [
                    'fecha_inicio' => $row->fecha_inicio,
                    'fecha_fin' => $row->fecha_fin,
                    'nombre_persona' => $row->rolturno_per->nombres,
                    'ci' => $row->rolturno_per->ci,
                    'turno' => $row->tipoTurno->nombre,
                    'tipo_dia' => $row->tipo_dia,
                    'hora_inicio' => $row->hora_inicio,
                    'hora_fin' => $row->hora_fin,
                    'observaciones' => $row->obs,
                ];
            } else {
                // Agrupar personas por fecha y área
                $personas[$area][$fecha][] = [
                    'fecha_fin' => $row->fecha_fin,
                    'nombre_persona' => $row->rolturno_per->nombres,
                    'ci' => $row->rolturno_per->ci,
                    'turno' => $row->tipoTurno->nombre,
                    'tipo_dia' => $row->tipo_dia,
                    'hora_inicio' => $row->hora_inicio,
                    'hora_fin' => $row->hora_fin,
                    'observaciones' => $row->obs,
                ];
            }
        }
        //return view('rolturnos.ImprimirRolturnos', compact('personas', 'vacaciones', 'extras'));
        $pdf = PDF::loadView('rolturnos.ImprimirRolturnos', compact('personas', 'vacaciones', 'extras'))->setPaper('legal', 'landscape');
        return $pdf->stream('prueba.pdf');
    }
    public function tabla()
    {
        // para imprimir pdf formato de rol de turnos 
       // $per_rolturnos=PersonaRolturno::orderBy('id')->get();
        //return view('rolturnos.tablas')->with(compact('per_rolturnos')); 
        $rolTurnos=PersonaRolturno::orderBy('id')->get();
        $mesActual = Carbon::now()->format('m-Y'); //Obtiene el mes y año actual
        $mesDias = Carbon::now()->daysInMonth; //Obtiene la cantidad de días del mes actual
    
        //Crea un arreglo con los días del mes actual
        $diasMes = [];
        for ($i = 1; $i <= $mesDias; $i++) {
            $diasMes[] = $i;
        }
    
        //Crea un arreglo con las fechas del mes actual
        $fechasMes = [];
        for ($i = 1; $i <= $mesDias; $i++) {
            $fecha = Carbon::createFromDate(Carbon::now()->year, Carbon::now()->month, $i);
            $fechasMes[] = $fecha->format('Y-m-d');
        }
      
        return view('rolturnos.tablas', compact('rolTurnos', 'mesActual', 'diasMes', 'fechasMes'));      
    }
    
    public function gettest($id)
    {
       // $per = Persona::where('id_servicio', 4)->pluck('nombres', 'id')->dd();
        //$servicios = Servicio::all();
       // $personas = Persona::all(); 
       $turnos = TipoTurno::where('estado', 'Habilitado')->pluck('nombre', 'id');
       $areas = Area::where('estado', 'Habilitado')->pluck('nombre', 'id');
       $per_rolturnos=PersonaRolturno::orderBy('id')->where('rolturno_id',$id)->get();
       // $per_rolturnos=PersonaRolturno::orderBy('id')->get(); //ASI SE ORDENA POR SU ID
        return view('rolturnos.editarRolturnosTest')->with(compact('per_rolturnos', 'turnos', 'areas'));

    }
    public function getPersons()
    {
        $servicio= Servicio::where('nombre', request()->input('servicio'))->get(); 
        $personas = Persona::where('id_servicio', $servicio[0]->id)->where( 'estado_per', 'Habilitado')->pluck('nombres', 'id');
        return response()->json($personas);
    }
    public function controlGestion(Request $request)
    {
        //EN CASO DE SERVICIOS K TENGAN SUB-SERVICIOS SE TOMARA EN CUENTA EL AREA   para este control
       $servicio= Servicio::where('nombre', request()->input('datos1'))->get();
        $rolturno = Rolturno::where('servicio_id', $servicio[0]->id)->where('gestion', $request->datos2)->first();
        if(isset($rolturno) && $rolturno->gestion == $request->datos2) return 'existe';
        else return 'no existe';//$rolturno; //
    }

    public function actualizar(Request $request)
    {
        //dd($request);
        $validatedData = $request->validate([
            'id' => 'required',//
            'persona' => 'required',//
            'servicio' => 'required',//
            'area' => 'required',//-
            'gestion' => 'required',//
            'tipod' => 'required',//
            'turno' => 'required',
            'turnoMo' => 'required_if:$request->turnoMo != null, "" ',
            'fecha_inicio' => 'required',
            'fecha_fin' => 'required_if:$request->tipod == "V", "" ',
            'hora_inicio' => 'required_if:$request->tipod == "DL", "" ',
            'hora_fin' => 'required_if:$request->tipod == "DL", "" ',
            //'comentario' => ['regex:/^[a-zA-Zñ0-9 ]{5,150}$/']
        ]);
        $per_rolturno = PersonaRolturno::findOrFail($validatedData['id']);
        $per_rolturno->fecha_inicio = $validatedData['fecha_inicio'];
        if($validatedData['turnoMo'] != null ){ $per_rolturno->turno_id = $validatedData['turnoMo']; }
        
        if($validatedData['tipod'] == 'DL'){
            $per_rolturno->hora_inicio = $validatedData['hora_inicio'];
            $per_rolturno->hora_fin = $validatedData['hora_fin']; 
            if($request->cambioT == null) { $per_rolturno->cambio_turno = 'F'; }
            else {$per_rolturno->cambio_turno = 'V'; }
        }else {
            $per_rolturno->fecha_fin = $validatedData['fecha_fin'];
        }
        $per_rolturno->user_id = auth()->user()->id;
        $per_rolturno->obs = $request->comentario;// $validatedData['comentario'];
        $per_rolturno->save();
        return back()->with('success', 'El rolturno se actualizo correctamente');
    }

    public function destroy(Request $request)
    {
        //dd($request);
        if(isset($request)){
            $id = $request->id;
            $per_rolturno = PersonaRolturno::findOrFail($id);
            $id_rol = $per_rolturno->rolturno_id;
            $count = PersonaRolturno::where('rolturno_id', $id_rol)->count();
            if($count > '1'){
                $per_rolturno->delete();
                return back()->with('success', 'El rolturno se elimino correctamente');
            }
            else{ return back()->with('error', 'Error en la eliminacion , No se puede dejar sin elementos esta lista'); }
        }else abort(404);
    }
    public function send(Request $request)
    {
        if(isset($request)){
            $id = $request->id;
            //dd($id);
            $rolturno = Rolturno::findOrFail($id);
            $rolturno->estado = 'Pendiente';
            //$rolturno->user_id = auth()->user()->id;
            $rolturno->save();
            return back();//->with('success', 'Se envio exitosamente el rolturno');
        }else {
            return back();//->with('error', 'Error al enviar rolturno, concacte con soporte!!');
        }
    }
}
    /*
    CONSULTAS
    index
    // $personas = Persona::lists('nombres', 'id');
       // return view('rolturnos.Rolturno', compact('personas'));
      // $servicios = Servicios::lists('nombres', 'id');s
      //$personas = DB::table('personas')->orderBy('id');
        //dd($personas);
         //$per_rolturno=PersonaRolturno::find(12);
        //dd($per_rolturno->area->nombre);//llega
    lista
     $per_rolturno=PersonaRolturno::find(10);
       // dd($per_rolturno->rolturno_per->ci);//persona->ci
      // dd($per_rolturno->per_rolturno->servicios->nombre);//servicios->nombre
        //dd($per_rolturno->per_rolturno->servicios->areas->nombre);//NO LLEGA

         $rolturno=Rolturno::find(6);
         
        // dd($rolturno->user->per_user->nombres);//usuario->persona->nombres

        
       // $datas = Rolturno::with(['personas'])->get();  
       // dd($datas);
       // $servicios = Servicio::find(4)->area;
      // dd($servicios);




    public function antiguostore(Request $request)
    { 
                //$persona=Persona::where('idper_db',$request->id)->first(); 
       // $persona->area= $request->area;

        //$persona->save();
       // dd($persona);
       
        //return 'ok';
        //$array = explode(",", $request->personal);//convertiendo string a arrar(personal[nombrecompleto,idper_db])
        //dd('nombre '.$array[0].' id es '.$array[1]);
        //$servicio = new Servicio;
        //$nombreservicio = ucwords($request->nombre);
        //dd($nombreservicio);
        $id_per = explode(",", $request->personal);
        $rolturno = new Rolturno;
        $rolturno->tipo_dia = 'L';
        $rolturno->cargo = $request->cargo;
        $rolturno->turno = $request->turno;
        $rolturno->obs = $request->comentario;
        //$rolturno->save();
        $persona_rolturno = new PersonaRolturno;
        if($request->laboral == "on"){
            $persona_rolturno->fecha_inicio = $request->fecha_inicio;
            $persona_rolturno->fecha_fin = '';
            $persona_rolturno->hora_inicio = $request->hora_inicio;
            $persona_rolturno->hora_fin = $request->hora_fin;
            $persona_rolturno->id_persona = $request->$id_per[1];
            $persona_rolturno->id_rolturno = ''; //?????
            //$persona_rolturno->save();
        }
         if($request->descanso == "on"){
            $persona_rolturno->fecha_inicio = $request->fecha_inicio;
            $persona_rolturno->fecha_fin = $request->fecha_fin;
            $persona_rolturno->hora_inicio = '';
            $persona_rolturno->hora_fin = '';
            $persona_rolturno->id_persona = $request->$id_per[1];
            $persona_rolturno->id_rolturno = ''; //?????
            //$persona_rolturno->save();
        }

         
    }
*/
    /*
            $persona_rolturno = new PersonaRolturno();
            if($request->laboral == "DL"){
                $persona_rolturno->fecha_inicio = $request->fecha_inicio;
                $persona_rolturno->fecha_fin = '';
                $persona_rolturno->hora_inicio = $request->hora_inicio;
                $persona_rolturno->hora_fin = $request->hora_fin;
                $persona_rolturno->tipo_dia = $request->tipod;
                $persona_rolturno->turno = $request->turno;
                $persona_rolturno->id_persona = $request->$id_per[1];
                $persona_rolturno->id_rolturno = ''; //?????
                $persona_rolturno->save();
            }
            else if($request->descanso == "V"){
                $persona_rolturno->fecha_inicio = $request->fecha_inicio;
                $persona_rolturno->fecha_fin = $request->fecha_fin;
                $persona_rolturno->hora_inicio = '';
                $persona_rolturno->hora_fin = '';
                $persona_rolturno->tipo_dia = $request->tipod;
                $persona_rolturno->turno = '';
                $persona_rolturno->id_persona = $request->$id_per[1];
                $persona_rolturno->id_rolturno = ''; //?????
                $persona_rolturno->save();
            }*/

            /*relacion de  1 a N
              public function store(Request $request)
                {
                    return $request;

                    //$persona=Persona::where('idper_db',$request->id)->first(); 
                // $persona->area= $request->area;

                    //$persona->save();
                // dd($persona);
                    //$rolturno = new Rolturno;
                // $rolturno->obs = $request->comentario;
                    //$rolturno->estado = 'inactivo';
                // $rolturno->save();
            
                // return 'ok';
                    $pos=0;
                    foreach ($request->m as $rolturno_id) {
                        $rolturno = new Rolturno;
                    //$request->l[$pos];
                        if($request->tdia[$pos] == "DL"){
                            $rolturno->fecha_inicio = $request->f_ini[$pos];
                            $rolturno->fecha_fin = null;
                            $rolturno->hora_inicio = $request->h_ini[$pos];
                            $rolturno->hora_fin = $request->h_fin[$pos];
                            $rolturno->tipo_dia = $request->tdia[$pos];
                            $rolturno->turno = $request->t[$pos];
                            $rolturno->area = $request->area[$pos];
                            $rolturno->obs = $request->obs[$pos];
                            $rolturno->estado = 'inactivo';
                            $rolturno->id_persona = $rolturno_id;
                            //dd($rolturno);
                            $rolturno->save();
                        }
                        else if($request->tdia[$pos] == "V"){
                            $rolturno->fecha_inicio = $request->f_ini[$pos];
                            $rolturno->fecha_fin = $request->f_fin[$pos];
                            $rolturno->hora_inicio = null;
                            $rolturno->hora_fin = null;
                            $rolturno->tipo_dia = $request->tdia[$pos];
                            $rolturno->turno = null;
                            $rolturno->area = null;
                            $rolturno->obs = $request->obs[$pos];
                            $rolturno->estado = 'inactivo';
                            $rolturno->id_persona = $rolturno_id;
                            //dd($rolturno);
                            $rolturno->save();
                        } else{
                            return 'error';
                        }
                        $pos++;
                    }
                    
                }
             */
    //*************************************************** */ FUNCION ESTORE BIEN
        /*
      // return $request;
        $pos=0;
        $rolturno = new Rolturno;
        $rolturno->user_id = auth()->user()->id;
        $rolturno->servicio_id = $request->servicio; //$request->servicio; //;
        $rolturno->estado = 'Temporal';
        $rolturno->save();
        foreach ($request->m as $rolturno_id) {

            $per_rolturno = new PersonaRolturno;
           //$request->l[$pos];
            if($request->tdia[$pos] == "DL"){
                $per_rolturno->fecha_inicio = $request->f_ini[$pos];
                $per_rolturno->fecha_fin = $request->f_fin[$pos]; //
                $per_rolturno->hora_inicio = $request->h_ini[$pos];
                $per_rolturno->hora_fin = $request->h_fin[$pos];
                $per_rolturno->tipo_dia = $request->tdia[$pos];
                $per_rolturno->turno = $request->t[$pos];
                $per_rolturno->obs = $request->obs[$pos];
                $per_rolturno->estado = 'Habilitado';
                $per_rolturno->user_id = auth()->user()->id;
                $per_rolturno->area_id = $request->area_per[$pos];
                $per_rolturno->persona_id = $request->m[$pos];;
                $per_rolturno->rolturno_id = $rolturno->id;
                //dd($per_rolturno);
                $per_rolturno->save();
            }
            else if($request->tdia[$pos] == "V"){
                $per_rolturno->fecha_inicio = $request->f_ini[$pos];
                $per_rolturno->fecha_fin = $request->f_fin[$pos]; //
                $per_rolturno->hora_inicio = $request->h_ini[$pos];
                $per_rolturno->hora_fin = $request->h_fin[$pos];
                $per_rolturno->tipo_dia = $request->tdia[$pos];
                $per_rolturno->turno = $request->t[$pos];
                $per_rolturno->obs = $request->obs[$pos];
                $per_rolturno->estado = 'Habilitado';
                $per_rolturno->user_id = auth()->user()->id;
                $per_rolturno->area_id = $request->area_per[$pos];
                $per_rolturno->persona_id = $request->m[$pos];;
                $per_rolturno->rolturno_id = $rolturno->id;
                //dd($per_rolturno);
                $per_rolturno->save();
            }
            $pos++;
        } 
        return 'ok';*/

    //**************************************************** FUNCION ESTORE TEST
    /*
     // return $request;

        //$persona=Persona::where('idper_db',$request->id)->first(); 
       // $persona->area= $request->area;

        //$persona->save();
       // dd($persona);
        

       $pos=0;
       $rolturno = new Rolturno;
       $rolturno->user_id = auth()->user()->id;
       $rolturno->servicio_id = $request->servicio; //$request->servicio; //;
       $rolturno->estado = 'Temporal';
       $rolturno->save();
       foreach ($request->m as $rolturno_id) {

           $per_rolturno = new PersonaRolturno;
          //$request->l[$pos];
           if($request->tdia[$pos] == "DL"){
               $per_rolturno->fecha_inicio = $request->f_ini[$pos];
               $per_rolturno->fecha_fin = $request->f_fin[$pos]; //
               $per_rolturno->hora_inicio = $request->h_ini[$pos];
               $per_rolturno->hora_fin = $request->h_fin[$pos];
               $per_rolturno->tipo_dia = $request->tdia[$pos];
               $per_rolturno->turno = $request->t[$pos];
               $per_rolturno->area_id = $request->area_per[$pos];
               $per_rolturno->obs = $request->obs[$pos];
               $per_rolturno->persona_id = $request->m[$pos];;
               $per_rolturno->rolturno_id = $rolturno->id;
               //dd($per_rolturno);
               $per_rolturno->save();
           }
           else if($request->tdia[$pos] == "V"){
               $per_rolturno->fecha_inicio = $request->f_ini[$pos];
               $per_rolturno->fecha_fin = $request->f_fin[$pos];
               $per_rolturno->hora_inicio = $request->h_ini[$pos]; //
               $per_rolturno->hora_fin =  $request->h_fin[$pos]; //
               $per_rolturno->tipo_dia = $request->tdia[$pos];
               $per_rolturno->turno = $request->t[$pos]; //
               $per_rolturno->area_id = $request->area_per[$pos]; //
               $per_rolturno->obs = $request->obs[$pos];
               $per_rolturno->persona_id = $request->m[$pos];;
               $per_rolturno->rolturno_id = $rolturno->id;
               //dd($per_rolturno);
               $per_rolturno->save();
           } else{
               return 'error';
           }
           $pos++;
       }     
       return 'ok';
       */
      //-------------------------------------------------FUNCION ESTORE BIEN-------------------------- 
       /*$existe_rolturno = Rolturno::where('servicio_id', $request->servicio)->first();
       $pos=0;
        if(isset($existe_rolturno) && $existe_rolturno->gestion == $request->gestion){// GUARDANDO EL MISMO ROL TURNO --NUNCA ENTRA
           // $existe_rolturno->gestion = $request->gestion;
            $existe_rolturno->user_id = auth()->user()->id;
           // $existe_rolturno->servicio_id = $request->servicio; //$request->servicio; //;
            $existe_rolturno->estado = 'Temporal';
            $existe_rolturno->save();
            foreach ($request->m as $rolturno_id) {
                $per_rolturno = new PersonaRolturno;
               //$request->l[$pos];
                    $per_rolturno->fecha_inicio = $request->f_ini[$pos];
                    $per_rolturno->fecha_fin = $request->f_fin[$pos]; //
                    $per_rolturno->hora_inicio = $request->h_ini[$pos];
                    $per_rolturno->hora_fin = $request->h_fin[$pos];
                    $per_rolturno->tipo_dia = $request->tdia[$pos];
                    $per_rolturno->turno = $request->t[$pos];
                    $per_rolturno->obs = $request->obs[$pos];
                    $per_rolturno->estado = 'Habilitado';
                    $per_rolturno->user_id = auth()->user()->id;
                    $per_rolturno->area_id = $request->area_per[$pos];
                    $per_rolturno->persona_id = $request->m[$pos];;
                    $per_rolturno->rolturno_id = $existe_rolturno->id;
                    //dd($per_rolturno);
                    $per_rolturno->save();
                    $pos++;
                }  
                return 'ok';
        }
        else { //if(!isset($existe_rolturno) || $existe_rolturno->gestion != $request->gestion){ //!isset($existe_rolturno)){
            $rolturno = new Rolturno;
            $rolturno->gestion = $request->gestion;
            $rolturno->user_id = auth()->user()->id;
            $rolturno->servicio_id = $request->servicio; //$request->servicio; //;
            $rolturno->estado = 'Temporal';
            $rolturno->save();
            foreach ($request->m as $rolturno_id) {
                $per_rolturno = new PersonaRolturno;
               //$request->l[$pos];
                    $per_rolturno->fecha_inicio = $request->f_ini[$pos];
                    $per_rolturno->fecha_fin = $request->f_fin[$pos]; //
                    $per_rolturno->hora_inicio = $request->h_ini[$pos];
                    $per_rolturno->hora_fin = $request->h_fin[$pos];
                    $per_rolturno->tipo_dia = $request->tdia[$pos];
                    $per_rolturno->turno = $request->t[$pos];
                    $per_rolturno->obs = $request->obs[$pos];
                    $per_rolturno->estado = 'Habilitado';
                    $per_rolturno->user_id = auth()->user()->id;
                    $per_rolturno->area_id = $request->area_per[$pos];
                    $per_rolturno->persona_id = $request->m[$pos];;
                    $per_rolturno->rolturno_id = $rolturno->id;
                    //dd($per_rolturno);
                    $per_rolturno->save();
                    $pos++;
                }
                return 'ok';
        }*/
        //else return 'error';
    /*---------------------------------store test ultim-------------------
      //return $request;
      $nom_servi = Servicio::where('nombre', $request->servicioM)->pluck('id');
      // $data = $nom_servi->all();
       //dd($nom_servi[0]);
     
        $existe_rolturno = Rolturno::where('servicio_id', $nom_servi[0])->where('gestion', $request->gestionM)->first();
        //dd($existe_rolturno);
    // return $existe_rolturno->gestion;
        $pos=0;
         if(isset($existe_rolturno) && $existe_rolturno->gestion == $request->gestionM){ //isset($existe_rolturno)){
             $existe_rolturno->user_id = auth()->user()->id;
            // $existe_rolturno->gestion = $request->gestionM;
            // $existe_rolturno->servicio_id = $request->servicio; //$request->servicio; //;
             $existe_rolturno->estado = 'Temporal';
             $existe_rolturno->save();
            
             foreach ($request->m as $rolturno_id) {
               // $nom_servi = $request->servi[$pos];
                 $per_rolturno = new PersonaRolturno;
                //$request->l[$pos];
                     $per_rolturno->fecha_inicio = $request->f_ini[$pos];
                     $per_rolturno->fecha_fin = $request->f_fin[$pos]; //
                     $per_rolturno->hora_inicio = $request->h_ini[$pos];
                     $per_rolturno->hora_fin = $request->h_fin[$pos];
                     $per_rolturno->tipo_dia = $request->tdia[$pos];
                     $per_rolturno->turno_id = $request->t[$pos];
                     $per_rolturno->cambio_turno = $request->cambio_turno[$pos];
                     $per_rolturno->obs = $request->obs[$pos];
                     $per_rolturno->estado = 'Habilitado';
                     $per_rolturno->user_id = auth()->user()->id;
                     $per_rolturno->area_id = $request->area_per[$pos];
                     $per_rolturno->persona_id = $request->m[$pos];;
                     $per_rolturno->rolturno_id = $existe_rolturno->id;
                     //dd($per_rolturno);
                     $per_rolturno->save();
                     $pos++;
                 }  
            return 'ok';
         }
         else{ return 'error'; }
         /*
         if(!isset($existe_rolturno)){
             $rolturno = new Rolturno;
             $rolturno->user_id = auth()->user()->id;
             $rolturno->servicio_id = $request->servicio; //$request->servicio; //;
             $rolturno->estado = 'Temporal';
             $rolturno->save();
             foreach ($request->m as $rolturno_id) {
     
                 $per_rolturno = new PersonaRolturno;
                //$request->l[$pos];
 
                     $per_rolturno->fecha_inicio = $request->f_ini[$pos];
                     $per_rolturno->fecha_fin = $request->f_fin[$pos]; //
                     $per_rolturno->hora_inicio = $request->h_ini[$pos];
                     $per_rolturno->hora_fin = $request->h_fin[$pos];
                     $per_rolturno->tipo_dia = $request->tdia[$pos];
                     $per_rolturno->turno = $request->t[$pos];
                     $per_rolturno->obs = $request->obs[$pos];
                     $per_rolturno->estado = 'Habilitado';
                     $per_rolturno->user_id = auth()->user()->id;
                     $per_rolturno->area_id = $request->area_per[$pos];
                     $per_rolturno->persona_id = $request->m[$pos];;
                     $per_rolturno->rolturno_id = $rolturno->id;
                     //dd($per_rolturno);
                     $per_rolturno->save();
                     $pos++;
                 }
                 return 'ok';
 
         }
         else return 'error';*/
         /*
 --------------------------------------estore ultimo-----------------------
-----------------  actualizar bien-------------------
if(isset($request)){
            $id = $request->id;
            $per_rolturno = PersonaRolturno::find($id);
            $per_rolturno->fecha_inicio = $request->fecha_inicio;
            $per_rolturno->fecha_fin = $request->fecha_fin;
            $per_rolturno->hora_inicio = $request->hora_inicio;
            $per_rolturno->hora_fin = $request->hora_fin;
            //$per_rolturno->tipo_dia = $request->tipod;
            if(isset($request->turnoMo)){ $per_rolturno->turno_id = $request->turnoMo;}
            if($request->cambioT == null) { $per_rolturno->cambio_turno = 'F'; }
            else {$per_rolturno->cambio_turno = 'V'; }
            //$per_rolturno->area_id = $request->area;//??????
            $per_rolturno->obs = $request->comentario;
            $per_rolturno->user_id = auth()->user()->id;
            //$per_rolturno->persona_id = $request->m[$pos];;
            //$per_rolturno->rolturno_id = $rolturno->id;
            //dd($per_rolturno);
           // $per_rolturno->save();
            return back()->with('success', 'El rolturno se actualizo correctamente');
        }
        return back()->with('error', 'Error al actualizar el rolturno');
 */

