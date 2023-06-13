<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\servicios\Servicio;
use App\Models\personal\Persona;
use App\Models\tipo_contratos\TipoContrato;
use App\Models\rolturno\Rolturno;
use App\Models\rolturno\PersonaRolturno;


class ReportesController extends Controller
{

    public function index()
    {
      //  return view('habilitacionTurnos.listadoTurnos')->with(compact('rolturnos'));
      $personas = Persona::where( 'estado_per', 'Habilitado')->pluck('nombres', 'id');
      $items=TipoContrato::orderBy('id')->where('estado', 'Habilitado')->pluck('nombre', 'id');
      return view('reportes.reporte1')->with(compact('personas', 'items'));;
    }
    
    public function reportOne(Request $request)
    {
      $serverName = "DESKTOP-S9D1IAK"; //"193.168.0.4";// "DESKTOP-S9D1IAK"; //propiedades del servidor->ver propiedades de conexioon->producto-> nombre del servidor
      $connectionInfo = array( "Database"=>"BD_BIOMETRICO", "UID"=>"sa", "PWD"=>"Sice2023");//Sice2023
      $conn = sqlsrv_connect( $serverName, $connectionInfo) or die(print_r(sqlsrv_errors(), true));

      $sql="select USERID, CHECKTIME from CHECKINOUT"; //ORDER BY USERID;  personas
      $res=sqlsrv_query($conn,$sql);
      while($row=sqlsrv_fetch_array($res) ){
        dd($row);
      }sqlsrv_close($conn); 
    
      // dd($request);
      $id_item = 3;
      $resultado=PersonaRolturno::query();
      if ($request->persona == 'all' ) { //&& $request->tipo_item == 'item'
        $resultado = $resultado->whereHas('rolturno_per',function($query) use($id_item){
          return $query->where("item_id","<>",$id_item);
        })->where('fecha_inicio','>=',$request->fecha_inicio)->where('fecha_inicio','<=',$request->fecha_fin)->where('tipo_dia', 'DL')->get();
        dd($resultado);
      }
      /*if ($request->persona == 'all' && $request->tipo_item == 'item') {
        $resultado = PersonaRolturno::where('fecha_inicio','>=',$request->fecha_inicio)->where('fecha_inicio','<=',$request->fecha_fin)->where('tipo_dia', 'DL')->get();
        dd($resultado);
      }
      else{
          $resultado=$resultado->whereHas('paciente',function($query) use($sexo){
              return $query->where("genero","<>",$sexo);
          })->where('fecha','>=',$request->start)->where('fecha','<=',$request->end)->where('sus','<>',$request->tipo)->where('hemo_id',$request->hemo)->get();
      }*/

      /*$resultado=Cuaderno::query();
      if ($request->hemo == 'all') {
          $resultado=$resultado->whereHas('paciente',function($query) use($sexo){
              return $query->where("genero","<>",$sexo);
          })->where('fecha','>=',$request->start)->where('fecha','<=',$request->end)->where('sus','<>',$request->tipo)->get();
      }
      else{
          $resultado=$resultado->whereHas('paciente',function($query) use($sexo){
              return $query->where("genero","<>",$sexo);
          }*/
                
    }
    public function index2()
    {
      return view('reportes.reportes2');
    }
    public function index3()
    {

      return view('reportes.reportes3');
    }

}
