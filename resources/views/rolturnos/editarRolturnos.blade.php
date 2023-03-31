@extends("dashboard/dashboard") <!--extends se situa en views-->
@section('contenido')    
    <?php 
        $serverName ="DESKTOP-S9D1IAK"; //"193.168.0.4";// "DESKTOP-S9D1IAK"; //propiedades del servidor->ver propiedades de conexioon->producto-> nombre del servidor
        $connectionInfo = array( "Database"=>"BD_BIOMETRICO", "UID"=>"sa", "PWD"=>"S1af2023");//prueba
        $conn = sqlsrv_connect( $serverName, $connectionInfo) or die(print_r(sqlsrv_errors(), true));
                                    
        $sql="select * FROM USERINFO;"; //personas
        $result=sqlsrv_query($conn,$sql);    
    ?>
    
    {!! Form::open(array('id'=>'form_reg_rolturno','autocomplete'=>'off', 'class'=>'border border-5 form-control-sm')) !!}
    @csrf
     <table class="table table-sm" >
         <tr>
             <th> 
                 <div class="row" >
                     <div class="col-md-3">
                         <table class="table table-sm border border-success"> <!--REGISTRAR ROL TURNO-->
                             <center class="font-weight-bold">Registrar Rol Turno</center>
                             <tr>
                                 <div class="form-group" style="margin-top: -5px;">
                                     {!! Form::label('servicioPer', 'Servicio de la persona', ['class' => 'font-weight-bold text-sm-left' ]) !!}
                                     <select class="form-control-sm custom-select text-uppercase select2" name="servicio" id='servicio' required="true">
                                         <option value="" selected disabled>Seleccione un servicio</option> 
                                         @foreach($servicios as $item)
                                             @if($item->estado == 'Habilitado')
                                                 <option value="{{$item->id}}" > {{$item->nombre}} </option>  
                                             @endif                       
                                         @endforeach
                                     </select>
                                 </div>
 
                                 <div class="form-group " style="margin-top: -10px;">
                                     <label for="personall" class="font-weight-bold">Personal</label>
                                     <select class="form-control-sm custom-select text-uppercase select2" name="personal" id="per" >
                                         <option value="Elegir personal" disabled selected>Elegir una persona</option>
                                         @foreach($personas as $persona)
                                             @if($persona->estado_per == 'Habilitado')
                                                 <option value="{{$persona->id}}" > {{$persona->nombres}} </option>  
                                             @endif 
                                         @endforeach
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
                                         <select name="turno" id="turno" class="form-control-sm custom-select mr-sm-2" >
                                             <option value="" disabled selected>Elegir turno</option>
                                             <option value="Mañana">Mañana</option>
                                             <option value="Tarde">Tarde</option>
                                             <option value="Dia">Dia</option>
                                             <option value="Noche">Noche</option>
                                             <option value="12 Hrs.">12 Hrs.</option>
                                             <option value="24 Hrs.">24 Hrs.</option>
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
 
                                 <div class="row justify-content-center align-content-center" style="margin-top: -10px;">
                                     <button id="adicionar" class="btn btn-success btn-sm" type="button"> Agregar</button>
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
                                     <th width="4%">Nro.</th>
                                     <th style="" width="">Persona</th>
                                     <th style="" width="">Servicio</th>
                                     <th style="" width="">Area</th>
                                     <th style="" width="">tipo dia</th>
                                     <th style="" width="">Fecha ini</th>
                                     <th style="" width="">Fecha fin</th>
                                     <th style="" width="">Hora ini</th>
                                     <th style="" width="">Hora fin</th>
                                     <th style="" width="">turno</th>
                                     <th style="" width="">Observacion</th>
                                     <th style="" width="">Accion</th>
                                 </tr>
                                 <tr class="vacio">
                                     <td colspan="8" >No hay datos registrados</td>
                                 </tr> 
                                 <tbody> <?php  $i=0; ?>
                                    @foreach ($per_rolturnos as $rolturno)
                                    
                                            <tr>
                                                <td>{{++$i}}</td>
                                                <td><span id="" >{{$rolturno->rolturno_per->nombres}}</span></td>
                                                <td><span id="" >{{$rolturno->per_rolturno->servicios->nombre}}</span></td>
                                                @php
                                                    $area=\App\Models\areaservicio\AreaServicio::where('id',$rolturno->area_id)->first();
                                                @endphp
                                                <td><span id="" >{{$area->nombre}}</span></td>
                        
                                                <td><span id="" >{{$rolturno->tipo_dia}}</span></td>
                                                <td><span id="" >{{$rolturno->fecha_inicio}}</span></td>
                                                <td><span id="" >{{$rolturno->fecha_fin}}</span></td>
                                                <td><span id="" >{{$rolturno->hora_inicio}}</span></td>
                                                <td><span id="" >{{$rolturno->hora_fin}}</span></td>
                                                <td><span id="" >{{$rolturno->turno}}</span></td>
                                                <td><span id="" >{{$rolturno->obs}}</span></td>
                                                <td>
                                                    <button class="btn btn-success btn-sm" id=""><i class="bi bi-pencil-square" style="font-size: 14px;"></i> </button>
                                                    <button class="btn btn-danger btn-sm" id=""><i class="bi bi-trash" style="font-size: 14px;"></i> </button>
                                                </td>
                                            </tr>
                                    @endforeach
                                </tbody>
                         </table> 
                     </div>
                 </div>
             </th>
         </tr>
     </table>
     <div class="col col-md-12" style="margin-top: -12px;">
         <center>
             <button type="button" id="boton1" class="btn btn-success btn-sm ml-4"> Guardar Temporal</button>  
             <button type="button" id="" class="btn btn-info btn-sm ml-3"> Guardar todo </button>
             {{--<button class="btn btn-danger ml-3"><i class="fa fa-times" id="limpiar_todo"></i> CANCELAR TODO</button>--}}
         </center>
 
     {!!Form::Close()!!}
   
