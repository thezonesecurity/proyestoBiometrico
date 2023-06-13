
<div class="modal fade" id="ActualizarServicio" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Modal Servicio a Editar</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
           {{--{!! Form::open(['route' => 'editarsave.servicio', 'method' => 'post', 'autocomplete'=>"off",  'id'=> 'form-editarServicio']) !!}--}}
            <form id="form-editarServicio" autocomplete="off">{{--action="{{route('editarsave.servicio')}}" method="post"--}}        
                <input type="hidden" name="id" id="idM">
                <div class="form-group">
                    <label for="recipient-servicio" class="font-weight-bold">Servicio</label>
                    <input type="text" class="form-control" name="servicioM" id="servicioM">
                  </div>
                <div class="form-group">
                    <label for="personall" class="font-weight-bold">Responsable</label>
                    <input type="text" class="form-control custom-select controlT1" name="responsable" id="responsableM">
                    <select class="form-control custom-select controlT2 controlR" name="responsableMo" id="responsableMo" style="display: none">
                            <option value="" selected >Selecione una opcion</option>
                            @foreach($users as $user)   
                                @if($user->estado == 'enable')
                                    <option value="{{$user->id}}" > {{$user->per_user->nombres}} {{$user->per_user->apellidos}}</option> 
                                @endif  
                            @endforeach
                    </select>
                    <small id="validacionResponsable" class="form-text"></small>
                </div>
                <div class="modal-footer">
                    {!! Form::submit('Guardar Cambios', ['class' => 'btn btn-primary', 'id'=> 'saveChanges' ] ) !!} 
                    {!! Form::reset('Cancelar', ['class' => 'btn btn-secondary cancelar', 'data-dismiss'=>"modal", 'id'=>"cancelarBtnM"] ) !!}
                </div>
            </form>   
            {{--{!! Form::close() !!}  --}}
      </div>
    </div>
  </div>   
