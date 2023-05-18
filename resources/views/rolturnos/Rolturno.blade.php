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
</style>
<style>
    .error {
    color: red;}
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
                        <table class="table table-sm border border-success"> <!--REGISTRAR ROL TURNO-->
                            <center class="font-weight-bold">Nuevo Registro de Rol Turnos</center>
                            <tr>
                                <div class="form-group" style="margin-top: -5px;">
                                    {!! Form::label('servicioPer', 'Servicio', ['class' => 'font-weight-bold text-sm-left' ]) !!}
                                    <select class="form-control-sm custom-select text-uppercase controlServicio select2" name="servicio" id='servicio'> {{--required="true"--}}
                                        <option value="" disabled selected>Selecione una opcion</option> 
                                        @foreach($servicios as $id => $item)
                                            <option value="{{$id}}" > {{$item}} </option>                      
                                        @endforeach
                                    </select>
                                    <small id="validacionServicio" class="form-text"></small>
                                </div>
                                <div class="form-group" style="margin-top: -10px;">
                                    {!! Form::label('gestionper', 'Mes', ['class' => 'font-weight-bold' ]) !!}
                                    <input type="month" name="gestion" id="gestion" class="form-control controlMes">
                                    <small id="validacionMes" class="form-text"></small>
                                </div>
                                <div class="form-group " style="margin-top: -10px;">
                                    <label for="personall" class="font-weight-bold">Personal</label>
                                    <select class="form-control-sm custom-select text-uppercase select2" name="personal" id="per" >
                                        <option value="Elegir personal" disabled selected>Selecione una opcion</option>
                                        @foreach($personas as $id => $persona)   
                                                <option value="{{$id}}" > {{$persona}} </option>  
                                        @endforeach
                                    </select>
                                </div>
                                
                                <div class="form-group" style="margin-top: -10px;">
                                    {!! Form::label('areaPer', 'Area de la persona', ['class' => 'font-weight-bold' ]) !!}
                                    <select class="form-control-sm custom-select text-uppercase select2" name="area" id='area' >
                                        
                                    </select>
                                </div>

                                <div class="form-group row " id="product1" style="margin-top: -10px;"> 
                                    <div class="form-check ml-4 col-auto">
                                        <input class="form-check-input" type="radio" name="tipod" id="laboral" value="DL" checked>
                                        <label class="form-check-label font-weight-bold" for="gridCheck">Dia laboral</label>
                                    </div>
                                    <div class="form-check ml-4 col-auto"> 
                                        <input class="form-check-input" type="radio" name="tipod" id="descanso" value="V">
                                        <label class="form-check-label font-weight-bold" for="gridCheck">Vacacion</label>
                                    </div>
                                </div>
                                
                                <div class="form-row font-weight-bold " style="margin-top: -10px;">
                                    <div class="form-group col">
                                        <label for="turnoo">Turno</label>
                                        <select name="turno" id="turno" class="form-control-sm custom-select mr-sm-2">
                                            <option value="" disabled selected>Selecione una opcion</option>
                                            @foreach($turnos as $id => $turno)   
                                                <option value="{{$id}}" > {{$turno}} </option>  
                                             @endforeach
                                        </select>
                                    </div>
                                </div>
                                
                                <div class="form-row font-weight-bold" style="margin-top: -10px;">
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
                                <div class="form-row font-weight-bold" style="margin-top: -10px;">
                                    <div class="form-group col-md-6">
                                        <label for="hora de inicio">Hora Entrada</label>
                                        <input type="time" class="form-control " name="hora_inicio" id="hrs_inicio">
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="hora de fin">Hora Salida</label>
                                        <input type="time" class="form-control " name="hora_fin" id="hrs_fin" >
                                    </div>
                                </div>

                                <div class="form-group row font-weight-bold" style="margin-top: -10px;">
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
                                    <td colspan="8" >No hay datos registrados</td>
                                </tr> 
                        </table> 
                    </div>
                </div>
            </th>
        </tr>
    </table>
    <div class="col col-md-12" style="margin-top: -12px;">
        <center>
            <button type="button" id="registrar" class="btn btn-success btn-sm ml-4"> Guardar</button>
        </center>
    </div>
    {!!Form::Close()!!}
   
@stop

@section('scripts')

