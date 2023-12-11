@extends("dashboard/dashboard") <!--extends se situa en views-->
@section('titulo')
 - Personal
@stop

@section('styles')
<link rel="stylesheet" type="text/css" href="{{ asset('bootstrap4/css/select2/select2.css') }}">
{{ Html::style( asset('datatables/dataTables.bootstrap4.min.css') )}}
{{ Html::style( asset('assets/styles/preloader.css') )}}
@stop

@section('contenido')
<div id="contenedor_carga"><div id="carga"></div></div>
{{--dd($data)--}}
<?php
$serverName = "DESKTOP-S9D1IAK"; //"193.168.0.7\SIAF";// "DESKTOP-S9D1IAK"; ->propiedades del servidor->ver propiedades de conexioon->producto-> nombre del servidor
$connectionInfo = array( "Database"=>"BD_BIOMETRICO", "UID"=>"sa", "PWD"=>"S1af");
$conn = sqlsrv_connect( $serverName, $connectionInfo) or die(print_r(sqlsrv_errors(), true));

$sql="select USERID, NAME, BADGENUMBER from USERINFO"; //ORDER BY USERID;  personas
$res=sqlsrv_query($conn,$sql);
$i=0;
?>
<div class=" table-responsive d-flex justify-content-center " style="margin-left: auto" ><!--style="margin-left: 250px"-->
  <div class="col">
    @include('dashboard.mensaje')
    <div class="box-body table-responsive-sm table-responsive-md table-responsive-lg table-responsive-xl">
        <h3 class="box-title text-center">Lista del personal H.D.B.</h3>
        <table id="listarPersonas" class="table table-sm table-bordered table-striped" width="100%"  style="font-size: 14px;">{{--listarPersonas--}}
            <thead>
                <tr>
                    <th scope="col" >Nro.</th>       
                    <th scope="col" >Nombre Completo</th>
                    <th scope="col">C.I.</th>
                    <th scope="col">Tipo Contrato</th>
                    <th scope="col">Servicio</th>
                    <th scope="col">Nro. Item</th>
                    <th scope="col">Estado</th>
                    <th scope="col">Opciones</th>
                  </tr>
            </thead>
            <tbody id="tablaRegistrosPersonas">
                <?php while($row=sqlsrv_fetch_array($res) ) {?>
                  
                    @if(isset($row))
                    <?php $persona=App\Models\personal\Persona::orderBy('id')->where('idper_db',$row['USERID'])->first(); ?>
                       @if(isset($persona->id))
                        <tr data-id={{$persona->id}}>
                                <td>{{++$i}}</td>
                                @if(isset($persona->nombres))
                                <td id="nombre{{$persona->id}}">{{$persona->nombres}}</td>
                                @else
                                    <td id="nombre<?php echo $row['USERID']; ?>">{{utf8_encode($row['NAME'])}}</td>
                                @endif
                                <td id="ci{{$persona->id}}">{{$row['BADGENUMBER']}}</td>   
                                @if(isset($persona)) 
                                    <td id="item{{$persona->id}}" >{{$persona->PersonaItem->nombre}}</td>
                                    <?php $servicio=App\Models\servicios\Servicio::where('id',$persona->id_servicio)->first(); ?>
                                    <td id="servicio{{$persona->id}}" >{{$servicio->nombre}}</td>
                                    @if(isset($persona->nro_item))
                                        <td id="numFinanc{{$persona->id}}" >{{$persona->nro_item}}</td>
                                    @else
                                        <td id="numFinanc{{$persona->id}}" >0</td>
                                    @endif
                                    <td id="estado{{$persona->id}}" >{{$persona->estado_per}}</td>
                                    <td >
                                    
                                        @if( $persona->estado_per == 'Habilitado' ) 
                                            <button type="button" class="btn btn-outline-success btn-sm edit ml-2" value="{{$persona->id}}" data-toggle="modal" data-target="#editarModalPersonal">Editar</button>
                                            <a href="{{ route('inhabilitar.persona', $persona->id)}}" type="buton" class="btn btn-sm btn-outline-danger">Inhabilitar</a>
                                        @else
                                            <button type="button" class="btn btn-outline-secondary btn-sm edit ml-2" value="{{$persona->id}}" data-toggle="modal" data-target="#editarModalPersonal" disabled>Editar</button> 
                                            <a href="{{ route('habilitar.persona', $persona->id)}}" type="buton" class="btn btn-sm btn-outline-warning"><span class="font-weight-bold">Habilitar</span></a>
                                        @endif 

                                    </td>
                                @else
                            {{--  < ?php $newpersona = new App\Models\personal\Persona;
                                $newpersona->nombres = utf8_encode($row['NAME']); //$request->nombre;
                                $newpersona->ci = $row['BADGENUMBER']; //$request->ci;
                                $newpersona->item_id = 1;
                                $newpersona->nro_item = 12345;
                                $newpersona->estado_per = 'Habilitado';
                                $newpersona->idper_db = $row['USERID'];
                                $newpersona->id_servicio = 2;
                                $newpersona->user_id = 28;
                                //dd($newpersona);
                                $newpersona->save();
                                ?>--}}
                                    <td><span id="item" >Sin item</span></td>
                                    <td><span id="servicio" >Sin servicio</span></td>
                                    <td><span id="num" >Sin fondo F.</span></td>
                                    <td><span id="estado" >Sin estado</span></td>
                                    <td>
                                        <div>{{--las dos lineas siguientes no son funcionales pero son requisito para el modal de registrar--}}
                                            <button type="button" class="btn btn-danger btn-sm registrar" data-toggle="modal" data-target=".registrarModal" style="display: none">Añadir Error NO FUNCIONAL</button>  
                                            @include('personal.modalErrorRegistrarPersona') 
                                        </div>
                                        <button type="button" class="btn btn-outline-info btn-sm registrarModal" value="{{$row['USERID']}}" data-toggle="modal" data-target="#exampleModal">Añadir</button>
                                        @include('personal.registrar')
                                    </td>
                                @endif  
                            </tr> 
                        @endif
                    @else
                    <tr>
                        <td colspan="8">No hay datos para mostrar. Contacte con soporte</td>
                        @break
                    </tr>   
                    @endif
                <?php }//Fin while
                sqlsrv_close($conn); ?> 
            </tbody>
        </table>
    </div>
