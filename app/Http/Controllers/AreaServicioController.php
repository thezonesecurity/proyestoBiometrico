<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\areas\Area;

class AreaServicioController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $areas = Area::orderBy('id')->get();
        return view('areas.listarArea')->with('areas', $areas);

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
       // dd($request);

        $area = new Area;
        $nombre = ucwords($request->nombre);
        $area->nombre = $nombre;
        $area->estado = 'Habilitado';
        $area->servicio_id = $request->id_servicio;
        $area->save();
       //dd($area);
       
        return redirect(route('listar.area.servicio'));
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
        //
        //dd($request);
        $id = $request->id_area;
        $area = Area::find($id);
        $nombre = ucwords($request->nombre);
        $area->nombre =  $nombre;
        $area->servicio_id = $request->id_servicio;
        $area->save();
        //dd($area);
        return redirect(route('listar.area.servicio'));
       
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
         $area = Area::find($id);
         $area->estado = 'Inhabilitado';
         $area->save();
         return redirect(route('listar.area.servicio'));
    }
    public function habilitar($id)
    {
         $area = Area::find($id);
         $area->estado = 'Habilitado';
         $area->save();
         return redirect(route('listar.area.servicio'));
    }
}
