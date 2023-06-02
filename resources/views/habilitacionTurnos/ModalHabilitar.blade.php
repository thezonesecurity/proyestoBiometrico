
  <div class="modal fade" id="ModalHabilitarRolturno" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">{{--id="habilitar{{ $rolturno->id }}"--}}
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h6 class="modal-title font-weight-bold" id="exampleModalLabel"  style="font-size: 17px;">Habilitacion rolturno de 
            <input type="text" name="servicio" id="servicioMH" disabled style="border: none; outline: none; font-size: 18px;" class="font-weight-bold"> 
          </h6>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            {!! Form::open(['route' => 'habilitar.servicio.rolturno', 'method' => 'post', 'id' => 'form-habilitarTurno']) !!}
               <input type="hidden" name="id" id="idMH">
                <p>Esta seguro que desea realizar alguna accion para el rolturno del servicio de
                   <input type="text" name="servicio2" id="servicioMH2" disabled class="font-weight-bold" style="border: none; outline: none;"><br>
                   corespondiente a la gestion de{{--{{$rolturno->servicios->nombre}}--}}
                  <input type="text" name="gestion" id="gestionMH" disabled class="font-weight-bold" style="border: none; outline: none;">
                </p>{{--{{$rolturno->gestion}}--}}
                <div class="form-group" style="margin-top: -13px;">
                  <label for="select2" class="font-weight-bold">Accion</label>
                  {{--<input type="text" name="op" id="opcionM" class="form-control">--}}
                  <select class="form-control" name="accion" id="accion">
                      <option value="" selected>Selecione una opcion</option>
                      <option value="Aceptado">Aceptado</option>
                      <option value="Rechazado">Rechazado</option>
                      <option value="Cambio_turno">Habilitar Cambio Turno</option>
                      <option value="Anular_accion">Anular Accion</option>
                  </select>
                </div>
                <div class="form-group" style="margin-top: -15px;">
                  <label for="recipient-name" class="col-form-label font-weight-bold">Observacion</label>
                  <textarea class="form-control observacion" name="comentario" id="obsMH">{{$rolturno->obsevacion}}</textarea>
                </div>  
                <div class="modal-footer">
                  <button type="submit" class="btn btn-success">Guardar</button>
                  <button type="reset" class="btn btn-secondary limpiarMH" id="cancelarBtn" data-dismiss="modal">Cancelar</button>
                </div>
            {!! Form::close() !!}  
        </div>
      </div>
    </div>
  </div>


      {{-- {{Form::hidden('id', $rolturno->id)}}
                <div class="text-center font-weight-bold">
                  <img src="{{asset('assets/img/ad.JPG')}}" width="250" height="190" class="rounded mx-auto d-block"/>
                  <h4>Esta seguro de habilitacion / rechazar rol Turnos ?</h4>
                </div>--}}
                   {{--<small>solo letras, numeros, min 5, max 60 y es requerido</small>--}}
                 {{-- 
                  <button type="submit" name="accion" value="Rechazado" class="btn btn-danger">Rechazar</button>
                  {!! Form::submit('Aceptar',  ['class' => 'btn btn-success', 'value'=> '0' ] ) !!} 
                  {!! Form::submit('Rechazar', ['class' => 'btn btn-danger', 'value'=> '1' ] ) !!} 
                  {!! Form::submit('Cancelar', ['class' => 'btn btn-secondary', 'data-dismiss'=>"modal" ] ) !!}--}}