<script type="text/javascript" src="{{ asset('scripts/jefe_servicio/turno.js') }}"></script>
<script type="text/javascript" src="{{ asset('bootstrap4/js/select2/select2.js') }}"></script>
<script>
    $(document).ready(function() {
         var exiteGestion = 0, countF_iniMes=0,countF_finMes=0;
          //FUNCIONES PARA LIMPIAR EL FORMULARIO Y LAS ALERTAS DE VALIDACION
          function limpiarServicioGestion(){ //caso de si ya esta registrado el servicio y la gestion
            $(".controlServicio").removeClass('is-invalid');
            $('#validacionServicio').text('Error ya se tiene registrado el rol turno para ese Mes !!!').removeClass('text-danger').hide();
            $(".controlMes").removeClass('is-invalid');
            $('#validacionMes').text('Error ya se tiene registrado el rol turno para ese Mes !!!').removeClass('text-danger').hide();
            $('#validacionError').text('Error verifique los errores del formulario !!!').removeClass('text-danger').hide();
         }
         function limpiarfec_iniMes(){ //caso para ver si los mismos datos de mes y fecha inicio
            $(".controlMes").removeClass('is-invalid');
            $('#validacionMes').text('Error no coincide los datos de Mes y Fecha Ingreso !!!').removeClass('text-danger').hide();
            $(".controlFechaInicio").removeClass('is-invalid');
            $('#validacionFechaIngreso').text('Error no coincide los datos de Mes y Fecha Ingreso !!!').removeClass('text-danger').hide();
            $('#validacionError').text('Error verifique los errores del formulario !!!').removeClass('text-danger').hide();
         }
         function limpiarfec_finMes(){ //caso para ver si los mismos datos de mes y fecha fin
            $(".controlMes").removeClass('is-invalid');
            $('#validacionMes').text('Error no coincide los datos de Mes y Fecha Ingreso !!!').removeClass('text-danger').hide();
            $(".controlFechaVacacion").removeClass('is-invalid');
            $('#validacionFechaRetorno').text('Error no coincide los datos de Mes y Fecha Ingreso !!!').removeClass('text-danger').hide();
            $('#validacionError').text('Error verifique los errores del formulario !!!').removeClass('text-danger').hide();
         }
        function limpiarform(){
            document.getElementById("servicio").value = "";//no limpia
            document.getElementById("per").value = "";//no limpia
            document.getElementById("gestion").value = "";
            document.getElementById("area").value = "";
            document.getElementById("turno").value = "";
            document.getElementById("fec_inicio").value = "";
            document.getElementById("fec_fin").value = "";
            document.getElementById("hrs_inicio").value = "";
            document.getElementById("hrs_fin").value = "";
            document.getElementById("obs").value = "";
            $('#validacionError').text('Error verifique los errores del formulario !!!').removeClass('text-danger').hide();
        }
        function limpiarformParcial(){
            document.getElementById("fec_inicio").value = "";
            document.getElementById("fec_fin").value = "";
            document.getElementById("hrs_inicio").value = "";
            document.getElementById("hrs_fin").value = "";
            document.getElementById("obs").value = "";
        }
         //CONTROLES PARA HABILITAR Y DESHABILITAR LOS INPUTS EN LOS CASOS DE LABORAL Y VACACION
         $('#laboral').on('change', function(e){ //CASO DIA LABORAL
            //var selected = document.querySelector('input[type=radio][name=tipod]:checked');
            // alert(selected.value)
            e.preventDefault();
            $('#laboral').prop("checked", true);
            $('#descanso').prop("checked", false);
            $('#fec_fin').prop("disabled", true);
            $('#hrs_inicio').prop("disabled", false);
            $('#hrs_fin').prop("disabled", false);
            // $('#turno').prop("disabled", false);
            $('#area').prop("disabled", false);
              // $('#obs').prop("disabled", false);
        });

        $('#descanso').on('change', function(e){// CASO VACACION
            e.preventDefault();
            $('#laboral').prop("checked", false);
            $('#descanso').prop("checked", true);
            $('#fec_inicio').prop("disabled", false);
            $('#fec_fin').prop("disabled", false);
            $('#hrs_inicio').prop("disabled", true);
            $('#hrs_fin').prop("disabled", true);
            //$('#turno').prop("disabled", false);
            $('#area').prop("disabled", false);
             // $('#obs').prop("disabled", false);
        });
        //PROCESO PARA LISTAR AREAS DE SERVICIO ESPECIFICO
        $('#servicio').change(function() {
            const area_per = $('#area');
            //var servi =  $('#servicio').val(); // console.log('aaa '+ servi);
            $.ajax({
                url: '{{ route('areas.servicio') }}',
                data: { servicio_id: $(this).val() },
                success: function(data){ // alert(data)
                    area_per.html('<option value="" selected disabled >Selecione una opcion</option>');
                    $.each(data, function(id, value, estado) {
                        area_per.append('<option value="' + id + '">' + value + '</option>');
                    });
                }
            });
        });
        //PROCESO PARA SABER SI YA ESTA REGISTRADO EL SERVICIO Y LA GESTION DE ROL TURNO
        $('.controlMes').change(function() {
            $.ajax({
                url: '{{ route('gestion.registrado') }}', //"{{ route('gestion.registrado') }}",
                type:'GET',
                data: { datos1: document.getElementById("servicio").value, datos2: document.getElementById("gestion").value, datos3: document.getElementById("area").value },
                success: function(data){
                //   alert(data)
                    if(data == 'existe'){ //resp=='error'
                        $(".controlServicio").addClass('is-invalid');//no funciona
                        $('#validacionServicio').text('Error ya se tiene registrado el rol turno para ese Mes !!!').addClass('text-danger').show();
                        $(".controlMes").addClass('is-invalid');
                        $('#validacionMes').text('Error ya se tiene registrado el rol turno para ese Mes !!!').addClass('text-danger').show();
                        exiteGestion=1;
                    }else {
                        limpiarServicioGestion()
                        exiteGestion=0;
                    }  
                    return false;
                }
             });
        });
        //CONTROL PARA SABER SI ES EL MISMO AÑO Y MES EN LOS INPUT FECHA INGRESO Y MES [CASO DIA LABORAL]
        $('.controlFechaInicio').change(function() {
            var fec_ini = $('.fechaDL').val();
            var mes = $('.controlMes').val();
            $mes_anioL = fec_ini.substring(0, 7);
            var tipodia = $('input[name=tipod]:checked','#form_reg_rolturno').val(); //console.log('dd 2 '+ $mes_anioL);
            if(tipodia == 'DL' && mes != $mes_anioL  && mes != ''){
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
        //CONTROL PARA SABER SI ES EL MISMO AÑO Y MES EN LOS INPUT FECHA INGRESO Y MES [CASO VACACION]
        $('.controlFechaVacacion').change(function() {
            var fec_fin = $('.fechaV').val();
            var mes = $('.controlMes').val();
            $mes_anioV = fec_fin.substring(0, 7); //validacionFechaRetorno
            var tipodia = $('input[name=tipod]:checked','#form_reg_rolturno').val(); //console.log('entro '+ fec_fin+ ' mes '+ mes+ 't dia'+ tipodia);
            if(tipodia == 'V' && mes != $mes_anioV  && mes != ''){
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
       //PROCESO PARA LIMPIAR EL FORMULARIO
       $('#limpiar').click(function() {//para limpiar el formulario  cuando cancelas
            limpiarform();
            limpiarServicioGestion();
            limpiarfec_iniMes();
            limpiarfec_finMes();
        });
        
        //PROCESO PARA ADICIONAR LOS DATOS DEL FORMUALRIO A LA TABLA TEMPORAL y VALIDACION DEL FORMULARIO
        var i = 1, fila; //contador para asignar id al boton que borrara la fila
        $('#adicionar').click(function() {
            //obtenemos el valor de todos los input
            var per = $('#per :selected').text();
            var per_id = $('#per').val();
            var fec_ini = $('#fec_inicio').val();
            var tipodia = $('input[name=tipod]:checked','#form_reg_rolturno').val();
            var fec_fin = document.getElementById("fec_fin").value;
            var hrs_ini=document.getElementById("hrs_inicio").value;
            var hrs_fin=document.getElementById("hrs_fin").value;
            var turno=document.getElementById("turno").value;
            var turno_nombre=$('#turno :selected').text();
            var gestion = document.getElementById("gestion").value; 
            var servicio_id=document.getElementById("servicio").value; 
            var servicio = $('#servicio :selected').text();// console.log('-> '+servicio+' -> '+ gestion);
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
            if(tipodia == 'V' && fec_fin == ''){ // si el checkbox vacacion esta seleccionado
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

            fila = '<tr  id="row' + i + '"><td>' + i + '</td> <td>'+per+'<input type="hidden" name="m[]" class="form-control" value="'+per_id+'"></td><td>'+servicio+'<input type="hidden" name="servi[]" class="form-control" value="'+servicio_id+'"></td><td>'+area+'<input type="hidden" name="area_per[]" class="form-control" value="'+area_id+'"></td><td>'+gestion+'<input type="hidden" name="mes[]" class="form-control" value="'+gestion+'"></td><td>'+tipodia+'<input type="hidden" name="tdia[]" class="form-control" value="'+tipodia+'"></td><td>'+fec_ini+'<input type="hidden" name="f_ini[]" class="form-control" value="'+fec_ini+'"></td><td>'+fec_fin+'<input type="hidden" name="f_fin[]" class="form-control" value="'+fec_fin+'"></td><td>'+hrs_ini+'<input type="hidden" name="h_ini[]" class="form-control" value="'+hrs_ini+'"></td><td>'+hrs_fin+'<input type="hidden" name="h_fin[]" class="form-control" value="'+hrs_fin+'"></td><td>'+turno_nombre+'<input type="hidden" name="t[]" class="form-control" value="'+turno+'"></td><td>'+obs+'<input type="hidden" name="obs[]" class="form-control" value="'+obs+'"></td><td><button type="button" name="remove" id="' + i + '" class="btn  btn-sm btn-danger btn_remove">Quitar</button></td></tr>';  
            i++;
            $('.vacio').hide();//para oculta la fila de NO EXISTEN DATOS en la tabla
            //console.log('fila'+ fila);
            
            if(exiteGestion == 0 && countF_iniMes == 0 && countF_finMes == 0){
                $('#mytable .titulo').after(fila); //before //se añade los datos a la lista
                limpiarformParcial(); //para limpiar el formulario despues de registrarlo
                $('#validacionError').text('Error verifique los errores del formulario !!!').removeClass('text-danger').hide();
            }else{
                //console.log('error ');
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
                toastr.error("Agregue datos mediante el formulario", "NO EXISTE ROLES DE TURNOS DEL PERSONAL!!!", {
                    "positionClass": "toast-bottom-right"
                });
                return false;
            }
            var formData = new FormData(document.getElementById("form_reg_rolturno")); //form_reg_rolturno
            
            $.ajax({
                url:"{{route('guardar.rolturno')}}",
                type:'POST',
                dataType: "html",
                cache: false,
                contentType: false,
                processData: false,
                data: formData
            }).done(function(resp){
            //alert(resp);
                if(resp=='ok'){ //resp=='error'
                    toastr.success("REGISTRO EXITOSO DE ROL DE TURNO...");	
                    setTimeout(function(){	
                        window.location="{{ route('listar.registrar.rolturno') }}";
                    },4000);
                }
                else {
                //alert(resp);
                toastr.error("ERROR NO SE PUDO REALIZAR EL REGISTRO");	
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

<script type="text/javascript">
    $('.select2').select2({
        placeholder: "Seleccione una opcion",
        allowClear: true
    });
</script>
{{--
<script type="text/javascript">
  $(document).ready(function(){
    //PROCESO PARA SABER SI YA ESTA REGISTRADO EL SERVICIO Y LA GESTION DE ROL TURNO
    $(document).on('click', '.add', function(e) { 
        e.preventDefault();
       // const datos = [document.getElementById("servicio").value, document.getElementById("gestion").value]; //form_reg_rolturno
        //console.log(' area -> '+ $('#area :selected').text() +' su id -> '+  document.getElementById("area").value);
        $.ajax({
            url: "{{ route('gestion.registrado') }}",
            data: { datos1: document.getElementById("servicio").value, datos2: document.getElementById("gestion").value, datos3: document.getElementById("area").value },
            success: function(data){
             //   alert(data)
                if(data == 'existe'){ //resp=='error'
                    $(".controlServicio").addClass('is-invalid');//no funciona
                    $('#validacionServicio').text('Error ya se tiene registrado el rol turno para ese Mes !!!').addClass('text-danger').show();
                    $(".controlMes").addClass('is-invalid');
                    $('#validacionMes').text('Error ya se tiene registrado el rol turno para ese Mes !!!').addClass('text-danger').show();
                }else {
                    $(".controlServicio").removeClass('is-invalid');//no funciona
                    $('#validacionServicio').text('Error ya se tiene registrado el rol turno para ese Mes !!!').removeClass('text-danger').hide();
                    $(".controlMes").removeClass('is-invalid');
                    $('#validacionMes').text('Error ya se tiene registrado el rol turno para ese Mes !!!').removeClass('text-danger').hide();
                }  
                return false;
                /* if(data == 'existe'){
                    toastr.error("ERROR YA SE TIENE REGISTRADO EL ROL TURNO PARA ESA GESTION",{"positionClass": "toast-bottom-right"});	
                    setTimeout(function(){	
                        window.location="{{ route('listar.registrar.rolturno') }}";
                    },4000);
                   
                   return false;
                   }  */
            }
        });
    });

    //PROCESO PARA LISTAR AREAS DE SERVICIO ESPECIFICO
    $('#servicio').change(function() {
        const area_per = $('#area');
        //var servi =  $('#servicio').val();
      // console.log('aaa '+ servi);
        $.ajax({
            url: "{{ route('areas.servicio') }}",
            data: { servicio_id: $(this).val() },
            success: function(data){
               // alert(data)
                area_per.html('<option value="" selected disabled >Selecione una opcion</option>');
                $.each(data, function(id, value, estado) {
                    area_per.append('<option value="' + id + '">' + value + '</option>');
                });
            }
        });
    });
    
     //PROCESOS PARA GUARDAR MULTIPLES DATOS
    $("#registrar").click(function(e){
        var cant=0;
        $("input[name^='m']").each(function(){
            cant++;
        });
        if (cant == 0) {
            toastr.error("Agregue datos mediante el formulario", "NO EXISTE ROLES DE TURNOS DEL PERSONAL!!!", {
                "positionClass": "toast-bottom-right"
            });
            //$('#adicionar').focus();
            return false;
        }
        //console.log('cantidad '+cont);
        //*
        e.preventDefault();
        //$('#boton1').attr('disabled', true).text('Registrando...');
        var f= $(this);
        //console.log('cantidad '+f);
        var formData = new FormData(document.getElementById("form_reg_rolturno")); //form_reg_rolturno
        
        $.ajax({
            url:"{{route('guardar.rolturno')}}",
            type:'POST',
            dataType: "html",
            cache: false,
            contentType: false,
            processData: false,
            data: formData
        }).done(function(resp){
        //alert(resp);
            if(resp=='ok'){ //resp=='error'
                toastr.success("REGISTRO EXITOSO DE ROL DE TURNO...");	
                setTimeout(function(){	
                    window.location="{{ route('listar.registrar.rolturno') }}";
                },4000);
             }
            else {
               //alert(resp);
               toastr.error("ERROR NO SE PUDO REALIZAR EL REGISTRO");	
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
--}}
@stop


{{--<thead>
                        <tr>
                            <th width="10px">Nro.</th>
                            <th style="text-align: center;" width="10px">Persona</th>
                            <th style="text-align: center;" width="10px">tipo dia</th>
                            <th style="text-align: center;" width="10px">Fecha ini</th>
                            <th style="text-align: center;" width="10px">Fecha fin</th>
                            <th style="text-align: center;" width="10px">Hora ini</th>
                            <th style="text-align: center;" width="10px">Hora fin</th>
                            <th style="text-align: center;" width="10px">turo</th>
                            <th style="text-align: center;" width="10px">Area</th>
                            <th style="text-align: center;" width="10px">Observacion</th>
                            <th style="text-align: center;" width="10px">Accion</th>
                        </tr>
                      </thead>
                      <tbody style=" border: 1px solid rgba(0, 0, 255, 0.239); width: 100px;  word-wrap: break-word;">
                        
                        <tr class="titulo" style="background-color: red;display: none;">
                            <th width="10px">Nro.</th>
                            <th style="text-align: center;">Persona</th>
                            <th style="text-align: center;">Fecha</th>
                            <th style="text-align: center;">Horaf</th>
                            <th style="text-align: center;">turo</th>
                            <th style="text-align: center;">area</th>
                            <th style="text-align: center;">Observacion</th>
                            <th style="text-align: center;">Accion</th>
                        </tr>--}} 
                        {{--
                      </tbody>--}}


    {{--jquery *
        //alert(formData)
       /*
        console.log('formdata');
        console.log(formData.get('personal'));
        console.log(formData.get('area'));
        console.log(formData.get('comentario'));
        console.log(formData.get('tipod'));
        console.log(formData.get('fecha_inicio'));
        console.log(formData.get('fecha_fin'));
        console.log(formData.get('hora_inicio'));
        console.log(formData.get('hora_fin'));
        console.log(formData.get('turno'));
        */
        //$array = explode(",", formData.get('personal'));//convertiendo string a arrar(personal[nombrecompleto,idper_db])
        //dd('nombre '.$array[0].' id es '.$array[1]);
        //console.log('nombre '+$array[0]+' id es '+$array[1]);
       
        //console.log(formData);
        --}}