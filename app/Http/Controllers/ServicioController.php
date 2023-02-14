<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\servicios\Servicio;

class ServicioController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // 
        $servicios = Servicio::all();
       //dd($servicios);
        return view('servicios.Servicio')->with('servicios', $servicios);
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
       // dd($request);
        $servicio = new Servicio;
        $nombreservicio = ucwords($request->nombre);
        //dd($nombreservicio);
        $servicio->nombre = $nombreservicio;
        $servicio->estado = 'Habilitado';
        $servicio->save();
       // dd($servicio);
       
        return redirect(route('listar.servicio'))->with('creado', 'El servicio se creo satisfactoriamente ...');
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
         //dd($id);
        //$servicioe = Servicio::find($id);
        //dd($servicioe->id);
       // return view('servicios.ModalEditar')->with('servicioe', $servicioe);
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
        //dd($request->id);
        $id = $request->id;
        $servicio = Servicio::find($id);
        $nombreserviciomodificado = ucwords($request->nombre);
        $servicio->nombre =  $nombreserviciomodificado;
        $servicio->save();
        //dd($servicio);
        return redirect(route('listar.servicio'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
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
