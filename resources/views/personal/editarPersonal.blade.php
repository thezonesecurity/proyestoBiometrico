
<div class="modal fade" id="editar_personalModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-center sticky-top" id="exampleModalLabel">Registro de Personal</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                {!! Form::open(['route' => 'editar.personal', 'method' => 'post', 'autocomplete'=>"off"]) !!}
                
                        <input type="hidden" name="id_user" id="idM">
                        <div class="form-group ">
                            {!! Form::label('Nombre Completo', 'Nombre completo de la persona', ['class' => 'font-weight-bold' ]) !!}
                            {!! Form::text('nombre','' , ['class' => ' form-control' , 'required' => 'required', 'id'=>"nombreM", 'readonly' => 'true']) !!}
                        </div>
                        <div class="form-group">
                            {!! Form::label('ciPer', 'CI de la persona', ['class' => 'font-weight-bold' ]) !!}
                            {!! Form::text('ci','' , ['class' => 'form-control' , 'required' => 'required', 'id'=>"ciM", 'readonly' => 'true']) !!}
                        </div>

                        <div class="form-group">
                            {!! Form::label('item_Per', 'Tipo de contrato', ['class' => 'font-weight-bold' ]) !!}
                            <input type="text" class="form-control custom-select controlT1" name="itemM" id="itemM">
                            <select class="form-control custom-select controlT2" name="itemMo" id="itemMo" required="true" style="display: none">
                                <option value="" disabled>Elegir un tipo de contrato</option> 
                                @foreach($items as $id => $item) 
                                    <option value="{{$id}}" > {{$item}} </option>  
                                @endforeach
                            </select>
                        </div>
                       
                        <div class="form-group">
                            {!! Form::label('servicioPer', 'Nombre del servicio', ['class' => 'font-weight-bold' ]) !!}
                            <input type="text" class="form-control custom-select controlT1" name="servicioM" id="servicioM">
                           <select class="form-control custom-select controlT2" name="servicioMo" id='servicioMo' required="true" style="display: none">
                                <option value="" disabled>Elegir un servicio</option> 
                                @foreach($servicios as $id => $servicio)
                                    <option value="{{$id}}">{{$servicio}}</option>                       
                                @endforeach
                             </select>
                        </div>

                        <div class="modal-footer"> <!--nombre, ci, item, id X, servicio X-->
                            {!! Form::submit('Guardar Cambios', ['class' => 'btn btn-primary' ] ) !!} 
                            {!! Form::submit('Cancelar', ['class' => 'btn btn-secondary', 'data-dismiss'=>"modal"] ) !!}
                        </div>
                    {!! Form::close() !!}   
                <form>
                
            </div>
       </div>
    </div>
</div>