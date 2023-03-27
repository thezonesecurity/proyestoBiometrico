
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
                <th style="" width="">Servicio</th>

                <th style="" width="">Area</th>
                <th style="" width="">Tipo dia</th>
                <th style="" width="">Fecha inicio</th>
                <th style="" width="">Fecha ingreso</th>
                <th style="" width="">Hora ingreso</th>
                <th style="" width="">Hora salida</th>
                <th style="" width="">turno</th>
                <th style="" width="">Observacion</th>
                <th style="" width="">Estado</th>
                <th style="" width="">Accion</th>
            </tr>
        </thead>
        <tbody> <?php  $i=0; ?>
            @foreach ($per_rolturnos as $rolturno_per)
                    <tr>
                        <td>{{++$i}}</td>
                        <td><span id="" >nombre</span></td>
                        <td><span id="" >serviciio</span></td>
                        <td><span id="" >{{$rolturno_per->area_id}}</span></td>
                        <td><span id="" >{{$rolturno_per->tipo_dia}}</span></td>
                        <td><span id="" >{{$rolturno_per->fecha_inicio}}</span></td>
                        <td><span id="" >{{$rolturno_per->fecha_fin}}</span></td>
                        <td><span id="" >{{$rolturno_per->hora_inicio}}</span></td>
                        <td><span id="" >{{$rolturno_per->hora_fin}}</span></td>
                        <td><span id="" >{{$rolturno_per->turno}}</span></td>
                        <td><span id="" >{{$rolturno_per->obs}}</span></td>
                        <td><span id="" >{{$rolturno_per->estado}}</span></td>
                        <td>
                            <button type="button" class="btn btn-primary editbtn" data-toggle="modal" data-target="#ModalEditar">Editar</button>
                            <a type="button" class="btn btn-sm btn-danger" href="{{route('eliminar.roles.turno', $rolturno_per->id)}}" > Eliminar</a>
                            
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

