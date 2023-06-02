@extends("dashboard/dashboard") <!--extends se situa en views-->
@section('titulo')
 - Habilitacion de Rolturnos
@stop

@section('styles')
{{ Html::style( asset('datatables/dataTables.bootstrap4.min.css') )}}
<style>
    .error {
    color: red;}
</style>
@stop

@section('contenido')

    <div class="row justify-content-center align-content-center">
       <h4> <span >Habilitacion de roles de turnos</span> </h4>
    </div>
    @include('dashboard.mensaje')
    {{--<table class="table table-striped" id="myTable"> </table>--}}
    <table class="table table-sm table-bordered table-striped"  width="100%" id="listaHabilitacionTurnos" >
        <thead>
            <tr class="titulo" > {{--style="background-color: red;display: none;"--}}
                <th width="5px">Nro.</th>
                <th style="" width="30px">Responsable</th>
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
                 {{--dd($rolturno->servicios->user->per_user->nombres)--}}
                    <tr>
                        <td width="3%">{{++$i}}</td>
                        <td width="20%"><span id="responsable{{$rolturno->id}}"  >{{$rolturno->servicios->user->per_user->nombres}} {{$rolturno->servicios->user->per_user->apellidos}}</span></td> {{--{{$rolturno->user->per_user->nombres}} {{$rolturno->user->per_user->apellidos}}--}}
                        <td width="17%"><span id="servicio{{$rolturno->id}}"  >{{$rolturno->servicios->nombre}}</span></td>
                        <td width="8%"><span id="estado{{$rolturno->id}}"  >{{$rolturno->estado}}</span></td>
                        <td  width="8%"><span id="gestion{{$rolturno->id}}" >{{$rolturno->gestion}}</span></td>
                        <td  width="%"><span id="comentario{{$rolturno->id}}" >{{$rolturno->obsevacion}}</span></td>
                        <td  width="19%">
                            <button type="button" class="btn btn-outline-success btn-sm edit" value="{{$rolturno->id}}" data-toggle="modal" data-target="#ModalHabilitarRolturno">Habilitar?</button>
                            <a type="button" class="btn btn-outline-info btn-sm " href="{{route('rolturno.imprimir.pdf', $rolturno->id)}}" target='_Blank'>Ver rolturno</a>
                            {{--@if( $rolturno->estado != 'Temporal') {{--$rolturno->estado != 'Pendiente' && || $rolturno->estado == 'Rechazado'--}
                                <button type="button" class="btn btn-outline-success btn-sm edit" value="{{$rolturno->id}}" data-toggle="modal" data-target="#ModalHabilitarRolturno">Habilitar</button>
                                <a type="button" class="btn btn-outline-info btn-sm " href="{{route('rolturno.imprimir.pdf', $rolturno->id)}}" target='_Blank'>Ver rolturno</a>
                            @else
                                <button type="button" class="btn btn-outline-secondary btn-sm edit" value="{{$rolturno->id}}" data-toggle="modal" data-target="#ModalHabilitarRolturno" disabled>Habilitar</button>
                                <a type="button" class="btn btn-outline-info btn-sm " href="{{route('rolturno.imprimir.pdf', $rolturno->id)}}" target='_Blank'>Ver rolturno</a>
                            @endif--}}
                            @include('habilitacionTurnos.ModalHabilitar')
                        </td>
                    </tr>
                 @endforeach
            @endif
        </tbody>
    </table>

@stop

@section('scripts')
<script src="{{ asset('datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('datatables/dataTables.bootstrap4.min.js') }}"></script>
<script src="{{asset('jquery-validate/jquery.validate.js')}}"></script>
<script type="text/javascript" src="{{ asset('assets/scripts/admin/habilitacion.js') }}"></script>

<script>
    $(document).ready(function () {
        $('#listaHabilitacionTurnos').DataTable({
            "lengthMenu": [[15 , 30, 60, -1], [15 , 30, 60, "All"]],
            language: {
                "lengthMenu": "Mostrar _MENU_ registros",
                "zeroRecords": "No se encontraron resultados",
                "info": "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
                "infoEmpty": "Mostrando registros del 0 al 0 de un total de 0 registros",
                "infoFiltered": "(filtrado de un total de _MAX_ registros)",
                "sSearch": "Buscar:",
                "oPaginate": {
                    "sFirst": "Primero",
                    "sLast":"Último",
                    "sNext":"Siguiente",
                    "sPrevious": "Anterior"
			     },
			     "sProcessing":"Procesando...",
            },
        });
    });
</script>
@stop


  {{--<a data-toggle="modal" href="#habilitar{{ $rolturno->id }}" class="btn btn-outline-success btn-sm habilitacionBtn1"  type="buton">Habilitacion</a>--}}
                             {{---
                            @if($rolturno->estado == 'Pendiente') {{--|| $rolturno->estado == 'Rechazado'--}
                            <a data-toggle="modal" href="#habilitar{{ $rolturno->id }}" class="btn btn-outline-success btn-sm habilitacionBtn1"  type="buton">Habilitacion</a> 
                            <a type="button" class="btn btn-outline-info btn-sm " href="{{route('rolturno.imprimir.pdf', $rolturno->id)}}" target='_Blank'>Ver rolturno</a>
                            @else
                            <a data-toggle="modal"  class="btn btn-outline-secondary btn-sm habilitacionBtn"  type="buton" disabled>Habilitacion</a>
                            <a type="button" class="btn btn-outline-info btn-sm " href="{{route('rolturno.imprimir.pdf', $rolturno->id)}}" target='_Blank'>Ver rolturno</a>
                           @endif
                           @if($rolturno->estado == 'Aceptado')
                           <a type="button" data-toggle="modal" class="btn btn-outline-warning btn-sm CambioAccionBtn" href="#cambioRolTurno{{ $rolturno->id }}">Cambio Accion</a>{{-- style="display: none;"--}
                           @endif
                           --}}
                           {{--@include('habilitacionTurnos.ModalCambioRolTurno')--}}