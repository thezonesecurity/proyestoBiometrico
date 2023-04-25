
  <div class="modal fade" id="rolturnEnviar{{ $rolturno->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                {{Form::hidden('id', $rolturno->id)}}
                 <p>Esta seguro que desea Enviar el rolturno del servicio de <span class="font-weight-bold">{{$rolturno->servicios->nombre}}</span> corespondiente a la gestion de
                    <span class="font-weight-bold">{{$rolturno->gestion}}</span>. Una vez enviado no podra realizar ningun registro ni podra editar. Desea Enviar?</p>
                <div class="modal-footer">
                    {!! Form::submit('Enviar', ['class' => 'btn btn-primary' ] ) !!} 
                    {!! Form::submit('Cancelar', ['class' => 'btn btn-secondary', 'data-dismiss'=>"modal" ] ) !!}
                </div>
            {!! Form::close() !!}  
        </div>
      </div>
    </div>
  </div>