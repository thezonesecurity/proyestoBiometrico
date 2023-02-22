<!--Modal editar servicio  dd($servicioe->id)}}-->
<div class="modal fade" id="ActualizarServicio{{ $servicio->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Modal Servicio a Editar</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            {!! Form::open(['route' => 'editarsave.servicio', 'method' => 'post', 'autocomplete'=>"off"]) !!}
                {{Form::hidden('id', $servicio->id)}}
                <div class="form-group">
                    {!! Form::label('nombre', 'Nombre Del Servicio A Editar') !!}
                    {!! Form::text('nombre', $servicio->nombre, ['class' => 'form-control' , 'required' => 'required', 'id'=>"nombre",
                    'placeholder'=>"Ingrese el nombre del servicio editado, solo letras min. 5 caracteres", 'pattern'=>"[A-Za-z ]{5,60}"]) !!}
                    <?php $antiguonombre = $servicio->nombre; ?>
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


<!--
<div class="container">
    <!-- si se necesita cambiar tamaño de modal agregar modal-lg a la linea 
    <div class="modal-dialog"> por <div class="modal-dialog modal-lg">-->
    <!-- Modal--
    <div class="modal fade" id="ActualizarServicio{ $servicio->id }}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">
                    <span aria-hidden="true">&times;</span><span class="sr-only">Cerrar</span>
                </button>
                <h4 class="modal-title" id="myModalLabel">Editar Servicio</h4>
                </div>
                <div class="modal-body">
                    <div class="row" style="padding:15px">
                        !! Form::open(['route' => 'editarsave.servicio', 'method' => 'post', 'autocomplete'=>"off"]) !!}
                            {Form::hidden('id', $servicio->id)}}
                            <div class="form-group">
                                !! Form::label('nombre', 'Nombre Del Servicio A Editar') !!}
                                !! Form::text('nombre', $servicio->nombre, ['class' => 'form-control' , 'required' => 'required', 'id'=>"nombre",
                                'placeholder'=>"Ingrese el nombre del servicio editado, solo letras min. 5 caracteres", 'pattern'=>"[A-Za-z ]{5,60}"]) !!}
                                 ?php $antiguonombre = $servicio->nombre; ?>
                            </div>
                            !! Form::submit('Guardar Cambios', ['class' => 'btn btn-success col-md-3 ', 'style'=>"margin-left: 80px " ] ) !!}
                            !! Form::submit('Cancelar', ['class' => 'btn btn-danger col-md-3', 'style' => "margin-left: 120px", 'data-dismiss'=>"modal" ] ) !!}
                            <!--
                            <div class="form-group">
                                if($antiguonombre != $servicio->nombre)
                                !! Form::submit('Guardar Cambios', ['class' => 'btn btn-success col-md-3 ', 'style'=>"margin-left: 80px " ] ) !!}
                                !! Form::submit('Cancelar', ['class' => 'btn btn-danger col-md-3', 'style' => "margin-left: 120px", 'data-dismiss'=>"modal" ] ) !!}
                                else
                                !! Form::submit('Guardar Cambios', ['class' => 'btn btn-success col-md-3 ', 'style'=>"margin-left: 80px ", 'disabled' ] ) !!}
                                !! Form::submit('Cancelar', ['class' => 'btn btn-danger col-md-3', 'style' => "margin-left: 120px", 'data-dismiss'=>"modal" ] ) !!}
                                endif
                            </div>-------
                        !! Form::close() !!}              
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
-->
  