<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Registrar Nueva Persona</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            {!! Form::open(['route' => 'registrar.persona.nueva', 'method' => 'post', 'autocomplete'=>"off", 'id'=> 'formRegistrarPersonal']) !!}
                 <input type="hidden" name="id_per" id="id"> {{--hidden--}}
                <div class="form-group">
                    <label for="recipient-persona" class="font-weight-bold">Nombre de la Persona</label>
                    <input type="text" class="form-control" name="nombre" id="nombre" readonly>
                </div>
                <div class="form-group">
                    <label for="recipient-ci" class="font-weight-bold">Cedula de Identidad</label>
                    <input type="text" class="form-control" name="ci" id="ci" readonly>
                </div>
                
                <div class="form-group">
                    {!! Form::label('item_Per', 'Tipo de contrato', ['class' => 'font-weight-bold' ]) !!}
                    <select class="form-control controlItem valorItem" name="item" id="item">
                        <option value="" selected>Selecione una opcion</option> 
                        @foreach($items as $id => $item) 
                            <option value="{{$id}}" >{{$item}}</option>  
                        @endforeach
                    </select>
                </div>

                <div class="form-group" >
                    <label for="recipient-fonfoFianciamiento" class="font-weight-bold controlNFFN" style="display: none;">Nro. fondo de financiamiento</label>
                    <input type="number" class="form-control controlNFFI" name="numFinanciamiento" id="numFinanciamiento" placeholder="Ingrese numero fondo de financiamiento" style="display: none;">
                </div>

                <div class="form-group">
                    {!! Form::label('servicioPer', 'Nombre del servicio', ['class' => 'font-weight-bold' ]) !!}
                <select class="form-control custom-select valorServicio" name="servicio" id='servicio'>
                        <option value="" disabled selected>Selecione una opcion</option> 
                        @foreach($servicios as $id => $servicio)
                            <option value="{{$id}}">{{$servicio}}</option>                       
                        @endforeach
                    </select>
                </div>
                    <div class="form-group">
                        <div class="modal-footer"> 
                            {!! Form::submit('Guardar', ['class' => 'btn btn-primary ' ] ) !!} 
                            {!! Form::button('Cancelar', ['class' => 'btn btn-secondary limpiar', 'data-dismiss'=>"modal", 'id'=>"cancelarBtnR" ] ) !!}
                        </div>
                    </div>
            {!! Form::close() !!}
      </div>
    </div>
  </div>
  {{--<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">New message</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <div class="modal-body">
                {!! Form::open(['route' => 'registrar', 'method' => 'post', 'autocomplete'=>"off"]) !!}
                        <input type="hidden" name="id" id="id">
                        <div class="form-group">
                            <label for="recipient-persona" class="font-weight-bold">Nombre de la Persona</label>
                            <input type="text" class="form-control" name="nombre" id="nombre" readonly>
                        </div>
                        <div class="form-group">
                            <label for="recipient-ci" class="font-weight-bold">Cedula de Identidad</label>
                            <input type="text" class="form-control" name="ci" id="ci" readonly>
                        </div>
                        
                        {{--<div class="form-group">
                            {!! Form::label('item_Per', 'Tipo de contrato', ['class' => 'font-weight-bold' ]) !!}
                            <select class="form-control custom-select controlT2" name="item" id="item" required="true">
                                <option value="" selected>Elegir una opcion</option> 
                                @foreach($items as $id => $item) 
                                    <option value="{{$id}}" > {{$item}} </option>  
                                @endforeach
                            </select>
                        </div>
                       
                        <div class="form-group">
                            {!! Form::label('servicioPer', 'Nombre del servicio', ['class' => 'font-weight-bold' ]) !!}
                           <select class="form-control custom-select controlT2" name="servicio" id='servicio' required="true">
                                <option value="" selected>Elegir una opcion</option> 
                                @foreach($servicios as $id => $servicio)
                                    <option value="{{$id}}">{{$servicio}}</option>                       
                                @endforeach
                             </select>
                        </div>--}

                        <div class="modal-footer"> <!--nombre, ci, item, id X, servicio X-->
                            {!! Form::submit('Guardar', ['class' => 'btn btn-primary '] ) !!} 
                            {!! Form::reset('Cancelar', ['class' => 'btn btn-secondary', 'data-dismiss'=>"modal", 'id'=>"limpiarmodal"] ) !!}
                        </div>
                {!! Form::close() !!}    
              </div>
              
              {{---
            {!! Form::open(['route' => 'registrar.persona.nueva', 'method' => 'POST', 'autocomplete'=>"off"]) !!}
                <input type="hidden" name="id_user" id="idMR">
                <div class="form-group">
                    <label for="recipient-persona" class="font-weight-bold">Nombre de la Persona</label>
                    <input type="text" class="form-control" name="nombre" id="nombreMR" >
                </div>
                <div class="form-group">
                    <label for="recipient-ci" class="font-weight-bold">Cedula de Identidad</label>
                    <input type="text" class="form-control" name="ci" id="ciMR" >
                </div>
                
                <div class="form-group">
                    {!! Form::label('item_Per', 'Tipo de contrato', ['class' => 'font-weight-bold' ]) !!}
                    <select class="form-control custom-select controlT2" name="item" id="itemMR" required="true">
                        <option value="" selected>Elegir una opcion</option> 
                        @foreach($items as $id => $item) 
                            <option value="{{$id}}" > {{$item}} </option>  
                        @endforeach
                    </select>
                </div>
            
                <div class="form-group">
                    {!! Form::label('servicioPer', 'Nombre del servicio', ['class' => 'font-weight-bold' ]) !!}
                <select class="form-control custom-select controlT2" name="servicio" id='servicioMR' required="true">
                        <option value="" selected>Elegir una opcion</option> 
                        @foreach($servicios as $id => $servicio)
                            <option value="{{$id}}">{{$servicio}}</option>                       
                        @endforeach
                    </select>
                </div>

                <div class="modal-footer"> <!--nombre, ci, item, id X, servicio X-->
                    {!! Form::submit('Guardar', ['class' => 'btn btn-primary'] ) !!} 
                    {!! Form::reset('Cancelar', ['class' => 'btn btn-secondary', 'data-dismiss'=>"modal", 'id'=>"limpiarmodal"] ) !!}
                </div>
           {!! Form::close() !!}  
           --}
      </div>
    </div>
  </div>--}}