<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\servicios\Servicio;
use App\Models\areas\Area;
use App\Models\personal\Persona;
use App\Models\rolturno\Rolturno;
use App\Models\rolturno\PersonaRolturno;
use DB;

class ReportesController extends Controller
{

    public function index()
    {
        //}
        $rolturnos = Rolturno::all();
        return view('habilitacionTurnos.listadoTurnos')->with(compact('rolturnos'));
    }
    
    public function habilitacion(Request $request)
    {
       // dd(auth()->user()->id);
       dd($request);
    }

}
