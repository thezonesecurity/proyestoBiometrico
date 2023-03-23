<table class="table table-sm table-striped">
    <thead>
    <tr>
        <th scope="col">Nro.</th>
        <th scope="col">Nombre Completo</th>
        <th scope="col">Fecha</th>
        <th scope="col">Hora</th>
        <th scope="col">Turno</th>
        <th scope="col">Cargo</th>
        <th scope="col">Obs.</th> 
        <th scope="col">Opciones</th>
    </tr>
    </thead>
    <tbody>
        <?php
            
            $serverName ="DESKTOP-S9D1IAK"; //"193.168.0.4";// "DESKTOP-S9D1IAK"; //propiedades del servidor->ver propiedades de conexioon->producto-> nombre del servidor
            $connectionInfo = array( "Database"=>"BD_BIOMETRICO", "UID"=>"sa", "PWD"=>"S1af2023");//prueba
            $conn = sqlsrv_connect( $serverName, $connectionInfo) or die(print_r(sqlsrv_errors(), true));                    
            $sql="select * FROM USERINFO;"; //personas
            $res=sqlsrv_query($conn,$sql);   
            $i=0;
            while($row=sqlsrv_fetch_array($res)) {
                $persona=App\Models\personal\Persona::where('idper_db',$row['USERID'])->first(); 
                    if(isset($persona)) {   ?>       
                        <tr>
                            <th scope="row">{{++$i}}</th>
                            <td>{{$row['NAME']}}</td>
                            
                            <td>Editar ¬ Eliminar </td>
                        </tr>
                    <?php }       
            } sqlsrv_close($conn); ?>
      
    </tbody>

</table>
