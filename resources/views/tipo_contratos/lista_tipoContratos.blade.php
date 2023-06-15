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
    <div class="col-md "> 
        @include('dashboard.mensaje')
        <div class="box-body">
            <h4 class="box-title text-center">Lista Tipos de Contratos</h4>
            <table id="listarTcontratos" class="table table-sm table-bordered table-striped"  width="100%">
                <thead>
                    <tr>
                        <th width="20px">Nro.</th>
                        <th width="160px">Nombre</th>
                        <th width="100px">Estado</th>
                        <th width="100px">Opciones
                        <!-- boton registrar servicio-->
                        <button data-toggle="modal" href="#registrar_tipoContratoModal" class="btn btn-sm btn-outline-primary" style="margin-left: 60px">Registar tipo contrato</button>
                        </th>
                    </tr>
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
    </div>
    @include('tipo_contratos.registrar_tipoContrato') 
</div>
@include('tipo_contratos.ModalInhabilitarTC') 
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
<script>
    $(document).ready(function() {   
 
        //PROCESO PARA GUARDAR CAMBIOS DEL MODAL EDITAR
        $('#saveChangesTC').click(function(e) {//registro modal editars
            e.preventDefault();
             // Obtener los valores del modal
            var idM = $('#idM').val();
            var TcontratoM = $('#t_contratoM').val().charAt(0).toUpperCase() + $('#t_contratoM').val().slice(1).toLowerCase(); //$('#servicioM').val();
            console.log('id '+idM+' contrato '+TcontratoM);

            if ($('#formEditarTipoContrato').valid()) {
                $('#saveChangesTC').attr('disabled', true).text('Editando...');
                $.ajax({// Realizar una solicitud AJAX para actualizar el registro
                    url: "{{route('editarsave.tipo.contrato')}}",
                    method: 'POST',
                    dataType: "json",
                    data: { id: idM, contrato: TcontratoM, _token: '{{ csrf_token() }}' },
                    success: function(response) {
                        //alert(response);
                        if(response.status == 'ok'){
                            toastr.success(response.message, 'Feliciades !!');
                            $('#tablaRegistrosTcontratos tr[data-id="' + idM + '"] td:nth-child(2)').text(TcontratoM); //Actualizar la fila en la tabla con los nuevos valores
                        }else{
                            toastr.error('Hubo un error al actualizar el registro.', 'Error, Contacte con soporte !!');
                        }
                        $('#ActualizarTipoContrato').modal('hide');
                        $('#saveChangesTC').attr('disabled', false);
                    },
                    error: function(xhr, status, error) {
                        $('#ActualizarTipoContrato').modal('hide');
                    // toastr.error('Hubo un error al actualizar el registro.', 'Error'); //console.error(error); // Manejar el error
                        if (xhr.status === 422) {
                            var errors = xhr.responseJSON.errors;
                            $.each(errors, function(field, messages) { // Mostrar los mensajes de error en algún lugar de tu página
                                toastr.error(messages.join(', '), "Error no se pude actualizar !!!", { "preventDuplicates": false});
                            $('#ActualizarTipoContrato').modal('hide');
                            $('#saveChangesTC').attr('disabled', false);
                            });
                        }   
                    }
                }); 
            }           
        });
    });
</script>

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

