$(document).ready(function() {
  var rules = /^[a-zA-Zñ ]{5,50}$/;
  $.validator.addMethod("NombreT_contrato", function(value, element) {//metodo para validar con tipo de rule especifico con exprecion regular
    return this.optional(element) || rules.test(value);
  },'');

   //PROCESO DE VALIDACION PARA REGISTRAR UN TIPO DE CONTRATO
  $("#cancelarBtn").click(function() {//para limpiar los avisos de la validacion del formulario modal registrar
    $("#formRegistrarTipoContrato").validate().resetForm();
  });
  $(".limpiar").click(function() {//para limpiar el modal de registrar
    document.getElementById("t_contrato").value = "";
  });
 
  $('#formRegistrarTipoContrato').validate({ //validacion del formulario modal  registrar
     rules: {
        tipo_contrato: {
           required: true,
           NombreT_contrato: true
        },
     },
     messages: {           
        tipo_contrato: {
           required: "Por favor ingresa el nombre del tipo de contrato",
           NombreT_contrato: "Formato invalido. solo mayusc, minusc, min 5 y max 50"
        },
     },
     errorClass: 'error'
  });

  //PROCESO PARA MANDAR DATOS AL MODAL EDITAR Y VALIDACION DEL FORMULARIO EDITAR  
  $('.edit').click(function (e) {
    e.preventDefault();
    var id=$(this).val(); //console.log('id_user',id);
    var nombre =$('#nombre'+id).text();
    var estado =$('#estado'+id).text();     //   console.log('gestion '+gestion);
    //console.log('id_user '+ id+' -> '+ nombre);
    
    $('#ActualizarTipoContrato').modal('show');
    $('#idM').val(id);
    $('#t_contratoM').val(nombre);
    $('#estadoM').val(estado);
    
      //PROCESO DE VALIDACION PARA EDITAR EL FORMULARIO
    $("#cancelarBtn").click(function() {//para limpiar los avisos de la validacion del formulario modal editar
      $("#formEditarTipoContrato").validate().resetForm();
    });
   // console.log('id_user ->  '+ id+' -> '+ $('#tipo_turno_M').val());
    $('#formEditarTipoContrato').validate({ //validacion del formulario modal  editar
      rules: {
          tipo_contratoM: {
            required: true,
            NombreT_contrato: true
          },
      },
      messages: {           
          tipo_contratoM: {
            required: "Por favor ingresa el nombre del tipo de contrato",
            NombreT_contrato: "Formato invalido. solo mayusc, minusc, min 5, max 50"
          },
      },
      errorClass: 'error'
    });
    $(".limpiarM").click(function() {//para limpiar el modal de editar
      document.getElementById("t_contratoM").value = "";
    });
    
  });
  
});


/*
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

  */