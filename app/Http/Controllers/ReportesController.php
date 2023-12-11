<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Arr;

use App\Models\servicios\Servicio;//
use App\Models\personal\Persona;
use App\Models\tipo_contratos\TipoContrato;
use App\Models\rolturno\Rolturno;//
use App\Models\rolturno\PersonaRolturno;

use App\Models\marcacion\MarcacionBio;
use Carbon\Carbon;

class ReportesController extends Controller
{

    public function index()
    {
      //  return view('habilitacionTurnos.listadoTurnos')->with(compact('rolturnos'));
      $personas = Persona::orderBy('id')->where( 'estado_per', 'Habilitado')->pluck('nombres', 'id');
      $items=TipoContrato::orderBy('id')->where('estado', 'Habilitado')->pluck('nombre', 'id');
      return view('reportes.reporte1')->with(compact('personas', 'items'));
    }
    
    public function reportOne(Request $request)
    {
      //dd($request);
      $resultado=PersonaRolturno::query();
      $serverName = "DESKTOP-S9D1IAK"; //"193.168.0.7\SIAF";// "DESKTOP-S9D1IAK"; //propiedades del servidor->ver propiedades de conexioon->producto-> nombre del servidor
      $connectionInfo = array( "Database"=>"BD_BIOMETRICO", "UID"=>"sa", "PWD"=>"S1af");
      $conn = sqlsrv_connect( $serverName, $connectionInfo );
      if( $conn === false ) { die( print_r( sqlsrv_errors(), true)); }

      $fechaInicio = Carbon::parse($request->fecha_inicio);//->format('Y-m-d');
      $fechaFin = Carbon::parse($request->fecha_fin);//->format('Y-m-d');

      if($request->opcion == 'Todos'){ //para todas las personas
          
        if($request->tipo_item == 'all'){//para todos los items i contratos
          $resultado = PersonaRolturno::where('fecha_inicio','>=',$request->fecha_inicio)->where('fecha_inicio','<=',$request->fecha_fin)->where('tipo_dia', 'DL')->get();
            foreach($resultado as $lista ){
              $id_per = $lista->rolturno_per->idper_db;
              // echo $lista->fecha_inicio." ".$lista->hora_inicio." ".$lista->hora_fin." ->".$lista->persona_id."<br>";

              $fechaTurno = Carbon::create($lista->fecha_inicio);//->format('Y-m-d 1H:i:s');

              $limiteDespuesE = Carbon::create($lista->hora_inicio)->addHour(2);//->format('H:i:s');
              $limiteAntesE = Carbon::create($lista->hora_inicio)->subHour(2);//->format('H:i:s'); 
              $limiteDespuesS = Carbon::create($lista->hora_fin)->addHour();//->format('H:i:s');
              $limiteAntesS = Carbon::create($lista->hora_fin)->subHour();//->format('H:i:s');

              $toleranciaE =  Carbon::parse($lista->hora_inicio)->addMinute(10);//->format('H:i:s');CONVERT(date, CHECKTIME, 120) BETWEEN $fechaInicio AND $fechaFin
              $toleranciaS =  Carbon::parse($lista->hora_fin);

              $hora_ini = Carbon::parse($lista->hora_inicio);
              $hora_fin = Carbon::parse($lista->hora_fin);

              $sql = "SELECT USERID, CONVERT(date, CHECKTIME ) AS Fecha,
                MIN(CONVERT(datetime, CHECKTIME )) AS PrimeraEntrada,
                MAX(CASE WHEN CONVERT(time, CHECKTIME) > '$hora_fin'  THEN CONVERT(datetime, CHECKTIME) ELSE 0 END ) AS PrimeraSalida,
                SUM(CASE WHEN CONVERT(time, CHECKTIME) > '$toleranciaE' THEN DATEDIFF(MINUTE, '$toleranciaE', CHECKTIME) ELSE 0 END) AS total_atrasos
                FROM CHECKINOUT
                WHERE USERID = $id_per 
                AND CONVERT(date, CHECKTIME ) BETWEEN '$fechaInicio' AND '$fechaFin' 
                GROUP BY USERID, CONVERT(date, CHECKTIME )
                HAVING MIN(CONVERT(datetime, CHECKTIME )) IS NOT NULL 
                ORDER BY  USERID ASC, PrimeraEntrada ASC, PrimeraSalida ASC";

              $res = sqlsrv_query( $conn, $sql);
              if( $res === false) { die( print_r( sqlsrv_errors(), true) ); }
                $atraso=0;
                $userAtrasos = [];

                $atrasosPorUsuario = [];
                while( $row = sqlsrv_fetch_array( $res, SQLSRV_FETCH_ASSOC) ) { 
                  $userID = $row['USERID'];
                  
                  $newDate = Carbon::create($row['PrimeraEntrada'])->format('Y-m-d');
                  $DateBio = Carbon::create($newDate);
                  $TimeBio = Carbon::create($row['PrimeraEntrada'])->format('H:i:s');
                  $horaBio = Carbon::create($TimeBio);

                  $userId = $row['USERID'];
                  $newDate = Carbon::create($row['PrimeraEntrada'])->format('Y-m-d');
                  $DateBio = Carbon::create($newDate);
                  $TimeBio = Carbon::create($row['PrimeraEntrada'])->format('H:i:s');
                  $horaBio = Carbon::create($TimeBio);

                if($fechaTurno->equalTo($DateBio) ){ 
                    if( $horaBio->between($limiteAntesE, $limiteDespuesE) ){ // $horaBio->between($limiteAntesE, $limiteDespuesE)
                      if($horaBio > $toleranciaE){
                        $atraso = $horaBio->diffInMinutes($toleranciaE);
                        $userAtrasos[$userId] = ($userAtrasos[$userId] ?? 0) + $atraso;
                      }
                      // echo $row['USERID'] . " " . $row['PrimeraEntrada']->format('Y-m-d H:i:s')." => ".$fechaTurno." <> ".$toleranciaE . "  Atraso: " . $atraso. "<br>";
                    }
                  }
                } 
              
                foreach ($userAtrasos as $userId => $totalAtraso) {   // Mostrar el total de atrasos por usuario
                  if ($totalAtraso > 0) {
                      echo "todos item + contratos Usuario: " . $userId . " Total de atrasos: " . $totalAtraso . "<br>";}
                }
              sqlsrv_free_stmt($res);
            }
        }

        if($request->tipo_item == 'item'){//solo para los items menos contratos
            $item=TipoContrato::where('nombre', 'Contrato')->pluck('id'); //dd($item[0]);
            $id_item = $item[0];
            $resultado = $resultado->whereHas('rolturno_per',function($query) use($id_item){
              return $query->where("item_id","<>",$id_item);
            })->where('fecha_inicio','>=',$request->fecha_inicio)->where('fecha_inicio','<=',$request->fecha_fin)->where('tipo_dia', 'DL')->get();
            
            foreach($resultado as $lista ){
               $id_per = $lista->rolturno_per->idper_db;
               // echo $lista->fecha_inicio." ".$lista->hora_inicio." ".$lista->hora_fin." ->".$lista->persona_id."<br>";

               $fechaTurno = Carbon::create($lista->fecha_inicio);//->format('Y-m-d 1H:i:s');

               $limiteDespuesE = Carbon::create($lista->hora_inicio)->addHour(2);//->format('H:i:s');
               $limiteAntesE = Carbon::create($lista->hora_inicio)->subHour(2);//->format('H:i:s'); 
               $limiteDespuesS = Carbon::create($lista->hora_fin)->addHour();//->format('H:i:s');
               $limiteAntesS = Carbon::create($lista->hora_fin)->subHour();//->format('H:i:s');

               $toleranciaE =  Carbon::parse($lista->hora_inicio)->addMinute(10);//->format('H:i:s');CONVERT(date, CHECKTIME, 120) BETWEEN $fechaInicio AND $fechaFin
               $toleranciaS =  Carbon::parse($lista->hora_fin);

               $hora_ini = Carbon::parse($lista->hora_inicio);
               $hora_fin = Carbon::parse($lista->hora_fin);
 
               $sql = "SELECT USERID, CONVERT(date, CHECKTIME ) AS Fecha,
                  MIN(CONVERT(datetime, CHECKTIME )) AS PrimeraEntrada,
                  MAX(CASE WHEN CONVERT(time, CHECKTIME) > '$hora_fin'  THEN CONVERT(datetime, CHECKTIME) ELSE 0 END ) AS PrimeraSalida,
                  SUM(CASE WHEN CONVERT(time, CHECKTIME) > '$toleranciaE' THEN DATEDIFF(MINUTE, '$toleranciaE', CHECKTIME) ELSE 0 END) AS total_atrasos
                  FROM CHECKINOUT
                  WHERE USERID = $id_per 
                  AND CONVERT(date, CHECKTIME ) BETWEEN '$fechaInicio' AND '$fechaFin' 
                  GROUP BY USERID, CONVERT(date, CHECKTIME )
                  HAVING MIN(CONVERT(datetime, CHECKTIME )) IS NOT NULL 
                  ORDER BY  USERID ASC, PrimeraEntrada ASC, PrimeraSalida ASC";

             $res = sqlsrv_query( $conn, $sql);
             if( $res === false) { die( print_r( sqlsrv_errors(), true) ); }
              $atraso=0;
              $userAtrasos = [];

              $atrasosPorUsuario = [];
              while( $row = sqlsrv_fetch_array( $res, SQLSRV_FETCH_ASSOC) ) { 
                $userID = $row['USERID'];
                
                $newDate = Carbon::create($row['PrimeraEntrada'])->format('Y-m-d');
                $DateBio = Carbon::create($newDate);
                $TimeBio = Carbon::create($row['PrimeraEntrada'])->format('H:i:s');
                $horaBio = Carbon::create($TimeBio);

                 $userId = $row['USERID'];
                $newDate = Carbon::create($row['PrimeraEntrada'])->format('Y-m-d');
                $DateBio = Carbon::create($newDate);
                $TimeBio = Carbon::create($row['PrimeraEntrada'])->format('H:i:s');
                $horaBio = Carbon::create($TimeBio);

               if($fechaTurno->equalTo($DateBio) ){ 
                  if( $horaBio->between($limiteAntesE, $limiteDespuesE) ){ // $horaBio->between($limiteAntesE, $limiteDespuesE)
                    if($horaBio > $toleranciaE){
                      $atraso = $horaBio->diffInMinutes($toleranciaE);
                      $userAtrasos[$userId] = ($userAtrasos[$userId] ?? 0) + $atraso;
                    }
                       // echo $row['USERID'] . " " . $row['PrimeraEntrada']->format('Y-m-d H:i:s')." => ".$fechaTurno." <> ".$toleranciaE . "  Atraso: " . $atraso. "<br>";
                  }
                }
              } 
              foreach ($userAtrasos as $userId => $totalAtraso) {    // Mostrar el total de atrasos por usuario
                if ($totalAtraso > 0) {
                   echo "solo item Usuario: " . $userId . " Total de atrasos: " . $totalAtraso . "<br>";}
              }
              sqlsrv_free_stmt($res);
            }
        }
        if($request->tipo_item != 'item' && $request->tipo_item != 'all'){//para los items invividules
          $item_id = $request->tipo_item;
          $resultado = $resultado->whereHas('rolturno_per',function($query) use($item_id){
            return $query->where("item_id",$item_id);
          })->where('fecha_inicio','>=',$request->fecha_inicio)->where('fecha_inicio','<=',$request->fecha_fin)->where('tipo_dia', 'DL')->get();

          foreach($resultado as $lista ){
            $id_per = $lista->rolturno_per->idper_db;
            // echo $lista->fecha_inicio." ".$lista->hora_inicio." ".$lista->hora_fin." ->".$lista->persona_id."<br>";

            $fechaTurno = Carbon::create($lista->fecha_inicio);//->format('Y-m-d 1H:i:s');

            $limiteDespuesE = Carbon::create($lista->hora_inicio)->addHour(2);//->format('H:i:s');
            $limiteAntesE = Carbon::create($lista->hora_inicio)->subHour(2);//->format('H:i:s'); 
            $limiteDespuesS = Carbon::create($lista->hora_fin)->addHour();//->format('H:i:s');
            $limiteAntesS = Carbon::create($lista->hora_fin)->subHour();//->format('H:i:s');

            $toleranciaE =  Carbon::parse($lista->hora_inicio)->addMinute(10);//->format('H:i:s');CONVERT(date, CHECKTIME, 120) BETWEEN $fechaInicio AND $fechaFin
            $toleranciaS =  Carbon::parse($lista->hora_fin);

            $hora_ini = Carbon::parse($lista->hora_inicio);
            $hora_fin = Carbon::parse($lista->hora_fin);

            $sql = "SELECT USERID, CONVERT(date, CHECKTIME ) AS Fecha,
               MIN(CONVERT(datetime, CHECKTIME )) AS PrimeraEntrada,
               MAX(CASE WHEN CONVERT(time, CHECKTIME) > '$hora_fin'  THEN CONVERT(datetime, CHECKTIME) ELSE 0 END ) AS PrimeraSalida,
               SUM(CASE WHEN CONVERT(time, CHECKTIME) > '$toleranciaE' THEN DATEDIFF(MINUTE, '$toleranciaE', CHECKTIME) ELSE 0 END) AS total_atrasos
               FROM CHECKINOUT
               WHERE USERID = $id_per 
               AND CONVERT(date, CHECKTIME ) BETWEEN '$fechaInicio' AND '$fechaFin' 
               GROUP BY USERID, CONVERT(date, CHECKTIME )
               HAVING MIN(CONVERT(datetime, CHECKTIME )) IS NOT NULL 
               ORDER BY  USERID ASC, PrimeraEntrada ASC, PrimeraSalida ASC";

          $res = sqlsrv_query( $conn, $sql);
          if( $res === false) { die( print_r( sqlsrv_errors(), true) ); }
           $atraso=0;
           $userAtrasos = [];

           $atrasosPorUsuario = [];
           while( $row = sqlsrv_fetch_array( $res, SQLSRV_FETCH_ASSOC) ) { 
             $userID = $row['USERID'];
             
             $newDate = Carbon::create($row['PrimeraEntrada'])->format('Y-m-d');
             $DateBio = Carbon::create($newDate);
             $TimeBio = Carbon::create($row['PrimeraEntrada'])->format('H:i:s');
             $horaBio = Carbon::create($TimeBio);

             $userId = $row['USERID'];
             $newDate = Carbon::create($row['PrimeraEntrada'])->format('Y-m-d');
             $DateBio = Carbon::create($newDate);
             $TimeBio = Carbon::create($row['PrimeraEntrada'])->format('H:i:s');
             $horaBio = Carbon::create($TimeBio);

              if($fechaTurno->equalTo($DateBio) ){ 
                if( $horaBio->between($limiteAntesE, $limiteDespuesE) ){ // $horaBio->between($limiteAntesE, $limiteDespuesE)
                  if($horaBio > $toleranciaE){
                    $atraso = $horaBio->diffInMinutes($toleranciaE);
                    $userAtrasos[$userId] = ($userAtrasos[$userId] ?? 0) + $atraso;
                  }
                      // echo $row['USERID'] . " " . $row['PrimeraEntrada']->format('Y-m-d H:i:s')." => ".$fechaTurno." <> ".$toleranciaE . "  Atraso: " . $atraso. "<br>";
                }
              }
            } 
            foreach ($userAtrasos as $userId => $totalAtraso) {    // Mostrar el total de atrasos por usuario
              if ($totalAtraso > 0) {
                echo "iten individual Usuario: " . $userId . " Total de atrasos: " . $totalAtraso . "<br>";}
            }
           sqlsrv_free_stmt($res);
         }
      }

      }else{//para solo una persona
        $id_per = $request->persona;
        $resultado = $resultado->whereHas('rolturno_per',function($query) use($id_per){
        return $query->where("persona_id",$id_per);
        })->where('fecha_inicio','>=',$request->fecha_inicio)->where('fecha_inicio','<=',$request->fecha_fin)->where('tipo_dia', 'DL')->get();
        
        foreach($resultado as $lista ){
          $id_per = $lista->rolturno_per->idper_db;
          // echo $lista->fecha_inicio." ".$lista->hora_inicio." ".$lista->hora_fin." ->".$lista->persona_id."<br>";

          $fechaTurno = Carbon::create($lista->fecha_inicio);//->format('Y-m-d 1H:i:s');

          $limiteDespuesE = Carbon::create($lista->hora_inicio)->addHour(2);//->format('H:i:s');
          $limiteAntesE = Carbon::create($lista->hora_inicio)->subHour(2);//->format('H:i:s'); 
          $limiteDespuesS = Carbon::create($lista->hora_fin)->addHour();//->format('H:i:s');
          $limiteAntesS = Carbon::create($lista->hora_fin)->subHour();//->format('H:i:s');

          $toleranciaE =  Carbon::parse($lista->hora_inicio)->addMinute(10);//->format('H:i:s');CONVERT(date, CHECKTIME, 120) BETWEEN $fechaInicio AND $fechaFin
          $toleranciaS =  Carbon::parse($lista->hora_fin);

          $hora_ini = Carbon::parse($lista->hora_inicio);
          $hora_fin = Carbon::parse($lista->hora_fin);

          $sql = "SELECT USERID, CONVERT(date, CHECKTIME ) AS Fecha,
             MIN(CONVERT(datetime, CHECKTIME )) AS PrimeraEntrada,
             MAX(CASE WHEN CONVERT(time, CHECKTIME) > '$hora_fin'  THEN CONVERT(datetime, CHECKTIME) ELSE 0 END ) AS PrimeraSalida,
             SUM(CASE WHEN CONVERT(time, CHECKTIME) > '$toleranciaE' THEN DATEDIFF(MINUTE, '$toleranciaE', CHECKTIME) ELSE 0 END) AS total_atrasos
             FROM CHECKINOUT
             WHERE USERID = $id_per 
             AND CONVERT(date, CHECKTIME ) BETWEEN '$fechaInicio' AND '$fechaFin' 
             GROUP BY USERID, CONVERT(date, CHECKTIME )
             HAVING MIN(CONVERT(datetime, CHECKTIME )) IS NOT NULL 
             ORDER BY  USERID ASC, PrimeraEntrada ASC, PrimeraSalida ASC";

          $res = sqlsrv_query( $conn, $sql);
          if( $res === false) { die( print_r( sqlsrv_errors(), true) ); }
          $atraso=0;
          $userAtrasos = [];

          $atrasosPorUsuario = [];
          while( $row = sqlsrv_fetch_array( $res, SQLSRV_FETCH_ASSOC) ) { 
            $userID = $row['USERID'];
            
            $newDate = Carbon::create($row['PrimeraEntrada'])->format('Y-m-d');
            $DateBio = Carbon::create($newDate);
            $TimeBio = Carbon::create($row['PrimeraEntrada'])->format('H:i:s');
            $horaBio = Carbon::create($TimeBio);

              $userId = $row['USERID'];
            $newDate = Carbon::create($row['PrimeraEntrada'])->format('Y-m-d');
            $DateBio = Carbon::create($newDate);
            $TimeBio = Carbon::create($row['PrimeraEntrada'])->format('H:i:s');
            $horaBio = Carbon::create($TimeBio);

            if($fechaTurno->equalTo($DateBio) ){ 
              if( $horaBio->between($limiteAntesE, $limiteDespuesE) ){ // $horaBio->between($limiteAntesE, $limiteDespuesE)
                if($horaBio > $toleranciaE){
                  $atraso = $horaBio->diffInMinutes($toleranciaE);
                  $userAtrasos[$userId] = ($userAtrasos[$userId] ?? 0) + $atraso;
                }
                    // echo $row['USERID'] . " " . $row['PrimeraEntrada']->format('Y-m-d H:i:s')." => ".$fechaTurno." <> ".$toleranciaE . "  Atraso: " . $atraso. "<br>";
              }
            }
          } 
          foreach ($userAtrasos as $userId => $totalAtraso) {    // Mostrar el total de atrasos por usuario
            if ($totalAtraso > 0) {
              echo "por persona Usuario: " . $userId . " Total de atrasos: " . $totalAtraso . "<br>";}
          }
          sqlsrv_free_stmt($res);
       }
      }
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

 