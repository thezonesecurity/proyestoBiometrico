$(document).on('click', '#limpiarmodal', function(e){ //PROCESO PARA LIMPIAR EL MODAL SI SE CANCELA
    document.getElementById("servicio").value = "vacio";
    document.getElementById("area").value = "";
});

$(document).on('click', '.registrar', function(e){ //PROCESO PARA EL MODAL REGISTRAR
    //obtenemos el valor de todos los input
    var servicio = $('#servicio :selected').text();
    var area=$('#area').val();
    console.log('data -> '+area+ ' -> '+ servicio);
    //alert('ingreso');
   if (area == '') {
    notificaciones("Ingrese el nombre del area", "ERROR DE FORMULARIO", 'warning'); 
    return false;
  } 
    if (servicio == 'Selecione una opcion') {
      notificaciones("Seleccione un servicio para el area", "ERROR DE FORMULARIO", 'warning');
      return false;
    } 
});

$(document).on('click', '.edit', function(e){ //PROCESO PARA MANDAR DATOS AL MODAL EDITAR
  e.preventDefault();
  var id=$(this).val(); //console.log('id_user',id);
  var servicio =$('#servicio'+id).text();
  var area =$('#area'+id).text();
  var estado =$('#estado'+id).text();     //   console.log('gestion '+gestion);
 // console.log('id_user '+ id+' -> '+ responsable+ ' -> '+ res);
  
    $('#ActualizarServicio').modal('show');
    $('#idM').val(id);
    $('#areaM').val(area);
    $('#servicioM').val(servicio);
    $('#estadoM').val(estado);
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
  var area=$('#areaM').val();
//  console.log('data -> '+personaM+ ' -> '+ servicioM);
 if (area == '') {
  notificaciones("Ingrese el nombre del area", "ERROR DE FORMULARIO", 'warning'); 
  return false;
 } 
});

$(document).on('click', '#limpiarmodal', function(e){  //PROCESO PARA LIMPIAR EL MODAL REGISTRAR
    document.getElementById("servicio").value = "";
    document.getElementById("area").value = "";
  });