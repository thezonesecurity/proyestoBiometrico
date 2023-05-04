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
        // 
        $users = users::where('estado', 'enable')->get();
        $servicios = Servicio::orderBy('id')->get();
       //dd($servicios);
        return view('servicios.Servicio')->with(compact('servicios', 'users'));
    }

    public function store(Request $request) //
    {
       //dd($request);
        $servicio = new Servicio;
        $nombreservicio = ucwords($request->servicio);
        //dd($nombreservicio);
        $servicio->nombre = $nombreservicio;
        $servicio->estado = 'Habilitado';
        $servicio->id_responsable = $request->persona;
        //dd($servicio);
        $servicio->save();

       // dd($servicio);
       
        return redirect(route('listar.servicio'))->with('success', 'El servicio se creo correctamente');
    }

    public function update(Request $request)
    {
       //dd($request);
        //dd($request->id);
        //dd($request->responsableMo);
        $id = $request->id;
        $servicio = Servicio::find($id);
        
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

    }

    public function deshabilitar($id)
    {
         //dd($id);
         $servicio = Servicio::find($id);
         //$servicio->delete();
         $servicio->estado = 'Inhabilitado';
         $servicio->save();
         return redirect(route('listar.servicio'))->with('warning', 'El servicio se deshabilito correctamente !!'); 
    }
    public function habilitar($id)
    {
         $servicio = Servicio::find($id);
         $servicio->estado = 'Habilitado';
         $servicio->save();
         return redirect(route('listar.servicio'))->with('success', 'El servicio se habilito correctamente !!'); 
    }

    public function mostrartabla()
    {
        // NO USADO
        return view('servicios.tablas');
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
