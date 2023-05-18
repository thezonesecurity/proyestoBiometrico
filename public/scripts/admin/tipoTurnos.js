$(document).ready(function() {
  var rules = /^[a-zA-Z0-9ñ. ]{5,50}$/;
  $.validator.addMethod("NombreT_turno", function(value, element) {//metodo para validar con tipo de rule especifico con exprecion regular
    return this.optional(element) || rules.test(value);
  },'');

   //PROCESO DE VALIDACION PARA REGISTRAR UN SERVICIO
  $("#cancelarBtn").click(function() {//para limpiar los avisos de la validacion del formulario modal registrar
    $("#formRegistrarTipoTurno").validate().resetForm();
  });
  $(".limpiar").click(function() {//para limpiar el modal de registrar
    document.getElementById("tipo_turno").value = "";
  });
 
  $('#formRegistrarTipoTurno').validate({ //validacion del formulario modal  registrar
     rules: {
        tipo_turno: {
           required: true,
           NombreT_turno: true
        },
     },
     messages: {           
        tipo_turno: {
           required: "Por favor ingresa el nombre del tipo de turno",
           NombreT_turno: "Formato invalido. solo mayusc, minusc, 0-9, min 5 y max 50"
        },
     },
     errorClass: 'error'
  });

  //PROCESO PARA MANDAR DATOS AL MODAL EDITAR Y VALIDACION DEL FORMULARIO EDITAR  
  $('.edit').click(function (e) {
    e.preventDefault();
    var id=$(this).val(); //console.log('id_user',id);
    var nombre =$('#nombre'+id).text();
    var estado =$('#estado'+id).text();   
    //console.log('id_user '+ id+' -> '+ nombre);
        
    $('#ActualizarTipoTurno').modal('show');
      $('#idM').val(id);
      $('#tipo_turno_M').val(nombre);
      $('#estadoM').val(estado);
    
      //PROCESO DE VALIDACION PARA EDITAR EL FORMULARIO
    $("#cancelarBtn").click(function() {//para limpiar los avisos de la validacion del formulario modal editar
      $("#formEditarTipoTurno").validate().resetForm();
    });
   // console.log('id_user ->  '+ id+' -> '+ $('#tipo_turno_M').val());
    $('#formEditarTipoTurno').validate({ //validacion del formulario modal  editar
      rules: {
          tipo_turnoM: {
            required: true,
            //NombreT_turno: true
            NombreT_turno:  {
              depends: function() {
                if($('#tipo_turno_M').val() !== nombre) return true //!
                else  return false
              }
            },
          },
      },
      messages: {           
          tipo_turnoM: {
            required: "Por favor ingresa el nombre del tipo de turno",
            NombreT_turno: "Formato invalido. solo mayusc, minusc, min 5, max 50 y ."
          },
      },
      errorClass: 'error'
    });
    $(".limpiarM").click(function() {//para limpiar el modal de editar
      document.getElementById("tipo_turno_M").value = "";
    });
  });
});
/*
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
  */