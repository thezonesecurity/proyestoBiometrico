@extends("dashboard/dashboard") <!--extends se situa en views-->
@section('titulo')
 - Servicio
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
        <form action="{{route('registrar.servicio')}}" method="post" class="border border-info" id="formRegistrarServicio" autocomplete="off">
            
        <h5 class="box-title text-center font-weight-bold mt-2">Registrar nuevo servicio</h5>
            @csrf
            <div class="form-row mt-2">
                <div class="form-group col-md-10 col-sm-6 ml-4">
                    <label class="font-weight-bold">Nombre del Servicio</label>
                    <input type="text" class="form-control" name="servicioR" id="servicioR" placeholder="Ingrese un servicio">
                </div>
                <div class="form-group col-md-10 col-sm-6 ml-4">
                    <label class="font-weight-bold">Responsable del servicio</label>
                    <select class="form-control custom-select select2" style="width: 100%" name="personaR" id="personaR">
                        <option value="0" disabled selected>Selecione una opcion</option>
                        @foreach($users as $user)   
                            @if($user->estado == 'enable')
                                <option value="{{$user->id}}" > {{$user->per_user->nombres}} {{$user->per_user->apellidos}}</option> 
                            @endif  
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
       
        <h4 class="box-title text-center font-weight-bold mt-2">Lista de Servicios</h4>
        <table id="listaServicios" class="table table-sm table-bordered table-striped table-responsives"  width="100%">
            <thead>
                <tr>
                    <th width="20px">Nro.</th>
                    <th width="180px">Nombre</th>
                    <th width="200px">Responsable</th>
                    <th width="100px">Estado</th>
                    <th width="150px">Opciones</th>
                </tr>
            </thead>
            <tbody id="tablaRegistros">
                @if($servicios->isEmpty() && $servicios->count() == 0) 
                    <tr>
                        <td colspan="5" class="">No hay ningun servicio registrado aun... </td>
                    </tr>
                @else 
                    <?php $i=0; ?>
                    @foreach ($servicios as $servicio)
                    <tr data-id={{$servicio->id}}>
                        <td>{{ ++$i }}</td>
                        <td id="servicio{{$servicio->id}}">{{ $servicio->nombre }}</td>
                        <td id="responsable{{$servicio->id}}">{{$servicio->user->per_user->nombres}} {{$servicio->user->per_user->apellidos}}</td>
                        <td id="estado{{$servicio->id}}">{{ $servicio->estado }}</td>
                        <td style='background-color: ;'>
                            @if($servicio->estado == "Habilitado")
                                <button type="button" class="btn btn-outline-success btn-sm edit ml-1" value="{{$servicio->id}}" data-toggle="modal" data-target="#ActualizarServicio">Editar</button>  
                                <button type="button" class="btn btn-sm btn-outline-danger invalidar ml-1" value="{{$servicio->id}}" data-toggle="modal" data-target="#abrirModalInhabilitar">Deshabilitar?</button>              
                            @else
                                <button type="button" class="btn btn-outline-secondary btn-sm ml-1" value="{{$servicio->id}}" data-toggle="modal" data-target="#ActualizarServicio" disabled>Editar</i></button> 
                                <button type="button" class="btn btn-sm btn-outline-warning invalidar ml-1" value="{{$servicio->id}}" data-toggle="modal" data-target="#abrirModalInhabilitar"><span class="font-weight-bold">Habilitar?</span></button>                  
                            @endif 
                        </td>
                    </tr>
                    @endforeach
                @endif
            </tbody>
        </table>
        @include('servicios.ModalEditar')
    </div>
</div>
@include('servicios.ModalInhabilitar')

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
<script type="text/javascript" src="{{ asset('assets/scripts/admin/servicios.js') }}"></script>

<script>
    $(document).ready(function() {
    
        $('#saveChanges').click(function(e) {//registro modal editars
            e.preventDefault();
            var countLastResp=0;
            if ($(".controlT2").is(":visible")) {// para validar el input tipo select
                if( $('#ActualizarServicio #responsableMo :selected').val() == ''){
                    $(".controlR").addClass('is-invalid');
                    $('#validacionResponsable').text('Por favor elige un responsable del servicio !!!').addClass('text-danger').show();
                    countLastResp=1;
                }else{
                    $(".controlR").removeClass('is-invalid');
                    $('#validacionResponsable').text('Por favor elige un responsable del servicio !!!').removeClass('text-danger').hide();
                countLastResp=0;
                }
            } else {
                $(".controlR").removeClass('is-invalid');
                $('#validacionResponsable').text('Por favor elige un responsable del servicio !!!').removeClass('text-danger').hide();
                countLastResp=0;
            }
            // Obtener los valores del modal
            var idM = $('#idM').val();//texto.charAt(0).toUpperCase() + texto.slice(1).toLowerCase();
            var servicioM = $('#servicioM').val().charAt(0).toUpperCase() + $('#servicioM').val().slice(1).toLowerCase(); //$('#servicioM').val();
            var Aresponsable = $('#responsableM').val();
            var Nresponsable = $('#responsableMo :selected').val();
            var NresponsableNombre = $('#responsableMo :selected').text(); //console.log('id '+idM+' nombre '+servicioM+' responsable '+Aresponsable + ' otro res-> '+NresponsableNombre);

            if(countLastResp == 0 && $('#form-editarServicio').valid()) {
                $('#saveChanges').attr('disabled', true).text('Editando...');
                $.ajax({// Realizar una solicitud AJAX para actualizar el registro
                    url: "{{route('editarsave.servicio')}}",
                    method: 'POST',
                    dataType: "json",
                    data: { id: idM, servicio: servicioM, LastResp: Aresponsable, NewResp: Nresponsable, _token: '{{ csrf_token() }}' },
                    success: function(response) {
                        //alert(response);
                        if(response.status == 'ok'){
                            toastr.success(response.message, 'Feliciades !!');
                            $('#tablaRegistros tr[data-id="' + idM + '"] td:nth-child(2)').text(servicioM); //Actualizar la fila en la tabla con los nuevos valores
                            if(Nresponsable != ''){
                                $('#tablaRegistros tr[data-id="' + idM + '"] td:nth-child(3)').text(NresponsableNombre);
                            }
                        }else{
                            toastr.error('Hubo un error al actualizar el registro.', 'Error, Contacte con soporte !!');
                        }
                        $('#ActualizarServicio').modal('hide');
                        $('#saveChanges').attr('disabled', false);
                    },
                    error: function(xhr, status, error) {
                        $('#ActualizarServicio').modal('hide');
                    // toastr.error('Hubo un error al actualizar el registro.', 'Error'); //console.error(error); // Manejar el error
                        if (xhr.status === 422) {
                            var errors = xhr.responseJSON.errors;
                            $.each(errors, function(field, messages) { // Mostrar los mensajes de error en algún lugar de tu página
                                toastr.error(messages.join(', '), "Error no se pude actualizar !!!", { "preventDuplicates": false});
                            $('#ActualizarServicio').modal('hide');
                            $('#saveChanges').attr('disabled', false);
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
       var table =  $('#listaServicios').DataTable({
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

