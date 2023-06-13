@extends("dashboard/dashboard") <!--extends se situa en views-->
@section('titulo')
 - Registrar-Editar Rolturno
@stop

@section('styles')
<link rel="stylesheet" type="text/css" href="{{ asset('bootstrap4/css/select2/select2.css') }}">
<style>
    #este {
  height: 45em;
  line-height: 2em;
  overflow-x: scroll;
  overflow-y: scroll;
  width: 100%;
  border: 1px solid;
  border-color: rgba(0, 191, 255, 0.695);
}
.error { color: red; }

</style>
@stop

@section('contenido')    

{!! Form::open(array('id'=>'form_reg_rolturno','autocomplete'=>'off', 'class'=>'border border-5 form-control-sm')) !!}
    @csrf
     <table class="table table-sm" >
         <tr>
             <th> 
                 <div class="row" >
                     <div class="col-md-3">
                         <table class="table table-sm border border-success"> <!--REGISTRAR LISTA ROL TURNO-->
                             <center class="font-weight-bold">Seguir Registrando Rol Turnos</center>
                             <tr>
                                 <div class="form-group">
                                     {!! Form::label('servicioPer', 'Servicio', ['class' => 'font-weight-bold text-sm-left' ]) !!}
                                     <input type="text" class="form-control" name="servicioM" id='servicioM' readonly>
                                     <input type="hidden" class="form-control" name="s" id='servicio' readonly>   
                                 </div>
                                 
                                 <div class="form-group" style="margin-top: -10px;">
                                    {!! Form::label('gestionper', 'Gestion', ['class' => 'font-weight-bold' ]) !!}
                                    <input type="month" name="gestionM" id="gestionM" class="form-control controlMes" readonly>
                                    <small id="validacionMes" class="form-text"></small>
                                </div>

                                 <div class="form-group " style="margin-top: -10px;">
                                     <label for="personall" class="font-weight-bold">Personal</label>
                                     <select class="form-control-sm custom-select text-uppercase select2" style="width: 100%" name="personal" id="per" >
                                     </select>
                                 </div>

                                 <div class="form-group" style="margin-top: -10px;">
                                     {!! Form::label('areaPer', 'Area de la persona', ['class' => 'font-weight-bold' ]) !!}
                                     <select class="form-control-sm custom-select text-uppercase select2" style="width: 100%" name="area" id='area' >
                                     </select>
                                 </div>
                                 <div class="form-group" style="margin-top: -10px;">
                                    <label for="ti_dia" class="font-weight-bold">Tipo dia</label>
                                    <select class="form-control-sm custom-select" name="tipodia" id="tipodia">
                                        <option value="DL" selected>Dia Laboral</option>
                                        <option value="V">Vacacion</option>
                                        <option value="CV">Cuenta Vacacion</option>
                                        <option value="BM">Baja Medica</option>
                                        <option value="PE">Permiso Especial</option>
                                    </select>
                                </div>
                                 <div class="form-row" style="margin-top: -10px;" >
                                     <div class="form-group col">
                                         <label for="turnoo" class="font-weight-bold">Turno</label>
                                         <select name="turno" id="turno" class="form-control-sm custom-select mr-sm-2" >
                                             <option value="" disabled selected>Selecione una opcion</option>
                                             @foreach($turnos as $id => $turno)   
                                                <option value="{{$id}}" > {{$turno}} </option>  
                                             @endforeach
                                         </select>
                                     </div>
                                 </div>
                                 <div class="form-row" style="margin-top: -10px;">
                                     <div class="form-group col-md-6">
                                         <label for="fecha_sinicio" class="font-weight-bold" >Fecha Igreso</label>
                                         <input type="date" class="form-control controlFechaInicio fechaDL" name="fecha_inicio" id="fec_inicio">
                                         <small id="validacionFechaIngreso" class="form-text"></small>
                                     </div>
                                     <div class="form-group col-md-6">
                                         <label for="fecha_sfin" class="font-weight-bold" >Fecha Retorno</label>
                                         <input type="date" class="form-control controlFechaVacacion fechaV"  name="fecha_fin" id="fec_fin" disabled>
                                         <small id="validacionFechaRetorno" class="form-text"></small>
                                     </div>
                                 </div>
                                 <div class="form-row " style="margin-top: -10px;">
                                     <div class="form-group col-md-6">
                                         <label for="hora_de_inicio" class="font-weight-bold" >Hora Entrada</label>
                                         <input type="time" class="form-control " name="hora_inicio" id="hrs_inicio">
                                     </div>
                                     <div class="form-group col-md-6">
                                         <label for="hora_de_fin" class="font-weight-bold" >Hora Salida</label>
                                         <input type="time" class="form-control" name="hora_fin" id="hrs_fin" >
                                     </div>
                                 </div>
                                 <div class="form-group" style="margin-top: -10px;">
                                    <div class="row">
                                        <div class="row-md-3 font-weight-bold" ><label class="col">Observaciones</p> </div>
                                        <div class="row-md-5 ml-5">
                                                <label class="col font-weight-bold" >Cambio turno</label>
                                                <input class="form-check-input" type="checkbox" name="cambioT" id="cambio" style="margin-left: -10px;">
                                        </div>
                                    </div>
                                    <div class="row-md-auto" style="margin-top: -15px;">
                                        <div class="col" >
                                            <textarea name="comentario" class="form-control " placeholder="Este campo es opcional" id="obs" ></textarea>
                                            <small id="validacionError" class="form-text"></small>
                                        </div>
                                    </div>
                                 </div>
                                 <div class="row justify-content-center align-content-center" style="margin-top: -1px;">
                                     <button id="adicionar" class="btn btn-success btn-sm adicionarForm" type="button"> Agregar</button>
                                     <button id="limpiar" class="btn btn-danger btn-sm ml-4 limpiarForm" type="button" > Cancelar</button>                                  
                                 </div>
                             </tr>
                         </table>
                     </div>
                     <!---->
                     <div class="col-md-9" id="este"> {{--LISTAR ROLTURNOS--}}
                         <center class="font-weight-bold"> <h5>Lista de registro de Roles de Turno</h5></center>
                         <table id="mytable" class="table table-sm table-striped border" style="font-size: 12px;  table-layout: fixed;" width="">
                                 <tr class="titulo" > {{--style="background-color: red;display: none;"--}}
                                     <th width="30px">Nro.</th>
                                     <th style="" width="130px">Persona</th>
                                    <th style="" width="90px">Servicio</th>
                                    <th style="" width="90">Area</th>
                                    <th style="" width="70">Mes</th>
                                    <th style="" width="54px">tipo dia</th>
                                    <th style="" width="88px">Fecha ingreso</th>
                                    <th style="" width="88px">Fecha retorno</th>
                                    <th style="" width="80px">Entrada</th>
                                    <th style="" width="80px">Salida</th>
                                    <th style="" width="70">Turno</th>
                                    <th style="font-size: 10px;" width="75">Cambio turno</th>
                                    <th style="" width="140px">Observacion</th>
                                    <th style="" width="80px">Accion</th>
                                 </tr>
                                 @include('dashboard.mensaje')

                                 <tbody id="mostrarLista" style="display: none"> <?php  $i=0; //F6F1E9 E4DCCF F0EEED " ?>
                                    @foreach ($per_rolturnos as $rolturno)
                                        @if($rolturno->estado == 'Habilitado')             
                                            <tr style="background-color: #F6F1E9">
                                                <td>{{++$i}}</td>
                                                <td id="persona{{$rolturno->id}}" >{{$rolturno->rolturno_per->nombres}}</td>
                                                <td id="servi"><span id="servicio{{$rolturno->id}}" >{{$rolturno->per_rolturno->servicios->nombre}}</span></td>
                                                <td id="area{{$rolturno->id}}" >{{$rolturno->area->nombre}}</td>
                                                <td id="gesti"><span id="gestion{{$rolturno->id}}" >{{$rolturno->per_rolturno->gestion}}</span></td>
                                                <td id="tdia{{$rolturno->id}}" >{{$rolturno->tipo_dia}}</td>
                                                <td id="f_ini{{$rolturno->id}}" >{{$rolturno->fecha_inicio}}</td>
                                                <td id="f_fin{{$rolturno->id}}" >{{$rolturno->fecha_fin}}</td>
                                                <td id="h_ini{{$rolturno->id}}" >{{$rolturno->hora_inicio}}</td>
                                                <td id="h_fin{{$rolturno->id}}" >{{$rolturno->hora_fin}}</td>
                                                <td id="turno{{$rolturno->id}}" >{{$rolturno->tipoTurno->nombre}}</td>
                                                <td id="cambio_turno{{$rolturno->id}}" >{{$rolturno->cambio_turno}}</td>
                                                {{--<td id="estado{{$rolturno->id}}" >{{$rolturno->estado}}</td>--}}
                                                <td id="obs{{$rolturno->id}}" class="comment">{{$rolturno->obs}}</td>
                                                <td>
                                                    <button type="button" class="btn btn-success btn-sm editbtn" value="{{$rolturno->id}}" data-toggle="modal" data-target="#editModal"><i class="bi bi-pencil-square" style="font-size: 14px;"></i></button>
                                                    <button type="button" class="btn btn-danger btn-sm deletebtn" value="{{$rolturno->id}}" data-toggle="modal" data-target="#eliminarModal"><i class="bi bi-trash" style="font-size: 14px;"></i></button>
                                                </td>
                                            </tr>
                                        @endif
                                    @endforeach
                                </tbody>
                         </table> 
                     </div>
                 </div>
             </th>
         </tr>
     </table>
     <div class="col col-md-12" style="margin-top: -12px;">
         <center>
             <button type="button" id="registrarBtn" class="btn btn-success btn-sm ml-4"> Guardar </button>  
             <button type="button" id="mostrar1" class="btn btn-info btn-sm ml-3" >Mostrar Lista</button>
             <button type="button" id="mostrar2" class="btn btn-warning btn-sm ml-3" style="display: none;">Ocultar Lista</button>
         </center>
 
