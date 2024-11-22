<?php
error_reporting(0);
require_once '../config_db.php';
require_once '../utils/helper.php';

$reccode = $_GET['reccode'];

$contract_line = $_POST['immigration_contract_line'];
$description = $_POST['immigration_description'];
$unit_price = $_POST['immigration_unit_price'];
$location = $_POST['immigration_location'];
$uom = $_POST['immigration_uom'];

$iquery = "UPDATE contract_immigration SET contract_line='$contract_line', description='$description', unit_price='$unit_price', location='$location', uom='$uom' WHERE reccode='$reccode'";

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