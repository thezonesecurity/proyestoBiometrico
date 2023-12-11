@extends("dashboard/dashboard") <!--extends se situa en views-->
@section('titulo')
 - Areas
@stop

@section('styles')
<link rel="stylesheet" type="text/css" href="{{ asset('bootstrap4/css/select2/select2.css') }}">
{{ Html::style( asset('datatables/dataTables.bootstrap4.min.css') )}}
{{ Html::style( asset('assets/styles/preloader.css') )}}
@stop

@section('contenido')
    <div id="contenedor_carga"><div id="carga"></div></div>

    <div class="row table-responsive d-flex justify-content-center" style="font-size: 14px;">
        <div class="col-md-3 mt-5">
            <form action="{{route('guardar.area.servicio')}}" method="post" class="border border-info" id="formRegistrarArea" autocomplete="off">
                <h5 class="box-title text-center font-weight-bold mt-2">Registrar nuevo area</h5>
                @csrf
                <div class="form-row mt-2">
                    <div class="form-group col-md-10 col-sm-6 ml-4">
                        <label for="recipient-servicio" class="font-weight-bold">Area</label>
                        <input type="text" class="form-control" name="areaR" id="areaR" placeholder="Ingrese un nombre de area">
                    </div>
                    <div class="form-group col-md-10 col-sm-6 ml-4">
                        <label for="recipient-servicio" class="font-weight-bold">Servicio</label>
                        <select class="form-control custom-select select2" style="width: 100%" name="servicioR" id='servicioR'>
                                <option value="vacio" disabled selected>Selecione una opcion</option>
                                @foreach($servicios as $id => $servicio)   
                                    <option value="{{$id}}" >{{$servicio}}</option>  
                                @endforeach
                        </select>
                    </div>
                    <div class="form-group col-md-10 col-sm-6 ml-4">
                        <button type="submit" id="registrar" class="btn btn-outline-success">Registrar</button>
                        <button type="reset" id="cancelarBtn" class="btn btn-outline-secondary m-2">Limpiar</button>
                    </div>
                </div>
            </form>
        </div>
        <div class="col-md-9">
            @include('dashboard.mensaje')

            <h4 class="box-title text-center font-weight-bold mt-2">Lista de Areas de los Servicios</h4>
            <table id="listarAreas" class="table table-sm table-bordered table-striped"  width="100%">
                <thead>
                    <tr>
                        <th width="20px">Nro.</th>
                        <th width="180px">Area del servico</th>
                        <th width="200px">Nombre del servicio</th>
                        <th width="100px">Estado</th>
                        <th width="150px">Opciones</th>
                    </tr>
                </thead>
                <tbody id="tablaRegistrosAreas">
                    @if($areas->isEmpty() && $areas->count() == 0) 
                        <tr>
                            <td colspan="5" class="">No hay ningun registrado para mostrar </td>
                        </tr>
                    @else 
                        <?php $i=0; ;?>
                        @foreach ($areas as $area)
                        <tr data-id={{$area->id}}>
                            <td>{{ ++$i }}</td>
                            <td  id="area{{$area->id}}">{{ $area->nombre }}</td>
                            <td  id="servicio{{$area->id}}">{{ $area->servicio->nombre }}</td>
                            <td  id="estado{{$area->id}}">{{ $area->estado }}</td>
                            <td style='background-color: ;'>
                                @if($area->estado == "Habilitado")
                                    <button type="button" class="btn btn-outline-success btn-sm edit ml-1" value="{{$area->id}}" data-toggle="modal" data-target="#Actualizar_Area">Editar</button>
                                    <button type="button" class="btn btn-sm btn-outline-danger invalidarA m-1" value="{{$area->id}}" data-toggle="modal" data-target="#abrirModalInhabilitarAreas">Deshabilitar?</button>
                                @else
                                    <button type="button" class="btn btn-outline-secondary btn-sm edit ml-1" value="{{$area->id}}" data-toggle="modal" data-target="#Actualizar_Area" disabled>Editar</button>
                                    <button type="button" class="btn btn-sm btn-outline-warning invalidarA m-1" value="{{$area->id}}" data-toggle="modal" data-target="#abrirModalInhabilitarAreas"><span class="font-weight-bold">Habilitar?</span></button>
                                @endif 
                            </td>
                        </tr>
                        @endforeach
                    @endif
                </tbody>
            </table>
            @include('areas.editarArea')
        </div>
    </div>
    @include('areas.ModalInhabilitarA')
