<?php
error_reporting(0);
require_once '../config_db.php';
require_once '../utils/helper.php';

$reccode = $_GET['reccode'];

$branch = $_POST['heavy_branch'];
$equipment = $_POST['heavy_equipment'];
$diesel_baht_from = $_POST['diesel_baht_from'];
$diesel_baht_to = $_POST['diesel_baht_to'];
$rate = $_POST['rate'];
$minimum_charge_hour = $_POST['minimum_charge_hour'];
$contract_line = $_POST['contract_line4'];
$day_rate = $_POST['day_rate'];
$uom = $_POST['heavy_uom'];
$ton_rate = $_POST['ton_rate'];

$iquery = "UPDATE contract_equipment_rental SET branch='$branch', equipment='$equipment', diesel_baht_from='$diesel_baht_from', diesel_baht_to='$diesel_baht_to', rate='$rate', minimum_charge_hour='$minimum_charge_hour', contract_line='$contract_line', day_rate='$day_rate', uom='$uom', ton_rate='$ton_rate' WHERE reccode='$reccode'";
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