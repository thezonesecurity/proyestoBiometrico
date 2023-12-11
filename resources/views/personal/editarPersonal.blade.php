
<div class="modal fade" id="editarModalPersonal" tabindex="-1" role="dialog" aria-labelledby="exampleModaleditar" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-center sticky-top" id="exampleModalLabel">Registro para actualizar el Personal</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                {{--{!! Form::open(['route' => 'editar.personal', 'method' => 'post', 'autocomplete'=>"off", 'id' => 'formEditarPersonal']) !!}--}}
                <form id="formEditarPersonal" autocomplete="off">
                    <input type="hidden" name="id_user" id="idM"> {{--hidden--}}
                    <div class="form-group ">
                        <label for="for nombre" class="font-weight-bold">Nombre Completo</label>
                        <input type="text" class="form-control" name="nombrePersonal" id="nombreM"  style="text-transform: uppercase;">
                    </div>
                    <div class="form-group">
                        {!! Form::label('ciPer', 'CI de la persona', ['class' => 'font-weight-bold' ]) !!}
                        {!! Form::text('ci','' , ['class' => 'form-control' , 'required' => 'required', 'id'=>"ciM", 'readonly' => 'true']) !!}
                    </div>

                    <div class="form-group">
                        {!! Form::label('item_Per', 'Tipo de contrato', ['class' => 'font-weight-bold' ]) !!}
                        <input type="text" class="form-control controlT1 itemI" name="itemM" id="itemM">
                        <select class="form-control controlT2" name="itemMo" id="itemMo" style="display: none">
                            <option value="" selected>Seleccione una opcion</option> 
                            @foreach($items as $id => $item) 
                                <option value="{{$id}}" >{{$item}}</option>  
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group" >
                        <label for="recipient-fonfoFianciamiento" class="font-weight-bold controlNFFNm" style="display: none;">Nro. Item</label>
                        <input type="number" class="form-control controlNFFIm" name="numFinanciamientoM" id="numFinancM" style="display: none;" required>
                    </div>
                    <div class="form-group">
                        {!! Form::label('servicioPer', 'Servicio', ['class' => 'font-weight-bold' ]) !!}
                        <input type="text" class="form-control custom-select controlT3" name="servicioM" id="servicioM">
                       <select class="form-control custom-select controlT4" name="servicioMo" id='servicioMo' style="display: none">
                            <option value=""  selected>Seleccione una opcion</option> 
                            @foreach($servicios as $id => $servicio)
                                <option value="{{$id}}">{{$servicio}}</option>                       
                            @endforeach
                         </select>
                    </div>

                    <div class="modal-footer">
                        {!! Form::submit('Guardar Cambios', ['class' => 'btn btn-primary', 'id' => 'saveChangesPer' ] ) !!} 
                        {!! Form::reset('Cancelar', ['class' => 'btn btn-secondary cancelar limpiar', 'data-dismiss'=>"modal", 'id' => 'cancelarBtnM'] ) !!}
                    </div>        
                    {{--{!! Form::close() !!}   --}}
                <form>
            </div>
       </div>
    </div>
</div>