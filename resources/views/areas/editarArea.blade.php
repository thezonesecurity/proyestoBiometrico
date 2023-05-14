
<div class="modal fade" id="Actualizar_Area" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Modal Editar Area</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            {!! Form::open(['route' => 'editarsave.area.servicio', 'method' => 'post', 'autocomplete'=>"off", 'id'=> 'form-editarArea']) !!}
               <input type="hidden" name="idM" id="idM">
                <div class="form-group">
                    <label for="recipient-area" class="font-weight-bold">Area</label>
                    <input type="text" class="form-control" name="areaM" id="areaM">
                </div>
                <div class="form-group">
                    <label for="recipient-servicio" class="font-weight-bold">Servicio</label>
                    <input type="text" class="form-control custom-select controlT1" name="servicioM" id="servicioM">
                    <select class="form-control custom-select controlT2" name="servicioMo" id='servicioMo' style="display: none">
                        <option value="" selected>Selecione una opcion</option>
                        @foreach($servicios as $id => $servicio)   
                            <option value="{{$id}}" >{{$servicio}}</option>  
                        @endforeach
                    </select>
                </div>
                <div class="modal-footer">
                    {!! Form::submit('Guardar Cambios', ['class' => 'btn btn-primary editsave' ] ) !!} 
                    {!! Form::reset('Cancelar', ['class' => 'btn btn-secondary cancelar', 'data-dismiss'=>"modal", 'id'=> 'cancelarBtnM' ] ) !!}
                </div>
            {!! Form::close() !!}   
      </div>
    </div>
  </div>   