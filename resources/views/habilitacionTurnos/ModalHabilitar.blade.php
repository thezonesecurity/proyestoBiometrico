
  <div class="modal fade" id="habilitar{{ $rolturno->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel"  style="font-size: 20px;">Habilitacion de rolturno de {{$rolturno->servicios->nombre}} </h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            {!! Form::open(['route' => 'habilitar.servicio.rolturno', 'method' => 'post']) !!}
                {{Form::hidden('id', $rolturno->id)}}
                <p>Esta seguro que desea realizar alguna accion para el rolturno del servicio de <span class="font-weight-bold">{{$rolturno->servicios->nombre}}</span> corespondiente a la gestion de
                  <span class="font-weight-bold">{{$rolturno->gestion}}</span>. </p>
                <div class="form-group">
                  <label for="recipient-name" class="col-form-label font-weight-bold">Observacion</label>
                  <textarea class="form-control" name="obs" id="obs"  pattern="[A-Za-z ]{5,60}" required>{{$rolturno->obsevacion}}</textarea>
                </div>  
                <div class="modal-footer">
                  <button type="submit" name="accion" value="Aceptado" class="btn btn-success">Aceptar</button>
                  <button type="submit" name="accion" value="Rechazado" class="btn btn-danger">Rechazar</button>
                  <button type="submit" name="accion" value="Cancelado" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                 {{-- {!! Form::submit('Aceptar',  ['class' => 'btn btn-success', 'value'=> '0' ] ) !!} 
                  {!! Form::submit('Rechazar', ['class' => 'btn btn-danger', 'value'=> '1' ] ) !!} 
                  {!! Form::submit('Cancelar', ['class' => 'btn btn-secondary', 'data-dismiss'=>"modal" ] ) !!}--}}
                </div>
            {!! Form::close() !!}  
        </div>
      </div>
    </div>
  </div>