@stop

@section('scripts')
<script>
    window.onload = function(){
        var contenedor = document.getElementById('contenedor_carga');
        contenedor.style.visibility = 'hidden';
        contenedor.style.opacity = '0';
    }
</script>

<script type="text/javascript" src="{{ asset('bootstrap4/js/select2/select2.js') }}"></script>
<script type="text/javascript">
  $('.select2').select2({
      placeholder: "Seleccione una opcion",
      allowClear: true,
      ancho : 'resolver'
  });
</script>

<script src="{{asset('jquery-validate/jquery.validate.js')}}"></script>
<script type="text/javascript" src="{{ asset('assets/scripts/admin/areas.js') }}"></script>
<script>
    $(document).ready(function() {
        $('#Actualizar_Area').on('shown.bs.modal', function() {
            $('#select').select2();
        });
        //PROCESO PARA GUARDAR CAMBIOS DEL MODAL EDITAR
        $('#saveChangesA').click(function(e) {//registro modal editars
            e.preventDefault();
             // Obtener los valores del modal
            var idM = $('#idM').val();
            var areaM = $('#areaM').val().charAt(0).toUpperCase() + $('#areaM').val().slice(1).toLowerCase(); //$('#servicioM').val();
            var Aservicio = $('#servicioM').val();
            var Nservicio = $('#servicioMo :selected').val();
            var NservicioNombre = $('#servicioMo :selected').text(); 
           // console.log('id '+idM+' nombre '+areaM+' servicio '+Aservicio + ' otro ser-> '+NservicioNombre);
            //proceso de ajax
            if ($('#form-editarArea').valid()) {
                $('#saveChangesA').attr('disabled', true).text('Editando...');
                $.ajax({// Realizar una solicitud AJAX para actualizar el registro
                    url: "{{route('editarsave.area.servicio')}}",
                    method: 'POST',
                    dataType: "json",
                    data: { id: idM, area: areaM, LastServicio: Aservicio, NewServicio: Nservicio, _token: '{{ csrf_token() }}' },
                    success: function(response) {
                        //alert(response);
                        if(response.status == 'ok'){
                            toastr.success(response.message, 'Feliciades !!');
                            $('#tablaRegistrosAreas tr[data-id="' + idM + '"] td:nth-child(2)').text(areaM); //Actualizar la fila en la tabla con los nuevos valores
                            if(Nservicio != ''){
                                $('#tablaRegistrosAreas tr[data-id="' + idM + '"] td:nth-child(3)').text(NservicioNombre);
                            }
                        }else{
                            toastr.error('Hubo un error al actualizar el registro.', 'Error, Contacte con soporte !!');
                        }
                        $('#Actualizar_Area').modal('hide');
                        $('#saveChangesA').attr('disabled', false);
                    },
                    error: function(xhr, status, error) {
                        $('#Actualizar_Area').modal('hide');
                    // toastr.error('Hubo un error al actualizar el registro.', 'Error'); //console.error(error); // Manejar el error
                        if (xhr.status === 422) {
                            var errors = xhr.responseJSON.errors;
                            $.each(errors, function(field, messages) { // Mostrar los mensajes de error en algún lugar de tu página
                                toastr.error(messages.join(', '), "Error no se pude actualizar !!!", { "preventDuplicates": false});
                            $('#Actualizar_Area').modal('hide');
                            $('#saveChangesA').attr('disabled', false);
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
        var table = $('#listarAreas').DataTable({
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



