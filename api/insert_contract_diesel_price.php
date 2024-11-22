<?php
error_reporting(0);
require_once '../config_db.php';
require_once '../utils/helper.php';

$contract_no = $_GET['contract_no'];
$customer = $_GET['customer'];

$category = $_POST['category'];
$commute_range = $_POST['commute_range'];
$diesel_baht_from = $_POST['diesel_baht_from'];
$diesel_baht_to = $_POST['diesel_baht_to'];
$one_way = $_POST['one_way'];
$round_trip = $_POST['round_trip'];
$vehicle_type = $_POST['vehicle_type3'];
$transport_solution = isset($_POST['transport_solution3'])?$_POST['transport_solution3']:false;
$contract_line = $_POST['contract_line3'];

$iquery = "INSERT INTO contract_diesel_price (contract_no, customer, category, commute_range, diesel_baht_from, diesel_baht_to, one_way, round_trip, vehicle_type, transport_solution, contract_line) VALUES ('$contract_no', '$customer', '$category', '$commute_range', '$diesel_baht_from', '$diesel_baht_to', '$one_way', '$round_trip', '$vehicle_type', '$transport_solution', '$contract_line')";
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