{!!Form::Close()!!}
     @include('rolturnos.ModalEditarRolturno')
     @include('rolturnos.ModalEliminarRolturno')
@stop

@section('scripts')
<script type="text/javascript" src="{{ asset('bootstrap4/js/select2/select2.js') }}"></script>
<script type="text/javascript">
    $('.select2').select2({
        placeholder: "Seleccione una opcion",
        allowClear: true,
        ancho : 'resolver'
    });
</script>

<script type="text/javascript" src="{{ asset('assets/scripts/jefe_servicio/turnoTest.js') }}"></script>
<script src="{{asset('jquery-validate/jquery.validate.js')}}"></script>
<script type="text/javascript" src="{{ asset('assets/scripts/jefe_servicio/editarturno.js') }}"></script>

<script>
 $(document).ready(function(){
    var exiteGestion = 0, countF_iniMes=0,countF_finMes=0;
    //*1 PROCESO PARA LISTAR AREAS DE SERVICIO ESPECIFICO
    $('#servicioM').val($('#servi').text());
    $('#gestionM').val($('#gesti').text());
    const area_per = $('#area');
    $.ajax({
        url: "{{ route('areas.servicio.test') }}",
        data: { servicio_id: $('#servi').text()}, //$(this).val() 
        success: function(data){
            //alert(data);
            area_per.html('<option value="" selected disabled >Selecione una opcion</option>');
            $.each(data, function(id, value) {
                area_per.append('<option value="' + id + '">' + value + '</option>');
            });
        }
    });
     //PROCESO PARA SABER K PERSONAS PERTENECE A K SERVICIO
    const personas = $('#per');
    $.ajax({
        url: "{{ route('servicio.personas') }}",
        data: { servicio: $('#servi').text()}, //$(this).val() 
        success: function(data){
            personas.html('<option value="" selected disabled >Selecione una opcion</option>');
            $.each(data, function(id, value) {
                personas.append('<option value="' + id + '">' + value + '</option>');
            });
        }
    });
    //*2
    //PROCESO PARA ADICIONAR LOS DATOS DEL FORMUALRIO A LA TABLA TEMPORAL y VALIDACION DEL FORMULARIO
    var i = 1, fila; //contador para asignar id al boton que borrara la fila
    $('.adicionarForm').click(function() {
        //obtenemos el valor de todos los input
        var per = $('#per :selected').text();
        var gestion = document.getElementById("gestionM").value; //console.log('gestion ser '+ gestion);
        var per_id = $('#per').val();
        var fec_ini = $('#fec_inicio').val();
        var tipodia = $('#tipodia').val(); //$('input[name=tipod]:checked','#form_reg_rolturno').val();
        var fec_fin = document.getElementById("fec_fin").value;
        var hrs_ini=document.getElementById("hrs_inicio").value;
        var hrs_fin=document.getElementById("hrs_fin").value;
        var turno=document.getElementById("turno").value;
        var turno_nombre=$('#turno :selected').text();
        //var servicio_id=0;//document.getElementById("servicioM").value; 
        var servicio = document.getElementById("servicioM").value;
        var cambio_turno='F';
        var area_id=document.getElementById("area").value; 
        var area=$('#area :selected').text();
        var obs=document.getElementById("obs").value;
    
       if( $('#cambio').is(':checked') ) { cambio_turno = 'V';}
      
       if (per == 'Selecione una opcion') {
         notificaciones("Seleccione un personal", "ERROR DE FORMULARIO", 'error'); //$('#per').focus();
         return false;
       } 
       if (area == 'Selecione una opcion') {
         notificaciones("Seleccione un area", "ERROR DE FORMULARIO", 'error'); //$('#area').focus();
         return false;
       } 
       if (turno_nombre == 'Selecione una opcion') {
         notificaciones("Seleccione un turno", "ERROR DE FORMULARIO", 'error'); //$('#turno').focus();
         return false;
       }  
       if (fec_ini == '') {
         notificaciones("Seleccione una fecha de ingreso", "ERROR DE FORMULARIO", 'error'); //$('#fec_inicio').focus();
         return false;
       } 
       if(tipodia == 'DL'){// si el checkbox laboral esta seleccionado
            if (hrs_ini == '') {
            notificaciones("Seleccione un hora de entrada", "ERROR DE FORMULARIO", 'error'); //$('#hrs_inicio').focus();
            return false;
            } 
            if (hrs_fin == '') {
            notificaciones("Seleccione una hora de salida", "ERROR DE FORMULARIO", 'error'); //$('#hrs_fin').focus();
            return false;
            } 
        }
        if(tipodia != 'DL' && fec_fin == ''){ // si el checkbox vacacion esta seleccionado
            notificaciones("Seleccione una fecha de retorno", "ERROR DE FORMULARIO", 'error'); // $('#fec_fin').focus();
            return false;
        } 
        //proceso para guardar los datos en la lista temporal
        //$('.titulo').after(fila);  //$('.titulo').show();
        control=-1;
        var existe;
        $("input[name^='m']").each(function(){
        if ($(this).val() == per_id) {
            existe=true;
        }
        });
        
        fila = '<tr  id="row' + i + '"><td>' + i + '</td> <td>'+per+'<input type="hidden" name="m[]" class="form-control" value="'+per_id+'"></td><td>'+servicio+'<input type="hidden" name="servi[]" class="form-control" value="'+servicio+'"></td><td>'+area+'<input type="hidden" name="area_per[]" class="form-control" value="'+area_id+'"></td><td>'+gestion+'<input type="hidden" name="gesti[]" class="form-control" value="'+gestion+'"></td><td>'+tipodia+'<input type="hidden" name="tdia[]" class="form-control" value="'+tipodia+'"></td><td>'+fec_ini+'<input type="hidden" name="f_ini[]" class="form-control" value="'+fec_ini+'"></td><td>'+fec_fin+'<input type="hidden" name="f_fin[]" class="form-control" value="'+fec_fin+'"></td><td>'+hrs_ini+'<input type="hidden" name="h_ini[]" class="form-control" value="'+hrs_ini+'"></td><td>'+hrs_fin+'<input type="hidden" name="h_fin[]" class="form-control" value="'+hrs_fin+'"></td><td>'+turno_nombre+'<input type="hidden" name="t[]" class="form-control" value="'+turno+'"></td><td>'+cambio_turno+'<input type="hidden" name="cambio_turno[]" class="form-control" value="'+cambio_turno+'"></td><td>'+obs+'<input type="hidden" name="obs[]" class="form-control" value="'+obs+'"></td><td><button type="button" name="remove" id="' + i + '" class="btn  btn-sm btn-danger btn_remove">Quitar</button></td></tr>';  
        i++;
        $('.vacio').hide();//para oculta la fila de NO EXISTEN DATOS en la tabla
        if(exiteGestion == 0 && countF_iniMes == 0 && countF_finMes == 0){
            $('#mytable .titulo').after(fila); //before //se añade los datos a la lista
            limpiarformParcial(); //para limpiar el formulario despues de registrarlo
            $('#validacionError').text('Error verifique los errores del formulario !!!').removeClass('text-danger').hide();
        }else{
            $('#validacionError').text('Error verifique los errores del formulario !!!').addClass('text-danger').show();
        }
    });
    //limpia el formulario para que vuelva a contar las filas de la tabla
    $(document).on('click', '.btn_remove', function() { 
    var button_id = $(this).attr("id");
      $('#row' + button_id + '').remove(); //borra la fila
    });
    //PROCESO PARA REGISTRAR MULTIPLES FILAS DE LA TABLA  TEMPORAL 
    $("#registrarBtn").click(function(e){    
            e.preventDefault();
            var cant=0;
            $("input[name^='m']").each(function(){
                cant++;
            });
            if (cant == 0) {
                notificaciones("Agregue datos mediante el formulario", "NO EXISTE ROLES DE TURNOS DEL PERSONAL!!!", 'error');
               /* toastr.error("Agregue datos mediante el formulario", "NO EXISTE ROLES DE TURNOS DEL PERSONAL!!!", {
                    "positionClass": "toast-bottom-right"
                });*/
                return false;
            }
            var formData = new FormData(document.getElementById("form_reg_rolturno")); //form_reg_rolturno
            $.ajax({
                url:"{{route('guardar.rolturno.test')}}",
                type:'POST',
                dataType: "html",
                cache: false,
                contentType: false,
                processData: false,
                data: formData
    
            }).done(function(resp){
                // alert(resp);
                if(resp=='ok'){ //resp=='error'
                    toastr.success("Se registro correctamente", "REGISTRO EXITOSO DE ROL DE TURNO");
                    setTimeout(function(){	
                        window.location="{{ route('listar.roles.turno') }}";
                    },4000);
                }
                else {
                    //alert(resp);
                   toastr.error("Contacte con soporte", "ERROR NO SE PUDO REALIZAR EL REGISTRO");
                        setTimeout(function(){	
                        window.location="{{ route('listar.roles.turno') }}";
                    },4000);
                }
            });
            document.getElementById("obs").value = "";
            document.getElementById("area").value = "";
    });
});
</script>

@stop
