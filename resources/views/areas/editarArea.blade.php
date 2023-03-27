<!--Modal editar servicio  dd($servicioe->id)}}-->
<div class="modal fade" id="Actualizar_Area" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Modal Servicio a Editar</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            {!! Form::open(['route' => 'editarsave.area.servicio', 'method' => 'post', 'autocomplete'=>"off"]) !!}
               {{-- {{Form::hidden('id_area', '')}}--}}
               <input type="hidden" name="id_area" id="id_area">
                <div class="form-group">
                    {!! Form::label('nombre', 'Nombre Del Servicio A Editar',['class' => 'font-weight-bold' ]) !!}
                    {!! Form::text('nombre', '', ['class' => 'form-control' , 'required' => 'required', 'id'=>"nombre",
                    'placeholder'=>"Ingrese el nombre del servicio editado, solo letras min. 5 caracteres", 'pattern'=>"[A-Za-z ]{5,60}"]) !!}
                    
                </div>
                
                <div class="form-group">
                    {!! Form::label('servicioPer', 'servicio de la persona', ['class' => 'font-weight-bold' ]) !!}
                    {{-- {!! Form::text('servicio','' , ['class' => 'form-control' , 'required' => 'required', 'id'=>"servicioM"]) !!} --}}
                    <select class="js-example-basic-single form-control custom-select" name="id_servicio" id='id_servicio'>
                        <?php $servi = App\Models\servicios\Servicio::all(); ?>
                        <option  disabled >Elija un servicio</option>
                        @foreach($servi as $item)
                            @if($item->estado == 'Habilitado')
                                <option value="{{$item->id}}">
                                    {{$item->nombre}}
                                </option>  
                            @endif                       
                        @endforeach
                    </select>
                </div>
                <div class="modal-footer">
                    {!! Form::submit('Guardar Cambios', ['class' => 'btn btn-primary' ] ) !!} 
                    {!! Form::submit('Cancelar', ['class' => 'btn btn-secondary', 'data-dismiss'=>"modal" ] ) !!}
                </div>
                <!--
                <div class="form-group">
                    if($antiguonombre != $servicio->nombre)
                    !! Form::submit('Guardar Cambios', ['class' => 'btn btn-success col-md-3 ', 'style'=>"margin-left: 80px " ] ) !!}
                    !! Form::submit('Cancelar', ['class' => 'btn btn-danger col-md-3', 'style' => "margin-left: 120px", 'data-dismiss'=>"modal" ] ) !!}
                    else
                    !! Form::submit('Guardar Cambios', ['class' => 'btn btn-success col-md-3 ', 'style'=>"margin-left: 80px ", 'disabled' ] ) !!}
                    !! Form::submit('Cancelar', ['class' => 'btn btn-danger col-md-3', 'style' => "margin-left: 120px", 'data-dismiss'=>"modal" ] ) !!}
                    endif
                </div>-->
            {!! Form::close() !!}   
      </div>
    </div>
  </div>   