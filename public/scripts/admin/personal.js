$(document).on('click', '.registrar', function(e){ //PROCESO PARA EL MODAL REGISTRAR
    //var servicio = $('#servicio :selected').text();
    var id=$(this).val(); //console.log('id_user',id);
    var nombre=$('#nombre'+id).text();
    var ciper=$('#ci'+id).text();
    console.log('id- '+ id + ' persona '+ nombre+ ' ci '+ ciper );
    
    $('#registro_personalModal').modal('show');
    $('#idMR').val(id);
    $('#nombreMR').val(nombre);
    $('#ciMR').val(ciper);
});
$(document).on('click', '.registrarpersona', function(e){ //PROCESO PARA EL MODAL REGISTRAR
  //var servicio = $('#servicio :selected').text();
  var id=$(this).val(); //console.log('id_user',id);
  var nombre=$('#nombre'+id).text();
  var ciper=$('#ci'+id).text();
  console.log('id- '+ id + ' persona '+ nombre+ ' ci '+ ciper );
  
  if (t_turno == '') {
    notificaciones("Ingrese el nombre tipo turno", "ERROR DE FORMULARIO", 'warning'); 
    return false;
   } 
});

$(document).on('click', '.edit', function(e){ //PROCESO PARA MANDAR DATOS AL MODAL EDITAR
    var id=$(this).val(); //console.log('id_user',id);
    var nameper=$('#nombre'+id).text();
    var ciper=$('#ci'+id).text();
    var item=$('#item'+id).text(); 
    var servicio=$('#servicio'+id).text();
    var estadoper=$('#estado'+id).text();
    console.log('id '+ id + ' persona'+ nameper+ ' ci '+ ciper + ' item -> '+ item+ ' servicio -> '+ servicio)
    
    $('#registro_personalModal').modal('show');
    $('#idM').val(id);
    $('#nombreM').val(nameper);
    $('#ciM').val(ciper);
    $('#itemM').val(item);
    $('#servicioM').val(servicio);
    $('#estadoM').val(estadoper);
    //select2
    //$('.js-example-basic-single').select2();
});

$('.controlT1').click(function() {
    $('.controlT1').hide();
    $('.controlT2').show();
    $('.controlT2').attr("required", true);
  });
  //control para que aparescar y se oculte el input y el select de servicios
  $('.cancelar').click(function() {
    $('.controlT2').hide();
    $('.controlT2').attr("required", false);
    $('.controlT1').show();
  });

$(document).on('click', '.editsave', function(e){  //PROCESO PARA GUARDAR LOS DATOS EDITADOS
  var t_turno=$('#t_turnoM').val();
//  console.log('data -> '+personaM+ ' -> '+ servicioM);
 if (t_turno == '') {
  notificaciones("Ingrese el nombre tipo turno", "ERROR DE FORMULARIO", 'warning'); 
  return false;
 } 
});

$(document).on('click', '#limpiarmodal', function(e){  //PROCESO PARA LIMPIAR EL MODAL REGISTRAR
    document.getElementById("t_turno").value = "";
  });