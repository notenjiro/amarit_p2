<?php
require_once '../config_db.php';
require_once '../utils/helper.php';
$raw = array();

if($_GET["branch"]){
    $fQuery = "SELECT branch.description FROM branch";
    $result = sqlsrv_query($conn, $fQuery);
while($row = sqlsrv_fetch_array( $result, SQLSRV_FETCH_ASSOC)){
    array_push($raw,$row);
}
echo json_encode($raw);
}
if($_GET["position"]){
    $fQuery = "SELECT position.description FROM position";
    $result = sqlsrv_query($conn, $fQuery);
while($row = sqlsrv_fetch_array( $result, SQLSRV_FETCH_ASSOC)){
    array_push($raw,$row);
}
echo json_encode($raw);
}
if($_GET["vehicle_type"]){
    $fQuery = "SELECT vehicle_type.description FROM vehicle_type";
    $result = sqlsrv_query($conn, $fQuery);
while($row = sqlsrv_fetch_array( $result, SQLSRV_FETCH_ASSOC)){
    array_push($raw,$row);
}
echo json_encode($raw);
}

sqlsrv_close($conn);

?>