
   <!--Modal editar servicio  dd($servicioe->id)}}-->
   <div class="container">
    <!-- si se necesita cambiar tamaño de modal agregar modal-lg a la linea 
    <div class="modal-dialog"> por <div class="modal-dialog modal-lg">-->
    <!-- Modal-->
    <div class="modal fade" id="ActualizarServicio{{ $servicio->id }}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
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
                        {!! Form::open(['route' => 'editarsave.servicio', 'method' => 'post', 'autocomplete'=>"off"]) !!}
                            {{Form::hidden('id', $servicio->id)}}
                            <div class="form-group">
                                {!! Form::label('nombre', 'Nombre Del Servicio A Editar') !!}
                                {!! Form::text('nombre', $servicio->nombre, ['class' => 'form-control' , 'required' => 'required', 'id'=>"nombre",
                                'placeholder'=>"Ingrese el nombre del servicio editado, solo letras min. 5 caracteres", 'pattern'=>"[A-Za-z ]{5,60}"]) !!}
                                 <?php $antiguonombre = $servicio->nombre; ?>
                            </div>
                            {!! Form::submit('Guardar Cambios', ['class' => 'btn btn-success col-md-3 ', 'style'=>"margin-left: 80px " ] ) !!}
                            {!! Form::submit('Cancelar', ['class' => 'btn btn-danger col-md-3', 'style' => "margin-left: 120px", 'data-dismiss'=>"modal" ] ) !!}
                            <!--
                            <div class="form-group">
                                if($antiguonombre != $servicio->nombre)
                                !! Form::submit('Guardar Cambios', ['class' => 'btn btn-success col-md-3 ', 'style'=>"margin-left: 80px " ] ) !!}
                                !! Form::submit('Cancelar', ['class' => 'btn btn-danger col-md-3', 'style' => "margin-left: 120px", 'data-dismiss'=>"modal" ] ) !!}
                                else
                                !! Form::submit('Guardar Cambios', ['class' => 'btn btn-success col-md-3 ', 'style'=>"margin-left: 80px ", 'disabled' ] ) !!}
                                !! Form::submit('Cancelar', ['class' => 'btn btn-danger col-md-3', 'style' => "margin-left: 120px", 'data-dismiss'=>"modal" ] ) !!}
                                endif
                            </div>-->>
                        {!! Form::close() !!}              
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
    <!--Modal editar servicio-->
   <!---
    <div class="container">
    <br>dd($servicioEdit)
    <!-- Boton --
    <button data-toggle="modal" href="#mi_modal" class="btn btn-primary">Abrir ventana modal</button>
    <br><br>
    <!-- Link --
    <a data-toggle="modal" href="#mi_modal">Abrir ventana modal</a>

    <!-- si se necesita cambiar tamaño de modal agregar modal-lg a la linea 
    <div class="modal-dialog"> por <div class="modal-dialog modal-lg">-->

    <!-- Modal--
    <div class="modal fade" id="mi_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">
                <span aria-hidden="true">&times;</span><span class="sr-only">Cerrar</span>
            </button>
            <h4 class="modal-title" id="myModalLabel">TITULO</h4>
            </div>
            <div class="modal-body">
            <div class="row" style="padding:15px">
                ESPACIO PARA TEXTO ESPACIO PARA TEXTO ESPACIO PARA TEXTO ESPACIO PARA TEXTO ESPACIO PARA TEXTO
                ESPACIO PARA TEXTO                   
            </div>
            </div>
            <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
            </div>
        </div>
        </div>
    </div>
    </div>



    antiguo formulario del modal
    <form method="POST" action="{{ route('editarsave.servicio') }}" role="form" autocomplete="off">
                            @csrf
                            <div class="">
                                {{Form::hidden('id', $servicio->id)}}
                                <div class="form-group">
                                    <label for="nombre">Nombre</label>
                                    <input type="text" required name="nombre" class="form-control" id="nombre" value="{{ $servicio->nombre }}" placeholder="Ingrese nombre del servicio">
                                </div> 
                            </div>
                            <div class="booton-group">
                                <button type="submit" class="btn btn-primary col-md-3" style="margin: 10px 50px 20px;">Guardar</button>
                                <button type="button" class="btn btn-danger col-md-3" data-dismiss="modal" style="margin: 10px 50px 20px;">Cerrar</button>
                            </div>
                        </form>  
-->