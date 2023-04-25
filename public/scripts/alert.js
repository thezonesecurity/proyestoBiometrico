 function notificaciones(mensaje, titulo, tipo){
        toastr.options = {
            closeButton: true,
            newestOnTop: true,
            progressBar: true,
            positionClass: "toast-bottom-right",
            preventDuplicates: true,
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
