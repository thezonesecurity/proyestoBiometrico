<?php
$serverName ="DESKTOP-S9D1IAK"; //"193.168.0.4";// "DESKTOP-S9D1IAK"; //propiedades del servidor->ver propiedades de conexioon->producto-> nombre del servidor
$connectionInfo = array( "Database"=>"BD_BIOMETRICO", "UID"=>"sa", "PWD"=>"S1af2023");//prueba
$conn = sqlsrv_connect( $serverName, $connectionInfo) or die(print_r(sqlsrv_errors(), true));
    
$sql="select * FROM USERINFO;";    
$i=0;
while($row=sqlsrv_fetch_array($res)) {
    $persona=App\Models\personal\Persona::where('idper_db',$row['USERID'])->first(); 
        if(isset($persona)) {   ?>       
             <tr>
                <th scope="row">{{++$i}}</th>
                <td>{{$row['NAME']}}</td>
                <td>{{$persona->pivot->fecha_inicio}} - {{$persona->pivot->fecha_fin}}</td>
                <td>{{$persona->pivot->hora_inicio}} - {{$persona->pivot->hora_fin}}</td>
                <td>{{$persona->rolturnos->turno}}</td>
                <td>{{$persona->cargo}}</td>
                <td>{{$persona->rolturnos->obs}}</td>
                <td>Editar ¬ Eliminar </td>
            </tr>
        <?php }       
} sqlsrv_close($conn); ?>

<table id="mytable" class="table table-striped table-hover" style="font-size: 12px;" width="100%">
    <tr class="titulo" style="background-color: red;display: none;">
          <th width="10px">#</th>
          <th style="text-align: center;">Medicamentos</th>
          <th style="text-align: center;">Accion</th>
    </tr>
</table>


<td>{{$persona->pivot->fecha_inicio}} - {{$persona->pivot->fecha_fin}}</td>
                            <td>{{$persona->pivot->hora_inicio}} - {{$persona->pivot->hora_fin}}</td>
                            <td>{{$persona->rolturnos->turno}}</td>
                            <td>{{$persona->cargo}}</td>
                            <td>{{$persona->rolturnos->obs}}</td>





                            <?php 
                            $serverName ="DESKTOP-S9D1IAK"; //"193.168.0.4";// "DESKTOP-S9D1IAK"; //propiedades del servidor->ver propiedades de conexioon->producto-> nombre del servidor
                            $connectionInfo = array( "Database"=>"BD_BIOMETRICO", "UID"=>"sa", "PWD"=>"S1af2023");//prueba
                            $conn = sqlsrv_connect( $serverName, $connectionInfo) or die(print_r(sqlsrv_errors(), true));
                                    
                            $sql="select * FROM USERINFO;"; //personas
                            $result=sqlsrv_query($conn,$sql);    
                            ?>



<td>{{$persona->pivot->fecha_inicio}} - {{$persona->pivot->fecha_fin}}</td>
                            <td>{{$persona->pivot->hora_inicio}} - {{$persona->pivot->hora_fin}}</td>
                            <td>{{$persona->rolturnos->turno}}</td>
                            <td>{{$persona->cargo}}</td>
                            <td>{{$persona->rolturnos->obs}}</td>


<script>
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
        if(!$('#laboral').checked  || !$('#descanso').checked){
            $('#fec_inicio').prop("disabled", true);
            $('#fec_fin').prop("disabled", true);
            $('#hrs_inicio').prop("disabled", true);
            $('#hrs_fin').prop("disabled", true);
            $('#turno').prop("disabled", true);
            $('#cargo').prop("disabled", true);
            $('#obs').prop("disabled", true);
           // console.log('apagado');
        }
       
    });
</script>



var fila = '<tr  id="row' + i + '"><td>' + i + '</td><td>'+per+'<input type="hidden"  name="m[]" class="form-control" value="'+per_id+'"></td><td><button type="button" name="remove" id="' + i + '" class="btn  btn-sm btn-danger btn_remove">Quitar</button></td></tr>';


