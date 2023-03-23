 <!--container-fluid justify-content-center-->
NO ESTA SIENDO USADO ESTE FILE
{!! Form::open(['route' => 'guardar.rolturno', 'method' => 'post', 'autocomplete'=>"off", 'class'=> 'border border-5 border-success form-control']) !!}
    <div class="form-group col-md-10 ml-5">
        <label for="personall" class="font-weight-bold">Personal</label>
        <select id="per" class="form-control" name="personal" required>
            <option value="" disabled selected>Elegir personal</option>
            <?php  while($row=sqlsrv_fetch_array($result) ) {
                $persona=App\Models\personal\Persona::where('idper_db',$row['USERID'])->first(); 
                if(isset($persona)) { 
                   $cargo_per=$persona->cargo; echo $cargo_per;  ?>       
                <option value="{{$row['NAME']}},{{$persona->idper_db}}">{{$row['NAME']}}
                </option>
            <?php }} sqlsrv_close($conn); ?>
        </select>
    </div>

    <div class="form-group row font-weight-bold" id="product1">
        <div class="form-check ml-5 col-md-4">
            <input class="form-check-input" type="checkbox" id="laboral" name="laboral">
            <label class="form-check-label" for="gridCheck">Dia laboral</label>
        </div>
        <div class="form-check ml-5 col-md-4"> 
            <input class="form-check-input" type="checkbox" id="descanso" name="descanso">
            <label class="form-check-label" for="gridCheck">Vacacion</label>
        </div>
    </div>
    
    <div class="form-row font-weight-bold">
        <div class="form-group col-md-6">
            <label for="fecha de inicio">Fecha Inicio</label>
            <input type="date" class="form-control" id="fec_inicio" name="fecha_inicio" required >
        </div>
        <div class="form-group col-md-6">
            <label for="fecha de fin">Fecha Fin</label>
            <input type="date" class="form-control " id="fec_fin" name="fecha_fin" required disabled>
        </div>
    </div>
    <div class="form-row font-weight-bold">
        <div class="form-group col-md-6">
            <label for="hora de inicio">Hora Inicio</label>
            <input type="time" class="form-control " id="hrs_inicio" name="hora_inicio" required>
        </div>
        <div class="form-group col-md-6">
            <label for="hora de fin">Hora Fin</label>
            <input type="time" class="form-control " id="hrs_fin" name="hora_fin" required>
        </div>
    </div>

    <div class="form-row font-weight-bold">
        <div class="form-group col-md-4">
            <label for="turnoo">Turno</label>
            <select id="turno" class="form-control" name="turno" required>
                <option value="" disabled selected>Elegir turno</option>
                <option value="Mañana">Mañana</option>
                <option value="Tarde">Tarde</option>
                <option value="Dia">Dia</option>
                <option value="Noche">Noche</option>
                <option value="24 Hrs.">24 Hrs.</option>
            </select>
        </div>
        <div class="form-group col-md-8">
            <label for="cargoo">Cargo</label>
            <input type="text" class="form-control" placeholder="Este campo es opcional" id="cargo" name="cargo" required >
        </div>
    </div>
    <div class="form-group row font-weight-bold">
        <label class="col">Observaciones</p>
        <textarea name="comentario" class="form-control col" placeholder="Este campo es opcional" id="obs"></textarea>
    </div>

    <div class="form-row font-weight-bold">
        <button id="adicionar" class="btn btn-success" type="button">+ Agregar</button>
        {!! Form::submit('Guardar', ['class' => 'btn btn-primary ml-4' ] ) !!} 
        {!! Form::reset('Cancelar', ['class' => 'btn btn-secondary ml-4'] ) !!}
    </div>
    
{!! Form::close() !!}

{{--OFICIAL SELECT
    <select id="per" class="form-control" name="personal" required>
            <option value="" disabled selected>Elegir personal</option>
            <option value="A">A</option>
            <option value="B">B</option>
            <option value="C">C</option>
        </select>

        -----------------------------------------------------------------------
{!! Form::open(['route' => 'guardar.servicio', 'method' => 'post', 'autocomplete'=>"off"]) !!}
<div class="form-group">
    {!! Form::label('Nombre', 'Nombre Del Nuevo Servicio') !!}
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
@section('scripts')
<script>
    $(document).ready(function(){
        $(document).ready(function(){
        $('#laboral').prop("checked", true);
       
        $('#laboral').on('change', function(e){
            //DIA LABORAL
            e.preventDefault();
            $('#laboral').prop("checked", true);
            $('#descanso').prop("checked", false);
            $('#fec_inicio').prop("disabled", false);
            $('#fec_fin').prop("disabled", true);
            $('#hrs_inicio').prop("disabled", false);
            $('#hrs_fin').prop("disabled", false);
            $('#turno').prop("disabled", false);
            $('#cargo').prop("disabled", false);
            $('#obs').prop("disabled", false);
           //console.log('apagado descando');
           
        });

        $('#descanso').on('change', function(e){
            //VACACION
            e.preventDefault();
            $('#descanso').prop("checked", true);
            $('#laboral').prop("checked", false);
            $('#fec_inicio').prop("disabled", false);
            $('#fec_fin').prop("disabled", false);
            $('#hrs_inicio').prop("disabled", true);
            $('#hrs_fin').prop("disabled", true);
            $('#turno').prop("disabled", true);
            $('#cargo').prop("disabled", true);
            $('#obs').prop("disabled", false);
           // console.log('apagado laboral');
        });
       
        $('#limpiar').click(function() {
    $('input[type="text"]').val('');
  });
    });
           


       
    });
</script>
@stop
