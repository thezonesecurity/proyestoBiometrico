 public function reportOne(Request $request)
    {
      // dd($request);
      $resultado=PersonaRolturno::query();
      $serverName = "DESKTOP-S9D1IAK"; //"193.168.0.4";// "DESKTOP-S9D1IAK"; //propiedades del servidor->ver propiedades de conexioon->producto-> nombre del servidor
      $connectionInfo = array( "Database"=>"BD_BIOMETRICO", "UID"=>"sa", "PWD"=>"Sice2023");
      $conn = sqlsrv_connect( $serverName, $connectionInfo );
      if( $conn === false ) { die( print_r( sqlsrv_errors(), true)); }

      if($request->opcion == 'Todos'){ //para todas las personas
        
        if($request->tipo_item == 'all'){//para todos los items i contratos
            $resultado = PersonaRolturno::where('fecha_inicio','>=',$request->fecha_inicio)->where('fecha_inicio','<=',$request->fecha_fin)->where('tipo_dia', 'DL')->get();
            foreach($resultado as $lista ){
              $id_per = $lista->rolturno_per->idper_db;
              $sql = "SELECT USERID, CHECKTIME FROM CHECKINOUT WHERE USERID = $id_per";
              $res = sqlsrv_query( $conn, $sql );
              if( $res === false) { die( print_r( sqlsrv_errors(), true) ); }
              while( $row = sqlsrv_fetch_array( $res, SQLSRV_FETCH_ASSOC) ) {
                //$newDate = $row['CHECKTIME']->format('d/m/Y H:m:s'); 
                $newDate = $row['CHECKTIME'];
                $DateBio = Carbon::parse($row['CHECKTIME'])->format('Y-m-d');
                $TimeBio = Carbon::parse($row['CHECKTIME'])->format('H:i:s');
                if($lista->fecha_inicio === $DateBio){
                  //echo $row['USERID']." ".$DateBio." -> ".$TimeBio." ==> ".$lista->fecha_inicio." ->".$lista->hora_inicio." -> ".$lista->hora_fin."<br />";
                }
              }
              sqlsrv_free_stmt( $res);
              //echo 'todos-> '.$lista->persona_id." -> ".$lista->fecha_inicio." ->".$lista->hora_inicio." -> ".$lista->hora_fin."<br />";
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

              $fechaTurno = Carbon::create($lista->fecha_inicio);
              $limiteDespuesE = Carbon::create($lista->hora_inicio)->addHour(2);//->format('H:i:s');
              $limiteAntesE = Carbon::create($lista->hora_inicio)->subHour(2);//->format('H:i:s'); 
              $limiteDespuesS = Carbon::create($lista->hora_fin)->addHour();//->format('H:i:s');
              $limiteAntesS = Carbon::create($lista->hora_fin)->subHour();//->format('H:i:s');

              $toleranciaE =  Carbon::parse($lista->hora_inicio)->addMinute(10);//->format('H:i:s');
              $toleranciaS =  Carbon::parse($lista->hora_fin);

              $sql = "SELECT USERID, CHECKTIME FROM CHECKINOUT WHERE USERID = $id_per";
              $res = sqlsrv_query( $conn, $sql );
              if( $res === false) { die( print_r( sqlsrv_errors(), true) ); }
              $cont=0;
              $atrasos=0;
              while( $row = sqlsrv_fetch_array( $res, SQLSRV_FETCH_ASSOC) ) { 
               
                $newDate = Carbon::create($row['CHECKTIME'])->format('Y-m-d');
                $DateBio = Carbon::create($newDate);
               
                $TimeBio = Carbon::create($row['CHECKTIME'])->format('H:i:s');
                $horaBio = Carbon::create($TimeBio);
                if($fechaTurno->equalTo($DateBio)){ 

                  
                  if($horaBio->between($limiteAntesE, $limiteDespuesE)){
                    if($horaBio->gt($toleranciaE)){
                      $atrasos = $horaBio->diffInMinutes($toleranciaE);
                    }
                    if($horaBio->gt($toleranciaS)){
                      $atrasos = $horaBio->diffInMinutes($toleranciaS);
                    }
                 
                }
                
                echo $row['USERID']." ".$DateBio." -> ".$TimeBio." ==> ".$fechaTurno." ->".$lista->hora_inicio." -> ".$lista->hora_fin." <= ".$toleranciaE." -> ".$atrasos."<br />";
                //    echo $row['USERID']." ".$DateBio." -> ".$TimeBio." ==> ".$lista->fecha_inicio." -> ".$toleranciaE." -> ".$atrasos." -> ".$cont."<br />";
           
           //    break; // continue(2);
               /*  if(($limiteAntesE <= $TimeBio && $TimeBio <= $limiteDespuesE) || ($limiteAntesS <= $TimeBio && $TimeBio <= $limiteDespuesS)){
                    if($TimeBio > $toleranciaE){
                      $atrasos = $horaBio->diffInMinutes($toleranciaE);
                      $cont = $cont + $atrasos;
                    }

                    echo $row['USERID']." ".$DateBio." -> ".$TimeBio." ==> ".$lista->fecha_inicio." -> ".$toleranciaE." -> ".$atrasos." -> ".$cont."<br />";
                     continue(2);
                  }*/
            
                }
               
              }

               // $tiempoS = Carbon::createFromFormat('H:i:s', $tiempoS);
              // $tiempoS =  Carbon::parse($lista->hora_fin)->addMinute(10)->format('H:i:s');
              //$toleranciaS = Carbon::createFromFormat('H:i:s', $tiempoS);

               //   $tiempo = Carbon::create($lista->hora_inicio)->addMinute(10)->format('H:i:s');
             //  $toleranciaE = Carbon::create($lista->hora_inicio)->addMinute(10)->format('H:i:s'); // Carbon::createFromFormat('H:i:s', $tiempo);

              // echo $row['USERID']." ".$DateBio." -> ".$TimeBio." ==> ".$lista->fecha_inicio." ->".$lista->hora_inicio." -> ".$lista->hora_fin."<br />";
               // echo $row['USERID']." ".$DateBio." -> ".$TimeBio." ==> ".$limiteAntesE." ->".$limiteDespuesE." => ".$limiteAntesS. " -> ".$limiteDespuesS."<br />";

             /* $Bio = Carbon::parse($row['CHECKTIME'])->format('H:i:s');
                $Bios = Carbon::create($Bio);
                $bio = gettype($Bios); 

              $limiteDespuesE = Carbon::parse($lista->hora_inicio)->addHour()->format('H:i:s');
               $limiteAntesE = Carbon::parse($lista->hora_inicio)->subHour()->format('H:i:s'); 
               $limiteDespuesS = Carbon::parse($lista->hora_fin)->addHour()->format('H:i:s');
               $limiteAntesS = Carbon::parse($lista->hora_fin)->subHour()->format('H:i:s');
              
               $tiempo = Carbon::parse($lista->hora_inicio)->addMinute(10)->format('H:i:s');
               $toleranciaE = Carbon::createFromFormat('H:i:s', $tiempo);
             //$datos=[];$tempE=[];$tempS=[];
              //$auxfecha=null;$fechaTemp=null;$auxhora=null;$controlF=0;$controlH=0;
             / *while( $row = sqlsrv_fetch_array( $res, SQLSRV_FETCH_ASSOC) ) { 
                $newDate = $row['CHECKTIME'];
                $DateBio = Carbon::parse($row['CHECKTIME'])->format('Y-m-d');
                $TimeBio = Carbon::parse($row['CHECKTIME'])->format('H:i:s');
                $horaBio = Carbon::parse($row['CHECKTIME'])->format('H');
                
                if($lista->fecha_inicio === $DateBio){
                  $auxfecha = $DateBio;
                  $fechaValidaExiste = false;
                  if($DateBio === $auxfecha && $controlF==0){
                   // echo gettype($TimeBio.' .-. '.$limiteAntesE);  
                    //echo $row['USERID']." ".$DateBio." -> ".$TimeBio." => ".$auxfecha." => ".$horaBio."<br />";
             
                    if($limiteAntesE <= $TimeBio && $TimeBio <= $limiteDespuesE){
                      $tempE = collect([
                        'id_user' => $row['USERID'],
                        'fechaBio' => $DateBio,
                        'tiempoBio' => $TimeBio,
                        'hora' => $horaBio
                      ]);
                      $fechaValidaExiste = true;
                      if($cont === 0 && $fechaValidaExiste){
                        $datos=$tempE;
                        $tempE=[];
                        $cont=1;
                        $auxfecha = $DateBio;
                        $controlF=1;
                        continue;
                        break;
                        $fechaValidaExiste =false;
                      
                      }else{
                        $auxfecha = $DateBio;
                        //continue;
                        $fechaValidaExiste =false;
                        break;
                      }
                    
                  
                  }else{
                    //$cont = 0;
                  }
                  }        
                } 

                  /*  if(($limiteAntesE <= $TimeBio && $TimeBio <= $limiteDespuesE) || ($limiteAntesS <= $TimeBio && $TimeBio <= $limiteDespuesS)){
                    if($TimeBio > $toleranciaE){
                      $atrasos = $horaBio->diffInMinutes($toleranciaE);
                      $cont = $cont + $atrasos;
                    }

                    echo $row['USERID']." ".$DateBio." -> ".$TimeBio." ==> ".$lista->fecha_inicio." -> ".$toleranciaE." -> ".$atrasos." -> ".$cont."<br />";
                     continue(2);
                  }* /

              }*/
              sqlsrv_free_stmt( $res);
             // echo 'item sin contrato-> '.$lista->persona_id." -> ".$lista->fecha_inicio." ->".$lista->hora_inicio." -> ".$lista->hora_fin."<br />";
           // echo(count($datos));
           
          /* foreach($datos as $dato){
            //dd($dato);  //    dd(count($datos));
             echo $datos['id_user'].' '.$datos['fechaBio'].' '.$datos['tiempoBio'].' '.$datos['hora']."<br />";
            }*/
            }
            
            

        }
        if($request->tipo_item != 'item' && $request->tipo_item != 'all'){//para los items invividules
            $item_id = $request->tipo_item;
            $resultado = $resultado->whereHas('rolturno_per',function($query) use($item_id){
              return $query->where("item_id",$item_id);
            })->where('fecha_inicio','>=',$request->fecha_inicio)->where('fecha_inicio','<=',$request->fecha_fin)->where('tipo_dia', 'DL')->get();
            foreach($resultado as $lista ){
              $id_per = $lista->rolturno_per->idper_db;
         
              $sql = "SELECT USERID, CHECKTIME FROM CHECKINOUT WHERE USERID = $id_per";
              $res = sqlsrv_query( $conn, $sql );
              if( $res === false) { die( print_r( sqlsrv_errors(), true) ); }
              while( $row = sqlsrv_fetch_array( $res, SQLSRV_FETCH_ASSOC) ) {
                //$newDate = $row['CHECKTIME']->format('d/m/Y H:m:s'); 
                $newDate = $row['CHECKTIME'];
                $DateBio = Carbon::parse($row['CHECKTIME'])->format('Y-m-d');
                $TimeBio = Carbon::parse($row['CHECKTIME'])->format('H:i:s');
                if($lista->fecha_inicio === $DateBio){
                  echo $row['USERID']." ".$DateBio." -> ".$TimeBio." ==> ".$lista->fecha_inicio." ->".$lista->hora_inicio." -> ".$lista->hora_fin."<br />";
                }
              }
              sqlsrv_free_stmt( $res);
              //echo 'item individual-> '.$lista->persona_id." -> ".$lista->fecha_inicio." ->".$lista->hora_inicio." -> ".$lista->hora_fin."<br />";
            }
        }

      }else{//para solo una persona
            $id_per = $request->persona;
            $resultado = $resultado->whereHas('rolturno_per',function($query) use($id_per){
              return $query->where("persona_id",$id_per);
            })->where('fecha_inicio','>=',$request->fecha_inicio)->where('fecha_inicio','<=',$request->fecha_fin)->where('tipo_dia', 'DL')->get();
            foreach($resultado as $lista ){
              $id_per = $lista->rolturno_per->idper_db;
         
              $sql = "SELECT USERID, CHECKTIME FROM CHECKINOUT WHERE USERID = $id_per";
              $res = sqlsrv_query( $conn, $sql );
              if( $res === false) { die( print_r( sqlsrv_errors(), true) ); }
              while( $row = sqlsrv_fetch_array( $res, SQLSRV_FETCH_ASSOC) ) {
                //$newDate = $row['CHECKTIME']->format('d/m/Y H:m:s'); 
                $newDate = $row['CHECKTIME'];
                $DateBio = Carbon::parse($row['CHECKTIME'])->format('Y-m-d');
                $TimeBio = Carbon::parse($row['CHECKTIME'])->format('H:i:s');
                if($lista->fecha_inicio === $DateBio){
                  echo $row['USERID']." ".$DateBio." -> ".$TimeBio." ==> ".$lista->fecha_inicio." ->".$lista->hora_inicio." -> ".$lista->hora_fin."<br />";
                }
              }
              sqlsrv_free_stmt( $res);
             //echo 'persona-> '.$lista->persona_id." -> ".$lista->fecha_inicio." ->".$lista->hora_inicio." -> ".$lista->hora_fin."<br />";
            }
      }
    }