@extends("dashboard/dashboard") <!--extends se situa en views-->
@section('contenido')    
   
    {!! Form::open(array('id'=>'form_reg_rolturno','autocomplete'=>'off', 'class'=>'border border-5 form-control-sm')) !!}
   @csrf
    <table class="table table-sm" >
        <tr>
            <th> 
                <div class="row" >
                    <div class="col-md-3">
                        <table class="table table-sm border border-success"> <!--REGISTRAR ROL TURNO-->
                            <center class="font-weight-bold">Nuevo Registro de Rol Turnos</center>
                            <tr>
                                <div class="form-group" style="margin-top: -5px;">
                                    {!! Form::label('servicioPer', 'Servicio de la persona', ['class' => 'font-weight-bold text-sm-left' ]) !!}
                                    <select class="form-control-sm custom-select text-uppercase select2 ser" name="servicio" id='servicio' required="true">
                                        <option value="" selected disabled>Seleccione un servicio</option> 
                                        @foreach($servicios as $id => $item)
                                            <option value="{{$id}}" > {{$item}} </option>                      
                                        @endforeach
                                        {{--@foreach($servicios as $item)
                                            @if($item->estado == 'Habilitado')
                                                <option value="{{$item->id}}" > {{$item->nombre}} </option>  
                                            @endif                       
                                        @endforeach--}}
                                    </select>
                                </div>
                                <div class="form-group" style="margin-top: -10px;">
                                    {!! Form::label('gestionper', 'Gestion', ['class' => 'font-weight-bold' ]) !!}
                                    <input type="month" name="gestion" id="gestion" class="form-control ">
                                </div>
                                <div class="form-group " style="margin-top: -10px;">
                                    <label for="personall" class="font-weight-bold">Personal</label>
                                    <select class="form-control-sm custom-select text-uppercase select2" name="personal" id="per" >
                                        <option value="Elegir personal" disabled selected>Elegir una persona</option>
                                        @foreach($personas as $id => $persona)   
                                                <option value="{{$id}}" > {{$persona}} </option>  
                                        @endforeach
                                        {{--@foreach($personas as $persona)
                                            @if($persona->estado_per == 'Habilitado')
                                                <option value="{{$persona->id}}" > {{$persona->nombres}} </option>  
                                            @endif 
                                        @endforeach--}}
                                    </select>
                                </div>
                                
                                <div class="form-group" style="margin-top: -10px;">
                                    {!! Form::label('areaPer', 'Area de la persona', ['class' => 'font-weight-bold' ]) !!}
                                    <select class="form-control-sm custom-select text-uppercase select2" name="area" id='area' >
                                        
                                    </select>
                                </div>

                                <div class="form-group row " id="product1" style="margin-top: -10px;"> 
                                    <div class="form-check ml-4 col-auto">
                                        <input class="form-check-input" type="radio" name="tipod" id="laboral" value="DL" checked>
                                        <label class="form-check-label font-weight-bold" for="gridCheck">Dia laboral</label>
                                    </div>
                                    <div class="form-check ml-4 col-auto"> 
                                        <input class="form-check-input" type="radio" name="tipod" id="descanso" value="V">
                                        <label class="form-check-label font-weight-bold" for="gridCheck">Vacacion</label>
                                    </div>
                                </div>
                                
                                <div class="form-row font-weight-bold " style="margin-top: -10px;">
                                    <div class="form-group col">
                                        <label for="turnoo">Turno</label>
                                        <select name="turno" id="turno" class="form-control-sm custom-select mr-sm-2">
                                            <option value="" disabled selected>Elegir tipo de turno</option>
                                            @foreach($turnos as $id => $turno)   
                                                <option value="{{$id}}" > {{$turno}} </option>  
                                             @endforeach
                                            {{--<option value="Mañana">Mañana</option>
                                            <option value="Tarde">Tarde</option>
                                            <option value="12 Hrs.">12 Hrs.</option>
                                            <option value="24 Hrs.">24 Hrs.</option>--}}
                                        </select>
                                    </div>
                                </div>
                                
                                <div class="form-row font-weight-bold" style="margin-top: -10px;">
                                    <div class="form-group col-md-6">
                                        <label for="fecha de inicio">Fecha Inicio</label>
                                        <input type="date" class="form-control" name="fecha_inicio" id="fec_inicio" >
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="fecha de fin">Fecha Fin</label>
                                        <input type="date" class="form-control "  name="fecha_fin" id="fec_fin" disabled>
                                    </div>
                                </div>
                                <div class="form-row font-weight-bold" style="margin-top: -10px;">
                                    <div class="form-group col-md-6">
                                        <label for="hora de inicio">Hora Inicio</label>
                                        <input type="time" class="form-control " name="hora_inicio" id="hrs_inicio">
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="hora de fin">Hora Fin</label>
                                        <input type="time" class="form-control " name="hora_fin" id="hrs_fin" >
                                    </div>
                                </div>

                                <div class="form-group row font-weight-bold" style="margin-top: -10px;">
                                    <label class="col">Observaciones</p>
                                    <textarea name="comentario" class="form-control-sm col" placeholder="Este campo es opcional" id="obs"></textarea>
                                </div>

                                <div class="row justify-content-center align-content-center" style="margin-top: -20px;">
                                    <button id="adicionar" class="btn btn-success btn-sm add" type="button"> Agregar</button>
                                    <button id="limpiar" class="btn btn-danger btn-sm ml-4" type="button" > Cancelar</button>                                  
                                </div>
                            </tr>
                        </table>
                    </div>
                    <!---->
                    <div class="col-md-9" id="este"> {{--listar tabla--}}
                        <center class="font-weight-bold mt-2">Lista Temporal de Roles de Turno</center> <br>
                        <table id="mytable" class="table table-sm table-striped border" style="font-size: 12px;  table-layout: fixed;" width="">
                                <tr class="titulo" > {{--style="background-color: red;display: none;"--}}
                                    <th width="30px">Nro.</th>
                                    <th style="" width="130px">Persona</th>
                                    <th style="" width="90px">Servicio</th>
                                    <th style="" width="90">Area</th>
                                    <th style="" width="70">Mes</th>
                                    <th style="" width="56px">Tipo dia</th>
                                    <th style="" width="88px">Fecha ingreso</th>
                                    <th style="" width="88px">Fecha retorno</th>
                                    <th style="" width="80px">Entrada</th>
                                    <th style="" width="80px">Salida</th>
                                    <th style="" width="75">Turno</th>
                                    <th style="" width="140px">Observacion</th>
                                    <th style="" width="80px">Accion</th>
                                </tr>
                                <tr class="vacio">
                                    <td colspan="8" >No hay datos registrados</td>
                                </tr> 
                        </table> 
                    </div>
                </div>
            </th>
        </tr>
    </table>
    <div class="col col-md-12" style="margin-top: -12px;">
        <center>
            <button type="button" id="boton1" class="btn btn-success btn-sm ml-4"> Guardar</button>
        </center>
    </div>
    {!!Form::Close()!!}
   
