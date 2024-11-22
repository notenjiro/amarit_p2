<?php
error_reporting(0);
require_once '../config_db.php';
require_once '../utils/helper.php';

$contract_no = $_GET['contract_no'];
$customer = $_GET['customer'];
$description = $_GET['taxi_description'];
$contract_line = $_POST['taxi_contract_line'];
$vehicle_type = $_POST['taxi_vehicle_type'];
$transport_rate = $_POST['taxi_rate'];
$uom = $_POST['taxi_uom'];
$customer_ref = $_POST['taxi_ref'];
$transport_from = $_POST['taxi_from'];
$transport_to = $_POST['taxi_to'];
$total_km = $_POST['taxi_total_km'];
$diesel_baht_from = $_POST['taxi_diesel_baht_from'];
$diesel_baht_to = $_POST['taxi_diesel_baht_to'];

$iquery = "INSERT INTO contract_taxi_service (contract_no, customer, contract_line, vehicle_type, transport_rate, uom, customer_ref, transport_from, transport_to, total_km, diesel_baht_from, diesel_baht_to,description) VALUES ('$contract_no', '$customer', '$contract_line', '$vehicle_type', '$transport_rate', '$uom', '$customer_ref', '$transport_from', '$transport_to', '$total_km', '$diesel_baht_from', '$diesel_baht_to','$description')";
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