@extends("dashboard/dashboard") <!--extends se situa en views-->
@section('contenido')

<div class="table-responsive d-flex justify-content-center " style="margin-left: auto" ><!--style="margin-left: 250px"-->
  <div class="col-md-10"> 
    
    <div class="box-body">
        <h3 class="box-title text-center">Lista del personal H.D.B.</h3>
        <table id="example" class="table table-bordered table-striped"  width="60%">
            <thead>
                <tr>
                    <th scope="col">Nro.</th>
                    <th scope="col">Nombre  Completo</th>
                    <th scope="col">C.I.</th>
                    <th scope="col">Item</th>
                    <th scope="col">Servicio</th>
                    <th scope="col">Cargo</th>
                    <th scope="col">Estado</th>
                    <th scope="col">Opciones
                        <!-- boton registrar servicio-->
                        <button data-toggle="modal" href="#registrar_personalModal" class="btn btn-primary" style="margin-left: 60px">Registar Personal</button>
                    </th>
                  </tr>
            </thead>
            <tbody>
                <?php
                $serverName = "193.168.0.4, 1542"; //serverName\instanceName, portNumber (por defecto es 1433)
                $connectionInfo = array( "Database"=>"hdb", "UID"=>"sa", "PWD"=>"S1af2023");
                $conn = sqlsrv_connect( $serverName, $connectionInfo);
                
                if( $conn ) {
                     echo "Conexión establecida.<br />";
                }else{
                     echo "Conexión no se pudo establecer.<br />";
                     die( print_r( sqlsrv_errors(), true));
                }
                ?>
            </tbody>
        </table>
    </div>
</div>
    @include('personal.registrarPersonal')  
@stop

@section('titulo')
 - Personal
@stop

@section('styles')
@stop

@section('scripts')
@stop

