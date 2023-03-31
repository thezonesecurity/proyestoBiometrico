
@extends("dashboard/dashboard") <!--extends se situa en views-->
@section('contenido')

    <div class="row justify-content-center align-content-center">
       <h4> <span >lista de roles de turnos</span> </h4>
       <a type="button" class="btn btn-warning btn-sm " href="{{route('tablas')}}" >tabla</a>
    </div>
    {{--<table class="table table-striped" id="myTable"> </table>--}}
    <table class="table table-striped table-sm">
        <thead>
            <tr class="titulo" > {{--style="background-color: red;display: none;"--}}
                <th width="4%">Nro.</th>
                <th style="" width="">Usuario</th>
                <th style="" width="">Servicio</th>
                <th style="" width="">Estado</th>
                <th style="" width="">Accion</th>
            </tr>
        </thead>
        <tbody> <?php  $i=0; ?>
            @foreach ($rolturnos as $rolturno)
                    <tr>
                        <td>{{++$i}}</td>
                        <td><span id="" >{{$rolturno->user->per_user->nombres}} {{$rolturno->user->per_user->apellidos}}</span></td>
                        <td><span id="" >{{$rolturno->servicios->nombre}}</span></td>
                        <td><span id="" >{{$rolturno->estado}}</span></td>
                        <td>
                           {{-- <button type="button" class="btn btn-primary btn-sm editbtn" data-toggle="modal" data-target="#ModalEditar">Editar</button>--}}
                            <a type="button" class="btn btn-primary btn-sm editbtn" href="{{route('editar.rolturno', $rolturno->id)}}" >Editar</a>
                            <a type="button" class="btn btn-primary btn-sm editbtn" href="" >Seguir registrando</a>
                            <a type="button" class="btn btn-warning btn-sm " href="{{route('rolturno.imprimir.pdf', $rolturno->id)}}" >Reporte PDF</a>
                        </td>
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

