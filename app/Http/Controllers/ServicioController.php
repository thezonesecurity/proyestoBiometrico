<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\servicios\Servicio;
use App\Models\seguridad\users;

class ServicioController extends Controller
{
    
    public function index()
    {
        // 
        $users = users::all();
       // dd($users);

        /*foreach($users as $user){
            dd($user->per_user);
        }*/

        $servicios = Servicio::orderBy('id')->get();
       //dd($servicios);
        // return view('servicios.Servicio')->with('servicios', $servicios);
        return view('servicios.Servicio')->with(compact('servicios', 'users'));
    }

    public function store(Request $request)
    {
       // dd($request);
        $servicio = new Servicio;
        $nombreservicio = ucwords($request->servicio);
        //dd($nombreservicio);
        $servicio->nombre = $nombreservicio;
        $servicio->estado = 'Habilitado';
        $servicio->id_responsable = $request->persona;
        //dd($servicio);
        $servicio->save();
       // dd($servicio);
       
        return redirect(route('listar.servicio'))->with('creado', 'El servicio se creo satisfactoriamente ...');
    }

    public function update(Request $request)
    {
       // dd($request);
        //dd($request->id);
        $id = $request->id;
        $servicio = Servicio::find($id);
        $nombre = ucwords($request->servicioM);
        $servicio->nombre =  $nombre;
        $servicio->id_responsable =  $request->responsable;
        $servicio->save();
       // dd($servicio);
        return redirect(route('listar.servicio'));
    }

    public function deshabilitar($id)
    {
         //dd($id);
         $servicio = Servicio::find($id);
         //$servicio->delete();
         $servicio->estado = 'Inhabilitado';
         $servicio->save();
         return redirect(route('listar.servicio'));
    }
    public function habilitar($id)
    {
         $servicio = Servicio::find($id);
         $servicio->estado = 'Habilitado';
         $servicio->save();
         return redirect(route('listar.servicio'));
    }

    public function mostrartabla()
    {
        // 
        return view('servicios.tablas');
    }

    public function destroy($id)
    {
        
        $servicio = Servicio::find($id);
        //dd($servicio);
        $servicio->delete();
        return redirect(route('listar.servicio'));
    }
}
