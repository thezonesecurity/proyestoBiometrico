<!--Modal crear servicio-->
<div class="modal fade" id="registrar_tipoTurnoModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Registrar Tipo de turno</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            {!! Form::open(['route' => 'guardar.tipo.turno', 'method' => 'post', 'autocomplete'=>"off", 'id' => 'formRegistrarTipoTurno']) !!}
              <div class="form-group">
                <label for="recipient-servicio" class="font-weight-bold">Nombre</label>
                <input type="text" class="form-control" name="tipo_turno" id="tipo_turno">
              </div>
              <div class="form-group">
                    <div class="modal-footer"> 
                        {!! Form::submit('Guardar', ['class' => 'btn btn-primary registrar' ] ) !!} 
                        {!! Form::reset('Cancelar', ['class' => 'btn btn-secondary limpiar', 'data-dismiss'=>"modal", 'id'=>"cancelarBtn" ] ) !!}
                    </div>
                </div>
              {!! Form::close() !!}
        </div>
    </div>
  </div>
