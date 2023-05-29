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
        'servicioR' => ['required', 'regex:/^[a-zA-Zñ ]{5,50}$/'], //'required|min:5|max:50|string',
        'personaR' => 'required',
        ]);

        $newservicio = new Servicio();
        $nombre = ucwords($validatedData['servicioR']);
        $newservicio->nombre = $nombre;
        $newservicio->estado = 'Habilitado';
        $newservicio->id_responsable = $validatedData['personaR'];
        //dd($newservicio);
        $newservicio->save();
        return redirect(route('listar.servicio'))->with('success', 'El servicio se creo correctamente');
    }

    public function update(Request $request)
    {
        //dd($request);
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
    }

    public function deshabilitar($id)
    {
         //dd($id);
         $servicio = Servicio::findOrFail($id);
         //$servicio->delete();
         $servicio->estado = 'Inhabilitado';
         $servicio->save();
         return redirect(route('listar.servicio'))->with('success', 'El servicio se deshabilito correctamente !!'); 
    }
    public function habilitar($id)
    {
         $servicio = Servicio::findOrFail($id);
         $servicio->estado = 'Habilitado';
         $servicio->save();
         return redirect(route('listar.servicio'))->with('success', 'El servicio se habilito correctamente !!'); 
    }

    public function destroy($id)
    {
        //NO USADO
        $servicio = Servicio::find($id);
        //dd($servicio);
        $servicio->delete();
        return redirect(route('listar.servicio'));
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
*/