@stop

@section('titulo')
 - Rolturno
@stop

@section('styles')

<link rel="stylesheet" type="text/css" href="{{ asset('bootstrap4/css/select2/select2.css') }}">
<style>
    #este {
  height: 45em;
  line-height: 1em;
  overflow-x: scroll;
  overflow-y: scroll;
  width: 100%;
  border: 1px solid;
  border-color: rgba(0, 191, 255, 0.695);
}
</style>
@stop

@section('scripts')

<script type="text/javascript" src="{{ asset('scripts/turno.js') }}"></script>
<script type="text/javascript" src="{{ asset('bootstrap4/js/select2/select2.js') }}"></script>
<script type="text/javascript">
    $('.select2').select2({
        placeholder: "Seleccione una opcion",
        allowClear: true
    });
</script>

<script type="text/javascript">
  $(document).ready(function(){
    //PROCESO PARA SABER SI YA ESTA REGISTRADO EL SERVICIO Y LA GESTION DE ROL TURNO
    $(document).on('click', '.add', function(e) { 
        e.preventDefault();
       // const datos = [document.getElementById("servicio").value, document.getElementById("gestion").value]; //form_reg_rolturno
        //console.log(' area -> '+ $('#area :selected').text() +' su id -> '+  document.getElementById("area").value);

        $.ajax({
            url: "{{ route('gestion.registrado') }}",
            data: { datos1: document.getElementById("servicio").value, datos2: document.getElementById("gestion").value, datos3: document.getElementById("area").value },
            success: function(data){
             //   alert(data)
                if(data == 'existe'){ //resp=='error'
                     //$('.titulo').hide();
                     //$('.vacio').show();
                     //$('.titulo').parents('tr').remove(); no sirve
                    toastr.error("ERROR YA SE TIENE REGISTRADO EL ROL TURNO PARA ESA GESTION",{"positionClass": "toast-bottom-right"});	
                    setTimeout(function(){	
                        window.location="{{ route('listar.registrar.rolturno') }}";
                    },4000);
                   
                   return false;
                }
            }
        });
    });

    //PROCESO PARA SABER K AREA PERTENECE A K SERVICIO
    $('#servicio').change(function() {
        const area_per = $('#area');
        //var servi =  $('#servicio').val();
      // console.log('aaa '+ servi);
        $.ajax({
            url: "{{ route('areas.servicio') }}",
            data: { servicio_id: $(this).val() },
            success: function(data){
               // alert(data)
                area_per.html('<option value="" selected disabled > Selecione una opcion </option>');
                $.each(data, function(id, value, estado) {
                    area_per.append('<option value="' + id + '">' + value + '</option>');
                });
            }
        });
    });
    
     //PROCESOS PARA GUARDAR MULTIPLES DATOS
    $("#boton1").click(function(e){
        var cant=0;
        $("input[name^='m']").each(function(){
            cant++;
        });
        if (cant == 0) {
            toastr.error("Agregue datos mediante el formulario", "NO EXISTE ROLES DE TURNOS DEL PERSONAL!!!", {
                "positionClass": "toast-bottom-right"
            });
            //$('#adicionar').focus();
            return false;
        }
        //console.log('cantidad '+cont);
        //*
        e.preventDefault();
        //$('#boton1').attr('disabled', true).text('Registrando...');
        var f= $(this);
        //console.log('cantidad '+f);
        var formData = new FormData(document.getElementById("form_reg_rolturno")); //form_reg_rolturno
        
        $.ajax({
            url:"{{route('guardar.rolturno')}}",
            type:'POST',
            dataType: "html",
            cache: false,
            contentType: false,
            processData: false,
            data: formData
        }).done(function(resp){
        //alert(resp);
            if(resp=='ok'){ //resp=='error'
                toastr.success("REGISTRO EXITOSO DE ROL DE TURNO...");	
                setTimeout(function(){	
                    window.location="{{ route('listar.registrar.rolturno') }}";
                },4000);
             }
            else {
               //alert(resp);
               toastr.error("ERROR NO SE PUDO REALIZAR EL REGISTRO");	
                setTimeout(function(){	
                    window.location="{{ route('listar.registrar.rolturno') }}";
                },4000);
            }
        });
        document.getElementById("obs").value = "";
        document.getElementById("area").value = "";
    });

  });
