<?php
error_reporting(1);
require_once '../config_db.php';
require_once '../utils/helper.php';

$miledge_from = $_POST['miledge_from'];
$miledge_to = $_POST['miledge_to'];
$qty = $_POST['qty'];
$long_haul = isset($_POST['long_haul'])?$_POST['long_haul']:0;
$round_trip = isset($_POST['round_trip'])?$_POST['round_trip']:0;

$iquery = "INSERT INTO miledge_calc (miledge_from, miledge_to, qty, long_haul, round_trip) VALUES ('$miledge_from', '$miledge_to', '$qty', '$long_haul', '$round_trip')";
$stmt = sqlsrv_query($conn, $iquery);

if($stmt === false){
    $Data["Status"] = "Error";
    $Data["msg"] = $iquery;//"มีข้อมูลซ้ำกับที่มีอยู่แล้ว";
}else{
    $Data["Status"] = "Success";
    $Data["msg"] = "Data has been updated";
}

echo json_encode($Data);

sqlsrv_close($conn);

?>