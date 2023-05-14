$(document).ready(function() {
  var rules = /^[a-zA-Z ]{5,50}$/;
  $.validator.addMethod("NombreArea", function(value, element) {//metodo para validar con tipo de rule especifico con exprecion regular
    return this.optional(element) || rules.test(value);
  },'');

   //PROCESO DE VALIDACION PARA REGISTRAR UN AREA
  $("#cancelarBtn").click(function() {//para limpiar los avisos de la validacion del formulario registrar
    $("#formRegistrarArea").validate().resetForm();
  });
 
  $('#formRegistrarArea').validate({ //validacion del formulario registrar
     rules: {
        areaR: {
           required: true,
           NombreArea: true
        },
        servicioR: {
          required: true,
        },
     },
     messages: {           
        areaR: {
           required: "Por favor ingresa el nombre del area",
           NombreArea: "Formato invalido. solo mayusc, minusc, min 5 y max 50"
        },
        servicioR: {
           required: "Por favor seleccione un servicio",
        },
     },
     errorClass: 'error'
  });
//PROCESO PARA MANDAR DATOS AL MODAL EDITAR Y VALIDACION DEL FORMULARIO EDITAR  

$('.edit').click(function (e) {
  e.preventDefault();
  var id=$(this).val();
  var servicio =$('#servicio'+id).text();
  var area =$('#area'+id).text();
  var estado =$('#estado'+id).text(); 
  
    $('#ActualizarServicio').modal('show');//se paso datos al modal editar
    $('#idM').val(id);
    $('#areaM').val(area);
    $('#servicioM').val(servicio);
    $('#estadoM').val(estado);

    $('.controlT1').click(function() {//control para que aparescar y se oculte el input y el select de servicios
      $('.controlT1').hide();
      $('.controlT2').show();
      $('.controlT2').attr("required", true);
    });
    
    $('.cancelar').click(function() {//control para que aparescar y se oculte el input y el select de servicios
      $('.controlT2').hide();
      $('.controlT2').attr("required", false);
      $('.controlT1').show();
    });

  // Inicializa el plugin de jQuery Validate para validar el formulario en el modal
  $("#cancelarBtnM").click(function() {//para limpiar los avisos de la validacion del formulario editar
    $("#form-editarArea").validate().resetForm();
  });
  
  $('#form-editarArea').validate({//validacion del formulario editar
        rules: {
          areaM: {
            required: true,
            NombreArea: true
          },
          servicioMo: {
            required: {
              depends: function() {
                 return $('#servicioMos :selected').val() !== '';//!
              }
            }
          },
        },
        messages: {
          areaM: {
            required: 'Por favor, ingrese un nombre de area',
            NombreArea: "Formato invalido. solo mayusc, minusc, min 5 y max 50"
          },
          servicioMo: {
            required: "Por favor seleccione un servicio",
          }
        },
  }); 
});

});
/*
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

  $(document).on('click', '#limpiarmodal', function(e){ //PROCESO PARA LIMPIAR EL MODAL SI SE CANCELA
    document.getElementById("servicio").value = "vacio";
    document.getElementById("area").value = "";
});
*/