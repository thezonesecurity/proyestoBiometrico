
$(document).on('click', '.registrar', function(e){ //PROCESO PARA EL MODAL REGISTRAR
    //obtenemos el valor de todos los input
    var persona = $('#persona :selected').text();
    var servicio=$('#servicio').val();
    //console.log('data -> '+persona+ ' -> '+ servicio);
   if (servicio == '') {
    notificaciones("Ingrese el nombre del nuevo servicio", "ERROR DE FORMULARIO", 'warning'); 
    return false;
  } 
    if (persona == 'Selecione una opcion') {
      notificaciones("Seleccione un responsable para el servicio", "ERROR DE FORMULARIO", 'warning');
      return false;
    } 
});

$(document).on('click', '.edit', function(e){ //PROCESO PARA MANDAR DATOS AL MODAL EDITAR
  e.preventDefault();
  var id=$(this).val(); //console.log('id_user',id);
  var servicio =$('#servicio'+id).text();
  var responsable =$('#responsable'+id).text();
  var estado =$('#estado'+id).text();     //   console.log('gestion '+gestion);
 // console.log('id_user '+ id+' -> '+ responsable+ ' -> '+ res);
  
    $('#ActualizarServicio').modal('show');
    $('#idM').val(id);
    $('#servicioM').val(servicio);
    $('#resM').val(responsable);
    $('#estadoM').val(estado);
});

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
});

$(document).on('click', '.editsave', function(e){  //PROCESO PARA GUARDAR LOS DATOS EDITADOS
  var servicioM=$('#servicioM').val();
//  console.log('data -> '+personaM+ ' -> '+ servicioM);
 if (servicioM == '') {
  notificaciones("Ingrese el nombre del servicio", "ERROR DE FORMULARIO", 'warning'); 
  return false;
} 
});

$(document).on('click', '#limpiarmodal', function(e){  //PROCESO PARA LIMPIAR EL MODAL REGISTRAR
  document.getElementById("servicio").value = "";
  document.getElementById("persona").value = "";
});