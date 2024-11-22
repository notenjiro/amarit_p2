<?php
$serverName = "I3OAT\SQL2019"; //serverName\instanceName
$connectionInfo = array( "Database"=>"db1", "UID"=>"sa", "PWD"=>"delphib006");
$conn = sqlsrv_connect( $serverName, $connectionInfo);

if( $conn ) {
     echo "Connection established.<br />";
}else{
     echo "Connection could not be established.<br />";
     die( print_r( sqlsrv_errors(), true));
}
?>