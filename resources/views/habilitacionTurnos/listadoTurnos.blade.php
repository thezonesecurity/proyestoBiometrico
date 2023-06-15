@extends("dashboard/dashboard") <!--extends se situa en views-->
@section('titulo')
 - Habilitacion de Rolturnos
@stop

@section('styles')
{{ Html::style( asset('datatables/dataTables.bootstrap4.min.css') )}}
{{ Html::style( asset('assets/styles/preloader.css') )}}
@stop

@section('contenido')
<div id="contenedor_carga"><div id="carga"></div></div>
<marquee>
    <span class="text-info">Temporal = sigue registrando rol turno <i class="bi bi-circle ml-1" style="font-size: 1rem;"></i> </span>||
    <span class="text-primary">Pendiente = rol turno enviado <i class="bi bi-circle-half" style="font-size: 1rem;"></i> </span>||
    <span class="text-success">Aceptado = rol turno aceptado <i class="bi bi-circle-fill" style="font-size: 1rem;"></i> </span>||
    <span class="text-danger">Rechazado = rol turno rechazado <i class="bi bi-slash-circle" style="font-size: 1rem;"></i>  </span>
</marquee>

    <div class="row justify-content-center align-content-center">
       <h4 class="font-weight-bold" >Habilitacion de roles de turnos de los servicios H.D.B.</h4>
    </div>
    @include('dashboard.mensaje')
    <table class="table table-sm table-bordered table-striped"  width="100%" id="listaHabilitacionTurnos" style="font-size: 14px;">
        <thead>
            <tr class="titulo" >
                <th width="5px">Nro.</th>
                <th style="" width="30px">Responsable</th>
                <th style="" width="30px">Servicio</th>
                <th style="" width="23px">Estado</th>
                <th style="" width="20px">Gestion</th>
                <th style="" width="250px">Observacion</th>
                <th style="" width="30px">Accion</th>
            </tr>
        </thead>
        <tbody> <?php  $i=0; ?>
            @if($rolturnos->isEmpty() && $rolturnos->count() == 0) 
                <tr>
                    <td colspan="7" class="">No hay registros que mostrar </td>
                </tr>
            @else 
                 @foreach ($rolturnos as $rolturno) {{--dd($rolturno->servicios->user->per_user->nombres)--}}
                    <tr>
                        <td width="3%">{{++$i}}</td>
                        <td width="20%" id="responsable{{$rolturno->id}}"  >{{$rolturno->servicios->user->per_user->nombres}} {{$rolturno->servicios->user->per_user->apellidos}}</td> {{--{{$rolturno->user->per_user->nombres}} {{$rolturno->user->per_user->apellidos}}--}}
                        <td width="17%" id="servicio{{$rolturno->id}}"  >{{$rolturno->servicios->nombre}}</td>
                        @if($rolturno->estado == 'Temporal')
                            <td width="8%" class="text-info" id="estado{{$rolturno->id}}"  >{{$rolturno->estado}} <i class="bi bi-circle ml-1" style="font-size: 1rem;"></i></td> @endif
                        @if($rolturno->estado == 'Pendiente')
                            <td width="8%" class="text-primary" id="estado{{$rolturno->id}}"  >{{$rolturno->estado}} <i class="bi bi-circle-half" style="font-size: 1rem;"></i></td> @endif
                         @if($rolturno->estado == 'Aceptado')
                            <td width="8%" class="text-success" id="estado{{$rolturno->id}}"  >{{$rolturno->estado}} <i class="bi bi-circle-fill ml-1" style="font-size: 1rem;"></i></td> @endif
                         @if($rolturno->estado == 'Rechazado')
                            <td width="9%" class="text-danger" id="estado{{$rolturno->id}}"  >{{$rolturno->estado}} <i class="bi bi-slash-circle" style="font-size: 1rem;"></i></td> @endif
                        <td  width="8%" id="gestion{{$rolturno->id}}" >{{$rolturno->gestion}}</td>
                        <td  width="%" id="comentario{{$rolturno->id}}" >{{$rolturno->obsevacion}}</td>
                        <td  width="15%">
                            <button type="button" class="btn btn-outline-success btn-sm edit ml-1" value="{{$rolturno->id}}" data-toggle="modal" data-target="#ModalHabilitarRolturno">Habilitar?</button>
                            <a type="button" class="btn btn-outline-info btn-sm ml-1" href="{{route('rolturno.imprimir.pdf', $rolturno->id)}}" target='_Blank'>Ver PDF</a>
                        </td>
                    </tr>
                 @endforeach
            @endif
        </tbody>
    </table>
    @include('habilitacionTurnos.ModalHabilitar')
@stop

@section('scripts')
<script>
    window.onload = function(){
        var contenedor = document.getElementById('contenedor_carga');
        contenedor.style.visibility = 'hidden';
        contenedor.style.opacity = '0';
    }
</script>
<script src="{{asset('jquery-validate/jquery.validate.js')}}"></script>
<script type="text/javascript" src="{{ asset('assets/scripts/admin/habilitacion.js') }}"></script>

<script src="{{ asset('datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('datatables/dataTables.bootstrap4.min.js') }}"></script>
<script>
    $(document).ready(function () {
        var table = $('#listaHabilitacionTurnos').DataTable({
            "lengthMenu": [[15 , 30, 60, -1], [15 , 30, 60, "All"]],
            language: {
                "sProcessing":"Procesando...",
                "lengthMenu": "Mostrar _MENU_ registros",
                "zeroRecords": "No se encontraron resultados",
                "emptyTable": "No hay datos disponibles en la Tabla",
                "info": "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
                "infoEmpty": "Mostrando registros del 0 al 0 de un total de 0 registros",
                "infoFiltered": "(filtrado de un total de _MAX_ registros)",
                "loadingRecords": "Cargando...",
                "sSearch": "Buscar:",
                "oPaginate": {
                    "sFirst": "Primero",
                    "sLast":"Último",
                    "sNext":"Siguiente",
                    "sPrevious": "Anterior"
			     },
                  "aria": {
                    "sortAscending": ": orden ascendente",
                    "sortDescending": ": orden descendente"
                },
                  "buttons": {
                    "copy": "Copiar",
                    "updateState": "Actualizar"
                }
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