<?php
error_reporting(0);
require_once '../config_db.php';
require_once '../utils/helper.php';

$contract_no = $_GET['contract_no'];
$customer = $_GET['customer'];
//$branch = $_POST['branch'];
$equipment = $_POST['heavy_equipment'];
$diesel_baht_from = $_POST['diesel_baht_from'];
$diesel_baht_to = $_POST['diesel_baht_to'];
$rate = $_POST['rate'];
$minimum_charge_hour = $_POST['minimum_charge_hour'];
$branch = $_POST['heavy_branch'];
$contract_line = $_POST['contract_line4'];
$day_rate = $_POST['day_rate'];
$uom = $_POST['heavy_uom'];
$ton_rate = $_POST['ton_rate'];

$iquery = "INSERT INTO contract_equipment_rental (contract_no, customer, branch, equipment, diesel_baht_from, diesel_baht_to, rate, minimum_charge_hour, contract_line, day_rate, uom, ton_rate) VALUES ('$contract_no', '$customer','$branch', '$equipment', '$diesel_baht_from', '$diesel_baht_to', '$rate', '$minimum_charge_hour', '$contract_line', '$day_rate', '$uom', '$ton_rate')";
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