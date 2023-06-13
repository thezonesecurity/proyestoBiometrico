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
            'numFinanciamiento' => 'required_if:$request->numFinanciamiento != 0, ""|regex:/^[0-9]{1,20}+$/',
            'servicio' => 'required',
        ]);
       //dd($validatedData);
        $newpersona = new Persona;
        $newpersona->nombres = $validatedData['nombre']; //$request->nombre;
        $newpersona->ci = $validatedData['ci']; //$request->ci;
        $newpersona->item_id = $validatedData['item'];
        if($validatedData['numFinanciamiento'] != '0'){ $newpersona->num_financ = $validatedData['numFinanciamiento']; }
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
        //return response()->json($request);
        $validatedData = $request->validate([
            'id' => 'required',
            'persona' => 'required|regex:/^[a-zA-ZÑñ. ]{5,99}+$/',
            'ci' => 'required',//readonly
            'Lastitem' => 'required',
            'Newitem' => 'required_if:$request->itemMo != "", "" ',
            'nroitem' => 'required_if:$request->numFinanciamientoM != 0, ""|regex:/^[0-9]{1,20}+$/',
            'LastServicio' => 'required',
            'NewServicio' => 'required_if:$request->servicioMo != "", "" ',
        ]);
        //return response()->json($validatedData);
        $persona = persona::findOrFail($validatedData['id']);
        $persona->nombres = strtoupper($validatedData['persona']);
        // $persona->ci = $validatedData['ci'];
        if($validatedData['Newitem'] != null) {  $persona->item_id = $validatedData['Newitem']; };
        if($validatedData['NewServicio'] != null) { $persona->id_servicio = $validatedData['NewServicio']; }
        if($validatedData['nroitem'] != '0'){ $persona->num_financ = $validatedData['nroitem']; }
        else { $persona->num_financ = null; }
        $persona->user_id = auth()->user()->id; 
        //dd($persona);
        $persona->save();
        return response()->json(['message' => 'El registro se actualizó correctamente.', 'status' => 'ok']);
    }

    public function deshabilitar($id)
    {
        $persona = Persona::findOrFail($id);
        $persona->estado_per = 'Deshabilitado';
        $persona->save();
        return redirect(route('listar.personal'))->with('success', 'El personal se deshabilito correctamente !!'); 
    }
    public function habilitar($id)
    {
        //dd($id);
        $persona = Persona::findOrFail($id);
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
        ----------------------otro update ----------------
        $validatedData = $request->validate([
            'id_user' => 'required',
            'nombrePersonal' => 'required|regex:/^[a-zA-ZÑñ. ]{5,99}+$/',
            'ci' => 'required',//readonly
            'itemM' => 'required',
            'itemMo' => 'required_if:$request->itemMo != "", "" ',
            'numFinanciamientoM' => 'required_if:$request->numFinanciamientoM != 0, ""|regex:/^[0-9]{1,20}+$/',
            'servicioM' => 'required',
            'servicioMo' => 'required_if:$request->servicioMo != "", "" ',
        ]);
        // dd($validatedData['id_user']);
        //$idM = explode(',', $validatedData['id_user']); // $idM[0]=id , $idM[1]=idper_db
        $persona = persona::findOrFail($validatedData['id_user']);
        $persona->nombres = strtoupper($validatedData['nombrePersonal']);
        // $persona->ci = $validatedData['ci'];
        if($validatedData['itemMo'] != null) {  $persona->item_id = $validatedData['itemMo']; };
        if($validatedData['servicioMo'] != null) { $persona->id_servicio = $validatedData['servicioMo']; }
        if($validatedData['numFinanciamientoM'] != '0'){ $persona->num_financ = $validatedData['numFinanciamientoM']; }
        else { $persona->num_financ = null; }
        $persona->user_id = auth()->user()->id; 
        //dd($persona);
        $persona->save();
        return redirect(route('listar.personal'))->with('success', 'El personal se actualizo correctamente !!'); 
 */

 