<script>
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
            $('input[type="date"]').val('');
            $('input[type="time"]').val('');
            $('select').val('');
            $('textarea').val('');
        });  

       
    });

    //var fila = '<tr  id="row' + i + '"><td>' + i + '</td><td>'+per+'<input type="hidden"  name="m[]" class="form-control" value="'+per_id+'"></td><td><button type="button" name="remove" id="' + i + '" class="btn  btn-sm btn-danger btn_remove">Quitar</button></td></tr>';
    
    //var fila = '<tr  id="row' + i + '"><td>' + i + '</td><td>'+per+'<input type="hidden"  name="m[]" class="form-control" value="'+per_id+'"></td> <td>'+fec_ini+'<input type="hidden"  name="m[]" class="form-control" value="'+per_id+'"></td><td>'+fec_fin+'<input type="hidden"  name="m[]" class="form-control" value="'+per_id+'"></td><td>'+hrs_ini+'<input type="hidden"  name="m[]" class="form-control" value="'+per_id+'"></td><td>'+hrs_fin+'<input type="hidden"  name="m[]" class="form-control" value="'+per_id+'"></td><td>'+turno+'<input type="hidden"  name="m[]" class="form-control" value="'+per_id+'"></td><td>'+cargo+'<input type="hidden"  name="m[]" class="form-control" value="'+per_id+'"></td><td>'+obs+'<input type="hidden"  name="m[]" class="form-control" value="'+per_id+'"></td><td><button type="button" name="remove" id="' + i + '" class="btn  btn-sm btn-danger btn_remove">Quitar</button></td></tr>';
   

</script>


<tr class="titulo" style="background-color: red;display: none;">
    <th width="10px">Nro.</th>
    <th style="text-align: center;">Persona</th>
    <th style="text-align: center;">Fecha</th>
    <th style="text-align: center;">Hora</th>
    <th style="text-align: center;">turo</th>
    <th style="text-align: center;">Cargo</th>
    <th style="text-align: center;">Observacion</th>
    <th style="text-align: center;">Accion</th>
</tr>


<div class="form-group justify-content-center align-content-center">
    <center class="font-weight-bold">Registrar Rol Turno</center> <br>
    <label for="personall" class="font-weight-bold">Personal</label>
    <select id="per" class="form-control text-uppercase select2" style="width: 100%;" name="personal" required>
        <option value="Elegir personal" disabled selected>Elegir personal</option>
        <?php  while($row=sqlsrv_fetch_array($result) ) {
            $persona=App\Models\personal\Persona::where('idper_db',$row['USERID'])->first(); 
            if(isset($persona)) {  ?>       
            <option value="{{$row['NAME']}},{{$persona->idper_db}}">{{$row['NAME']}}</option>
        <?php }} sqlsrv_close($conn); ?>
    </select>
    <div class="form-group col">
        <label for="cargoo">Cargo</label>
        <input type="text" class="form-control" placeholder="Este campo es opcional" id="cargo" name="cargo" value="de" >
    </div>
</div>

