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
                        <button data-toggle="modal" href="#registrar_tipoTurnoModal" class="btn btn-sm btn-outline-primary btnregistrartt" style="margin-left: 60px">Registar tipo Turno</button>
                        </th>
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
    </div>
    @include('tipo_turnos.registrar_tipoTurno') 
</div>
@include('tipo_turnos.ModalInhabilitarTturnos') 
@stop

@section('scripts')
<script src="{{asset('jquery-validate/jquery.validate.js')}}"></script>
<script type="text/javascript" src="{{ asset('assets/scripts/admin/tipoTurnos.js') }}"></script>
<script>
    $(document).ready(function(){
        //PROCESO PARA GUARDAR LOS DATOS DEL MODAL EDITAR
        $('#saveChangesTT').click(function(e) {//registro modal editars
            e.preventDefault();
             // Obtener los valores del modal editar
            var idM = $('#idM').val();
            var turnoM = $('#tipo_turno_M').val().charAt(0).toUpperCase() + $('#tipo_turno_M').val().slice(1).toLowerCase(); //$('#servicioM').val();
           // console.log('id '+idM+' turno '+turnoM);
            //proceso de ajax
            if ($('#formEditarTipoTurno').valid()) {
                $('#saveChangesTT').attr('disabled', true).text('Editando...');
                $.ajax({// Realizar una solicitud AJAX para actualizar el registro
                    url: "{{route('editarsave.tipo.turno')}}",
                    method: 'POST',
                    dataType: "json",
                    data: { id: idM, turno: turnoM, _token: '{{ csrf_token() }}' },
                    success: function(response) {
                        //alert(response);
                        if(response.status == 'ok'){
                            toastr.success(response.message, 'Feliciades !!');
                            $('#tablaRegistrosTturnos tr[data-id="' + idM + '"] td:nth-child(2)').text(turnoM); //Actualizar la fila en la tabla con los nuevos valores
                        }else{
                            toastr.error('Hubo un error al actualizar el registro.', 'Error, Contacte con soporte !!');
                        }
                        $('#ActualizarTipoTurno').modal('hide');
                        $('#saveChangesTT').attr('disabled', false);
                    },
                    error: function(xhr, status, error) {
                        $('#ActualizarTipoTurno').modal('hide');
                    // toastr.error('Hubo un error al actualizar el registro.', 'Error'); //console.error(error); // Manejar el error
                        if (xhr.status === 422) {
                            var errors = xhr.responseJSON.errors;
                            $.each(errors, function(field, messages) { // Mostrar los mensajes de error en algún lugar de tu página
                                toastr.error(messages.join(', '), "Error no se pude actualizar !!!", { "preventDuplicates": false});
                            $('#ActualizarTipoTurno').modal('hide');
                            $('#saveChangesTT').attr('disabled', false);
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
      var table = $('#listarTturnos').DataTable({
            "lengthMenu": [[10 , 30, 60, -1], [10 , 30, 60, "All"]],
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

