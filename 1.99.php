<?php
$serverName = "192.168.10.4"; //serverName\instanceName, portNumber (default is 1433)
$connectionInfo = array( "Database"=>"AAL Live (01,Aug,2015)", "UID"=>"sa", "PWD"=>"amarit1982");
$conn = sqlsrv_connect( $serverName, $connectionInfo);

if( $conn ) {
     echo "Connection established.<br />";
}else{
     echo "Connection could not be established.<br />";
     die( print_r( sqlsrv_errors(), true));
}

$fQuery = ' SELECT * FROM [AAL LIVE (NEW)$Dimension Value]  ';
$result = sqlsrv_query($conn, $fQuery);

while($row = sqlsrv_fetch_array( $result, SQLSRV_FETCH_ASSOC)){
    die( print_r($row['Code'], true));
}




?>