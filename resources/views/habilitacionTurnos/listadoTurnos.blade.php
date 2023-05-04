@extends("dashboard/dashboard") <!--extends se situa en views-->
@section('contenido')

    <div class="row justify-content-center align-content-center">
       <h4> <span >Habilitacion de roles de turnos</span> </h4>
    </div>
    {{--<table class="table table-striped" id="myTable"> </table>--}}
    <table class="table table-striped table-sm">
        <thead>
            <tr class="titulo" > {{--style="background-color: red;display: none;"--}}
                <th width="5px">Nro.</th>
                <th style="" width="30px">Usuario</th>
                <th style="" width="30px">Servicio</th>
                <th style="" width="20px">Estado</th>
                <th style="" width="20px">Gestion</th>
                <th style="" width="120">Observacion</th>
                <th style="" width="180">Accion</th>
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
                        <td><span id="" >{{$rolturno->estado}}</span></td>
                        <td><span id="" >{{$rolturno->gestion}}</span></td>
                        <td><span id="" >{{$rolturno->obsevacion}}</span></td>
                        <td>
                            @if($rolturno->estado == 'Pendiente' || $rolturno->estado == 'Rechazado')
                            <a data-toggle="modal" href="#habilitar{{ $rolturno->id }}" class=" btn btn-success btn-sm"  type="buton">Habilitacion</a>
                            <a type="button" class="btn btn-info btn-sm " href="{{route('rolturno.imprimir.pdf', $rolturno->id)}}" target='_Blank'>Ver rolturno</a>
                            <a type="button" class="btn btn-info btn-sm " href="" >Habilitacion Temporal</a>
                            @else
                            <button data-toggle="modal" href="#habilitar{{ $rolturno->id }}" class=" btn btn-secondary btn-sm"  type="buton" disabled>Habilitacion</button>
                            <a type="button" class="btn btn-info btn-sm " href="{{route('rolturno.imprimir.pdf', $rolturno->id)}}" target='_Blank'>Ver rolturno</a>
                           @endif
                        </td>
                    </tr>
                    @include('habilitacionTurnos.ModalHabilitar')
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
<script>
    $(document).ready(function(){
        
    )};
</script>
@stop
