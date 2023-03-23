
@extends("dashboard/dashboard") <!--extends se situa en views-->
@section('contenido')

    <div class="row justify-content-center align-content-center">
       <h4> <span >lista de roles de turnos</span> </h4>
    </div>
    {{--<table class="table table-striped" id="myTable"> </table>--}}
    <table class="table table-striped">
        <thead>
            <tr class="titulo" > {{--style="background-color: red;display: none;"--}}
                <th width="4%">Nro.</th>
                <th style="" width="">Persona</th>
                <th style="" width="">Fecha inicio</th>
                <th style="" width="">Fecha ingreso</th>
                <th style="" width="">Hora ingreso</th>
                <th style="" width="">Hora salida</th>
                <th style="" width="">Tipo dia</th>
                <th style="" width="">turno</th>
                <th style="" width="">Area</th>
                <th style="" width="">Observacion</th>
                <th style="" width="">Estado</th>
                <th style="" width="">Accion</th>
            </tr>
        </thead>
        <?php
        $serverName ="DESKTOP-S9D1IAK"; //"193.168.0.4";// "DESKTOP-S9D1IAK"; //propiedades del servidor->ver propiedades de conexioon->producto-> nombre del servidor
        $connectionInfo = array( "Database"=>"BD_BIOMETRICO", "UID"=>"sa", "PWD"=>"S1af2023");//prueba

        $i=0;
        $rolturnos=App\Models\rolturno\Rolturno::all(); 
        ?>
        <tbody>
            @foreach ($rolturnos as $rolturno)
                    <tr>
                        <td>{{++$i}}</td>
                        <?php 
                         $conn = sqlsrv_connect( $serverName, $connectionInfo) or die(print_r(sqlsrv_errors(), true));
                         $sql="select NAME FROM USERINFO WHERE USERID = $rolturno->id_persona";
                         $res=sqlsrv_query($conn,$sql);
                        // echo $res;
                        while($row=sqlsrv_fetch_array($res) ){ ?>
                            <td><span id="" >{{$row['NAME']}}</span></td>
                        <?php  } sqlsrv_close($conn); ?>  

                        <td><span id="" >{{$rolturno->fecha_inicio}}</span></td>
                        <td><span id="" >{{$rolturno->fecha_fin}}</span></td>
                        <td><span id="" >{{$rolturno->hora_inicio}}</span></td>
                        <td><span id="" >{{$rolturno->hora_fin}}</span></td>
                        <td><span id="" >{{$rolturno->tipo_dia}}</span></td>
                        <td><span id="" >{{$rolturno->turno}}</span></td>
                        <td><span id="" >{{$rolturno->area}}</span></td>
                        <td><span id="" >{{$rolturno->obs}}</span></td>
                        <td><span id="" >{{$rolturno->estado}}</span></td>
                        <td>
                            <button type="button" class="btn btn-primary editbtn" data-toggle="modal" data-target="#ModalEditar">Editar</button>
                            <a type="button" class="btn btn-sm btn-danger" href="{{route('eliminar.roles.turno', $rolturno->id)}}" > Eliminar</a>
                            
                        </td>
                        @include('rolturnos.editarLista')
                    </tr>
            @endforeach
        </tbody>
    </table>
    
@stop

@section('titulo')
 - ListarRolturnos
@stop

@section('styles')
@stop

@section('scripts')
<script type="text/javascript" src="{{ asset('scripts/editarturno.js') }}"></script>
@stop

