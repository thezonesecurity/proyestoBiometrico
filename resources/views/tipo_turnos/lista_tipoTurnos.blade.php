@extends("dashboard/dashboard") <!--extends se situa en views-->
@section('titulo')
 - Tipo de turnos
@stop

@section('styles')
{{ Html::style( asset('datatables/dataTables.bootstrap4.min.css') )}}
<style>
    .error {
    color: red;
  }
  </style>
@stop

@section('contenido')

<div class="table-responsive d-flex justify-content-center " style="margin-left: auto" ><!--style="margin-left: 250px"-->
    <div class="col-md "> 
        @include('dashboard.mensaje')
        <div class="box-body">
            <h3 class="box-title text-center">Lista de Tipos de Turnos</h3>
            <table id="listarTturnos" class="table table-sm table-bordered table-striped"  width="100%">{{--listarTturnos--}}
                <thead>
                    <tr>
                        <th width="20px">Nro.</th>
                        <th width="160px">Nombre</th>
                        <th width="100px">Estado</th>
                        <th width="100px">Opciones
                        <!-- boton registrar servicio-->
                        <button data-toggle="modal" href="#registrar_tipoTurnoModal" class="btn btn-sm btn-outline-primary" style="margin-left: 60px">Registar tipo Turno</button>
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @if($tipo_turnos->isEmpty() && $tipo_turnos->count() == 0) 
                        <tr>
                            <td colspan="4" class="">No hay ningun servicio registrado aun... </td>
                        </tr>
                    @else 
                        <?php $i=0; ;?>
                        @foreach ($tipo_turnos as $tipo_turno)
                        <tr>
                            <td>{{ ++$i }}</td>
                            <td id="nombre{{$tipo_turno->id}}">{{ $tipo_turno->nombre }}</td>
                            <td id="estado{{$tipo_turno->id}}">{{ $tipo_turno->estado }}</td>
                            <td style='background-color: ;'>
                                @if($tipo_turno->estado == "Habilitado")
                                <button type="button" class="btn btn-outline-success btn-sm edit" value="{{$tipo_turno->id}}" data-toggle="modal" data-target="#ActualizarTipoTurno">Editar</button>                
                                <a href="{{ route('inhabilitar.tipo.turno', $tipo_turno->id)}}" type="buton" class="btn btn-sm btn-outline-danger " style="margin-left: 20px">Inhabilitar</a>
                                @else
                                <button type="button" class="btn btn-outline-secondary btn-sm edit" value="{{$tipo_turno->id}}" data-toggle="modal" data-target="#ActualizarTipoTurno" disabled>Editar</i></button>                
                                <a href="{{ route('habilitar.tipo.turno', $tipo_turno->id)}}" type="buton" class="btn btn-sm btn-outline-warning " style="margin-left: 20px"><span class="font-weight-bold">Habilitar</span></a>
                                @endif 
                            </td>
                        </tr>
                        @endforeach
                    @endif
                </tbody>
            </table>
            @include('tipo_turnos.editar_tipoTurno')
        </div>
    </div>
    @include('tipo_turnos.registrar_tipoTurno') 
</div>
@stop

@section('scripts')
<script src="{{ asset('datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('datatables/dataTables.bootstrap4.min.js') }}"></script>
<script src="{{asset('jquery-validate/jquery.validate.js')}}"></script>
<script type="text/javascript" src="{{ asset('assets/scripts/admin/tipoTurnos.js') }}"></script>

<script>
    $(document).ready(function () {
        $('#listarTturnos').DataTable({
            "lengthMenu": [[10 , 30, 60, -1], [10 , 30, 60, "All"]],
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

