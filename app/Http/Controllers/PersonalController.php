<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\personal\Persona;
use App\Models\servicios\Servicio;
use App\Models\tipo_contratos\TipoContrato;


class PersonalController extends Controller
{
    public function index()
    {
        $items=TipoContrato::orderBy('id')->where('estado', 'Habilitado')->pluck('nombre', 'id');
        $servicios=Servicio::orderBy('id')->where('estado', 'Habilitado')->pluck('nombre', 'id');
        //dd($items);
        return view('personal.personal')->with(compact('items', 'servicios'));
    }
    public function store(Request $request)
    {
       // dd($request);
        $newpersona = new Persona;
        $newpersona->nombres = $request->nombre;
        $newpersona->ci = $request->ci;
        $newpersona->item_id = $request->item;
        $newpersona->estado_per = 'Habilitado';
        $newpersona->idper_db = $request->id_user;
        $newpersona->id_servicio = $request->servicio;
        $newpersona->user_id = auth()->user()->id; 
       dd($newpersona);
        $newpersona->save();
        return redirect(route('listar.personal'))->with('success', 'El personal se registro correctamente !!'); 
    }

    public function update(Request $request)
    {
        dd($request);
        $persona=Persona::where('id_servicio',$request->servicio)->where('nombres', $request->nombre)->first(); 
       // dd($persona);
        if(isset($persona)){
           // echo 'existe en DB' SE ACTUALIZA;
            $persona->nombres = $request->nombre;
            $persona->ci = $request->ci;
            $persona->item_id = $request->item;
            $persona->estado_per = 'Habilitado';
            $persona->idper_db = $request->id_user;
            $persona->id_servicio = $request->servicio;
            $persona->user_id = auth()->user()->id; 
            dd($persona);
            //$persona->save();
            return redirect(route('listar.personal'))->with('success', 'El personal se actualizo correctamente !!'); 
        }
        else {
            //echo 'NO existe en DB' SE HACE UN NUEVO REGISTRO;
            $newpersona = new Persona;
            $newpersona->nombres = $request->nombre;
            $newpersona->ci = $request->ci;
            $newpersona->item_id = $request->item;
            $newpersona->estado_per = 'Habilitado';
            $newpersona->idper_db = $request->id_user;
            $newpersona->id_servicio = $request->servicio;
            $newpersona->user_id = auth()->user()->id; 
           dd($newpersona);
            //$newpersona->save();
            return redirect(route('listar.personal'))->with('success', 'El personal se registro correctamente !!'); 
        }

    }

    public function deshabilitar($id)
    {
         //dd($id);
         $iper_db = $id;
         $persona = Persona::findOrFail($iper_db);
         $persona->estado_per = 'Inhabilitado';
         $persona->save();
         return redirect(route('listar.personal'))->with('warning', 'El personal se deshabilito correctamente !!'); 
    }
    public function habilitar($id)
    {
        //dd($id);
        $iper_db = $id;
        $persona = Persona::findOrFail($iper_db);
        $persona->estado_per = 'Habilitado';
        $persona->save();
        return redirect(route('listar.personal'))->with('success', 'El personal se habilito correctamente !!'); 
    }
}
