<!--Modal crear servicio-->
<div class="modal fade" id="registrar_servicioModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Registrar Nuevo Servicio</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            {!! Form::open(['route' => 'guardar.servicio', 'method' => 'post', 'autocomplete'=>"off", 'id'=> 'form-registrar']) !!}
              <div class="form-group">
                <label for="recipient-servicio" class="font-weight-bold">Servicio</label>
                <input type="text" class="form-control" name="servicio" id="servicio">
              </div>
              <div class="form-group">
                <label for="personall" class="font-weight-bold">Responsable</label>
                    <select class="form-control custom-select text-uppercase select2" name="persona" id="persona" >
                        <option value="" disabled selected>Selecione una opcion</option>
                        @foreach($users as $user)   
                            @if($user->estado == 'enable')
                                <option value="{{$user->id}}" > {{$user->per_user->nombres}} {{$user->per_user->apellidos}}</option> 
                            @endif  
                        @endforeach
                    </select>
              </div>
              <div class="form-group">
                    <div class="modal-footer"> 
                        {!! Form::submit('Guardar', ['class' => 'btn btn-primary registrar'] ) !!} 
                        {!! Form::reset('Cancelar', ['class' => 'btn btn-secondary', 'data-dismiss'=>"modal", 'id'=>"limpiarmodal" ] ) !!}
                    </div>
                </div>
              {!! Form::close() !!}
        </div>
        
    </div>
  </div>
