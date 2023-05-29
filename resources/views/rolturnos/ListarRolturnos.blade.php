
@extends("dashboard/dashboard") <!--extends se situa en views-->
@section('titulo')
 - ListarRolturnos
@stop

@section('styles')
{{ Html::style( asset('datatables/dataTables.bootstrap4.min.css') )}}
@stop

@section('contenido')

    <div class="row justify-content-center align-content-center">
       <h4> <span >Lista de roles de turnos</span> </h4>
       <a type="button" class="btn btn-warning btn-sm " href="{{route('tablas')}}" >tabla</a>
    </div>
    {{--<table class="table table-striped" id="myTable"> </table>--}}
    <table id="listarturnos" class="table table-sm table-bordered table-striped"  width="100%"> 
        <thead>
            <tr class="titulo" > {{--style="background-color: red;display: none;"--}}
                <th width="5px">Nro.</th>
                <th style="" width="60px">Responsable</th>
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
                            <a type="button" class="btn btn-outline-info btn-sm" href="{{route('editar.rolturno.test', $rolturno->id)}}" id="registro">Seguir registrando</a>
                            <a type="button" class="btn btn-outline-warning btn-sm " href="{{route('rolturno.imprimir.pdf', $rolturno->id)}}" target='_Blank' >PDF</a>
                            <a data-toggle="modal" href="#rolturnEnviar{{ $rolturno->id }}" class=" btn btn-outline-success btn-sm"  type="buton">enviar</a>

                            @else
                            {{--<button type="button" class="btn btn-secondary btn-sm editbtn" href="{{route('editar.rolturno', $rolturno->id)}}" disabled>Editar</button>--}}
                            <button type="button" class="btn btn-outline-secondary btn-sm" href="{{route('editar.rolturno.test', $rolturno->id)}}" id="registro" disabled>Seguir registrando</button>
                            <a type="button" class="btn btn-outline-warning btn-sm " href="{{route('rolturno.imprimir.pdf', $rolturno->id)}}" target='_Blank' >PDF</a>
                            <button data-toggle="modal" href="#rolturnEnviar{{ $rolturno->id }}" class=" btn btn-outline-secondary btn-sm"  type="buton" disabled>enviar</button>
                            @endif
                        </td>
                    </tr>
                    @include('rolturnos.EnviarRolturno')
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
        $('#listarturnos').DataTable({
            "lengthMenu": [[5, 15 , 30, 60, -1], [5, 15 , 30, 60, "All"]],
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

