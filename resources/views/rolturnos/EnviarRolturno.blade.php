
  <div class="modal fade" id="rolturnoEnviar" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Verificacion de Enviar de rolturno a R.R.H.H.</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            {!! Form::open(['route' => 'enviar.rolturno', 'method' => 'post']) !!}
                <div class="text-center font-weight-bold">
                  <img src="{{asset('assets/img/ad.JPG')}}" width="250" height="190" class="rounded mx-auto d-block"/>
                  <h4>Esta seguro de enviar ?</h4>
                </div>
                <input type="hidden" name="id" id="idMenviar">
                 <p>Se enviar el rolturno del servicio de <span id="servicioMenviar" class="font-weight-bold"></span>
                   corespondiente al mes de <span id="gestionMenviar" class="font-weight-bold"></span>. Desea Enviar?</p>
                <div class="modal-footer">
                    {!! Form::submit('Enviar', ['class' => 'btn btn-primary' ] ) !!} 
                    {!! Form::submit('Cancelar', ['class' => 'btn btn-secondary', 'data-dismiss'=>"modal" ] ) !!}
                </div>
            {!! Form::close() !!}  
        </div>
      </div>
    </div>
  </div>