Usando javascript: , puede ejecutar código que no cambia la página actual. Esto, usado con void(0)
 significa, no hacer nada - no recargar, no navegar, no ejecutar ningún código. La palabra "Link"
  es tratada como un enlace por el navegador {javascript:void(0) en vez de #}
<a href="javascript:void(0)">botton</a>






<div class="row" ><!--style="margin-left: 250px"-->
    
    <?php 
        $serverName ="DESKTOP-S9D1IAK"; //"193.168.0.4";// "DESKTOP-S9D1IAK"; //propiedades del servidor->ver propiedades de conexioon->producto-> nombre del servidor
        $connectionInfo = array( "Database"=>"BD_BIOMETRICO", "UID"=>"sa", "PWD"=>"S1af2023");//prueba
        $conn = sqlsrv_connect( $serverName, $connectionInfo) or die(print_r(sqlsrv_errors(), true));
                                    
        $sql="select * FROM USERINFO;"; //personas
        $result=sqlsrv_query($conn,$sql);    
    ?>
<div class="col-md-8" id="este"> {{--listar tabla--}}
    <div class="col">
        <center class="font-weight-bold mt-2">Lista Temporal de Roles de Turno</center> <br>
        <table id="mytable" class="table table-striped border border-success" style="font-size: 12px;  table-layout: fixed;" width="100%">
            <tr class="titulo" id="enviar" > {{--style="background-color: red;display: none;"--}}
                <th width="4%">Nro.</th>
                <th style="text-align: center;" width="6%">Persona</th>
                <th style="text-align: center;" width="5%">Area</th>
                <th style="text-align: center;" width="4%">tipo dia</th>
                <th style="text-align: center;" width="5%">Fecha ini</th>
                <th style="text-align: center;" width="5%">Fecha fin</th>
                <th style="text-align: center;" width="5%">Hora ini</th>
                <th style="text-align: center;" width="5%">Hora fin</th>
                <th style="text-align: center;" width="5%">turno</th>
                <th style="text-align: center;" width="6%">Observacion</th>
                <th style="text-align: center;" width="5%">Accion</th>
            </tr>
            <tr class="vacio">
                <td colspan="8" >No hay datos registrados</td>
            </tr>
           
        </table>  
    </div>
</div>

<div class="col-md-4"> 
<!--REGISTRAR ROL TURNO-->
{!! Form::open(array('id'=>'form_reg_rolturno','autocomplete'=>'off', 'class'=>'border border-5 border-success form-control')) !!}
    <div class="form-group justify-content-center align-content-center">
        <center class="font-weight-bold">Registrar Rol Turno</center>
        <label for="personall" class="font-weight-bold">Personal</label>
       
        <select id="per" class="form-control text-uppercase select2" style="width: 100%;" name="personal">
            <option value="Elegir personal" disabled selected>Elegir personal</option>
            <?php  while($row=sqlsrv_fetch_array($result) ) {
                $persona=App\Models\personal\Persona::where('idper_db',$row['USERID'])->first(); 
                if(isset($persona)) { ?>  
                <option value="{{$row['NAME']}},{{$persona->idper_db}}">{{$row['NAME']}}</option>
                <?php }} sqlsrv_close($conn); ?>
        </select>
    </div>
    
    <div class="form-group row font-weight-bold">
        <label class="col">Area</p>
        <input type="text" class="form-control" placeholder="Este campo es opcional" id="area" name="area" value="" >
    </div>
    <div class="form-group row font-weight-bold">
        <label class="col">Observaciones</p>
        <textarea name="comentario" class="form-control col" placeholder="Este campo es opcional" id="obs"></textarea>
    </div>
    
    <div class="form-group row justify-content-center align-content-center" id="product1">
        <div class="form-check ml-5 col-auto">
            <input class="form-check-input" type="radio" name="tipod" id="laboral" value="DL" checked>
            <label class="form-check-label font-weight-bold" for="gridCheck">Dia laboral</label>
        </div>
        <div class="form-check ml-5 col-auto"> 
            <input class="form-check-input" type="radio" name="tipod" id="descanso" value="V">
            <label class="form-check-label font-weight-bold" for="gridCheck">Vacacion</label>
        </div>
    </div>
    
    <div class="form-row font-weight-bold">
        <div class="form-group col-md-6">
            <label for="fecha de inicio">Fecha Inicio</label>
            <input type="date" class="form-control" name="fecha_inicio" id="fec_inicio" >
        </div>
        <div class="form-group col-md-6">
            <label for="fecha de fin">Fecha Fin</label>
            <input type="date" class="form-control "  name="fecha_fin" id="fec_fin" disabled>
        </div>
    </div>
    <div class="form-row font-weight-bold">
        <div class="form-group col-md-6">
            <label for="hora de inicio">Hora Inicio</label>
            <input type="time" class="form-control " name="hora_inicio" id="hrs_inicio">
        </div>
        <div class="form-group col-md-6">
            <label for="hora de fin">Hora Fin</label>
            <input type="time" class="form-control " name="hora_fin" id="hrs_fin" >
        </div>
    </div>

    <div class="form-row font-weight-bold ">
        <div class="form-group col">
            <label for="turnoo">Turno</label>
            <select name="turno" id="turno" class="form-control custom-select mr-sm-2" >
                <option value="" disabled selected>Elegir turno</option>
                <option value="Mañana">Mañana</option>
                <option value="Tarde">Tarde</option>
                <option value="Dia">Dia</option>
                <option value="Noche">Noche</option>
                <option value="24 Hrs.">24 Hrs.</option>
            </select>
        </div>
    </div>

    <div class="row justify-content-center align-content-center">
        <button id="adicionar" class="btn btn-success " type="button">+ Agregar</button>
        <button id="limpiar" class="btn btn-danger ml-4" type="button" > Cancelar</button>
    </div>
{!!Form::Close()!!}<!---->
</div>
