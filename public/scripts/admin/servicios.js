$(document).ready(function() {
  var rules = /^[a-zA-Z ]{5,50}$/;
  $.validator.addMethod("NombreServicio", function(value, element) {//metodo para validar con tipo de rule especifico con exprecion regular
    return this.optional(element) || rules.test(value);
  },'');

   //PROCESO DE VALIDACION PARA REGISTRAR UN SERVICIO
  $("#cancelarBtn").click(function() {//para limpiar los avisos de la validacion del formulario registrar
    $("#formRegistrarServicio").validate().resetForm();
  });
 
  $('#formRegistrarServicio').validate({ //validacion del formulario registrar
     rules: {
        servicioR: {
           required: true,
           NombreServicio: true
        },
        personaR: {
          required: true,
        },
     },
     messages: {           
        servicioR: {
           required: "Por favor ingresa el nombre del nuevo servicio",
           NombreServicio: "Formato invalido. solo mayusc, minusc, min 5 y max 50"
        },
        personaR: {
           required: "Por favor elige un responsable del servicio",
        },
     },
     errorClass: 'error'
  });

  //PROCESO PARA MANDAR DATOS AL MODAL EDITAR Y VALIDACION DEL FORMULARIO EDITAR  

  $('.edit').click(function (e) {
    e.preventDefault();
    var id=$(this).val(); 
    var servicio =$('#servicio'+id).text();
    var responsable =$('#responsable'+id).text();
    var estado =$('#estado'+id).text();    
  // console.log('id_user '+ id+' -> '+ responsable+ ' -> '+ res);
    
      $('#ActualizarServicio').modal('show');//se pasa datos al modal
      $('#idM').val(id);
      $('#servicioM').val(servicio);
      $('#resM').val(responsable);
      $('#estadoM').val(estado);
 
    $('.controlT1').click(function() {//control para que aparescar y se oculte el input y el select de responsable
      $('.controlT1').hide();
      $('.controlT2').show();
      $('.controlT2').attr("required", true);
    });
    
    $('.cancelar').click(function() {//control para que aparescar y se oculte el input y el select de responsable
      $('.controlT2').hide();
      $('.controlT2').attr("required", false);
      $('.controlT1').show();
    });

    // Inicializa el plugin de jQuery Validate para validar el formulario en el modal
    $("#cancelarBtnM").click(function() {//para limpiar los avisos de la validacion del formulario editar
      $("#form-editarServicio").validate().resetForm();
    });
    
    $('#form-editarServicio').validate({//validacion del formulario editar
          rules: {
            servicioM: {
              required: true,
              NombreServicio: true
            },
            responsableMo: {
              required: {
                depends: function() {
                   return $('#servicioMo :selected').val() !== '';//!
                }
              }
            },
          },
          messages: {
            servicioM: {
              required: 'Por favor, ingrese su nombre',
              NombreServicio: "Formato invalido. solo mayusc, minusc, min 5 y max 50"
            },
            responsableMo: {
              required: "Por favor elige un responsable del servicio",
            }
          },
    }); 
  });

});
/*
$(document).ready(function () {//PROCESO PARA MANDAR DATOS AL MODAL EDITAR

  $('.edit').click(function (e) {// $(document).on('click', '.edit', function(e){ //PROCESO PARA MANDAR DATOS AL MODAL EDITAR
    e.preventDefault();
    var id=$(this).val(); //console.log('id_user',id);
    var servicio =$('#servicio'+id).text();
    var responsable =$('#responsable'+id).text();
    var estado =$('#estado'+id).text();     //   console.log('gestion '+gestion);
  // console.log('id_user '+ id+' -> '+ responsable+ ' -> '+ res);
    
      $('#ActualizarServicio').modal('show');//se pasa datos al modal
      $('#idM').val(id);
      $('#servicioM').val(servicio);
      $('#resM').val(responsable);
      $('#estadoM').val(estado);
 

    $('.controlT1').click(function() {//control para que aparescar y se oculte el input y el select de responsable
      $('.controlT1').hide();
      $('.controlT2').show();
      $('.controlT2').attr("required", true);
    });
    
    $('.cancelar').click(function() {//control para que aparescar y se oculte el input y el select de responsable
      $('.controlT2').hide();
      $('.controlT2').attr("required", false);
      $('.controlT1').show();
    });

    // Inicializa el plugin de jQuery Validate para validar el formulario en el modal
    $("#cancelarBtnM").click(function() {
      $("#form-editarServicio").validate().resetForm();
    });
    var rules = /^[a-zA-Z ]{5,50}$/;
      $.validator.addMethod("NombreServicio", function(value, element) {
      return this.optional(element) || rules.test(value);
    },'');

    $('#form-editarServicio').validate({
          rules: {
            servicioM: {
              required: true,
              NombreServicio: true
            },
            responsableMo: {
              required: {
                depends: function() {
                   return $('#servicioMo :selected').val() !== '';
                }
              }
            },
          },
          messages: {
            servicioM: {
              required: 'Por favor, ingrese su nombre',
              NombreServicio: "Formato invalido. solo mayusc, minusc, min 5 y max 50"
            },
            responsableMo: {
              required: "Por favor elige un responsable del servicio",
            }
          },
    });
      
  });
});
*/


/*
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
//control para que aparescar y se oculte el input y el select de responsable
$('.cancelar').click(function() {
  $('.controlT2').hide();
  $('.controlT2').attr("required", false);
  $('.controlT1').show();
});*/




/*
$(document).on('click', '.editsave', function(e){  //PROCESO PARA GUARDAR LOS DATOS EDITADOS
  var servicioM=$('#servicioM').val();
//  console.log('data -> '+personaM+ ' -> '+ servicioM);
 if (servicioM == '') {
  notificaciones("Ingrese el nombre del servicio", "ERROR DE FORMULARIO", 'warning'); 
  return false;
} 
});*/
