
@extends("dashboard/dashboard") <!--extends se situa en views-->
@section('titulo')
 - Listar Rolturnos
@stop

@section('styles')
{{ Html::style( asset('datatables/dataTables.bootstrap4.min.css') )}}
@stop

@section('contenido')

    @include('dashboard.mensaje')
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
                        <td id="" >{{$rolturno->user->per_user->nombres}} {{$rolturno->user->per_user->apellidos}}</td>
                        <td id="servicioL{{$rolturno->id}}" >{{$rolturno->servicios->nombre}}</td>
                        <td id="" >{{$rolturno->estado}}</td>
                        <td id="gestionL{{$rolturno->id}}" >{{$rolturno->gestion}}</td>
                        <td id="" >{{$rolturno->obsevacion}}</td>
                        <td>
                            @if($rolturno->estado == 'Temporal' || $rolturno->estado == 'Rechazado')
                                <a type="button" class="btn btn-outline-info btn-sm ml-2" href="{{route('editar.rolturno.test', $rolturno->id)}}" id="registro">Seguir registrando</a>
                                <a type="button" class="btn btn-outline-warning btn-sm ml-2 " href="{{route('rolturno.imprimir.pdf', $rolturno->id)}}" target='_Blank' >PDF</a>
                                <button type="button" class="btn btn-outline-success btn-sm ml-2 enviarbtn" value="{{$rolturno->id}}" data-toggle="modal" data-target="#rolturnoEnviar">Enviar</button>  
                            @else
                                <button type="button" class="btn btn-outline-secondary btn-sm ml-2" href="{{route('editar.rolturno.test', $rolturno->id)}}" id="registro" disabled>Seguir registrando</button>
                                <a type="button" class="btn btn-outline-warning btn-sm ml-2 " href="{{route('rolturno.imprimir.pdf', $rolturno->id)}}" target='_Blank' >PDF</a>
                                <button type="button" class="btn btn-outline-secondary btn-sm ml-2 enviarbtn" value="{{$rolturno->id}}" data-toggle="modal" data-target="#rolturnoEnviar" disabled>Enviar</button>  
                            @endif
                        </td>
                    </tr>
                 @endforeach
            @endif
        </tbody>
    </table>
    @include('rolturnos.EnviarRolturno')
@stop

@section('scripts')
<script src="{{ asset('datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('datatables/dataTables.bootstrap4.min.js') }}"></script>
<script>
    $(document).ready(function () {
        //proceso para mandar datos al modal enviar rolturno
        $(".enviarbtn").click(function(e) {
            e.preventDefault();
            var id=$(this).val(); 
            var servicio =$('#servicioL'+id).text();
            var gestion =$('#gestionL'+id).text();    

            $('#rolturnoEnviar').modal('show');//se pasa datos al modal
            $('#idMenviar').val(id);
            $('#servicioMenviar').text(servicio);
            $('#gestionMenviar').text(gestion);
        });
        //datatables
         var table = $('#listarturnos').DataTable({
            "lengthMenu": [[ 15 , 30, 60, -1], [ 15 , 30, 60, "All"]],
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

