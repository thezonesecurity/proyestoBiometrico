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
              <div class="text-center font-weight-bold">
                <img src="{{asset('assets/img/ad.JPG')}}" width="250" height="190" class="rounded mx-auto d-block"/>
                <h4>Esta seguro de eliminar ?</h4>
              </div>
                <input type="hidden" class="form-control " name="id" id='idMe'>
                <p>Se eliminara el rolturno de la persona <span id="personaMe" class="font-weight-bold"></span>
                  corespondiente a la fecha de <span id="f_iniMe" class="font-weight-bold"></span><br> Esta accion no se puede deshacer!</p>
                <div class="modal-footer" style="margin-top: -30px;">
                    {!! Form::submit('Eliminar', ['class' => 'btn btn-danger' ] ) !!} 
                    {!! Form::submit('Cancelar', ['class' => 'btn btn-secondary cancelar', 'data-dismiss'=>"modal" ] ) !!}
                </div>
            {!! Form::close() !!}  
          </div>
         
      </div>
    </div>
  </div>
