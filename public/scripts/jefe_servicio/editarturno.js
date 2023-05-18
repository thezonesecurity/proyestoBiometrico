$(document).ready(function(){
     //funciones para validar los inputs mes y fechas
    function limpiarfec_iniMes(){ //caso para ver si los mismos datos de mes y fecha inicio
        $(".controlMesM").removeClass('is-invalid');
        $('#validacionMesM').text('Error no coincide los datos de Mes y Fecha Ingreso !!!').removeClass('text-danger').hide();
        $(".controlFechaInicioM").removeClass('is-invalid');
        $('#validacionFechaIngresoM').text('Error no coincide los datos de Mes y Fecha Ingreso !!!').removeClass('text-danger').hide();
        $('#validacionErrorM').text('Error verifique los errores del formulario !!!').removeClass('text-danger').hide();
    }
    function limpiarfec_finMes(){ //caso para ver si los mismos datos de mes y fecha fin
        $(".controlMesM").removeClass('is-invalid');
        $('#validacionMesM').text('Error no coincide los datos de Mes y Fecha Ingreso !!!').removeClass('text-danger').hide();
        $(".controlFechaVacacionM").removeClass('is-invalid');
        $('#validacionFechaRetornoM').text('Error no coincide los datos de Mes y Fecha Ingreso !!!').removeClass('text-danger').hide();
        $('#validacionErrorM').text('Error verifique los errores del formulario !!!').removeClass('text-danger').hide();
    }
     //control para que aparescar y se oculte el input y el select de areas
    /* $('.controlT3').click(function() {
        $('.controlT3').hide();
        $('.controlT4').show();
        $('.controlT4').attr("required", true);
    });*/
     //control para que aparescar y se oculte el input y el select de turnos
     $('.controlT1').click(function() {
        $('.controlT1').hide();
        $('.controlT2').show();
        $('.controlT2').attr("required", true);
    });
      //control para que aparescar y se oculte el input y el select de turnos
      $('.cancelar').click(function() {
        $('.controlT2').hide();
        $('.controlT2').attr("required", false);
        $('.controlT1').show();
        limpiarfec_iniMes();
        limpiarfec_finMes();
        /*$('.controlT4').hide();
        $('.controlT4').attr("required", false);
        $('.controlT3').show();*/
    });
    //PROCESO PAA MANDAR DATOS AL MODAL EDITAR
	$(document).on('click', '.editbtn', function(e){
        e.preventDefault();
        var countF_iniMes=0,countF_finMes=0;
		var id=$(this).val(); //console.log('id_user',id);
        var persona =$('#persona'+id).text();
        var servicio =$('#servicio'+id).text();// console.log('id_user -> ',servicio); // $('#servicio'+id).text();
        var gestion =$('#gestion'+id).text();     //   console.log('gestion '+gestion);
        var area =$('#area'+id).text();
        var tdia =$('#tdia'+id).text();
        var f_ini =$('#f_ini'+id).text();
        var f_fin =$('#f_fin'+id).text();
        var h_ini =$('#h_ini'+id).text(); 
        var h_fin =$('#h_fin'+id).text();//document.getElementById("fec_ini").textContent;
        var turno =$('#turno'+id).text();
        var obs =$('#obs'+id).text();
        
        var cambio_turno =$('#cambio_turno'+id).text(); 
		$('#editModal').modal('show');//se manda datos al modal editar
        $('#idM').val(id);
		$('#personaM').val(persona);
        $('#servicioMo').val(servicio);
        $('#gestion').val(gestion);
        $('#areaM').val(area);
        //$('#tdiaM').val(tdia); 
        $('#f_iniM').val(f_ini);
        $('#f_finM').val(f_fin);
        $('#h_iniM').val(h_ini);
        $('#h_finM').val(h_fin);
        $('#turnoM').val(turno);
        $('#obsM').val(obs);
        //console.log('t dia -> '+ $('#tdia'+id).text());

         //CONTROL PARA SABER SI ES EL MISMO AÑO Y MES EN LOS INPUT FECHA INGRESO Y MES [CASO DIA LABORAL]
        $('.controlFechaInicioM').change(function() {
            var fec_ini = $('.fechaDLM').val();
            var mes = $('.controlMesM').val();
            $mes_anioL = fec_ini.substring(0, 7);
            //var tipodia = $('input[name=tipod]:checked','#form-editarRolturno').val(); //console.log('dd 2 '+ $mes_anioL);
            if(mes != $mes_anioL  && mes != ''){ // && tipodia == 'DL'
                $(".controlMesM").addClass('is-invalid');
                $('#validacionMesM').text('Error no coincide los datos de Mes y Fecha Ingreso !!!').addClass('text-danger').show();
                $(".controlFechaInicioM").addClass('is-invalid');
                $('#validacionFechaIngresoM').text('Error no coincide los datos de Mes y Fecha Ingreso !!!').addClass('text-danger').show();
                countF_iniMes=1;
                return ;
            }else{
                 limpiarfec_iniMes();
                countF_iniMes=0;
            }
            
         });
          //CONTROL PARA SABER SI ES EL MISMO AÑO Y MES EN LOS INPUT FECHA INGRESO Y MES [CASO VACACION]
        $('.controlFechaVacacionM').change(function() {
            var fec_fin = $('.fechaVM').val();
            var mes = $('.controlMesM').val();
            $mes_anioV = fec_fin.substring(0, 7); //validacionFechaRetorno
          //  var tipodia = $('input[name=tipod]:checked','#form-editarRolturno').val(); //console.log('entro '+ fec_fin+ ' mes '+ mes+ 't dia'+ tipodia);
            if(mes != $mes_anioV  && mes != ''){//tipodia == 'V' &&
                $(".controlMesM").addClass('is-invalid');
                $('#validacionMesM').text('Error no coincide los datos de Mes y Fecha Retorno !!!').addClass('text-danger').show();
                $(".controlFechaVacacionM").addClass('is-invalid');
                $('#validacionFechaRetornoM').text('Error no coincide los datos de Mes y Fecha Retorno !!!').addClass('text-danger').show();
                countF_finMes=1;
                return true;
            }else{
                limpiarfec_finMes();
                countF_finMes=0;
            }
            
        });

        //proceso para hanilitar y deshabilitar inputs segun casos de dia laboral y vacacion
        if(tdia == 'DL'){
            $('#laboralM').prop("checked", true);
         //  $('#descansoM').prop("readonly", true);
            $('#f_iniM').prop("disabled", false);
            $('#f_finM').prop("disabled", true);
            $('#h_iniM').prop("disabled", false);
            $('#h_finM').prop("disabled", false);
           // $('#turnoM').prop("disabled", false);
            //$('#areaM').prop("disabled", false);
            $('#laboralM').show();
            $('#descansoM').hide();
            $('#cambioT').attr("disabled", false);
            if(cambio_turno == 'V') {  $('#cambioT').prop("checked", true); } //$('#cambioT').val('VA');
            else {  $('#cambioT').prop("checked", false); } //$('#cambioT').val('F');
        }else{
           // $('#laboralM').prop("checked", false);
            $('#descansoM').prop("checked", true);
            $('#f_iniM').prop("disabled", false);
            $('#f_finM').prop("disabled", false);
            $('#h_iniM').prop("disabled", true);
            $('#h_finM').prop("disabled", true);
           //$('#turnoM').prop("disabled", false);
           //$('#areaM').prop("disabled", false);
           $('#cambioT').attr("disabled", true);
          // $('#cambioT').val('F');
            $('#laboralM').hide();
            $('#descansoM').show();
        }
         // Inicializa el plugin de jQuery Validate para validar el formulario en el modal
         $("#cancelarBtnM").click(function() {//para limpiar los avisos de la validacion del formulario editar
            $("#form-editarRolturno").validate().resetForm();
        });
        var rules = /^[a-zA-Zñ0-9 ]{5,150}$/;
        $.validator.addMethod("NombreComentario", function(value, element) {//metodo para validar con tipo de rule especifico con exprecion regular
          return this.optional(element) || rules.test(value);
        },'');
        $('#form-editarRolturno').validate({//validacion del formulario editar 
            rules: {
                turnoMo: {
                    required: {
                        depends: function() {
                            return $('#turnoMos :selected').val() !== '';//!
                        }
                    }
                },
                fecha_inicio:{
                    required: true,
                },
                fecha_fin:{
                    required:{
                        depends: function() {
                            return $('#descansoM').show();//!
                        }
                    }
                },
                comentario:{
                    NombreComentario: true,
                }
            },
            messages: {
                turnoMo: {
                    required: "Por favor seleccione un servicio",
                },
                fecha_inicio:{
                    required: "Por favor seleccione una fecha de ingreso",
                },
                fecha_fin:{
                    required: "Por favor seleccione una fecha de retorno",
                },
                comentario: {
                    NombreComentario: "Formato invalido. solo mayusc, minusc, min 5, max 150"
                }
            },
        }); 
       //control de alertas de error al enviar el modal editar
       $(".enviar").click(function() {//
            var tipodia = $('input[name=tipod]:checked','#form-editarRolturno').val();
            //console.log(tipodia);
            if(tipodia == 'DL'){
                if(countF_iniMes==0) { return true }
                else{ //alert('errores');
                $('#validacionErrorM').text('Error verifique los errores del formulario !!!').addClass('text-danger').show();
                return false
                }
            }else{
                if(countF_finMes==0) { return true }
                else{ //alert('errores');
                $('#validacionErrorM').text('Error verifique los errores del formulario !!!').addClass('text-danger').show();
                return false
                }
            }
         });
       
	});
    //PROCESO PARA MANDAR DATOS AL MODAL ELIMINAR
    $(document).on('click', '.deletebtn', function(e){
        e.preventDefault();
        var id=$(this).val(); 
        var persona =$('#persona'+id).text();
        var f_ini =$('#f_ini'+id).text();
        var f_fin =$('#f_fin'+id).text();
        //console.log('id_user -> '+id+ ' nombre '+ persona+ ' fecha '+ f_ini);
        $('#eliminarModal').modal('show');
        $('#idMe').val(id);
		$('#personaMe').val(persona);
        $('#f_iniMe').val(f_ini);
        $('#f_finMe').val(f_fin);
    });
});
