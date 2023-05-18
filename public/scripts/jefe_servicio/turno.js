
/*function limpiarform(){
  document.getElementById("fec_inicio").value = "";
      document.getElementById("fec_fin").value = "";
      document.getElementById("hrs_inicio").value = "";
      document.getElementById("hrs_fin").value = "";
      //document.getElementById("turno").value = "";
      //document.getElementById("area").value = "";
      document.getElementById("obs").value = "";
}

$(document).ready(function() {
  //controles para habilitar y deshabilitar los input los casos de dia laboral y vacacion
  $('#laboral').on('change', function(e){ //DIA LABORAL
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

  $('#descanso').on('change', function(e){//VACACION
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

  $('#limpiar').click(function() {//para limpiar el formulario  cuando cancelas
    limpiarform();
    document.getElementById("area").value = "";
  });

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

    $mes_anioL = fec_ini.substring(0, 7);
    $mes_anioV = fec_fin.substring(0, 7);

    //console.log('area '+area+ ' turno'+ turno)
    
    if (gestion == '') {
     notificaciones("Seleccione una gestion", "ERROR DE FORMULARIO", 'error'); //('#gestion').focus();
     return false;
    } 
    if (per == 'Selecione una opcion') {
      notificaciones("Seleccione un personal", "ERROR DE FORMULARIO", 'error'); //$('#per').focus();
      //toastr.error("Seleccione una personas", { "positionClass": "toast-bottom-right" });
      return false;
    } 
    if (area == 'Selecione una opcion') {
      notificaciones("Seleccione un area", "ERROR DE FORMULARIO", 'error'); //$('#area').focus();
      //toastr.error("Seleccione una area", { "positionClass": "toast-bottom-right" });
      return false;
    } 
    if (turno_nombre == 'Selecione una opcion') {
      notificaciones("Seleccione un turno", "ERROR DE FORMULARIO", 'error'); //$('#turno').focus();
      //toastr.error("Seleccione un turno", { "positionClass": "toast-bottom-right" });
      return false;
    }  
    if (fec_ini == '') {
      notificaciones("Seleccione una fecha de ingreso", "ERROR DE FORMULARIO", 'error'); //$('#fec_inicio').focus();
      //toastr.error("Seleccione una fecha del dia", { "positionClass": "toast-bottom-right" });
      return false;
    } 
    
    if(tipodia == 'DL'){// si el checkbox laboral esta seleccionado
     
      if(gestion!=$mes_anioL  && gestion!=''){  //CONTROL PARA SABER SI ES EL MISMO AÑO Y MES EN LOS INPUT FECHA(ingreso y retorno) Y GESTION
        notificaciones("Verifique que coincidan los datos", "ERROR NO COINCIDEN EL MES, AÑO DE GESTION Y FECHA INGRESO", 'error');
        return false;
      }
      if (hrs_ini == '') {
        notificaciones("Seleccione un hora de entrada", "ERROR DE FORMULARIO", 'error'); //$('#hrs_inicio').focus();
       //toastr.error("Seleccione una hora de entrada", { "positionClass": "toast-bottom-right" });
        return false;
      } 
      if (hrs_fin == '') {
        notificaciones("Seleccione una hora de salida", "ERROR DE FORMULARIO", 'error'); //$('#hrs_fin').focus();
       // toastr.error("Seleccione una hora de salida", { "positionClass": "toast-bottom-right" });
        return false;
      } 
    }
    if(tipodia == 'V'){ // si el checkbox vacacion esta seleccionado
      if (fec_fin == '') {
        notificaciones("Seleccione una fecha de retorno", "ERROR DE FORMULARIO", 'error'); // $('#fec_fin').focus();
        //toastr.error("Seleccione una fecha de ingreso");
        return false;
      } 
      if(gestion!=$mes_anioL  && gestion!=''){  //CONTROL PARA SABER SI ES EL MISMO AÑO Y MES EN LOS INPUT FECHA(ingreso y retorno) Y GESTION
        notificaciones("Verifique que coincidan los datos", "ERROR NO COINCIDEN EL MES, AÑO DE GESTION Y FECHA INGRESO", 'error');
        return false;
      }
       if(gestion!=$mes_anioV && gestion!=''){  //CONTROL PARA SABER SI ES EL MISMO AÑO Y MES EN LOS INPUT FECHA(ingreso y retorno) Y GESTION
         notificaciones("Verifique que coincidan los datos", "ERROR NO COINCIDEN EL MES, AÑO DE GESTION Y FECHA RETORNO", 'error');
         return false;
       }
    } 

    
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

  $('#mytable .titulo').after(fila); //before
     limpiarform(); //para limpiar el formulario despues de registrarlo
  });
  
  $(document).on('click', '.btn_remove', function() { //limpia el formulario para que vuelva a contar las filas de la tabla
    var button_id = $(this).attr("id");
      $('#row' + button_id + '').remove(); //borra la fila
    });
});


  /*
  $('#laboral').prop("checked", true);
  $('#laboral').on('change', function(e){//VACACION
    e.preventDefault();
    var selected = document.querySelector('input[type=radio][name=tipod]:checked');
      //alert(selected.value);
      if(selected.value == 'DL') alert(selected.value);
      if(selected.value == 'V') alert(selected.value);
    });
    // var selected = document.querySelector('input[type=radio][name=contact]:checked');
 
  //$('#laboral').prop("checked", true);
  */

  /*
    $('input[type="text"]').val('');
    $('input[type="date"]').val('');
    $('input[type="time"]').val('');
    $('select').val('');
    $('textarea').val('');*/

