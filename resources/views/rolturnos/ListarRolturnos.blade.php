
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
                <th width="5px">Nro.</th>
                <th style="" width="60px">Usuario</th>
                <th style="" width="60px">Servicio</th>
                <th style="" width="20px">Estado</th>
                <th style="" width="20px">Gestion</th>
                <th style="" width="100">Observacion</th>
                <th style="" width="40">Accion</th>
            </tr>
        </thead>
        <tbody> <?php  $i=0; ?>
            @if($rolturnos->isEmpty() && $rolturnos->count() == 0) 
                <tr>
                    <td colspan="7" class="">No hay registros que mostrar </td>
                </tr>
            @else 
                 @foreach ($rolturnos as $rolturno)
                    <tr>
                        <td>{{++$i}}</td>
                        <td><span id="" >{{$rolturno->user->per_user->nombres}} {{$rolturno->user->per_user->apellidos}}</span></td>
                        <td><span id="servicio{{$rolturno->id}}" >{{$rolturno->servicios->nombre}}</span></td>
                        {{--<td><span id="" >{{$rolturno->estado}}</span></td>--}}
                        <td><span id="" >{{$rolturno->estado}}</span></td>
                        <td><span id="" >{{$rolturno->gestion}}</span></td>
                        <td><span id="" >{{$rolturno->obsevacion}}</span></td>
                        <td>
                            @if($rolturno->estado == 'Temporal' || $rolturno->estado == 'Rechazado')
                            {{--<a type="button" class="btn btn-primary btn-sm editbtn" href="{{route('editar.rolturno', $rolturno->id)}}" >Editar</a>--}}
                            <a type="button" class="btn btn-info btn-sm" href="{{route('editar.rolturno.test', $rolturno->id)}}" id="registro">Seguir registrando</a>
                            <a type="button" class="btn btn-warning btn-sm " href="{{route('rolturno.imprimir.pdf', $rolturno->id)}}" >Reporte PDF</a>
                            <a data-toggle="modal" href="#rolturnEnviar{{ $rolturno->id }}" class=" btn btn-success btn-sm"  type="buton">enviar</a>

                            @else
                            {{--<button type="button" class="btn btn-secondary btn-sm editbtn" href="{{route('editar.rolturno', $rolturno->id)}}" disabled>Editar</button>--}}
                            <button type="button" class="btn btn-secondary btn-sm" href="{{route('editar.rolturno.test', $rolturno->id)}}" id="registro" disabled>Seguir registrando</button>
                            <a type="button" class="btn btn-warning btn-sm " href="{{route('rolturno.imprimir.pdf', $rolturno->id)}}" >Reporte PDF</a>
                            <button data-toggle="modal" href="#rolturnEnviar{{ $rolturno->id }}" class=" btn btn-secondary btn-sm"  type="buton" disabled>enviar</button>
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

