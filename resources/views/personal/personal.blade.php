@extends("dashboard/dashboard") <!--extends se situa en views-->
@section('titulo')
 - Personal
@stop

@section('styles')
{{ Html::style( asset('datatables/dataTables.bootstrap4.min.css') )}}
<style>
    .error {
    color: red;
  }
</style>
@stop

@section('contenido')
{{--dd($data)--}}
<?php
$serverName ="DESKTOP-S9D1IAK"; //"193.168.0.4";// "DESKTOP-S9D1IAK"; //propiedades del servidor->ver propiedades de conexioon->producto-> nombre del servidor
$connectionInfo = array( "Database"=>"BD_BIOMETRICO", "UID"=>"sa", "PWD"=>"S1af2023");//prueba
$conn = sqlsrv_connect( $serverName, $connectionInfo) or die(print_r(sqlsrv_errors(), true));

$sql="select USERID, NAME, BADGENUMBER from USERINFO"; //ORDER BY USERID;  personas
$res=sqlsrv_query($conn,$sql);
$i=0;
?>
<div class=" table-responsive d-flex justify-content-center " style="margin-left: auto" ><!--style="margin-left: 250px"-->
  <div class="col">
    @include('dashboard.mensaje')
    <div class="box-body table-responsive-sm table-responsive-md table-responsive-lg table-responsive-xl">
        <h3 class="box-title text-center">Lista del personal H.D.B.</h3>
        <table id="listarPersonas" class="table table-sm table-bordered table-striped" width="100%">{{--listarPersonas--}}
            <thead>
                <tr>
                    <th scope="col" >Nro.</th>       
                    <th scope="col" >Nombre Completo</th>
                    <th scope="col">C.I.</th>
                    <th scope="col">Tipo Contrato</th>
                    <th scope="col">Servicio</th>
                    <th scope="col">Nro. Fondo F</th>
                    <th scope="col">Estado</th>
                    <th scope="col">Opciones</th>
                  </tr>
            </thead>
            <tbody>
                <?php while($row=sqlsrv_fetch_array($res) ) {?>
                    
                    @if(isset($row))
                      <tr>
                            <td>{{++$i}}</td>
                            <td><span id="nombre<?php echo $row['USERID']; ?>" >{{$row['NAME']}}</span></td>
                            <td><span id="ci<?php echo $row['USERID']; ?>" >{{$row['BADGENUMBER']}}</span></td>
                            <?php $persona=App\Models\personal\Persona::orderBy('id')->where('idper_db',$row['USERID'])->first(); ?>
                            @if(isset($persona)) 
                                <td><span id="item{{$persona->id}}" >{{$persona->PersonaItem->nombre}}</span></td>
                                <?php $servicio=App\Models\servicios\Servicio::where('id',$persona->id_servicio)->first(); ?>
                                <td><span id="servicio{{$persona->id}}" >{{$servicio->nombre}}</span></td>
                                @if(isset($persona->num_financ))
                                    <td><span id="numFinanc{{$persona->id}}" >{{$persona->num_financ}}</span></td>
                                @else
                                    <td><span id="numFinanc{{$persona->id}}" >No tiene</span></td>
                                @endif
                                <td><span id="estado{{$persona->id}}" >{{$persona->estado_per}}</span></td>
                                <td>
                                    @if( $persona->estado_per == 'Habilitado' ) 
                                        <button type="button" class="btn btn-outline-success btn-sm edit" value="{{$persona->id}},{{$row['USERID']}}" data-toggle="modal" data-target="#editarModal">Editar</button>
                                        <a href="{{ route('inhabilitar.persona', $row['USERID'])}}" type="buton" class="btn btn-sm btn-outline-danger">Inhabilitar</a>
                                    @else
                                        <button type="button" class="btn btn-outline-secondary btn-sm edit" value="{{$persona->id}},{{$row['USERID']}}" data-toggle="modal" data-target="#editarModal" disabled>Editar</button>  
                                        <a href="{{ route('habilitar.persona', $row['USERID'])}}" type="buton" class="btn btn-sm btn-outline-warning"><span class="font-weight-bold">Habilitar</span></a>
                                    @endif 
                                </td>
                            @else
                                <td><span id="item" >Sin item</span></td>
                                <td><span id="servicio" >Sin servicio</span></td>
                                <td><span id="num" >Sin fondo F.</span></td>
                                <td><span id="estado" >Sin estado</span></td>
                                <td>
                                    <div>{{--las dos lineas siguientes no son funcionales pero son requisito para el modal de registrar--}}
                                        <button type="button" class="btn btn-danger btn-sm registrar" data-toggle="modal" data-target=".registrarModal" style="display: none">Añadir Error NO FUNCIONAL</button>  
                                        @include('personal.modalErrorRegistrarPersona') 
                                    </div>
                                    <button type="button" class="btn btn-outline-info btn-sm registrarModal" value="{{$row['USERID']}}" data-toggle="modal" data-target="#exampleModal">Añadir</button>
                                    @include('personal.registrar')
                                </td>
                            @endif  
                        </tr> 
                    @else
                    <tr>
                        <td colspan="8">No hay datos para mostrar. Contacte con soporte</td>
                        @break
                    </tr>   
                    @endif
                <?php }//Fin while
                sqlsrv_close($conn); ?> 
            </tbody>
        </table>
    </div>
</div>
@include('personal.editarPersonal')

@stop

@section('scripts')
<script src="{{ asset('datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('datatables/dataTables.bootstrap4.min.js') }}"></script>
<script src="{{asset('jquery-validate/jquery.validate.js')}}"></script>
<script type="text/javascript" src="{{ asset('assets/scripts/admin/personal.js') }}"></script>

<script>
    $(document).ready(function () {
        $('#listarPersonas').DataTable({
            "lengthMenu": [[15 , 30, 60, -1], [15 , 30, 60, "All"]],
            language: {
                "lengthMenu": "Mostrar _MENU_ registros",
                "zeroRecords": "No se encontraron resultados",
                "info": "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
                "infoEmpty": "Mostrando registros del 0 al 0 de un total de 0 registros",
                "infoFiltered": "(filtrado de un total de _MAX_ registros)",
                "sSearch": "Buscar:",
                "oPaginate": {
                    "sFirst": "Primero",
                    "sLast":"Último",
                    "sNext":"Siguiente",
                    "sPrevious": "Anterior"
			     },
			     "sProcessing":"Procesando...",
            },
        });
    });
</script>

@stop
