
$(document).on('click', '.registrar', function(e){ //PROCESO PARA EL MODAL REGISTRAR
    //obtenemos el valor de todos los input
    var contrato=$('#t_contrato').val();
    console.log(' -> '+ contrato);
    //alert('ingreso');
    if (contrato == '') {
      notificaciones("Seleccione un nombre de tipo de contrato", "ERROR DE FORMULARIO", 'warning');
      return false;
    } 
});

$(document).on('click', '.edit', function(e){ //PROCESO PARA MANDAR DATOS AL MODAL EDITAR
    e.preventDefault();
    var id=$(this).val(); //console.log('id_user',id);
    var nombre =$('#nombre'+id).text();
    var estado =$('#estado'+id).text();     //   console.log('gestion '+gestion);
    console.log('id_user '+ id+' -> '+ nombre);
    
    $('#ActualizarTipoContrato').modal('show');
    $('#idM').val(id);
    $('#t_contratoM').val(nombre);
    $('#estadoM').val(estado);
});

$(document).on('click', '.editsave', function(e){  //PROCESO PARA GUARDAR LOS DATOS EDITADOS
  var t_contrato=$('#t_contratoM').val();
//  console.log('data -> '+personaM+ ' -> '+ servicioM);
 if (t_contrato == '') {
  notificaciones("Ingrese el nombre de tipo de contrato", "ERROR DE FORMULARIO", 'warning'); 
  return false;
 } 
});

$(document).on('click', '#limpiarmodal', function(e){  //PROCESO PARA LIMPIAR EL MODAL REGISTRAR
    document.getElementById("t_contrato").value = "";
  });