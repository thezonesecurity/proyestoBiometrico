<div class="modal fade" id="eliminarModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">

         <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Esta seguro que desea eliminar el resgistro ?</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            {!! Form::open(['route' => 'rolturno.eliminado', 'method' => 'post', 'autocomplete'=>"off"]) !!}
                <input type="hidden" class="form-control " name="id" id='idMe'>
                <p>Se eliminara el rolturno del personal <input class="font-weight-bold" id="personaMe" disabled  style="border: 0;"> 
                    corespondiente a la fecha de <input class="font-weight-bold mr-15" id="f_iniMe" disabled  style="border: 0;"><br> Esta accion no se puede deshacer!</p>
                <div class="modal-footer" style="margin-top: -30px;">
                    {!! Form::submit('Eliminar', ['class' => 'btn btn-success' ] ) !!} 
                    {!! Form::submit('Cancelar', ['class' => 'btn btn-secondary cancelar', 'data-dismiss'=>"modal" ] ) !!}
                </div>
            {!! Form::close() !!}  
          </div>
         
      </div>
    </div>
  </div>
