<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\ValidacionServicio;

use App\Models\servicios\Servicio;
use App\Models\seguridad\users;

class ServicioController extends Controller
{
    
    public function index()
    {
        $users = users::where('estado', 'enable')->get();
        $servicios = Servicio::orderBy('id')->get();
       //dd($servicios);
        return view('servicios.Servicio')->with(compact('servicios', 'users'));
    }

    public function store(Request $request)
    {        
       //dd($request);
       $validatedData = $request->validate([
        'servicioR' => ['required', 'regex:/^[a-zA-ZÑñ ]{5,50}$/'], //'required|min:5|max:50|string',
        'personaR' => 'required',
        ]);

        $newservicio = new Servicio();
        $nombre = ucfirst(strtolower($validatedData['servicioR'])); //ucwords($validatedData['servicioR']);
        $newservicio->nombre = $nombre;
        $newservicio->estado = 'Habilitado';
        $newservicio->id_responsable = $validatedData['personaR'];
       // dd($newservicio->nombre );
        $newservicio->save();
        return redirect(route('listar.servicio'))->with('success', 'El servicio se creo correctamente');
    }

    public function update(Request $request)
    {
       // return response()->json(['message' => 'El registro se actualizó correctamente.']);
       // return response()->json($request);
        $validatedData = $request->validate([
            'id' => 'required|numeric',
            'servicio' => ['required', 'regex:/^[a-zA-ZÑñ ]{5,50}$/'], //'required|min:5|max:50|string',
            'LastResp' => 'required', //'sometimes|required',
            'NewResp' => 'required_if:$request->otroResponsable != "", "" ', //'sometimes|required',
        ]);
       
        $servicio = Servicio::findOrFail($validatedData['id']);
        $servicio->nombre =  $validatedData['servicio'];
        if($validatedData['NewResp'] != null) {
            $servicio->id_responsable =  $validatedData['NewResp'];
            $servicio->save();
            return response()->json(['message' => 'El registro se actualizó correctamente.', 'status' => 'ok']);
        }else {
            $servicio->save();
            return response()->json(['message' => 'El registro se actualizó correctamente.', 'status' => 'ok']);
        }
        //return response()->json($validatedData);
    }

    public function deshabilitar(Request $request)
    {
        //dd($request);
        $id = $request->id;
        $servicio = Servicio::findOrFail($id);
        if($request->accion == 'H'){
            $servicio->estado = 'Habilitado';
            $servicio->save();
            return redirect(route('listar.servicio'))->with('success', 'El servicio se habilito correctamente !!'); 
        }else{
            $servicio->estado = 'Deshabilitado';
            $servicio->save();
            return redirect(route('listar.servicio'))->with('success', 'El servicio se deshabilito correctamente !!'); 
        } 
    }

}
        /* para validar sin el metodo request
       
        -----------del store-----------
        $servicio = new Servicio;
        $nombreservicio = ucwords($request->servicioR);
        $servicio->nombre = $nombreservicio;
        $servicio->estado = 'Habilitado';
        $servicio->id_responsable = $request->personaR;
       // dd($servicio);
        $servicio->save();
       // dd($servicio);

       -------- del update------------
        //dd($request->id);
        //dd($request->responsableMo);
        $id = $request->id;
        $servicio = Servicio::findOrFail($id);
        
        $nombre = ucwords($request->servicioM);
        $servicio->nombre =  $nombre;
        if($request->responsableMo != null) {
            $servicio->id_responsable =  $request->responsableMo;
            $servicio->save();
            return redirect(route('listar.servicio'))->with('success', 'El servicio se actualizo correctamente !!'); 
        }else {
            $servicio->save();
            return redirect(route('listar.servicio'))->with('success', 'El servicio se actualizo correctamente !!'); 
        }
        ---------------otro estore con validate-----------
        
        $validatedData = $request->validate([
            'id' => 'numeric',
            'servicioM' => ['required', 'regex:/^[a-zA-Zñ ]{5,50}$/'], //'required|min:5|max:50|string',
            'responsableMo' => 'required_if:$request->responsableMo != "", "" ', //'sometimes|required',
        ]);
        $servicio = Servicio::findOrFail($validatedData['id']);
        $nombre = ucwords($validatedData['servicioM']);
        $servicio->nombre =  $nombre;
        if($validatedData['responsableMo'] != null) {
            $servicio->id_responsable =  $validatedData['responsableMo'];
            $servicio->save();
            return redirect(route('listar.servicio'))->with('success', 'El servicio se actualizo correctamente !!'); 
        }else {
            $servicio->save();
            return redirect(route('listar.servicio'))->with('success', 'El servicio se actualizo correctamente !!'); 
        }
*/