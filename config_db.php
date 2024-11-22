<?php
require_once 'config.php';

$serverName = serverName;
$Database = Database;
$UID = UID;
$PWD = PWD;


$connectionInfo = array( "Database"=>$Database, "UID"=>$UID, "PWD"=>$PWD, "MultipleActiveResultSets"=>true,"CharacterSet"  => 'UTF-8');

$conn = sqlsrv_connect( $serverName, $connectionInfo);
$conntest = sqlsrv_connect( $serverName, $connectionInfo);
if( !$conn ){
    echo "Connection could not be established.<br />";
    die( print_r( sqlsrv_errors(), true));
}
?>