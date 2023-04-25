function limpiarform(){
  document.getElementById("fec_inicio").value = "";
      document.getElementById("fec_fin").value = "";
      document.getElementById("hrs_inicio").value = "";
      document.getElementById("hrs_fin").value = "";
      //document.getElementById("turno").value = "";
      //document.getElementById("area").value = "";
      document.getElementById("obs").value = "";
      $('#cambio').prop("checked", false);
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
   $('#cambio').attr("disabled", false);
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
    $('#cambio').attr("disabled", true);
    $('#cambio').prop("checked", false);
    $('#area').prop("disabled", false);
   // $('#obs').prop("disabled", false);
  });

  $(document).on('click', '.limpiarForm', function(e){ //$('#limpiar').click(function() {//para limpiar el formulario  cuando cancelas
    limpiarform();
    document.getElementById("area").value = "";
  });

  var i = 1, fila; //contador para asignar id al boton que borrara la fila
 $(document).on('click', '.adicionarForm', function(e){ //$('#adicionar').click(function() { 
      //obtenemos el valor de todos los input
      var per = $('#per :selected').text();
      var gestion = document.getElementById("gestionM").value; //console.log('gestion ser '+ gestion);
      var per_id = $('#per').val();
      var fec_ini = $('#fec_inicio').val();
      var tipodia = $('input[name=tipod]:checked','#form_reg_rolturno').val();
      var fec_fin = document.getElementById("fec_fin").value;
      var hrs_ini=document.getElementById("hrs_inicio").value;
      var hrs_fin=document.getElementById("hrs_fin").value;
      var turno=document.getElementById("turno").value;
      var turno_nombre=$('#turno :selected').text();
      //var servicio_id=0;//document.getElementById("servicioM").value; 
      var servicio = document.getElementById("servicioM").value;
    // console.log('nom ser '+servicio);
      var cambio_turno='F';
      var area_id=document.getElementById("area").value; 
      var area=$('#area :selected').text();
      var obs=document.getElementById("obs").value;
      //console.log(tipodia)
      //console.log(servicio+' '+servicio_id)
      //console.log(area+' '+area_id)
     // console.log('-> '+turno);
      /*
      console.log(per_id);
      console.log(per);
      console.log(tipodia);
      console.log(fec_ini);
      console.log(fec_fin);
      console.log(hrs_ini);
      console.log(hrs_fin);
      console.log(turno);
      console.log(area);
      console.log(obs);
      */
    
      if( $('#cambio').is(':checked') ) { cambio_turno = 'V';}

      console.log('camnbioturno -> '+cambio_turno)
      if (per == 'Selecione una opcion') {
        notificaciones('Seleccione una persona', 'error de formulario', 'error');
        //toastr.error("Seleccione una persona");
        //$('#per').focus();
        return false;
      } 
  /*
      if(tipodia == 'DL'){// si el checkbox laboral esta seleccionado
        if (fec_ini == '') {
          toastr.error("Seleccione una fecha del dia");
          $('#fec_inicio').focus();
          return false;
        } 
        if (hrs_ini == '') {
          toastr.error("Seleccione una hora de entrada");
          $('#hrs_inicio').focus();
          return false;
        } 
        if (hrs_fin == '') {
          toastr.error("Seleccione una hora de salida");
          $('#hrs_fin').focus();
          return false;
        } 
        if (turno == '') {
          toastr.error("Seleccione un turno");
          $('#turno').focus();
          return false;
        } 
        if (area == '') {
          toastr.error("Seleccione una area");
          $('#area').focus();
          return false;
        } 
      

      if(tipodia == 'V'){ // si el checkbox vacacion esta seleccionado
        if (fec_ini == '') {
          toastr.error("Seleccione una fecha de salida");
          $('#fec_inicio').focus();
          return false;
        } 
        if (fec_fin == '') {
          toastr.error("Seleccione una fecha de ingreso");
          $('#fec_fin').focus();
          return false;
        } 
        
      } 
    */
    
      //$('.titulo').after(fila);
      //$('.titulo').show();
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
    //console.log('fila'+ fila);
    
    $('#mytable .titulo').after(fila); //before
        //para limpiar el formulario despues de registrarlo
      limpiarform();
  });

  $(document).on('click', '.btn_remove', function() { //limpia el formulario para que vuelva a contar las filas de la tabla
    var button_id = $(this).attr("id");
      //cuando da click obtenemos el id del boton
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
    <td>'+turno+'<input type="hidden" name="turno[]" class="form-control" value="'+turno+'"></td>
    <td>'+cambio_turno+'<input type="hidden" name="cambio_turno[]" class="form-control" value="'+cambio_turno+'"></td>*/
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