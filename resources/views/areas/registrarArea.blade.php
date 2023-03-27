<!--Modal crear servicio-->
<div class="modal fade" id="registrar_areaModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Registrar Nuevo Servicio</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            {!! Form::open(['route' => 'guardar.area.servicio', 'method' => 'post', 'autocomplete'=>"off"]) !!}
                <div class="form-group">
                    {!! Form::label('Nombre', 'Nombre De la area') !!}
                    {!! Form::text('nombre', null, ['class' => 'form-control' , 'required' => 'required', 'placeholder'=>"Ingrese nombre del area, solo letras min. 5 caracteres",
                    'pattern'=>"[A-Za-z ]{5,60}",'onkeyup'=>"mostrarvalo(this.value)"]) !!}
                </div>
                <div class="form-group">
                    {!! Form::label('servicioPer', 'servicio de la persona', ['class' => 'font-weight-bold' ]) !!}
                {{-- {!! Form::text('servicio','' , ['class' => 'form-control' , 'required' => 'required', 'id'=>"servicioM"]) !!} --}}
                <select class="js-example-basic-single form-control custom-select" name="id_servicio" id='id_servicio' required="true">
                    <?php $servi = App\Models\servicios\Servicio::all(); ?>
                    <option value="" disabled selected>Elija un servicio</option>
                    @foreach($servi as $item)
                        @if($item->estado == 'Habilitado')
                            <option value="{{$item->id}}">
                                {{$item->nombre}}
                            </option>  
                        @endif                       
                    @endforeach
                </select>
                </div>
                <div class="form-group">
                    <div class="modal-footer"> 
                        {!! Form::submit('Guardar', ['class' => 'btn btn-primary' ] ) !!} 
                        {!! Form::submit('Cancelar', ['class' => 'btn btn-secondary', 'data-dismiss'=>"modal", 'id'=>"limpiarmodal" ] ) !!}
                    </div>
                </div>
            {!! Form::close() !!}
            {{--
            {!! Form::open(['route' => 'guardar.servicio', 'method' => 'post', 'autocomplete'=>"off"]) !!}
                <div class="form-group">
                    {!! Form::label('Nombressssss', 'Nombre Del Nuevo Servicio') !!}
                    {!! Form::text('nombre', null, ['class' => 'form-control' , 'required' => 'required', 'placeholder'=>"Ingrese nombre del servicio, solo letras min. 5 caracteres",
                     'pattern'=>"[A-Za-z ]{5,60}",'onkeyup'=>"mostrarvalo(this.value)"]) !!}
                </div>
                <div class="form-group">
                    <div class="modal-footer"> 
                        {!! Form::submit('Guardar', ['class' => 'btn btn-primary' ] ) !!} 
                        {!! Form::submit('Cancelar', ['class' => 'btn btn-secondary', 'data-dismiss'=>"modal", 'id'=>"limpiarmodal" ] ) !!}
                    </div>
                </div>
            {!! Form::close() !!}
            --}}

             {{--form--}}
      </div>
    </div>
  </div>