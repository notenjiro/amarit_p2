<?php
require_once 'config.php';

$serverName = serverName_erp;
$Database = Database_erp;
$UID = UID_erp;
$PWD = PWD_erp;
$connectionInfo = array( "Database"=>$Database, "UID"=>$UID, "PWD"=>$PWD, "MultipleActiveResultSets"=>true,"CharacterSet"  => 'UTF-8');
$conn_erp = sqlsrv_connect( $serverName, $connectionInfo);
if( !$conn_erp ){
    echo "Connection could not be established.<br />";
    die( print_r( sqlsrv_errors(), true));
}
?>