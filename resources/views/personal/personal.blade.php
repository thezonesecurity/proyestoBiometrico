@extends("dashboard/dashboard") <!--extends se situa en views-->
@section('contenido')
{{--dd($data)--}}
<div class=" table-responsive d-flex justify-content-center " style="margin-left: auto" ><!--style="margin-left: 250px"-->
  <div class="col"> 
    <div class="box-body table-responsive-sm table-responsive-md table-responsive-lg table-responsive-xl">
        <h3 class="box-title text-center">Lista del personal H.D.B.</h3>
        <table id="example" class="table table-bordered table-striped"  width="90%">
            <thead>
                <tr>
                    <th scope="col" >Nro.</th>       
                    
                    <th scope="col" >Nombre Completo</th>
                    <th scope="col">C.I.</th>
                    <th scope="col">Item</th>
                    <th scope="col">Servicio</th>
                    <th scope="col">Cargo</th>
                    <th scope="col">Estado</th>
                    <th scope="col">Opciones</th>
                  </tr>
            </thead>
            <?php
            $serverName ="DESKTOP-S9D1IAK"; //"193.168.0.4";// "DESKTOP-S9D1IAK"; //propiedades del servidor->ver propiedades de conexioon->producto-> nombre del servidor
            $connectionInfo = array( "Database"=>"BD_BIOMETRICO", "UID"=>"sa", "PWD"=>"S1af2023");//prueba
            $conn = sqlsrv_connect( $serverName, $connectionInfo) or die(print_r(sqlsrv_errors(), true));
            
            $sql="select * FROM USERINFO;"; //personas
            $res=sqlsrv_query($conn,$sql);
            $i=0;
            ?>
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
                    <?php $persona=App\Models\personal\Persona::where('idper_db',$row['USERID'])->first(); ?>
                    @if(isset($persona)) 
                        <td><span id="item{{$persona->id}}" >{{$persona->item}}</span></td>
                        <td><span id="servicio{{$persona->id}}" >{{$persona->servicio->nombre}}</span></td>
                        <td><span id="area{{$persona->id}}" >{{$persona->area}}</span></td>
                        <td><span id="estado{{$persona->id}}" >{{$persona->estado_per}}</span></td>

                    @else
                        <td><span id="item" >Sin item</span></td>
                        <td><span id="servicio" >Sin servicio</span></td>
                        <td><span id="area{{'Sin area'}}" >Sin area</span></td>
                        <td><span id="estado" >Sin estado</span></td>
                       
                    @endif   
                    <?php $persona=App\Models\personal\Persona::where('idper_db',$row['USERID'])->first(); ?>
                    <td>
                        @if(isset($persona))
                            @if( $persona->estado_per == 'Habilitado' ) {{--&& $persona->idper_db !== $row['USERID']--}} 
                                <button type="button" class="btn btn-sm btn-success edit" value="<?php echo $row['USERID']; ?>"> Editar</button>
                                <a href="{{ route('inhabilitar.persona', $row['USERID'])}}" type="buton" class="btn btn-sm btn-danger">Inhabilitar</a>
                            @else
                                <button type="button" class="btn btn-sm btn-secondary edit" value="<?php echo $row['USERID']; ?>" disabled> Editar</button>
                                <a href="{{ route('habilitar.persona', $row['USERID'])}}" type="buton" class="btn btn-sm btn-warning">Habilitar</a>
                            @endif 
                        @else   
                            <button type="button" class="btn btn-sm btn-info edit" value="<?php echo $row['USERID']; ?>">Añadir</button>
                        @endif    
                        @include('personal.editarPersonal')
                    </td>
                </tr>
                <?php
                }//Fin while 
                }//Fin if
                sqlsrv_close($conn); ?>  
        </tbody>
        </table>
    </div>
</div>

@stop

@section('titulo')
 - Personal
@stop

@section('styles')
@stop

@section('scripts')
{{ Html::script( asset('scripts/enviarpersonalmodal.js') )}}
@stop


