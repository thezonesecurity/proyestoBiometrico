<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\personal\Persona;
use App\Models\rolturno\Rolturno;
use App\Models\rolturno\PersonaRolturno;

class RolturnoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return view('rolturnos.Rolturno');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
       // return $request->tdia;

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

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function lista()
    {
        //
        return view('rolturnos.ListarRolturnos');
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
    
}
