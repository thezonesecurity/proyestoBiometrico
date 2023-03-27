
<div class="modal fade" id="edit" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-center sticky-top" id="exampleModalLabel">Editar Personal</h5>
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
                            {!! Form::label('item_Per', 'item de la persona', ['class' => 'font-weight-bold' ]) !!}
                            {{-- {!! Form::text('item','' , ['class' => 'form-control' , 'required' => 'required', 'id'=>"itemM"]) !!}--}}
                            <select class="form-control custom-select" name="item" id="itemM['idM']" required="true">
                                <option value="" disabled >Elegir un item</option> 
                                <option value="Item">Item</option> 
                                <option value="Tgn">Tgn</option>
                                <option value="Contrato">Contrato</option>
                                <option value="Idh">Idh</option>
                                <option value="Ministerial">Ministerial</option>
                            </select>
                        </div>
                       
                        <div class="form-group">
                            {!! Form::label('servicioPer', 'servicio de la persona', ['class' => 'font-weight-bold' ]) !!}
                           {{-- {!! Form::text('servicio','' , ['class' => 'form-control' , 'required' => 'required', 'id'=>"servicioM"]) !!} --}}
                            <?php $servi = DB::table('repbio.servicios')->get(); ?>
                           <select class="js-example-basic-single form-control custom-select" name="servicio" id='servicioM' required="true">
                            <option value="" disabled>Elegir un servicio</option> 
                            @foreach($servi as $item)
                                @if($item->estado == 'Habilitado')
                                    <option value="{{$item->nombre}}" selected >
                                        {{$item->nombre}}
                                    </option>  
                                @endif                       
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