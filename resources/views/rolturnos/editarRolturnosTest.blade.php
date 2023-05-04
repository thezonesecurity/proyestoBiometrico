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
                         <table class="table table-sm border border-success"> <!--REGISTRAR LISTA ROL TURNO-->
                             <center class="font-weight-bold">Seguir Registrando Rol Turnos</center>
                             <tr>
                                 <div class="form-group">
                                     {!! Form::label('servicioPer', 'Servicio de la persona', ['class' => 'font-weight-bold text-sm-left' ]) !!}
                                     <input type="text" class="form-control" name="servicioM" id='servicioM' readonly>
                                     <input type="hidden" class="form-control" name="s" id='servicio' readonly>
                                   {{--  <select class="form-control-sm custom-select text-uppercase select2" name="servicio" id='servicio'>
                                         <option value="" selected disabled>Seleccione un servicio</option> 
                                         @foreach($servicios as $item)
                                             @if($item->estado == 'Habilitado')
                                                 <option value="{{$item->id}}" > {{$item->nombre}} </option>  
                                             @endif                       
                                         @endforeach
                                     </select>
                                     --}}
                                     
                                 </div>
                                 
                                 <div class="form-group" style="margin-top: -10px;">
                                    {!! Form::label('gestionper', 'Gestion', ['class' => 'font-weight-bold' ]) !!}
                                    <input type="month" name="gestionM" id="gestionM" class="form-control " readonly>
                                    
                                </div>

                                 <div class="form-group " style="margin-top: -10px;">
                                     <label for="personall" class="font-weight-bold">Personal</label>
                                     <select class="form-control-sm custom-select text-uppercase select2" name="personal" id="per" >
                                       {{-- <option value="Elegir personal" disabled selected>Elegir una persona</option>
                                         @foreach($personas as $persona)
                                             @if($persona->estado_per == 'Habilitado')
                                                 <option value="{{$persona->id}}" > {{$persona->nombres}} </option>  
                                             @endif 
                                         @endforeach---}} 
                                     </select>
                                 </div>

                                 <div class="form-group" style="margin-top: -10px;">
                                     {!! Form::label('areaPer', 'Area de la persona', ['class' => 'font-weight-bold' ]) !!}
                                     <select class="form-control-sm custom-select text-uppercase select2" name="area" id='area' >
                                     </select>
                                 </div>
 
                                 <div class="form-group row " id="product1" style="margin-top: -10px;"> 
                                     <div class="form-check ml-3 col-auto">
                                         <input class="form-check-input" type="radio" name="tipod" id="laboral" value="DL" checked>
                                         <label class="form-check-label font-weight-bold" for="gridCheck">Dia laboral</label>
                                     </div>
                                     <div class="form-check ml-3 col-auto"> 
                                         <input class="form-check-input" type="radio" name="tipod" id="descanso" value="V">
                                         <label class="form-check-label font-weight-bold" for="gridCheck">Vacacion</label>
                                     </div>
                                 </div>
                                 
                                 <div class="form-row font-weight-bold " style="margin-top: -10px;">
                                     <div class="form-group col">
                                         <label for="turnoo">Turno</label>
                                         <select name="turno" id="turno" class="form-control-sm custom-select mr-sm-2" >
                                             <option value="" disabled selected>Selecione una opcion</option>
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
                                         <label for="fecha de inicio">Fecha Igreso</label>
                                         <input type="date" class="form-control" name="fecha_inicio" id="fec_inicio" >
                                     </div>
                                     <div class="form-group col-md-6">
                                         <label for="fecha de fin">Fecha Retorno</label>
                                         <input type="date" class="form-control "  name="fecha_fin" id="fec_fin" disabled>
                                     </div>
                                 </div>
                                 <div class="form-row font-weight-bold" style="margin-top: -10px;">
                                     <div class="form-group col-md-6">
                                         <label for="hora de inicio">Hora Entrada</label>
                                         <input type="time" class="form-control " name="hora_inicio" id="hrs_inicio">
                                     </div>
                                     <div class="form-group col-md-6">
                                         <label for="hora de fin">Hora Salida</label>
                                         <input type="time" class="form-control" name="hora_fin" id="hrs_fin" >
                                     </div>
                                 </div>
 
                                 <div class="form-group font-weight-bold" style="margin-top: -10px;">
                                    <div class="row">
                                        <div class="row-md-3"><label class="col">Observaciones</p> </div>
                                        <div class="row-md-5 ml-5">
                                                <label class="col" >Cambio turno</label>
                                                <input class="form-check-input" type="checkbox" name="cambioT" id="cambio" style="margin-left: -10px;">
                                        </div>
                                    </div>
                                    <div class="row-md-auto" style="margin-top: -15px;">
                                        <div class="col" >
                                            <textarea name="comentario" class="form-control " placeholder="Este campo es opcional" id="obs" ></textarea>
                                        </div>
                                    </div>
                                 </div>
 
                                 <div class="row justify-content-center align-content-center" style="margin-top: -1px;">
                                     <button id="adicionar" class="btn btn-success btn-sm adicionarForm" type="button"> Agregar</button>
                                     <button id="limpiar" class="btn btn-danger btn-sm ml-4 limpiarForm" type="button" > Cancelar</button>                                  
                                 </div>
                             </tr>
                         </table>
                     </div>
                     <!---->
                     <div class="col-md-9" id="este"> {{--LISTAR ROLTURNOS--}}
                         <center class="font-weight-bold"> <h5>Lista de registro de Roles de Turno</h5></center>
                         <table id="mytable" class="table table-sm table-striped border" style="font-size: 12px;  table-layout: fixed;" width="">
                                 <tr class="titulo" > {{--style="background-color: red;display: none;"--}}
                                     <th width="30px">Nro.</th>

                                     <th style="" width="130px">Persona</th>
                                    <th style="" width="90px">Servicio</th>
                                    <th style="" width="90">Area</th>
                                    <th style="" width="70">Mes</th>
                                    <th style="" width="54px">tipo dia</th>
                                    <th style="" width="88px">Fecha ingreso</th>
                                    <th style="" width="88px">Fecha retorno</th>
                                    <th style="" width="80px">Entrada</th>
                                    <th style="" width="80px">Salida</th>
                                    <th style="" width="70">Turno</th>
                                    <th style="font-size: 10px;" width="75">Cambio turno</th>
                                    <th style="" width="140px">Observacion</th>
                                    <th style="" width="80px">Accion</th>
                                 </tr>
                                 {{--@include('dashboard.mensaje')--}}
                                 

                                 @if(session("mensaje") && session("tipo"))
                                    {{session("mensaje")}}
                                @endif
                                {{-- @if(session('success'))
                                 <script>
                                    $(document).ready(function() {
                            
                                    toastr.{{ Session::get('flash_notification.level') }}
                                    ('{{ Session::get('flash_notification.message') }}');
                            
                                    });
                                </script>
                             @endif
                                  {{--<a href="javascript: toastr.success('{{session('success')}}') ;"> Púlseme </a>--}}
                                
                                
                                




                                 <tbody id="mostrarLista" style="display: none"> <?php  $i=0; //F6F1E9 E4DCCF F0EEED?>
                                    
                                    @foreach ($per_rolturnos as $rolturno)
                                        @if($rolturno->estado == 'Habilitado')             
                                            <tr class="bg-infos eliminar" style="background-color: #F6F1E9">
                                                <td>{{++$i}}</td>
                                                <td><span id="persona{{$rolturno->id}}" >{{$rolturno->rolturno_per->nombres}}</span></td>
                                                <td id="servi"><span id="servicio{{$rolturno->id}}" >{{$rolturno->per_rolturno->servicios->nombre}}</span></td>
                                                @php $area=\App\Models\areas\Area::where('id',$rolturno->area_id)->first(); @endphp
                                              
                                                <td><span id="area{{$rolturno->id}}" >{{$rolturno->area->nombre}}</span></td>
                                                <td id="gesti"><span id="gestion{{$rolturno->id}}" >{{$rolturno->per_rolturno->gestion}}</span></td>
                                                <td><span id="tdia{{$rolturno->id}}" >{{$rolturno->tipo_dia}}</span></td>
                                                <td><span id="f_ini{{$rolturno->id}}" >{{$rolturno->fecha_inicio}}</span></td>
                                                <td><span id="f_fin{{$rolturno->id}}" >{{$rolturno->fecha_fin}}</span></td>
                                                <td><span id="h_ini{{$rolturno->id}}" >{{$rolturno->hora_inicio}}</span></td>
                                                <td><span id="h_fin{{$rolturno->id}}" >{{$rolturno->hora_fin}}</span></td>
                                                <td><span id="turno{{$rolturno->id}}" >{{$rolturno->tipoTurno->nombre}}</span></td>
                                                <td><span id="cambio_turno{{$rolturno->id}}" >{{$rolturno->cambio_turno}}</span></td>
                                                {{--<td><span id="estado{{$rolturno->id}}" >{{$rolturno->estado}}</span></td>--}}
                                                <td><span id="obs{{$rolturno->id}}" >{{$rolturno->obs}}</span></td>
                                                <td>
                                                    <button type="button" class="btn btn-success btn-sm editbtn" value="{{$rolturno->id}}" data-toggle="modal" data-target="#editModal"><i class="bi bi-pencil-square" style="font-size: 14px;"></i></button>
                                                    {{--<a data-toggle="modal" href="#eliminarModal{{$rolturno->id}}" class=" btn btn-danger btn-sm"  type="buton"><i class="bi bi-trash" style="font-size: 14px;"></i></a>--}}
                                                    <button type="button" class="btn btn-danger btn-sm deletebtn" value="{{$rolturno->id}}" data-toggle="modal" data-target="#eliminarModal"><i class="bi bi-trash" style="font-size: 14px;"></i></button>
                                                    {{---<a type="button" class="btn btn-danger btn-sm debaja" href="{{route('rolturno.eliminado', $rolturno->id)}}"><i class="bi bi-trash" style="font-size: 14px;"></i> </a>--}}
                                                </td>
                                            </tr>
                                        @endif
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
             <button type="button" id="boton1" class="btn btn-success btn-sm ml-4"> Guardar </button>  
             <button type="button" id="mostrar1" class="btn btn-info btn-sm ml-3" >Mostrar Lista</button>
             <button type="button" id="mostrar2" class="btn btn-warning btn-sm ml-3" style="display: none;">Ocultar Lista</button>
         </center>
 
     {!!Form::Close()!!}
     @include('rolturnos.ModalEditarRolturno')
     @include('rolturnos.ModalEliminarRolturno')
@stop

@section('titulo')
 - Esditar Rolturno
@stop

@section('styles')

{{--<link rel="stylesheet" type="text/css" href="{{ asset('bootstrap4/css/select2/select2.css') }}">--}}
<style>
    #este {
  height: 45em;
  line-height: 2em;
  overflow-x: scroll;
  overflow-y: scroll;
  width: 100%;
  border: 1px solid;
  border-color: rgba(0, 191, 255, 0.695);
}
</style>
@stop

@section('scripts')
{{--<script type="text/javascript" src="{{ asset('bootstrap4/js/select2/select2.js') }}"></script>--}}
<script type="text/javascript">
//"form-control-sm custom-select text-uppercase select2"
    $('.select2').select2({
        placeholder: "Seleccione una opcion",
        allowClear: true
    });
</script>
<script type="text/javascript" src="{{ asset('scripts/turnoTest.js') }}"></script>
<script type="text/javascript" src="{{ asset('scripts/editarturno.js') }}"></script>
<script type="text/javascript">

    $(document).ready(function(){
       // var  da= document.getElementById("mensaje").value; //$('#mesaje').text()
    ///  console.log('-> '+ da);
       function myfuncion(msm){
        alert(msm);
            //notificaciones(msm, 'Rolturnos', 'success');
        };
        /*PROCESO PARA K DESAPARESCA EL ALERT DE SESSION
        window.setTimeout(function() {
            $(".alert").fadeTo(500, 0).slideUp(400, function(){
                $(this).remove(); 
            });
        }, 5000);*/
        
        //´PROCESO PARA MOSTRAR Y OCULTAR LA LISTA DE ROL TURNOS
        $('#mostrarLista').show();
        $('#mostrar1').click(function() {
            $('#mostrar1').hide();
            $('#mostrar2').show();
            $('#mostrarLista').show();
        });
        $('#mostrar2').click(function() {
            $('#mostrar2').hide();
            $('#mostrar1').show();
            $('#mostrarLista').hide();
        });
         //PROCESO PARA SABER K PERSONAS PERTENECE A K SERVICIO
         const personas = $('#per');
        $.ajax({
            url: "{{ route('servicio.personas') }}",
            data: { servicio: $('#servi').text()}, //$(this).val() 
            success: function(data){
                personas.html('<option value="" selected disabled >Selecione una opcion</option>');
                $.each(data, function(id, value) {
                    personas.append('<option value="' + id + '">' + value + '</option>');
                });
            }
        });
        //PROCESO PARA SABER K AREA PERTENECE A K SERVICIO
        $('#servicioM').val($('#servi').text());
        $('#gestionM').val($('#gesti').text());
        const area_per = $('#area');
        $.ajax({
                url: "{{ route('areas.servicio.test') }}",
                data: { servicio_id: $('#servi').text()}, //$(this).val() 
                success: function(data){
                   //alert(data);
                    area_per.html('<option value="" selected disabled >Selecione una opcion</option>');
                    $.each(data, function(id, value) {
                        // echo(value);
                        area_per.append('<option value="' + id + '">' + value + '</option>');
                    });
                }
         });
         //PROCESOS PARA GUARDAR MULTIPLES DATOS
         $("#boton1").click(function(e){            
            var cant=0;
            $("input[name^='m']").each(function(){
                cant++;
            });
            if (cant == 0) {
                //alert('Formulario vacio, agregue datos al formulario')
                notificaciones("Agregue datos mediante el formulario", "NO EXISTE ROLES DE TURNOS DEL PERSONAL", 'error')
                /*toastr.error("Agregue datos mediante el formulario", "NO EXISTE ROLES DE TURNOS DEL PERSONAL", {
                    "positionClass": "toast-bottom-right"
                });*/
                //$('#adicionar').focus();
                return false;
            }

            e.preventDefault();
            //$('#boton1').attr('disabled', true).text('Registrando...');
            var f= $(this);
            //console.log('cantidad '+f);
            var formData = new FormData(document.getElementById("form_reg_rolturno")); //form_reg_rolturno
            
            $.ajax({
                url:"{{route('guardar.rolturno.test')}}",
                type:'POST',
                dataType: "html",
                cache: false,
                contentType: false,
                processData: false,
                data: formData
    
            }).done(function(resp){
             //alert(resp);
                if(resp=='ok'){ //resp=='error'
                    notificaciones('El registro fue ejecutado exitosamente', 'Rolturnos', 'success');
                    setTimeout(function(){	
                        window.location="{{ route('listar.roles.turno') }}";
                    },4000);
                    /*toastr.success("REGISTRO EXITOSO DE ROL DE TURNO");	
                    setTimeout(function(){	
                        window.location="{{ route('listar.roles.turno') }}";
                    },4000);*/
                }
                else {
                    //alert(resp);
                    notificaciones('Error no se pudo realizar el registro de rol turnos', 'Contacte con soporte', 'error');
                   /* toastr.error("ERROR NO SE PUDO REALIZAR EL REGISTRO");	
                    setTimeout(function(){	
                        window.location="{{ route('listar.roles.turno') }}";
                    },4000);*/
                }
            });
            document.getElementById("obs").value = "";
            document.getElementById("area").value = "";
        });
        //PROCESO PARA ELIMINAR UN REGISTRO DE ROL DE TURNO
       
    });

   /* 
     $(document).ready(function(){
        
        //´PROCESO PARA MOSTRAR Y OCULTAR LA LISTA DE ROL TURNOS
        $('#mostrarLista').show();
        $('#mostrar1').click(function() {
            $('#mostrar1').hide();
            $('#mostrar2').show();
            $('#mostrarLista').show();
        });
        $('#mostrar2').click(function() {
            $('#mostrar2').hide();
            $('#mostrar1').show();
            $('#mostrarLista').hide();
        });
    });
    //PROCESO PARA SABER K PERSONAS PERTENECE A K SERVICIO
    $(document).ready(function(){
       // console.log("entro");
       const personas = $('#per');
       $.ajax({
                url: "{{ route('servicio.personas') }}",
                data: { servicio: $('#servi').text()}, //$(this).val() 
                success: function(data){
                    personas.html('<option value="" selected disabled > Selecione una opcion </option>');
                    $.each(data, function(id, value) {
                       personas.append('<option value="' + id + '">' + value + '</option>');
                    });
                }
            });
      });

    //PROCESO PARA SABER K AREA PERTENECE A K SERVICIO
      $(document).ready(function(){
       $('#servicioM').val($('#servi').text());
       $('#gestionM').val($('#gesti').text());
       const area_per = $('#area');
       $.ajax({
                url: "{{ route('areas.servicio.test') }}",
                data: { servicio_id: $('#servi').text()}, //$(this).val() 
                success: function(data){
                   //alert(data);
                    area_per.html('<option value="" selected disabled > Selecione una opcion </option>');
                    $.each(data, function(id, value) {
                        // echo(value);
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
                url:"{{route('guardar.rolturno.test')}}",
                type:'POST',
                dataType: "html",
                cache: false,
                contentType: false,
                processData: false,
                data: formData
    
            }).done(function(resp){
            // alert(resp);
                if(resp=='ok'){ //resp=='error'
                    toastr.success("REGISTRO EXITOSO DE ROL DE TURNO");	
                    setTimeout(function(){	
                        window.location="{{ route('listar.roles.turno') }}";
                    },4000);
                }
                else {
                    //alert(resp);
                    toastr.error("ERROR NO SE PUDO REALIZAR EL REGISTRO");	
                        setTimeout(function(){	
                        window.location="{{ route('listar.roles.turno') }}";
                    },4000);
                }
            });
            document.getElementById("obs").value = "";
            document.getElementById("area").value = "";
        });
*/
    </script>

@stop


 {{--- <tr class="bg-info">
                                                <td>{{++$i}}</td>
                                                <td><span id="" >{{$rolturno->rolturno_per->nombres}}</span></td>
                                                <td><span id="" >{{$rolturno->per_rolturno->servicios->nombre}}</span></td>
                                                @php
                                                    $area=\App\Models\areas\Area::where('id',$rolturno->area_id)->first();
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
                                                    <a class="btn btn-success btn-sm" id=""><i class="bi bi-pencil-square" style="font-size: 14px;"></i> </a>
                                                    <a class="btn btn-danger btn-sm" id="" href="{{route('rolturno.eliminado', $rolturno->id)}}"><i class="bi bi-trash" style="font-size: 14px;"></i> </a>
                                                </td>
                                            </tr>
                                            @include('rolturnos.ModalEditarRolturno')--}} 