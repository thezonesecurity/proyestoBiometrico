
  <div class="modal fade" id="cambioRolTurno{{ $rolturno->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel"  style="font-size: 20px;">Habilitacion de Cambio de rolturno de {{$rolturno->servicios->nombre}} </h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            {!! Form::open(['route' => 'anular.accion.rolturno', 'method' => 'post']) !!}
                {{Form::hidden('id', $rolturno->id)}}
                <div class="text-center font-weight-bold">
                  <img src="{{asset('assets/img/ad.JPG')}}" width="250" height="190" class="rounded mx-auto d-block"/>
                  <h4>Esta seguro de cambio de rol turno / anular accion ?</h4>
                </div>
                <p>Esta seguro que desea realizar alguna accion para el rolturno del servicio de <span class="font-weight-bold">{{$rolturno->servicios->nombre}}</span> corespondiente a la gestion de
                  <span class="font-weight-bold">{{$rolturno->gestion}}</span>. </p>
                <div class="form-group">
                  <label for="recipient-name" class="col-form-label font-weight-bold">Observacion</label>
                  <textarea class="form-control" name="obsMC" id="obs"  pattern="[A-Za-z ]{5,60}" >{{$rolturno->obsevacion}}</textarea>
                  <small>solo letras, numeros, min 5, max 60 y es requerido</small>
                </div>  
                <div class="modal-footer">
                  <button type="submit" name="accion" value="CambioTurno" class="btn btn-success">Habilitar Cambio turno</button>
                  <button type="submit" name="accion" value="AnularAccion" class="btn btn-danger">Anular accion</button>
                  <button type="submit" name="accion" value="Cancelado" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                </div>
            {!! Form::close() !!}  
        </div>
      </div>
    </div>
  </div>