/*
  if (existe == true) 
    {
    $('#medicamentos').focus().select2('open').select();
      toastr.error("Seleccione otro...", "MEDICAMENTO YA EXISTE!!!", {
                    "timeOut": "5000",
                    "extendedTImeout": "5000"
                });
  }

    if(lab){
      fila = '<tr  id="row' + i + '"><td>' + i + '</td><td>'+per+'<input type="hidden"  name="m[]" class="form-control" value="'+per_id+'"></td>  </td> <td>L<input type="hidden"  name="m[]" class="form-control" value="'+per_id+'"></td>    <td>'+fec_ini+'<input type="hidden"  name="m[]" class="form-control" value="'+per_id+'"></td><td>'+fec_fin+'<input type="hidden"  name="m[]" class="form-control" value="'+per_id+'"></td><td>'+hrs_ini+'<input type="hidden"  name="m[]" class="form-control" value="'+per_id+'"></td><td>'+hrs_fin+'<input type="hidden"  name="m[]" class="form-control" value="'+per_id+'"></td><td>'+turno+'<input type="hidden"  name="m[]" class="form-control" value="'+per_id+'"></td><td>'+cargo+'<input type="hidden"  name="m[]" class="form-control" value="'+per_id+'"></td><td>'+obs+'<input type="hidden"  name="m[]" class="form-control" value="'+per_id+'"></td><td><button type="button" name="remove" id="' + i + '" class="btn  btn-sm btn-danger btn_remove">Quitar</button></td></tr>';  
    }
    if(des){
      fila = '<tr  id="row' + i + '"><td>' + i + '</td><td>'+per+'<input type="hidden"  name="m[]" class="form-control" value="'+per_id+'"></td>  </td> <td>V<input type="hidden"  name="m[]" class="form-control" value="'+per_id+'"></td>    <td>'+fec_ini+'<input type="hidden"  name="m[]" class="form-control" value="'+per_id+'"></td><td>'+fec_fin+'<input type="hidden"  name="m[]" class="form-control" value="'+per_id+'"></td><td>'+hrs_ini+'<input type="hidden"  name="m[]" class="form-control" value="'+per_id+'"></td><td>'+hrs_fin+'<input type="hidden"  name="m[]" class="form-control" value="'+per_id+'"></td><td>'+turno+'<input type="hidden"  name="m[]" class="form-control" value="'+per_id+'"></td><td>'+cargo+'<input type="hidden"  name="m[]" class="form-control" value="'+per_id+'"></td><td>'+obs+'<input type="hidden"  name="m[]" class="form-control" value="'+per_id+'"></td><td><button type="button" name="remove" id="' + i + '" class="btn  btn-sm btn-danger btn_remove">Quitar</button></td></tr>';     
    }
    */
 /*
    <td>'+per+'<input type="hidden" name="id[]" class="form-control" value="'+per_id+'"></td>
    <td>'+area+'<input type="hidden" name="area[]" class="form-control" value="'+area+'"></td>
    <td>'+obs+'<input type="hidden" name="obs[]" class="form-control" value="'+obs+'"></td>
    <td>'+fec_ini+'<input type="hidden" name="f_ini[]" class="form-control" value="'+fec_ini+'"></td>
    <td>'+fec_fin+'<input type="hidden" name="f_fin[]" class="form-control" value="'+fec_fin+'"></td>
    <td>'+hrs_ini+'<input type="hidden" name="h_ini[]" class="form-control" value="'+hrs_ini+'"></td>
    <td>'+hrs_fin+'<input type="hidden" name="h_fin[]" class="form-control" value="'+hrs_fin+'"></td>
    <td>'+tipodia+'<input type="hidden" name="tdia[]" class="form-control" value="'+tipodia+'"></td>
    <td>'+turno+'<input type="hidden" name="turno[]" class="form-control" value="'+turno+'"></td>*/
  // var data = JSON.stringify(fila)




  /*
   //document.getElementById("per").value = "";
     document.getElementById("fec_inicio").value = "";
     document.getElementById("fec_fin").value = "";
     document.getElementById("hrs_inicio").value = "";
     document.getElementById("hrs_fin").value = "";
     document.getElementById("turno").value = "";
     document.getElementById("area").value = "";
     document.getElementById("obs").value = "";*/