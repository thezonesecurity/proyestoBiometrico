 //para notificaciones de los procesos
 function notificaciones(mensaje, titulo, tipo){
        toastr.options = {
            closeButton: true,
            newestOnTop: true,
            progressBar: true,
            positionClass: "toast-bottom-right",
            preventDuplicates: false,
            timeOut: "5000",
        };
        if(tipo == "error"){
            toastr.error(mensaje, titulo);
        }else if(tipo == "success"){
            toastr.success(mensaje, titulo);
        }else if(tipo == "info"){
            toastr.info(mensaje, titulo);
        }else if(tipo == "warning"){
            toastr.warning(mensaje, titulo);
        }
}
// para validacion y verificacion de inputs
/*
function verificarInput(valor, elementoValidacion, rules, idInput, msmValidado) {
    if (valor !== '') {
      if(rules.test(valor)){
        elementoValidacion.addClass('text-success');
        elementoValidacion.removeClass('text-danger');
        elementoValidacion.text('Campo Validado y verificado').show();
        idInput.removeClass('is-invalid');
      }else{
        elementoValidacion.addClass('text-danger');
        elementoValidacion.removeClass('text-success');
        elementoValidacion.text(msmValidado).show();
        idInput.addClass('is-invalid');
      }
    } else {
      elementoValidacion.addClass('text-danger');
      elementoValidacion.removeClass('text-success');
      elementoValidacion.text('Por favor ingrese este campo').show();
      idInput.addClass('is-invalid');
    }
  }*/
  
 //PROCESO PARA K DESAPARESCA EL ALERT DE SESSION ENVIADO DESDE EL CONTROLADOR
 window.setTimeout(function() {
    $(".alert").fadeTo(500, 0).slideUp(400, function(){
        $(this).remove(); 
    });
}, 5000);
