{{-----
ESTE MODAL SE SE USA PERO ES REQUISITO PARA QUE FUNCIONE EL OTRO MODAL DE "registrar.blade.php"
--------}}
<div class="modal fade registrarModal" id="registrarModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalregistrar" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-center sticky-top" id="exampleModalLabel">Registro de nuevo Personal</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                
                {!! Form::open([ 'method' => 'POST', 'autocomplete'=>"off"]) !!}
                       
                {!! Form::close() !!}    
            </div>
       </div>
    </div>
</div>




