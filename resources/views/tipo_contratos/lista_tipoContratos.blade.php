@extends("dashboard/dashboard") <!--extends se situa en views-->
@section('titulo')
 - Tipo de contratos
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
            <h5 class="box-title text-center font-weight-bold mt-2">Registrar Tipo Contrato</h5>
            {!! Form::open(['route' => 'guardar.tipo.contrato', 'method' => 'post', 'autocomplete'=>"off", 'id'=> 'formRegistrarTipoContrato']) !!}
                @csrf
                <div class="form-row mt-2">
                    <div class="form-group col-md-10 col-sm-6 ml-4">
                        <label for="recipient-tipoContrato" class="font-weight-bold">Nombre</label>
                        <input type="text" class="form-control" name="tipo_contrato" id="t_contrato">
                    </div>
                    <div class="form-group col-md-10 col-sm-6 ml-4">
                        <label for="recipient-opciones" class="font-weight-bold" style="display: none;">Accion</label>
                        {!! Form::submit('Guardar', ['class' => 'btn btn-outline-success registrar ml-3' ] ) !!} 
                        {!! Form::reset('Cancelar', ['class' => 'btn btn-outline-secondary limpiar ml-3', 'data-dismiss'=>"modal", 'id'=>"cancelarBtn" ] ) !!}
                    </div>
                </div>
            {!! Form::close() !!}
        </div>
    </div>
    <div class="col-md-9">
        @include('dashboard.mensaje')
       
        <h4 class="box-title text-center font-weight-bold mt-2">Lista de Tipo de Contratos</h4>
        <table id="listarTcontratos" class="table table-sm table-bordered table-striped table-responsives"  width="100%">
            <thead>
                <th width="20px">Nro.</th>
                        <th width="160px">Nombre</th>
                        <th width="100px">Estado</th>
                        <th width="100px">Opciones</th>
            </thead>
            <tbody id="tablaRegistrosTcontratos">
                @if($tipo_contratos->isEmpty() && $tipo_contratos->count() == 0) 
                    <tr>
                        <td colspan="4" class="">No hay ningun servicio registrado aun... </td>
                    </tr>
                @else 
                    <?php $i=0; ;?>
                    @foreach ($tipo_contratos as $tipo_contrato)
                    <tr data-id={{$tipo_contrato->id}}>
                        <td>{{ ++$i }}</td>
                        <td id="nombre{{$tipo_contrato->id}}">{{$tipo_contrato->nombre}}</td>
                        <td id="estado{{$tipo_contrato->id}}">{{$tipo_contrato->estado}}</td>
                        <td style='background-color: ;'>
                            @if($tipo_contrato->estado == "Habilitado")
                                <button type="button" class="btn btn-outline-success btn-sm edit ml-2" value="{{$tipo_contrato->id}}" data-toggle="modal" data-target="#ActualizarTipoContrato">Editar</button>
                                <button type="button" class="btn btn-sm btn-outline-danger invalidarTC ml-2" value="{{$tipo_contrato->id}}" data-toggle="modal" data-target="#abrirModalInhabilitarTC">Deshabilitar?</button>                 
                            @else
                                <button type="button" class="btn btn-outline-secondary btn-sm  ml-2" value="{{$tipo_contrato->id}}" data-toggle="modal" data-target="#ActualizarTipoContrato" disabled>Editar</button>  
                                <button type="button" class="btn btn-sm btn-outline-warning btn-sm invalidarTC ml-2" value="{{$tipo_contrato->id}}" data-toggle="modal" data-target="#abrirModalInhabilitarTC"><span class="font-weight-bold">Habilitar?</span></button>                
                            @endif 
                        </td>
                    </tr>
                    @endforeach
                @endif
            </tbody>
        </table>
       @include('tipo_contratos.editar_tipoContrato')
    </div>
    @include('tipo_contratos.ModalInhabilitarTC')
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
<script type="text/javascript" src="{{ asset('assets/scripts/admin/tipoContratos.js') }}"></script>

<script src="{{ asset('datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('datatables/dataTables.bootstrap4.min.js') }}"></script>
<script>
    $(document).ready(function () {
        var table = $('#listarTcontratos').DataTable({
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

