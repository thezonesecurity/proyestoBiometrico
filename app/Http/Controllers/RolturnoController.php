<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\servicios\Servicio;
use App\Models\areaservicio\AreaServicio;

use App\Models\personal\Persona;
use App\Models\rolturno\Rolturno;
use App\Models\rolturno\PersonaRolturno;
use DB;
use PDF;

class RolturnoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       // $personas = Persona::lists('nombres', 'id');
       // return view('rolturnos.Rolturno', compact('personas'));
      // $servicios = Servicios::lists('nombres', 'id');s

        $servicios = Servicio::all();
        $personas = Persona::all(); 
        //$personas = DB::table('personas')->orderBy('id');
        //dd($personas);
        return view('rolturnos.Rolturno')->with(compact('servicios', 'personas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    //funcion para saber k areas pertecencen a cada servicio
    public function getAreas()
    {
        $areas = AreaServicio::when(request()->input('servicio_id'), function($query){
            $query->where('servicio_id', request()->input('servicio_id'));
        })->pluck('nombre', 'id', 'estado');
        return response()->json($areas);

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      // return $request;

        //$persona=Persona::where('idper_db',$request->id)->first(); 
       // $persona->area= $request->area;

        //$persona->save();
       // dd($persona);
        

        $pos=0;
        $rolturno = new Rolturno;
        $rolturno->user_id = '28';
        $rolturno->servicio_id = $request->servicio; //$request->servicio; //;
        $rolturno->estado = 'inactivo';
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
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function lista()
    {
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
        $rolturnos = Rolturno::all();
        return view('rolturnos.ListarRolturnos')->with(compact('rolturnos'));
    }

    public function print($id)
    {
        //para pdf
       
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
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $servicios = Servicio::all();
        $personas = Persona::all(); 
        $per_rolturnos=PersonaRolturno::where('rolturno_id',$id)->get();
        return view('rolturnos.editarRolturnos')->with(compact('per_rolturnos','servicios', 'personas'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //dd($id);
        $rolturno = Rolturno::find($id);
        //$rolturno-> delete();
        return redirect(route('listar.roles.turno'));
    }
    /*
    public function antiguostore(Request $request)
    {
       
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
    
}
