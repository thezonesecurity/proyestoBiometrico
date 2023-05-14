$(document).ready(function() {
  //PROCESO PARA MANDAR DATOS AL MODAL REGISTRAR
  $('.registrarModal').click(function (e) {
    e.preventDefault();
     //var servicio = $('#servicio :selected').text();
     var id=$(this).val();
     var nombre=$('#nombre'+id).text();
     var ciper=$('#ci'+id).text();
     
     $('#exampleModal').modal('show');
     $('#id').val(id);
     $('#nombre').val(nombre);
     $('#ci').val(ciper);

  });
   //PROCESO DE VALIDACION PARA EL FORMULARIO MODAL REGISTRAR UN PERSONAL
  $("#cancelarBtnR").click(function() {//para limpiar los avisos de la validacion del formulario modal registrar
    $("#formRegistrarPersonal").validate().resetForm();
  });
  /*$(".limpiar").click(function() {//para limpiar el modal de registrar
    document.getElementById("item").value = "";
    document.getElementById("servicio").value = "";
  });*/
 
  $('#formRegistrarPersonal').validate({ //validacion del formulario modal  registrar
     rules: {
        item: {
           required: true,
        },
        servicio: {
          required: true,
        }
     },
     messages: {           
        item: {
           required: "Por favor seleccione el tipo de contrato",
        },
        servicio: {
          required: "Por favor seleccione al servicio que corresponde",
       },
     },
     errorClass: 'error'
  });

   //PROCESO PARA MANDAR DATOS AL MODAL EDITAR Y VALIDACION DEL FORMULARIO EDITAR  
   $('.edit').click(function (e) {
    e.preventDefault();
    var id=$(this).val(); //console.log('id_user',id);
    var nameper=$('#nombre'+id).text();
    var ciper=$('#ci'+id).text();
    var item=$('#item'+id).text(); 
    var servicio=$('#servicio'+id).text();
    var estadoper=$('#estado'+id).text();
   console.log('id -> '+ id + ' persona '+ nameper+ ' ci '+ ciper + ' items '+ item+ ' servicio '+ servicio)
    
    $('#editarModal').modal('show'); //SE PASA LOS DATOS AL MODAL EDITAR
    $('#idM').val(id);
    $('#nombreM').val(nameper);
    $('#ciM').val(ciper);
    $('#itemM').val(item);
    $('#servicioM').val(servicio);
    $('#estadoM').val(estadoper);
    //PARA CONTROLAR LOS INPUT DE TEXT Y SELECT A LA VEZ DE SERVICO E ITEM
    $('.controlT1').click(function() {
      $('.controlT1').hide();
      $('.controlT2').show();
      $('.controlT2').attr("required", true);
    });
    
    $('.controlT3').click(function() {
      $('.controlT3').hide();
      $('.controlT4').show();
      $('.controlT4').attr("required", true);
    });
    //control para que aparescar y se oculte el input y el select de servicio e item
    $('.cancelar').click(function() {
      $('.controlT2').hide();
      $('.controlT2').attr("required", false);
      $('.controlT1').show();
  
      $('.controlT4').hide();
      $('.controlT4').attr("required", false);
      $('.controlT3').show();
    });
   
    $('#formEditarPersonal').validate({ //validacion del formulario modal  registrar
       rules: {
        itemMo: {
          required: {
            depends: function() {
               return $('#itemMos :selected').val() !== '';//!
            }
          }
        },
        servicioMo: {
          required: {
            depends: function() {
                return $('#servicioMos :selected').val() !== '';//!
            }
          }
        }
       },
       messages: {           
          itemMo: {
             required: "Por favor seleccione el tipo de contrato",
          },
          servicioMo: {
            required: "Por favor seleccione al servicio que corresponda",
         },
       },
       errorClass: 'error'
    });
    //PROCESO DE VALIDACION PARA EL FORMULARIO MODAL EDITAR UN PERSONAL
    $("#cancelarBtnM").click(function() {//para limpiar los avisos de la validacion del formulario modal registrar
      $("#formEditarPersonal").validate().resetForm();
    });

  });
});

/*
$(document).on('click', '.registrarModal', function(e){ //PROCESO PARA PASAR DATOS AL MODAL REGISTRAR
    //var servicio = $('#servicio :selected').text();
    var id=$(this).val(); //console.log('id_user',id);
    var nombre=$('#nombre'+id).text();
    var ciper=$('#ci'+id).text();
    //console.log('id- '+ id + ' persona '+ nombre+ ' ci '+ ciper );
    
    $('#exampleModal').modal('show');
    $('#id').val(id);
    $('#nombre').val(nombre);
    $('#ci').val(ciper);
});

$(document).on('click', '.registrarpersona', function(e){ //PROCESO PARA EL MODAL REGISTRAR
  //var servicio = $('#servicio :selected').text();
  var nombre=$('#nombre').val();
  var ciper=$('#ci').val();
  var item = $('#item :selected').text();
  var servicio = $('#servicio :selected').text(); 
  console.log( ' persona '+ nombre+ ' ci '+ ciper + ' item '+ item+ ' servicio '+ servicio);
 
  if (item == 'Elegir una opcion') {
    notificaciones("Ingrese el nombre tipo de contrato", "ERROR DE FORMULARIO", 'warning'); 
    return false;
   } 
   if (servicio == 'Elegir una opcion') {
    notificaciones("Ingrese el nombre del servicio", "ERROR DE FORMULARIO", 'warning'); 
    return false;
   } 
});

//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

$(document).on('click', '.edit', function(e){ //PROCESO PARA MANDAR DATOS AL MODAL EDITAR
    var id=$(this).val(); //console.log('id_user',id);
    var nameper=$('#nombre'+id).text();
    var ciper=$('#ci'+id).text();
    var item=$('#item'+id).text(); 
    var servicio=$('#servicio'+id).text();
    var estadoper=$('#estado'+id).text();
   console.log('id -> '+ id + ' persona '+ nameper+ ' ci '+ ciper + ' items '+ item+ ' servicio '+ servicio)
    
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
  
  $('.controlT3').click(function() {
    $('.controlT3').hide();
    $('.controlT4').show();
    $('.controlT4').attr("required", true);
  });
  //control para que aparescar y se oculte el input y el select de servicios
  $('.cancelar').click(function() {
    $('.controlT2').hide();
    $('.controlT2').attr("required", false);
    $('.controlT1').show();

    $('.controlT4').hide();
    $('.controlT4').attr("required", false);
    $('.controlT3').show();
  });
*/



  /*
$(document).on('click', '.editsave', function(e){  //PROCESO PARA GUARDAR LOS DATOS EDITADOS
  var id=$('#idM').val();
  var nombre=$('#nombreM').val();
  var ci=$('#ciM').val();
  var item=$('#itemM').val(); 
  var servicio=$('#servicioM').val();
  var itemMo = $('#itemMo :selected').text();
  var servicioMo = $('#servicioMo :selected').text();
  console.log('id ' + id);
 //console.log('id => '+ id + ' persona'+ nombre+ ' ci '+ ci + ' item -> '+ item+ ' servicio -> '+ servicio + '  item=> '+ itemMo+ ' servi=> '+ servicioMo);
 /* if (itemMo == 'Seleccione una opcion') {
    notificaciones("Seleccione un tipo de contrato", "ERROR DE FORMULARIO", 'warning'); 
    return false;
  }
  if (servicioMo == 'Seleccione una opcion') {
    notificaciones("Seleccione un servicio", "ERROR DE FORMULARIO", 'warning'); 
    return false;
  }*

});*/

