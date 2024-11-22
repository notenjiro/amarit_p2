<?php
error_reporting(0);
require_once '../config_db.php';
require_once '../utils/helper.php';

$reccode = $_GET['reccode'];

$category = $_POST['category'];
$commute_range = $_POST['commute_range'];
$diesel_baht_from = $_POST['diesel_baht_from'];
$diesel_baht_to = $_POST['diesel_baht_to'];
$one_way = $_POST['one_way'];
$round_trip = $_POST['round_trip'];
$vehicle_type = $_POST['vehicle_type3'];
$transport_solution = isset($_POST['transport_solution3'])?$_POST['transport_solution3']:false;
$contract_line = $_POST['contract_line3'];

$iquery = "UPDATE contract_diesel_price SET category='$category', commute_range='$commute_range', diesel_baht_from='$diesel_baht_from', diesel_baht_to='$diesel_baht_to', one_way='$one_way', round_trip='$round_trip', vehicle_type='$vehicle_type', transport_solution='$transport_solution', contract_line='$contract_line' WHERE reccode='$reccode'";
$stmt = sqlsrv_query($conn, $iquery);

if($stmt === false){
    $Data["Status"] = "Error";
    $Data["msg"] = "มีข้อมูลซ้ำกับที่มีอยู่แล้ว";
}else{
    $Data["Status"] = "Success";
    $Data["msg"] = "Data has been updated";
}

echo json_encode($Data);

sqlsrv_close($conn);

?>