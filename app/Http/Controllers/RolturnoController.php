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

class RolturnoController extends Controller
{
    public function index()//Request $request
    {
       //return $request;
       // $servicios = Servicio::all();
        $servicios = Servicio::where( 'estado', 'Habilitado')->pluck('nombre', 'id');
        //$personas = Persona::all(); 
        $personas = Persona::where('estado_per', 'Habilitado')->pluck('nombres', 'id'); 
        $turnos = TipoTurno::where('estado', 'Habilitado')->pluck('nombre', 'id');
       // $per_rolturnos=PersonaRolturno::where('rolturno_id',$id)->get();
        
        return view('rolturnos.Rolturno')->with(compact('servicios', 'personas', 'turnos'));
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
        $areas = Area::when(request()->input('servicio_id'), function($query){
            $query->where('servicio_id', request()->input('servicio_id'))->where( 'estado', 'Habilitado');
        })->pluck('nombre', 'id');
        return response()->json($areas);
    }

    public function store(Request $request)
    { 
       // return $request;
       if($request->m){
        $rolturno = new Rolturno;
        $rolturno->gestion = $request->gestion;
        $rolturno->user_id = auth()->user()->id;
        $rolturno->servicio_id = $request->servicio; //$request->servicio; //;
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
       else return 'error';
    }
    
    public function storetest(Request $request)
    {
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
    }

    public function lista()
    {
       // dd(auth()->user()->id);
        $rolturnos = Rolturno::orderBy('id')->get();
        return view('rolturnos.ListarRolturnos')->with(compact('rolturnos'));
    }
    
    public function print($id)//para pdf
    {
         $per_rolturnos=PersonaRolturno::where('rolturno_id',$id)->get();
      //  return view('rolturnos.ImprimirRolturnos')->with(compact('per_rolturnos'));
       $pdf = PDF::loadView('rolturnos.ImprimirRolturnos', compact('per_rolturnos'))->setPaper('legal', 'landscape');
       return $pdf->stream('prueba.pdf');
    }
    
    public function tabla()
    {
        // para imprimir pdf formato de rol de turnos 
        return view('rolturnos.tablas');
    }
    
    public function edit($id)//--
    {
        //
        //$servicios = Servicio::all();
       // $personas = Persona::all(); 
       // $per_rolturnos=PersonaRolturno::where('rolturno_id',$id)->get();
       // return view('rolturnos.editarRolturnos')->with(compact('per_rolturnos'));

    }
    public function gettest($id)
    {
       // $per = Persona::where('id_servicio', 4)->pluck('nombres', 'id')->dd();
        //$servicios = Servicio::all();
       // $personas = Persona::all(); 
       $turnos = TipoTurno::where('estado', 'Habilitado')->pluck('nombre', 'id');
       $per_rolturnos=PersonaRolturno::orderBy('id')->where('rolturno_id',$id)->get();
       // $per_rolturnos=PersonaRolturno::orderBy('id')->get(); //ASI SE ORDENA POR SU ID
        return view('rolturnos.editarRolturnosTest')->with(compact('per_rolturnos', 'turnos'));

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
       //return $request->datos2;
        $rolturno = Rolturno::where('servicio_id', $request->datos1)->where('gestion', $request->datos2)->first();
        //return $rolturno->gestion;
        if(isset($rolturno) && $rolturno->gestion == $request->datos2) return 'existe';
        else return 'no existe';//$rolturno; //
    }

    public function actualizar(Request $request)
    {
      // dd($request);
        $id = $request->id;
        $per_rolturno = PersonaRolturno::find($id);
        $per_rolturno->fecha_inicio = $request->fecha_inicio;
        $per_rolturno->fecha_fin = $request->fecha_fin;
        $per_rolturno->hora_inicio = $request->hora_inicio;
        $per_rolturno->hora_fin = $request->hora_fin;
        //$per_rolturno->tipo_dia = $request->tipod;
        $per_rolturno->turno = $request->turno;
        //$per_rolturno->area_id = $request->area;//??????
        $per_rolturno->obs = $request->comentario;
        $per_rolturno->user_id = auth()->user()->id;
        //$per_rolturno->persona_id = $request->m[$pos];;
        //$per_rolturno->rolturno_id = $rolturno->id;
        //dd($per_rolturno);
        $per_rolturno->save();
        return back();
    }

    public function destroy($id)
    {
        //dd($id);
        $per_rolturno = PersonaRolturno::find($id);
        //$per_rolturno->estado = 'Eliminado';
        $per_rolturno->delete();
        return back();

/*
        $id_rol = $per_rolturno->rolturno_id;
        $count = PersonaRolturno::where('rolturno_id', $id_rol)->where('gestion'->$request->gestion)->count();
        dd($count);
        if($cont > '1'){
            $per_rolturno->delete();
            return back();
        }
        return back('error no se puede eliminar el ultimo dato');*/
    }
    public function send(Request $request)
    {
        $id = $request->id;
        //dd($id);
        $rolturno = Rolturno::find($id);
        $rolturno->estado = 'Pendiente';
       // dd($rolturno);
        $rolturno->save();
        return back();
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
}
