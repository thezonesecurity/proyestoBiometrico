@extends("dashboard/dashboard") <!--extends se situa en views-->
@section('titulo')
 - Tipo de turnos
@stop

@section('styles')
{{ Html::style( asset('datatables/dataTables.bootstrap4.min.css') )}}
{{ Html::style( asset('assets/styles/preloader.css') )}}
@stop

@section('contenido')
<div id="contenedor_carga"><div id="carga"></div></div>

<div class="row table-responsive d-flex justify-content-center" style="font-size: 14px;">
    <div class="col-md-3 mt-5">
        <div class="table table-sm border border-secondary">
            <h5 class="box-title text-center font-weight-bold mt-2">Registrar Tipo Turnos</h5>

             {!! Form::open(['route' => 'guardar.tipo.turno', 'method' => 'post', 'autocomplete'=>"off", 'id' => 'formRegistrarTipoTurno']) !!}
                @csrf
                <div class="form-row mt-2">
                    <div class="form-group col-md-10 col-sm-6 ml-4">
                        <label for="recipient-tipoturno" class="font-weight-bold">Nombre</label>
                        <input type="text" class="form-control" name="tipo_turno" id="tipo_turno">
                    </div>
                    <div class="form-group col-md-10 col-sm-6 ml-4">
                        <label for="recipient-opciones" class="font-weight-bold" style="display: none;">Accion</label>
                        {!! Form::submit('Guardar', ['class' => 'btn btn-outline-success registrar' ] ) !!} 
                        {!! Form::reset('Cancelar', ['class' => 'btn btn-outline-secondary limpiar ml-3', 'data-dismiss'=>"modal", 'id'=>"cancelarBtn" ] ) !!}
                    </div>
                </div>
            {!! Form::close() !!}
        </div>
    </div>
    <div class="col-md-9">
        @include('dashboard.mensaje')
       
        <h4 class="box-title text-center font-weight-bold mt-2">Lista de Tipo Turnos del Personal</h4>
        <table id="listarTturnos" class="table table-sm table-bordered table-striped table-responsives"  width="100%">
            <thead>
                <tr>
                    <th width="20px">Nro.</th>
                    <th width="160px">Nombre</th>
                    <th width="100px">Estado</th>
                    <th width="100px">Opciones</th>
                </tr>
            </thead>
            <tbody id="tablaRegistrosTturnos">
                @if($tipo_turnos->isEmpty() && $tipo_turnos->count() == 0) 
                    <tr>
                        <td colspan="4" class="">No hay ningun servicio registrado aun... </td>
                    </tr>
                @else 
                    <?php $i=0; ;?>
                    @foreach ($tipo_turnos as $tipo_turno)
                    <tr data-id={{$tipo_turno->id}}>
                        <td>{{ ++$i }}</td>
                        <td id="nombre{{$tipo_turno->id}}">{{$tipo_turno->nombre}}</td>
                        <td id="estado{{$tipo_turno->id}}">{{$tipo_turno->estado}}</td>
                        <td style='background-color: ;'>
                            @if($tipo_turno->estado == "Habilitado")
                                <button type="button" class="btn btn-outline-success btn-sm edit" value="{{$tipo_turno->id}}" data-toggle="modal" data-target="#ActualizarTipoTurno">Editar</button>   
                                <button type="button" class="btn btn-sm btn-outline-danger invalidarTT" value="{{$tipo_turno->id}}" data-toggle="modal" data-target="#abrirModalInhabilitarTT">Deshabilitar?</button>               
                            @else
                                <button type="button" class="btn btn-outline-secondary btn-sm edit" value="{{$tipo_turno->id}}" data-toggle="modal" data-target="#ActualizarTipoTurno" disabled>Editar</button> 
                                <button type="button" class="btn btn-outline-warning btn-sm invalidarTT" value="{{$tipo_turno->id}}" data-toggle="modal" data-target="#abrirModalInhabilitarTT"><span class="font-weight-bold">Habilitar?</span></button>                
                           @endif 
                        </td>
                    </tr>
                    @endforeach
                @endif
            </tbody>
        </table>
        @include('tipo_turnos.editar_tipoTurno')
    </div>
    @include('tipo_turnos.ModalInhabilitarTturnos') 
</div>

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
<script type="text/javascript" src="{{ asset('assets/scripts/admin/tipoTurnos.js') }}"></script>

<script src="{{ asset('datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('datatables/dataTables.bootstrap4.min.js') }}"></script>
<script>
    $(document).ready(function () {
      var table = $('#listarTturnos').DataTable({
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

