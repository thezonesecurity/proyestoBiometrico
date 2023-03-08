{{-- ?php
$Userve= "localhost";
$Uuser = "postgres";
$Upass ="sistemas";
$Udb = "hdb";

$con = new postgres($Userve, $Uuser, $Upass, $Udb);
if($con->connect_errno){
    echo "Error en la conexion.."
}
?>



    $serverName = "193.168.0.4"; //propiedades del servidor->ver propiedades de conexioon->producto-> nombre del servidor
                $connectionInfo = array( "Database"=>"BD_BIOMETRICO", "UID"=>"sa", "PWD"=>"S1af2023");
                $conn = sqlsrv_connect( $serverName, $connectionInfo) or die(print_r(sqlsrv_errors(), true));
--}}
<?php
$serverName ="DESKTOP-S9D1IAK"; //"193.168.0.4";// "DESKTOP-S9D1IAK"; //propiedades del servidor->ver propiedades de conexioon->producto-> nombre del servidor
            $connectionInfo = array( "Database"=>"BD_BIOMETRICO", "UID"=>"sa", "PWD"=>"S1af2023");//prueba
            $conn = sqlsrv_connect( $serverName, $connectionInfo) or die(print_r(sqlsrv_errors(), true));

?>