</div>
@include('personal.editarPersonal')

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
<script type="text/javascript" src="{{ asset('assets/scripts/admin/personal.js') }}"></script>
<script>
$(document).ready(function() {
   
    //PROCESO PARA GUARDAR CAMBIOS DEL MODAL EDITAR
    $('#saveChangesPer').click(function(e) {//registro modal editars
        e.preventDefault();
        // Obtener los valores del modal
        var idM = $('#idM').val();
        var persona = $('#nombreM').val().toUpperCase();// $('#areaM').val().charAt(0).toUpperCase() + $('#areaM').val().slice(1).toLowerCase(); //$('#servicioM').val();
        var cedula = $('#ciM').val();
        var Aitem = $('#itemM').val();
        var Nitem = $('#itemMo :selected').val();
        var Nroitem = $('#numFinancM').val();
        var Aservicio = $('#servicioM').val();
        var Nservicio = $('#servicioMo :selected').val();

        var NitemNombre = $('#itemMo :selected').text(); 
        var NservicioNombre = $('#servicioMo :selected').text(); 
         //proceso de ajax
         if ($('#formEditarPersonal').valid()) {
                $('#saveChangesPer').attr('disabled', true).text('Editando...');
                $.ajax({// Realizar una solicitud AJAX para actualizar el registro
                    url: "{{route('editar.personal')}}",
                    method: 'POST',
                    dataType: "json",
                    data: { id: idM, persona: persona, ci: cedula, Lastitem: Aitem, Newitem: Nitem, nroitem: Nroitem, LastServicio: Aservicio, NewServicio:Nservicio, _token: '{{ csrf_token() }}' },
                    success: function(response) {
                        //alert(response);
                        if(response.status == 'ok'){
                            toastr.success(response.message, 'Feliciades !!');
                            $('#tablaRegistrosPersonas tr[data-id="' + idM + '"] td:nth-child(2)').text(persona); //Actualizar la fila en la tabla con los nuevos valores
                            if(Nitem != ''){ $('#tablaRegistrosPersonas tr[data-id="' + idM + '"] td:nth-child(4)').text(NitemNombre); }
                            if(Nservicio != ''){ $('#tablaRegistrosPersonas tr[data-id="' + idM + '"] td:nth-child(5)').text(NservicioNombre); }
                           // if(Nitem != 'Contrato' && Nroitem != '0'){ $('#tablaRegistrosPersonas tr[data-id="' + idM + '"] td:nth-child(6)').text(Nroitem); }  
                           $('#tablaRegistrosPersonas tr[data-id="' + idM + '"] td:nth-child(6)').text(Nroitem); 
                        }else{
                            toastr.error('Hubo un error al actualizar el registro.', 'Error, Contacte con soporte !!');
                        }
                        $('#editarModalPersonal').modal('hide');
                        $('#saveChangesPer').attr('disabled', false);
                    },
                    error: function(xhr, status, error) {
                        $('#editarModalPersonal').modal('hide');
                        if (xhr.status === 422) {
                            var errors = xhr.responseJSON.errors;
                            $.each(errors, function(field, messages) { // Mostrar los mensajes de error en algún lugar de tu página
                                toastr.error(messages.join(', '), "Error no se pude actualizar !!!", { "preventDuplicates": false});
                            $('#editarModalPersonal').modal('hide');
                            $('#saveChangesPer').attr('disabled', false);
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
        var table = $('#listarPersonas').DataTable({
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
