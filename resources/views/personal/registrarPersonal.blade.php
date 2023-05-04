
<div class="modal fade" id="registro_personalModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-center sticky-top" id="exampleModalLabel">Registro de nuevo Personal</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                {!! Form::open(['route' => 'registrar.persona.nueva', 'method' => 'post', 'autocomplete'=>"off"]) !!}
                        <input type="hidden" name="id_user" id="idMR">
                        <div class="form-group ">
                            {!! Form::label('Nombre Completo', 'Nombre completo de la persona', ['class' => 'font-weight-bold' ]) !!}
                            {!! Form::text('nombre','' , ['class' => ' form-control' , 'required' => 'required', 'id'=>"nombreMR", 'readonly' => 'true']) !!}
                        </div>
                        <div class="form-group">
                            {!! Form::label('ciPer', 'CI de la persona', ['class' => 'font-weight-bold' ]) !!}
                            {!! Form::text('ci','' , ['class' => 'form-control' , 'required' => 'required', 'id'=>"ciMR", 'readonly' => 'true']) !!}
                        </div>

                        <div class="form-group">
                            {!! Form::label('item_Per', 'Tipo de contrato', ['class' => 'font-weight-bold' ]) !!}
                            <select class="form-control custom-select controlT2" name="item" id="itemMR" required="true">
                                <option value="" selected>Elegir un tipo de contrato</option> 
                                @foreach($items as $id => $item) 
                                    <option value="{{$id}}" > {{$item}} </option>  
                                @endforeach
                            </select>
                        </div>
                       
                        <div class="form-group">
                            {!! Form::label('servicioPer', 'Nombre del servicio', ['class' => 'font-weight-bold' ]) !!}
                           <select class="form-control custom-select controlT2" name="servicio" id='servicioMR' required="true">
                                <option value="" selected>Elegir un servicio</option> 
                                @foreach($servicios as $id => $servicio)
                                    <option value="{{$id}}">{{$servicio}}</option>                       
                                @endforeach
                             </select>
                        </div>

                        <div class="modal-footer"> <!--nombre, ci, item, id X, servicio X-->
                            {!! Form::submit('Guardar', ['class' => 'btn btn-primary registrarpersona'] ) !!} 
                            {!! Form::reset('Cancelar', ['class' => 'btn btn-secondary', 'data-dismiss'=>"modal", 'id'=>"limpiarmodal"] ) !!}
                        </div>
                    {!! Form::close() !!}   
                <form>
                
            </div>
       </div>
    </div>
</div>