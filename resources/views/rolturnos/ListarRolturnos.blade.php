
@extends("dashboard/dashboard") <!--extends se situa en views-->
@section('titulo')
 - Listar Rolturnos
@stop

@section('styles')
{{ Html::style( asset('datatables/dataTables.bootstrap4.min.css') )}}
{{ Html::style( asset('assets/styles/preloader.css') )}}
<style>
    .overlay {
        display: none;
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(0, 0, 0, 0.7);
        z-index: 99;
        display: flex;
        align-items: center;
        justify-content: center;
    }
    
    .overlay-content {
        background: #fff;
        padding: 20px;
        border-radius: 5px;
        text-align: center;
        max-width: 80%;
    }
    </style>
@stop

@section('contenido')


<div id="contenedor_carga"><div id="carga"></div></div>

    @include('dashboard.mensaje')
    <div class="row justify-content-center align-content-center">
       <h4  class="font-weight-bold">Lista de roles de turnos </h4>
       <a type="button" class="btn btn-warning btn-sm " href="{{route('tablas')}}" >tabla</a>
    </div>
    {{--<table class="table table-striped" id="myTable"> </table>--}}
    <table id="listarturnos" class="table table-sm table-bordered table-striped"  width="100%" style="font-size: 14px;"> 
        <thead>
            <tr class="titulo" > {{--style="background-color: red;display: none;"--}}
                <th width="5px">Nro.</th>
                <th style="" width="60px">Responsable</th>
                <th style="" width="60px">Servicio</th>
                <th style="" width="20px">Estado</th>
                <th style="" width="20px">Mes</th>
                <th style="" width="100">Observacion</th>
                <th style="" width="40">Accion</th>
            </tr>
        </thead>
        @if($controlUserResponsableServicio)
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
                             {{--<td id="" >{{$rolturno->obsevacion}}</td>--}}
                             <td >
                                <span data-toggle="popover" data-content="{{ $rolturno->obsevacion }}" data-placement="top">
                                    {{ str_limit($rolturno->obsevacion, 34) }}
                                </span>
                            </td>
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
        @else
            <div id="overlay" class="overlay">
                <div class="overlay-content">
                    @if (!$controlUserResponsableServicio)
                        <p>{{ $mensaje }}</p>
                    @endif
                </div>
            </div>
        @endif

    </table>
    @include('rolturnos.EnviarRolturno')

@stop

@section('scripts')
<script>
    window.onload = function(){
        var contenedor = document.getElementById('contenedor_carga');
        contenedor.style.visibility = 'hidden';
        contenedor.style.opacity = '0';
    }
</script>
<script src="{{ asset('datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('datatables/dataTables.bootstrap4.min.js') }}"></script>
<script>
    $(document).ready(function () {
         // Mostrar el mensaje si el usuario no pertenece a un servicio
         @if (!$controlUserResponsableServicio)
            $("#overlay").show();
        @else
            $("#overlay").hide();
        @endif

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
        // PARA MOSTRAR EL MENSAJE COMPLETO DE LA OBSERVACION
        $('[data-toggle="popover"]').popover({
            trigger: 'manual', // Cambiar el trigger a 'manual' para controlar el popover manualmente
            html: true,
            }).click(function (e) {
                e.preventDefault();
                $('[data-toggle="popover"]').not(this).popover('hide');  // Cerrar cualquier popover abierto en otro lugar
                $(this).popover('toggle');  // Alternar la visibilidad del popover actual
            });

        $(document).on('click', function (e) { // Cerrar el popover al hacer clic en cualquier lugar de la página
            if ($(e.target).data('toggle') !== 'popover' && !$(e.target).parents().is('.popover.in')) {
                $('[data-toggle="popover"]').popover('hide');
            }
        });
    });
</script>

@stop

