
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
                <th style="" width="">Fecha</th>
                <th style="" width="">Accion</th>
            </tr>
        </thead>
        <tbody> <?php  $i=0; ?>
            @if($rolturnos->isEmpty() && $rolturnos->count() == 0) 
                <tr>
                    <td colspan="5" class="">No hay registros que mostrar </td>
                </tr>
            @else 
                 @foreach ($rolturnos as $rolturno)
                    <tr>
                        <td>{{++$i}}</td>
                        <td><span id="" >{{$rolturno->user->per_user->nombres}} {{$rolturno->user->per_user->apellidos}}</span></td>
                        <td><span id="servicio{{$rolturno->id}}" >{{$rolturno->servicios->nombre}}</span></td>
                        <td><span id="" >{{$rolturno->estado}}</span></td>
                        <td><span id="" >{{$rolturno->created_at}}</span></td>
                        <td>
                            @if($rolturno->estado == 'Temporal' || $rolturno->estado == 'Rechazado')
                            <a type="button" class="btn btn-primary btn-sm editbtn" href="{{route('editar.rolturno', $rolturno->id)}}" >Editar</a>
                            <a type="button" class="btn btn-info btn-sm" href="{{route('editar.rolturno.test', $rolturno->id)}}" id="registro">Seguir registrando</a>
                            <a type="button" class="btn btn-warning btn-sm " href="{{route('rolturno.imprimir.pdf', $rolturno->id)}}" >Reporte PDF</a>
                            <a data-toggle="modal" href="#rolturnEnviar{{ $rolturno->id }}" class=" btn btn-danger btn-sm"  type="buton">enviar</a>

                            @else
                            <a type="button" class="btn btn-secondary btn-sm editbtn" href="{{route('editar.rolturno', $rolturno->id)}}" disabled>Editar</a>
                            <a type="button" class="btn btn-secondary btn-sm" href="{{route('editar.rolturno.test', $rolturno->id)}}" id="registro" disabled>Seguir registrando</a>
                            <a type="button" class="btn btn-warning btn-sm " href="{{route('rolturno.imprimir.pdf', $rolturno->id)}}" >Reporte PDF</a>
                            <a data-toggle="modal" href="#rolturnEnviar{{ $rolturno->id }}" class=" btn btn-secondary btn-sm"  type="buton" disabled>enviar</a>
                            @endif
                        </td>
                    </tr>
                    @include('rolturnos.EnviarRolturno')
                 @endforeach
            @endif
        </tbody>
    </table>

@stop

@section('titulo')
 - ListarRolturnos
@stop

@section('styles')
@stop

@section('scripts')

@stop

