<!--Modal crear servicio-->
<div class="modal fade" id="registrar_areaModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Registrar Nueva Area</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            {!! Form::open(['route' => 'guardar.area.servicio', 'method' => 'post', 'autocomplete'=>"off"]) !!}
                <div class="form-group">
                    <label for="recipient-servicio" class="font-weight-bold">Area</label>
                    <input type="text" class="form-control" name="area" id="area">
                  </div>
                <div class="form-group">
                    <label for="recipient-servicio" class="font-weight-bold">Servicio</label>
                    <select class="js-example-basic-single form-control custom-select" name="servicio" id='servicio'>
                        <option value="vacio" disabled selected>Selecione una opcion</option>
                        @foreach($servicios as $id => $servicio)   
                            <option value="{{$id}}" >{{$servicio}}</option>  
                        @endforeach
                    </select>
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