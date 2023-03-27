<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\areaservicio\AreaServicio;

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
        $areas = AreaServicio::all();
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

        $areaservicio = new AreaServicio;
        $nombre = ucwords($request->nombre);
        $areaservicio->nombre = $nombre;
        $areaservicio->estado = 'Habilitado';
        $areaservicio->servicio_id = $request->id_servicio;
        $areaservicio->save();
       //dd($areaservicio);
       
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
        $id = $request->id;
        $areaservicio = AreaServicio::find($id);
        $nombre = ucwords($request->nombre);
        $areaservicio->nombre =  $nombre;
        $areaservicio->servicio_id = $request->id_servicio;
        //$areaservicio->save();
        dd($areaservicio);
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
         $areaservicio = AreaServicio::find($id);
         $areaservicio->estado = 'Inhabilitado';
         $areaservicio->save();
         return redirect(route('listar.area.servicio'));
    }
    public function habilitar($id)
    {
         $areaservicio = AreaServicio::find($id);
         $areaservicio->estado = 'Habilitado';
         $areaservicio->save();
         return redirect(route('listar.area.servicio'));
    }
}
