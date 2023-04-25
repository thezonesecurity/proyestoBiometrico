<div class="modal fade" id="ActualizarcambioTurno{{ $servicio->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Cambio de turno</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            {!! Form::open(['route' => 'editarsave.rolturno', 'method' => 'post', 'autocomplete'=>"off"]) !!}
                <input type="hidden" class="form-control " name="id" id='idM'>
                <div class="form-row font-weight-bold" style="margin-top: -px;">
                    <div class="form-group col-md-6">
                        <label for="servicio">Servicio</label>
                        <input type="text" class="form-control custom-select " name="servicio" id='servicioMo' readonly>
                    </div>
                    <div class="form-group col-md-6">
                        <label class="font-weight-bold" for="Gestion">Gestion</label>
                        <input type="text" class="form-control" name="gestion" id='gestion' readonly>
                    </div>
                </div>


                <div class="form-row font-weight-bold" style="margin-top: -10px;">
                    <div class="form-group col-md-6">
                        <label for="persona1A">Persona Saliente</label>
                        <input type="text" class="form-control custom-select" name="persona1" id='personaM1' readonly style="font-size: 12px;">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="persona2B">Persona Reemplazo</label>
                        <input type="text" class="form-control custom-select" name="persona2" id='personaM2' readonly style="font-size: 12px;">
                    </div>
                </div>

                <div class="form-row font-weight-bold" style="margin-top: -10px;">
                    <label for="fecha">Fecha</label>
                    <input type="date" class="form-control" name="fecha" id="fecha" >
                </div>
                <div class="form-group row" style="margin-top: 5px;">
                    <label class="col font-weight-bold">Observaciones</p>
                    <textarea name="comentario" id="comentario" class="form-control-sm col" placeholder="Este campo es opcional"  style="margin-top: -10px;" ></textarea>
                </div>
                        
                <div class="modal-footer" style="margin-top: -30px;">
                    {!! Form::submit('Guardar Cambios', ['class' => 'btn btn-success' ] ) !!} 
                    {!! Form::submit('Cancelar', ['class' => 'btn btn-secondary', 'data-dismiss'=>"modal" ] ) !!}
                </div>
            {!! Form::close() !!}  

        </div>
      </div>
    </div>
  </div>