@stop

@section('titulo')
 - Esditar Rolturno
@stop

@section('styles')

<link rel="stylesheet" type="text/css" href="{{ asset('bootstrap4/css/select2/select2.css') }}">
<style>
    #este {
  height: 49em;
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
<script type="text/javascript" src="{{ asset('bootstrap4/js/select2/select2.js') }}"></script>
<script type="text/javascript">
    $('.select2').select2({
        placeholder: "Seleccione una opcion",
        allowClear: true
    });
</script>
<script type="text/javascript" src="{{ asset('scripts/turno.js') }}"></script>
<script type="text/javascript">
    //PROCESO PARA SABER K AREA PERTENECE A K SERVICIO
      $(document).ready(function(){
        $('#servicio').change(function() {
            const area_per = $('#area');
            $.ajax({
                url: "{{ route('areas.servicio') }}",
                data: { servicio_id: $(this).val() },
                success: function(data){
                    area_per.html('<option value="" selected disabled > Selecione una opcion </option>');
                    $.each(data, function(id, value) {
                        //if(data.estado == 'Habilitado'){
                            area_per.append('<option value="' + id + '">' + value + '</option>');
                       // }
                    });
                }
            });
    
        });
      });
      
     //PROCESOS PARA GUARDAR MULTIPLES DATOS
        $("#boton1").click(function(e){            
            var cant=0;
            $("input[name^='m']").each(function(){
                cant++;
            });
            if (cant == 0) {
                //alert('Formulario vacio, agregue datos al formulario')
                toastr.error("Agregue datos mediante el formulario", "NO EXISTE ROLES DE TURNOS DEL PERSONAL!!!", {
                    "positionClass": "toast-bottom-right"
                });
                //$('#adicionar').focus();
                return false;
            }

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
           // alert(resp);
                if(resp=='error')
                {
                    alert(resp);
                }
                else
                {
                    toastr.success("REGISTRO EXITOS...");	
                    setTimeout(function(){	
                        window.location="{{ route('listar.registrar.rolturno') }}";
                    },5000);
                }
            });
            document.getElementById("obs").value = "";
            document.getElementById("area").value = "";
        });
    </script>

@stop
