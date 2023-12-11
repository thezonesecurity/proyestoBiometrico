@extends("dashboard/dashboard") <!--extends se situa en views-->
@section('titulo')
 - Rolturno
@stop

@section('styles')
<link rel="stylesheet" type="text/css" href="{{ asset('bootstrap4/css/select2/select2.css') }}">
<style>
#este {
  height: 45em;
  line-height: 1em;
  overflow-x: scroll;
  overflow-y: scroll;
  width: 100%;
  border: 1px solid;
  border-color: rgba(0, 191, 255, 0.695);
}
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
.error {
    color: red;
}
</style>

@stop

@section('contenido')  

<div id="overlay" class="overlay">
    <div class="overlay-content">
        @if (!$controlUserResponsableServicio)
            <p>{{ $mensaje }}</p>
        @endif
    </div>
</div>



{!! Form::open(array('id'=>'form_reg_rolturno','autocomplete'=>'off', 'class'=>'border border-5 form-control-sm')) !!}

   @csrf
    <table class="table table-sm" >
        <tr>
            <th> 
                <div class="row" >
                    <div class="col-md-3">
                        <table class="table table-sm border border-success"> <!--REGISTRAR ROL TURNO-->
                            <center class="font-weight-bold">Nuevo Registro de Rol Turnos</center>
                            <tr>
                                <div class="form-group" style="margin-top: -5px;">
                                    {!! Form::label('servicioPer', 'Servicio', ['class' => 'font-weight-bold text-sm-left' ]) !!}
                                    @if ($controlUserResponsableServicio)
                                     <input type="text" name="servicio" id='servicio' class="form-control-sm custom-select controlServicio" value="{{ $nombreServicio }}" readonly>
                                     @else
                                      <input type="text" name="servicio" id='servicio' class="form-control-sm custom-select controlServicio" value="Sin Servicio" readonly>
                                    @endif

                                    {{--<select class="form-control-sm custom-select text-uppercase controlServicio select2" name="servicio" id='servicio'> {{--required="true"--}
                                        <option value="" disabled selected>Selecione una opcion</option> 
                                        @foreach($servicios as $id => $item)
                                            <option value="{{$id}}" > {{$item}} </option>                      
                                        @endforeach
                                    </select>--}}
                                    <small id="validacionServicio" class="form-text"></small>
                                </div>
                                <div class="form-group" style="margin-top: -10px;">
                                    {!! Form::label('gestionper', 'Mes', ['class' => 'font-weight-bold' ]) !!}
                                    <input type="month" name="gestion" id="gestion" class="form-control controlMes">
                                    <small id="validacionMes" class="form-text"></small>
                                </div>
                                <div class="form-group " style="margin-top: -10px;">
                                    <label for="personall" class="font-weight-bold">Personal</label>
                                    <select class="form-control-sm custom-select text-uppercase select2" style="width: 100%" name="personal" id="per" >
                                        <option value="Elegir personal" disabled selected>Selecione una opcion</option>
                                        @foreach($personas as $id => $persona) 
                                            <option value="{{$id}}" >{{$persona}}</option>  
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group" style="margin-top: -10px;">
                                    {!! Form::label('areaPer', 'Area de la persona', ['class' => 'font-weight-bold' ]) !!}
                                    <select class="form-control-sm custom-select select2 controlArea" style="width: 100%" name="area" id='area' >  
                                    </select>
                                </div>
                                <div class="form-group" style="margin-top: -10px;">
                                    <label for="ti dia" class="font-weight-bold">Tipo dia</label>
                                    <select class="form-control-sm custom-select" name="tipod" id="tipod">
                                        <option value="DL" selected>Dia Laboral</option>
                                        <option value="V">Vacacion</option>
                                        <option value="CV">Cuenta Vacacion</option>
                                        <option value="BM">Baja Medica</option>
                                        <option value="PE">Permiso Especial</option>
                                    </select>
                                </div>
                                <div class="form-row " style="margin-top: 10px;">
                                    <div class="form-group col">
                                        <label for="turnoo">Turno</label> 
                                        <select name="turno" id="turno" class="form-control-sm custom-select mr-sm-2">
                                            <option value="" disabled selected>Selecione una opcion</option>
                                            @foreach($turnos as $id => $turno)   
                                                <option value="{{$id}}" >{{$turno}}</option>  
                                             @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="form-row" style="margin-top: -10px;">
                                    <div class="form-group col-md-6">
                                        <label for="fecha de inicio">Fecha Ingreso</label>
                                        <input type="date" class="form-control controlFechaInicio fechaDL" name="fecha_inicio" id="fec_inicio" >
                                        <small id="validacionFechaIngreso" class="form-text"></small>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="fecha de fin">Fecha Retorno</label>
                                        <input type="date" class="form-control controlFechaVacacion fechaV"  name="fecha_fin" id="fec_fin" disabled>
                                        <small id="validacionFechaRetorno" class="form-text"></small>
                                    </div>
                                </div>
                                <div class="form-row " style="margin-top: -10px;">
                                    <div class="form-group col-md-6">
                                        <label for="hora de inicio">Hora Entrada</label>
                                        <input type="time" class="form-control " name="hora_inicio" id="hrs_inicio">
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="hora de fin">Hora Salida</label>
                                        <input type="time" class="form-control " name="hora_fin" id="hrs_fin" >
                                    </div>
                                </div>
                                <div class="form-group row " style="margin-top: -10px;">
                                    <label class="col">Observaciones</p>
                                    <textarea name="comentario" class="form-control-sm col" placeholder="Este campo es opcional" id="obs"></textarea>
                                    <small id="validacionError" class="form-text"></small>
                                </div>
                                <div class="row justify-content-center align-content-center" style="margin-top: -20px;">
                                    <button id="adicionar" class="btn btn-success btn-sm add" type="button"> Agregar</button>
                                    <button id="limpiar" class="btn btn-danger btn-sm ml-4" type="button" > Cancelar</button>                                  
                                </div>
                            </tr>
                        </table> <!--REGISTRAR ROL TURNO-->
                    </div>
                    <!---->
                    <div class="col-md-9" id="este"> {{--listar tabla--}}
                        <center class="font-weight-bold mt-2">Lista Temporal de Roles de Turno</center> <br>
                        <table id="mytable" class="table table-sm table-striped border" style="font-size: 12px;  table-layout: fixed;" width="">
                                <tr class="titulo" > {{--style="background-color: red;display: none;"--}}
                                    <th width="30px">Nro.</th>
                                    <th style="" width="130px">Persona</th>
                                    <th style="" width="90px">Servicio</th>
                                    <th style="" width="90">Area</th>
                                    <th style="" width="70">Mes</th>
                                    <th style="" width="56px">Tipo dia</th>
                                    <th style="" width="88px">Fecha ingreso</th>
                                    <th style="" width="88px">Fecha retorno</th>
                                    <th style="" width="80px">Entrada</th>
                                    <th style="" width="80px">Salida</th>
                                    <th style="" width="75">Turno</th>
                                    <th style="" width="140px">Observacion</th>
                                    <th style="" width="80px">Accion</th>
                                </tr>
                                <tr class="vacio">
                                    <td colspan="8" >No hay datos agregados ...</td>
                                </tr> 
                        </table> 
                    </div>
                </div>
            </th>
        </tr>
    </table>
    <div class="col col-md-12" style="margin-top: -12px;">
        <center>
            <button type="button" id="registrar" class="btn btn-success btn-sm ml-4">Guardar</button>
        </center>
    </div>

{!!Form::Close()!!}
   
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

<script type="text/javascript" src="{{ asset('assets/scripts/jefe_servicio/turno.js') }}"></script>
<script>
    $(document).ready(function() {
        // Mostrar el mensaje si el usuario no pertenece a un servicio
        @if (!$controlUserResponsableServicio)
            $("#overlay").show();
        @else
            $("#overlay").hide();
        @endif
        
         var exiteGestion = 0, countF_iniMes=0,countF_finMes=0;
       //*1
         //* PROCESO PARA LISTAR AREAS DE UN SERVICIO ESPECIFICO
        const area_per = $('#area');
        $.ajax({
            url: '{{ route('areas.servicio') }}',
            data: { nombreServicio: $('#servicio').val() },
            success: function(data){ //alert(data)
                area_per.html('<option value="" selected>Selecione una opcion</option>');
                $.each(data, function(id, value, estado) {
                    area_per.append('<option value="' + id + '">' + value + '</option>');
                });
            }
        });
        //* PROCESO PARA SABER SI YA ESTA REGISTRADO EL SERVICIO Y LA GESTION DE ROL TURNO
        $('.controlMes').change(function() {
            $.ajax({
                url: '{{ route('gestion.registrado') }}', //"{{ route('gestion.registrado') }}",
                type:'GET',
                data: { datos1: document.getElementById("servicio").value, datos2: document.getElementById("gestion").value, datos3: document.getElementById("area").value },
                success: function(data){
                    if(data == 'existe'){ //resp=='error'
                        $(".controlServicio").addClass('is-invalid');//no funciona
                        $('#validacionServicio').text('Error ya se tiene registrado el rol turno para ese Mes !!!').addClass('text-danger').show();
                        $(".controlMes").addClass('is-invalid');
                        $('#validacionMes').text('Error ya se tiene registrado el rol turno para ese Mes !!!').addClass('text-danger').show();
                        exiteGestion=1;
                    }else {
                        limpiarServicioGestion();
                        exiteGestion=0;
                    }  
                    return false;
                }
             });
        });
        //*2 CONTROL PARA SABER SI ES EL MISMO AÑO Y MES EN LOS INPUT FECHA INGRESO Y MES [CASO DIA LABORAL]
        $('.controlFechaInicio').change(function() {
            var fec_ini = $('.fechaDL').val();
            var mes = $('.controlMes').val();
            $mes_anioL = fec_ini.substring(0, 7);
        //   var tipodia = $('#tipod :selected').val(); //$('input[name=tipod]:checked','#form_reg_rolturno').val(); //console.log('dd 2 '+ $mes_anioL);
            if( mes != $mes_anioL  && mes != ''){//tipodia == 'DL' &&
                $(".controlMes").addClass('is-invalid');
                $('#validacionMes').text('Error no coincide los datos de Mes y Fecha Ingreso !!!').addClass('text-danger').show();
                $(".controlFechaInicio").addClass('is-invalid');
                $('#validacionFechaIngreso').text('Error no coincide los datos de Mes y Fecha Ingreso !!!').addClass('text-danger').show();
                countF_iniMes=1;
            }else{
                limpiarfec_iniMes()
                countF_iniMes=0;
            }
            return false;
        });
        //** CONTROL PARA SABER SI ES EL MISMO AÑO Y MES EN LOS INPUT FECHA INGRESO Y MES [CASO VACACION]
        $('.controlFechaVacacion').change(function() {
            var fec_fin = $('.fechaV').val();
            var mes = $('.controlMes').val();
            $mes_anioV = fec_fin.substring(0, 7); //validacionFechaRetorno
            var tipodia = $('#tipod :selected').val(); //$('input[name=tipod]:checked','#form_reg_rolturno').val(); //console.log('entro '+ fec_fin+ ' mes '+ mes+ 't dia'+ tipodia);
            if(tipodia != 'DL' && mes != $mes_anioV  && mes != ''){
                $(".controlMes").addClass('is-invalid');
                $('#validacionMes').text('Error no coincide los datos de Mes y Fecha Retorno !!!').addClass('text-danger').show();
                $(".controlFechaVacacion").addClass('is-invalid');
                $('#validacionFechaRetorno').text('Error no coincide los datos de Mes y Fecha Retorno !!!').addClass('text-danger').show();
                countF_finMes=1;
            }else{
                limpiarfec_finMes()
                countF_finMes=0;
            }
            return false;
        });
        //PROCESO PARA ADICIONAR LOS DATOS DEL FORMUALRIO A LA TABLA TEMPORAL y VALIDACION DEL FORMULARIO
        var i = 1, fila; //contador para asignar id al boton que borrara la fila
        $('#adicionar').click(function() {
            var per = $('#per :selected').text();//obtenemos el valor de todos los input
            var per_id = $('#per').val();
            var tipodia = $('#tipod :selected').val(); 
            var fec_ini = $('#fec_inicio').val();
            var fec_fin = document.getElementById("fec_fin").value;
            var hrs_ini=document.getElementById("hrs_inicio").value;
            var hrs_fin=document.getElementById("hrs_fin").value;
            var turno=document.getElementById("turno").value;
            var turno_nombre=$('#turno :selected').text();
            var gestion = document.getElementById("gestion").value; 
            //var servicio_id=document.getElementById("servicio").value; 
            var servicio =  document.getElementById("servicio").value;
            var area_id=document.getElementById("area").value; 
            var area=$('#area :selected').text();
            var obs=document.getElementById("obs").value;
            //controles de validacion del formulario
            if (servicio == 'Selecione una opcion') {
                notificaciones("Seleccione un servicio !!", "ERROR DE FORMULARIO", 'error'); //('#gestion').focus();
                return false;
            } 
            if (gestion == '') {
                notificaciones("Seleccione un mes !!", "ERROR DE FORMULARIO", 'error'); //('#gestion').focus();
                return false;
            } 
            if (per == 'Selecione una opcion') {
                notificaciones("Seleccione un personal !!", "ERROR DE FORMULARIO", 'error'); //$('#per').focus();
                return false;
            } 
            if (area == 'Selecione una opcion') {
                notificaciones("Seleccione un area !!", "ERROR DE FORMULARIO", 'error'); //$('#area').focus();
                return false;
            } 
            if (turno_nombre == 'Selecione una opcion') {
                notificaciones("Seleccione un turno !!", "ERROR DE FORMULARIO", 'error'); //$('#turno').focus();
                return false;
            }  
            if (fec_ini == '') {
                notificaciones("Seleccione una fecha de ingreso !!", "ERROR DE FORMULARIO", 'error'); //$('#fec_inicio').focus();
                return false;
            } 
            
            if(tipodia == 'DL'){// si el checkbox laboral esta seleccionado
                if (hrs_ini == '') {
                    notificaciones("Seleccione un hora de entrada !!", "ERROR DE FORMULARIO", 'error'); //$('#hrs_inicio').focus();
                    return false;
                } 
                if (hrs_fin == '') {
                    notificaciones("Seleccione una hora de salida !!", "ERROR DE FORMULARIO", 'error'); //$('#hrs_fin').focus();
                    return false;
                } 
            }
            if(tipodia != 'DL' && fec_fin == ''){ // si el checkbox vacacion esta seleccionado
                notificaciones("Seleccione una fecha de retorno !!", "ERROR DE FORMULARIO", 'error'); // $('#fec_fin').focus();
                return false;
            } 
            //proceso para guardar los datos en la lista temporal
            //$('.titulo').after(fila);
            //$('.titulo').show();
            control=-1;
            var existe;

            $("input[name^='m']").each(function(){
                if ($(this).val() == per_id) {
                existe=true;
                }
            });

            fila = '<tr  id="row' + i + '"><td>' + i + '</td> <td>'+per+'<input type="hidden" name="m[]" class="form-control" value="'+per_id+'"></td><td>'+servicio+'<input type="hidden" name="servi[]" class="form-control" value="'+servicio+'"></td><td>'+area+'<input type="hidden" name="area_per[]" class="form-control" value="'+area_id+'"></td><td>'+gestion+'<input type="hidden" name="mes[]" class="form-control" value="'+gestion+'"></td><td>'+tipodia+'<input type="hidden" name="tdia[]" class="form-control" value="'+tipodia+'"></td><td>'+fec_ini+'<input type="hidden" name="f_ini[]" class="form-control" value="'+fec_ini+'"></td><td>'+fec_fin+'<input type="hidden" name="f_fin[]" class="form-control" value="'+fec_fin+'"></td><td>'+hrs_ini+'<input type="hidden" name="h_ini[]" class="form-control" value="'+hrs_ini+'"></td><td>'+hrs_fin+'<input type="hidden" name="h_fin[]" class="form-control" value="'+hrs_fin+'"></td><td>'+turno_nombre+'<input type="hidden" name="t[]" class="form-control" value="'+turno+'"></td><td>'+obs+'<input type="hidden" name="obs[]" class="form-control" value="'+obs+'"></td><td><button type="button" name="remove" id="' + i + '" class="btn  btn-sm btn-danger btn_remove">Quitar</button></td></tr>';  
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
            
        $(document).on('click', '.btn_remove', function() { //limpia el formulario para que vuelva a contar las filas de la tabla
             var button_id = $(this).attr("id");
             $('#row' + button_id + '').remove(); //borra la fila
        });
              
        //PROCESO PARA REGISTRAR MULTIPLES FILAS DE LA TABLA  TEMPORAL
        $("#registrar").click(function(e){
            e.preventDefault();
            var cant=0;
            $("input[name^='m']").each(function(){
                cant++;
            });
            if (cant == 0) {
                toastr.error("Agregue datos mediante el formulario", "NO EXISTE ROLES DE TURNOS DEL PERSONAL!!!", { "positionClass": "toast-bottom-right" });
                return false;
            }
            var formData = new FormData(document.getElementById("form_reg_rolturno"));
            
            $.ajax({
                url:"{{route('guardar.rolturno')}}",
                type:'POST',
                dataType: "html",
                cache: false,
                contentType: false,
                processData: false,
                data: formData
            }).done(function(resp){ //alert(resp);
               if(resp=='ok'){ //resp=='error'
                    toastr.success("REGISTRO EXITOSO DE ROL DE TURNO...", { "positionClass": "toast-bottom-right" });	
                    setTimeout(function(){	
                        window.location="{{ route('listar.roles.turno') }}";
                    },4000);
                }
                else {
                toastr.error("ERROR NO SE PUDO REALIZAR EL REGISTRO", { "positionClass": "toast-bottom-right" });	
                    setTimeout(function(){	
                        window.location="{{ route('listar.registrar.rolturno') }}";
                    },4000);
                }
            });
            document.getElementById("obs").value = "";
            document.getElementById("area").value = "";
        });       
    });
</script>

@stop
