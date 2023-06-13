<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\areas\Area;
use App\Models\servicios\Servicio;

class AreaServicioController extends Controller
{

    public function index()
    {
        $areas = Area::orderBy('id')->get();
        $servicios = Servicio::where('estado', 'Habilitado')->pluck('nombre', 'id');
        return view('areas.listarArea')->with(compact('areas', 'servicios'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'areaR' => ['required', 'regex:/^[a-zA-ZÑñ ]{5,60}$/'],
            'servicioR' => 'required',
        ]);
        $newarea = new Area;
        $newarea->nombre = ucfirst(strtolower($validatedData['areaR'])); 
        $newarea->estado = 'Habilitado';
        $newarea->servicio_id = $validatedData['servicioR'];  
       // dd($newarea);
       $newarea->save();
        return redirect(route('listar.area.servicio'))->with('success', 'El area se registro correctamente !!');
    }

    public function update(Request $request)
    {
       
        $validatedData = $request->validate([
            'id' => 'required|numeric',
            'area' => ['required', 'regex:/^[a-zA-ZÑñ ]{5,60}$/'],
            'LastServicio' => 'required',
            'NewServicio' => 'required_if:$request->NewServicio != null, "" ',
        ]);
      // return response()->json($validatedData);
       $area = Area::findOrFail($validatedData['id']);
       $area->nombre = $validatedData['area'];
       if($validatedData['NewServicio'] != null) {
            $area->servicio_id  =  $validatedData['NewServicio'];
             $area->save();
            return response()->json(['message' => 'El registro se actualizó correctamente.', 'status' => 'ok']);
        }else {
             $area->save();
            return response()->json(['message' => 'El registro se actualizó correctamente.', 'status' => 'ok']);
        }
    }

    public function deshabilitar(Request $request)
    {
        // dd($request);
         $id = $request->id;
         $area = Area::findOrFail($id);
         if($request->accion == 'D'){
            $area->estado = 'Deshabilitado';
            $area->save();
            return redirect(route('listar.area.servicio'))->with('success', 'El area se deshabilito correctamente !!'); 
         }else{
            $area->estado = 'Habilitado';
            $area->save();
            return redirect(route('listar.area.servicio'))->with('success', 'El area se habilito correctamente !!'); 
         }
    }

}


/*
--------------del store------------
      dd($request);
        $area = new Area;
        $nombre = ucwords($request->area);
        $area->nombre = $nombre;
        $area->estado = 'Habilitado';
        $area->servicio_id = $request->servicio;
        $area->save();
       //dd($area);
-------------del update-------------
$id = $request->idM;
        $area = Area::find($id);
        $nombre = ucwords($request->areaM);
        $area->nombre =  $nombre;
        if($request->servicioMo != null) {
            $area->servicio_id = $request->servicioMo;
           $area->save();
            return redirect(route('listar.area.servicio'))->with('success', 'El area se actualizo correctamente !!'); 
        }else {
            $area->save();
            return redirect(route('listar.area.servicio'))->with('success', 'El area se actualizo correctamente !!'); 

-------otro update  completo ajax---------
 $validatedData = $request->validate([
            'idM' => 'numeric',
            'areaM' => 'required|min:5|max:50|string',
            'servicioM' => 'required',
            'servicioMo' => 'required_if:$request->servicioMo != "", "" ', //'sometimes|required',
        ]);
        // dd($validatedData);
        $area = Area::findOrFail($validatedData['idM']);
        $nombre = ucwords($validatedData['areaM']);
        $area->nombre =  $nombre;
        if($validatedData['servicioMo'] != null) {
            $area->servicio_id =  $validatedData['servicioMo'];
            $area->save();
            return redirect(route('listar.area.servicio'))->with('success', 'El area se actualizo correctamente !!'); 
        }else {
            $area->save();
            return redirect(route('listar.area.servicio'))->with('success', 'El area se actualizo correctamente !!'); 
        }            

*/