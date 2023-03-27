<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\personal\Persona;
use App\Models\servicios\Servicio;
use DB;

class PersonalController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {
        
        return view('personal.personal');
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
    public function update(Request $request)
    {
       // dd($request);
       // dd($request->id_user);
        $serv= DB::select("select * from repbio.servicios where nombre = '$request->servicio' ");
        $servicio_id = $serv[0]->id;
        //dd($servicio_id);
        $persona=Persona::where('idper_db',$request->id_user)->first(); 
       
        if(isset($persona)){
           // echo 'existe en DB' SE ACTUALIZA;
            $persona->nombres = $request->nombre;
            $persona->ci = $request->ci;
            $persona->item = $request->item;
            $persona->estado_per = 'Habilitado';
            $persona->idper_db = $request->id_user;
            $persona->id_servicio = $servicio_id;
            $persona->user_id = '1'; 
            //dd($persona);
            $persona->save();
            return redirect(route('listar.personal'));
        }
        else {
            //echo 'NO existe en DB' SE HACE UN NUEVO REGISTRO;
            $newpersona = new Persona;
            $newpersona->nombres = $request->nombre;
            $newpersona->ci = $request->ci;
            $newpersona->item = $request->item;
            $newpersona->estado_per = 'Habilitado';
            $newpersona->idper_db = $request->id_user;
            $newpersona->id_servicio = $servicio_id;
            $newpersona->user_id = '1'; 
           // dd($persona);
            $newpersona->save();
            return redirect(route('listar.personal'));
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
    public function deshabilitar($id)
    {
         //dd($id);
         $iper_db = $id;
         //dd($id_per);
         $persona = Persona::find($iper_db);
         //dd($persona);
         $persona->estado_per = 'Inhabilitado';
        // dd($persona);
         $persona->save();
         return redirect(route('listar.personal'));
    }
    public function habilitar($id)
    {
        //dd($id);
        $iper_db = $id;
        //dd($id_per);
        $persona = Persona::find($iper_db);
        //dd($persona);
        $persona->estado_per = 'Habilitado';
       // dd($persona);
        $persona->save();
        return redirect(route('listar.personal'));
    }
}
