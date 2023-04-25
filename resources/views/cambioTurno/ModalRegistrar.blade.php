<div class="modal fade" id="ModalRegistrarCambioTurno" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Cambio de turno</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            {!! Form::open(['route' => 'crear.cambio_turno', 'method' => 'post', 'autocomplete'=>"off"]) !!}
                 {{ csrf_field() }}
                <div class="form-row font-weight-bold" style="margin-top: -px;">
                    <div class="form-group col-md-6">
                        <label for="servicio">Servicio</label>
                        <select class="form-control custom-select text-uppercase select2 ser" name="servicio" id='servicio' required="true">
                            <option value="" selected disabled>Seleccione un servicio</option> 
                            @foreach($servicios as $id => $item)
                                <option value="{{$id}}" > {{$item}} </option>                      
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group col-md-6">
                        <label class="font-weight-bold" for="Gestion">Gestion</label>
                        <input type="month" class="form-control verificar" name="gestion" id='gestion'>
                    </div>
                </div>

                <div class="form-row font-weight-bold" style="margin-top: -10px;">
                    <div class="form-group col-md-6">
                        <label for="persona1A">Persona Saliente</label>
                        <select class="form-control custom-select text-uppercase select2" name="persona1" id="per1" style="font-size: 13px;">
                            {{--<option value="Elegir personal" disabled selected>Elegir una persona</option>
                            @foreach($personas as $id => $persona)   
                                    <option value="{{$id}}" > {{$persona}} </option>  
                            @endforeach--}}
                        </select>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="persona2B">Persona Reemplazo</label>
                        <select class="form-control custom-select text-uppercase select2" name="persona2" id="per2" style="font-size: 14px;">
                            {{--<option value="Elegir personal" disabled selected>Elegir una persona</option>
                            @foreach($personas as $id => $persona)   
                                    <option value="{{$id}}" > {{$persona}} </option>  
                            @endforeach--}}
                        </select>
                    </div>
                </div>

                <div class="form-row font-weight-bold" style="margin-top: -10px;">
                    <label for="fecha">Fecha</label>
                    <input type="date" class="form-control control" name="fecha" id="fecha" >
                </div>

                <div class="form-group row" style="margin-top: 5px;">
                    <label class="col font-weight-bold">Observaciones</p>
                    <textarea name="comentario" id="comentario" class="form-control-sm col" placeholder="Este campo es opcional"  style="margin-top: -10px;" ></textarea>
                </div>
                
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Registrar</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                </div>
              {{--<div class="modal-footer" style="margin-top: -30px;">
                    {!! Form::submit('Registrar', ['class' => 'btn btn-success envia', 'id'=> 'enviar' ] ) !!} 
                    {!! Form::submit('Cancelar', ['class' => 'btn btn-secondary', 'data-dismiss'=>"modal" ] ) !!}
                </div>--}}
            {!! Form::close() !!}  

        </div>
      </div>
    </div>
  </div>
