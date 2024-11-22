<?php
error_reporting(0);
require_once '../config_db.php';
require_once '../utils/helper.php';

$contract_no = $_GET['contract_no'];
$customer = $_GET['customer'];
$contract_line = $_POST['immigration_contract_line'];
$description = $_POST['immigration_description'];
$unit_price = $_POST['immigration_unit_price'];
$location = $_POST['immigration_location'];
$uom = $_POST['immigration_uom'];

$iquery = "INSERT INTO contract_immigration (contract_no, customer, contract_line, description, unit_price, location, uom) VALUES ('$contract_no', '$customer', '$contract_line', '$description', '$unit_price', '$location', '$uom')";
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