<!--Modal crear servicio-->
<div class="modal fade" id="registrar_tipoTurnoModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Registrar Nuevo Tipo de turno</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            {!! Form::open(['route' => 'guardar.tipo.turno', 'method' => 'post', 'autocomplete'=>"off"]) !!}
              <div class="form-group">
                <label for="recipient-servicio" class="font-weight-bold">Nombre</label>
                <input type="text" class="form-control" name="t_turno" id="t_turno">
              </div>
              <div class="form-group">
                    <div class="modal-footer"> 
                        {!! Form::submit('Guardar', ['class' => 'btn btn-primary registrar' ] ) !!} 
                        {!! Form::reset('Cancelar', ['class' => 'btn btn-secondary', 'data-dismiss'=>"modal", 'id'=>"limpiarmodal" ] ) !!}
                    </div>
                </div>
              {!! Form::close() !!}
        </div>
    </div>
  </div>
