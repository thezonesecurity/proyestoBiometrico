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
                    <tr>
                        <td>{{++$i}}</td>
                        <td><span id="" >{{$rolturno->user->per_user->nombres}} {{$rolturno->user->per_user->apellidos}}</span></td>
                        <td><span id="servicio{{$rolturno->id}}" >{{$rolturno->servicios->nombre}}</span></td>
                        <td><span id="" >{{$rolturno->estado}}</span></td>
                        <td><span id="" >{{$rolturno->gestion}}</span></td>
                        <td><span id="" >{{$rolturno->obsevacion}}</span></td>
                        <td>
                            @if($rolturno->estado == 'Pendiente') {{--|| $rolturno->estado == 'Rechazado'--}}
                            <a data-toggle="modal" href="#habilitar{{ $rolturno->id }}" class=" btn btn-success btn-sm"  type="buton">Habilitacion</a>
                            <a type="button" class="btn btn-info btn-sm " href="{{route('rolturno.imprimir.pdf', $rolturno->id)}}" target='_Blank'>Ver rolturno</a>
                            @else
                            <button data-toggle="modal" href="#habilitar{{ $rolturno->id }}" class=" btn btn-secondary btn-sm"  type="buton" disabled>Habilitacion</button>
                            <a type="button" class="btn btn-info btn-sm " href="{{route('rolturno.imprimir.pdf', $rolturno->id)}}" target='_Blank'>Ver rolturno</a>
                           @endif
                           @if($rolturno->estado == 'Aceptado')
                           <a type="button" class="btn btn-warning btn-sm" href="{{route('anular.accion.rolturno', $rolturno->id)}}">Anular Accion</a>
                           @endif
                        </td>
                    </tr>
                    @include('habilitacionTurnos.ModalHabilitar')
                 @endforeach
            @endif
        </tbody>
    </table>

@stop

@section('scripts')
<script src="{{ asset('datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('datatables/dataTables.bootstrap4.min.js') }}"></script>

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
