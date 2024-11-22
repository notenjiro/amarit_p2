<?php
require_once '../config_db.php';
require_once '../utils/helper.php';
$raw = array();

if($_GET["vehicle_list"]){
    $fQuery = "SELECT vehicle.vehicle_id, vehicle.registration_no, vehicle.vehicle_type FROM vehicle";
    $result = sqlsrv_query($conn, $fQuery);
while($row = sqlsrv_fetch_array( $result, SQLSRV_FETCH_ASSOC)){
    array_push($raw,$row);
}
echo json_encode($raw);
}

if($_GET["vehicle_group"]){
    $fQuery = "SELECT vehicle_group.description FROM vehicle_group";
    $result = sqlsrv_query($conn, $fQuery);
while($row = sqlsrv_fetch_array( $result, SQLSRV_FETCH_ASSOC)){
    array_push($raw,$row);
}
echo json_encode($raw);
}

if($_GET["vehicle_data"]){
    $fQuery = "SELECT id,vehicle_id,mile_start,mile_end,mile_total FROM miles WHERE vehicle_id = '".$_GET["vehicle_data"]."'";
    $result = sqlsrv_query($conn, $fQuery);
while($row = sqlsrv_fetch_array( $result, SQLSRV_FETCH_ASSOC)){
    array_push($raw,$row);
}
echo json_encode($raw);
}

if($_GET["add_mile"]){
    $vehicle_id = $_POST["vehicle_id"];
    $mile_start = $_POST["mile_start"];
    $mile_end = $_POST["mile_end"];
    $mile_total = $_POST["mile_total"];
    $fQuery = "insert into miles (vehicle_id,mile_start,mile_end,mile_total) values ('".$vehicle_id."','".$mile_start."','".$mile_end."','".$mile_total."')";
    $result = sqlsrv_query($conn, $fQuery);

    if($result){
        echo '1';
    }
    else{
        echo '0';
    }
}

if($_GET["update_mile"]){
    $data_id = $_POST["data_id"];
    $vehicle_id = $_POST["vehicle_id"];
    $mile_start = $_POST["mile_start"];
    $mile_end = $_POST["mile_end"];
    $mile_total = $_POST["mile_total"];
    $fQuery = "update miles set mile_start = '".$mile_start."', mile_end = '".$mile_end."' ,mile_total = '".$mile_total."' WHERE id = ".$data_id;
    $result = sqlsrv_query($conn, $fQuery);

    if($result){
        echo '1';
    }
    else{
        echo '0';
    }
}

sqlsrv_close($conn);

?>