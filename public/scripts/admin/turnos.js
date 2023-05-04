
$(document).on('click', '.registrar', function(e){ //PROCESO PARA EL MODAL REGISTRAR
    //obtenemos el valor de todos los input
    var contrato=$('#t_turno').val();
    console.log(' -> '+ contrato);
    //alert('ingreso');
    if (contrato == '') {
      notificaciones("Seleccione un nombre de tipo de turno", "ERROR DE FORMULARIO", 'warning');
      return false;
    } 
});

$(document).on('click', '.edit', function(e){ //PROCESO PARA MANDAR DATOS AL MODAL EDITAR
  e.preventDefault();
  var id=$(this).val(); //console.log('id_user',id);
  var nombre =$('#nombre'+id).text();
  var estado =$('#estado'+id).text();   
  console.log('id_user '+ id+' -> '+ nombre);
      
  $('#ActualizarTipoTurno').modal('show');
      $('#idM').val(id);
      $('#t_turnoM').val(nombre);
      $('#estadoM').val(estado);
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