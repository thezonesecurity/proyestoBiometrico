<!--Modal editar servicio  dd($servicioe->id)}}-->
<div class="modal fade" id="ActualizarTipoContrato" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Modal Editar Tipo de Contrato</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            {!! Form::open(['route' => 'editarsave.tipo.contrato', 'method' => 'post', 'autocomplete'=>"off", 'id' => 'formEditarTipoContrato']) !!}
                <input type="hidden" name="id" id="idM">
                <div class="form-group">
                    <label for="recipient-servicio" class="font-weight-bold">Nombre</label>
                    <input type="text" class="form-control" name="tipo_contratoM" id="t_contratoM">
                  </div>
                <div class="modal-footer">
                    {!! Form::submit('Guardar Cambios', ['class' => 'btn btn-primary editsave' ] ) !!} 
                    {!! Form::reset('Cancelar', ['class' => 'btn btn-secondary limpiarM', 'data-dismiss'=>"modal", 'id'=> 'cancelarBtn' ] ) !!}
                </div>
               
            {!! Form::close() !!}   
      </div>
    </div>
  </div>   

  