</script>

@stop


{{--<thead>
                        <tr>
                            <th width="10px">Nro.</th>
                            <th style="text-align: center;" width="10px">Persona</th>
                            <th style="text-align: center;" width="10px">tipo dia</th>
                            <th style="text-align: center;" width="10px">Fecha ini</th>
                            <th style="text-align: center;" width="10px">Fecha fin</th>
                            <th style="text-align: center;" width="10px">Hora ini</th>
                            <th style="text-align: center;" width="10px">Hora fin</th>
                            <th style="text-align: center;" width="10px">turo</th>
                            <th style="text-align: center;" width="10px">Area</th>
                            <th style="text-align: center;" width="10px">Observacion</th>
                            <th style="text-align: center;" width="10px">Accion</th>
                        </tr>
                      </thead>
                      <tbody style=" border: 1px solid rgba(0, 0, 255, 0.239); width: 100px;  word-wrap: break-word;">
                        
                        <tr class="titulo" style="background-color: red;display: none;">
                            <th width="10px">Nro.</th>
                            <th style="text-align: center;">Persona</th>
                            <th style="text-align: center;">Fecha</th>
                            <th style="text-align: center;">Horaf</th>
                            <th style="text-align: center;">turo</th>
                            <th style="text-align: center;">area</th>
                            <th style="text-align: center;">Observacion</th>
                            <th style="text-align: center;">Accion</th>
                        </tr>--}} 
                        {{--
                      </tbody>--}}


    {{--jquery *
        //alert(formData)
       /*
        console.log('formdata');
        console.log(formData.get('personal'));
        console.log(formData.get('area'));
        console.log(formData.get('comentario'));
        console.log(formData.get('tipod'));
        console.log(formData.get('fecha_inicio'));
        console.log(formData.get('fecha_fin'));
        console.log(formData.get('hora_inicio'));
        console.log(formData.get('hora_fin'));
        console.log(formData.get('turno'));
        */
        //$array = explode(",", formData.get('personal'));//convertiendo string a arrar(personal[nombrecompleto,idper_db])
        //dd('nombre '.$array[0].' id es '.$array[1]);
        //console.log('nombre '+$array[0]+' id es '+$array[1]);
       
        //console.log(formData);
        --}}