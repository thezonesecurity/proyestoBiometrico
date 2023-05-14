

{{--del controlador metodo update--}}
dd($request);
// dd($request->id_user);
 $persona=Persona::where('idper_db',$request->id_user)->first(); 
 //dd($persona);
 $serv= DB::select("select * from repbio.servicios where nombre = '$request->servicio' ");
 $id_servi = $serv[0]->id;
 $area_per = ucwords($request->area);
    //dd($id_servi);
 if($persona){
    // echo 'existe en DB';
     $persona->area = $area_per;
     $persona->item = $request->item;
     $persona->estado_per = 'Habilitado';
     $persona->idper_db = $request->id_user;
     $persona->id_servicio = $id_servi; 
     //dd($persona);
     $persona->save();
     return redirect(route('listar.personal'));
 }
 else {
     //echo 'NO existe en DB';
     $persona = new Persona;
     $persona->area = $area_per;;
     $persona->item = $request->item;
     $persona->estado_per = 'Habilitado';
     $persona->idper_db = $request->id_user;
     $persona->id_servicio = $id_servi; 
    // dd($persona);
     $persona->save();
     return redirect(route('listar.personal'));
 }


{{--DE LA LISTA MOSTRAR PERSONAL--}}
 <tbody>
    <?php if(!$res) {?>
        <tr> <td colspan="8">No hay datos para mostrar</td> </tr>
        <?php }//#ModalEditarPersonal{{$row['USERID']}}
        else { 
            
            while($row=sqlsrv_fetch_array($res) ) {?>
            
        <tr>
            <td>{{++$i}}</td>
           
            <td><span id="nombre<?php echo $row['USERID']; ?>" >{{$row['NAME']}}</span></td>
            <td><span id="ci<?php echo $row['USERID']; ?>" >{{$row['BADGENUMBER']}}</span></td>
            <?php $persona=App\Models\personal\Persona::orderBy('id')->where('idper_db',$row['USERID'])->first(); ?>
            @if(isset($persona)) 
                <td><span id="item{{$persona->id}}" >{{$persona->PersonaItem->nombre}}</span></td>
                <?php $servicio=App\Models\servicios\Servicio::where('id',$persona->id_servicio)->first(); ?>
                <td><span id="servicio{{$persona->id}}" >{{$servicio->nombre}}</span></td>
                <td><span id="estado{{$persona->id}}" >{{$persona->estado_per}}</span></td>
    
            @else
                <td><span id="item" >Sin item</span></td>
                <td><span id="servicio" >Sin servicio</span></td>
                <td><span id="estado" >Sin estado</span></td>
               
            @endif   
            <?php $persona=App\Models\personal\Persona::orderBy('id')->where('idper_db',$row['USERID'])->first(); ?>
            <td>
                @if(isset($persona))
                    @if( $persona->estado_per == 'Habilitado' ) {{--&& $persona->idper_db !== $row['USERID']   {{$persona->id}},{{$row['USERID']}}  --}} 
                        <button type="button" class="btn btn-success btn-sm edit" value="{{$persona->id}},{{$row['USERID']}}" data-toggle="modal" data-target="#editarModal">Editar</button>  
                        @include('personal.editarPersonal')
                        <a href="{{ route('inhabilitar.persona', $row['USERID'])}}" type="buton" class="btn btn-sm btn-danger">Inhabilitar</a>
                    @else
                         <button type="button" class="btn btn-secondary btn-sm edit" value="{{$persona->id}},{{$row['USERID']}}" data-toggle="modal" data-target="#editarModal" disabled>Editar</button>  
                        <a href="{{ route('habilitar.persona', $row['USERID'])}}" type="buton" class="btn btn-sm btn-warning">Habilitar</a>
                    @endif 
                @else   
                    <div>{{--las dos lineas siguientes no son funcionales pero son requisito para el modal de registrar--}}
                        <button type="button" class="btn btn-danger btn-sm registrar" data-toggle="modal" data-target=".registrarModal" style="display: none">Añadir Error NO FUNCIONAL</button>  
                        @include('personal.modalErrorRegistrarPersona')
                    </div>
                    <button type="button" class="btn btn-info btn-sm registrarModal" value="{{$row['USERID']}}" data-toggle="modal" data-target="#exampleModal">Añadir</button> {{--esta linea funcional--}}
                @endif    
            </td>
        </tr>
        <?php
        }//Fin while 
        }//Fin if
        sqlsrv_close($conn); ?>  
        @include('personal.registrar')
    </tbody>