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
        return view('personal.personal')->with(compact('items', 'servicios'));
    }
   
    public function store(Request $request)
    {
       //dd($request);
        $validatedData = $request->validate([
            'id_per' => 'required',
            'nombre' => 'required',//readonly
            'ci' => 'required',//readonly
            'item' => 'required',
            'servicio' => 'required',
        ]);
       //dd($validatedData);
        $newpersona = new Persona;
        $newpersona->nombres = $validatedData['nombre']; //$request->nombre;
        $newpersona->ci = $validatedData['ci']; //$request->ci;
        $newpersona->item_id = $validatedData['item'];
        $newpersona->estado_per = 'Habilitado';
        $newpersona->idper_db = $validatedData['id_per'];
        $newpersona->id_servicio = $validatedData['servicio'];
        $newpersona->user_id = auth()->user()->id; 
        //dd($newpersona);
        $newpersona->save();
        return redirect(route('listar.personal'))->with('success', 'El personal se registro correctamente !!'); 
    }

    public function update(Request $request)
    {
        //dd($request);
        $validatedData = $request->validate([
            'id_user' => 'required',
            'nombre' => 'required',//readonly
            'ci' => 'required',//readonly
            'itemM' => 'required',
            'itemMo' => 'required_if:$request->itemMo != "", "" ',
            'servicioMo' => 'required',
            'servicioMo' => 'required_if:$request->servicioMo != "", "" ',
        ]);
       // dd($validatedData['id_user']);
        $idM = explode(',', $validatedData['id_user']); // $idM[0]=id , $idM[1]=idper_db
        //dd($idM[0]);
        $persona = persona::findOrFail($idM[0]);
        //$persona->nombres = $validatedData['nombre'];
       // $persona->ci = $validatedData['ci'];
       if($validatedData['itemMo'] != null) {
         $persona->item_id = $validatedData['itemMo'];
       }
       if($validatedData['servicioMo'] != null) {
         $persona->id_servicio = $validatedData['servicioMo'];
       }
        $persona->user_id = auth()->user()->id; 
        $persona->idper_db = $idM[1];
        //dd($persona);
        $persona->save();
        return redirect(route('listar.personal'))->with('success', 'El personal se actualizo correctamente !!'); 
    }

    public function deshabilitar($id)
    {
         //dd($id);
         $iper_db = $id;
         $persona = Persona::findOrFail($iper_db);
         $persona->estado_per = 'Inhabilitado';
         $persona->save();
         return redirect(route('listar.personal'))->with('success', 'El personal se deshabilito correctamente !!'); 
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
  /*
  ---------------------del store-------------
   dd($request);
        $newpersona = new Persona;
        $newpersona->nombres = $request->nombre;
        $newpersona->ci = $request->ci;
        $newpersona->item_id = $request->item;
        $newpersona->estado_per = 'Habilitado';
        $newpersona->idper_db = $request->id_per;
        $newpersona->id_servicio = $request->servicio;
        $newpersona->user_id = auth()->user()->id; 
       // dd($newpersona);
        $newpersona->save();
 ----------------update--------------
  $data = $request->id_user;
        $idM = explode(',', $data); // $idM[0]=id , $idM[1]=idper_db
       // dd($request);
        $persona = persona::find($idM[0]);
        //$persona->nombres = $request->nombre;
       // $persona->ci = $request->ci;
       if($request->itemMo != null) {
         $persona->item_id = $request->itemMo;
       }
       if($request->servicioMo != null) {
         $persona->id_servicio = $request->servicioMo;
       }
        $persona->user_id = auth()->user()->id; 
        $persona->idper_db = $idM[1];
        //dd($persona);
        $persona->save();
 */

 /*
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
        */