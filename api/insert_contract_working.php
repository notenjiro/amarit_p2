<?php
error_reporting(0);
require_once '../config_db.php';
require_once '../utils/helper.php';

$contract_no = $_GET['contract_no'];
$customer = $_GET['customer'];
$position = $_POST['working_position'];
$monday = $_POST['monday'];
$tuesday = $_POST['tuesday'];
$wednesday = $_POST['wednesday'];
$thursday = $_POST['thursday'];
$friday = $_POST['friday'];
$saturday = $_POST['saturday'];
$sunday = $_POST['sunday'];

$iquery = "INSERT INTO contract_working_day (contract_no, customer, position, monday, tuesday, wednesday, thursday, friday, saturday, sunday) VALUES ('$contract_no','$customer','$position','$monday','$tuesday','$wednesday','$thursday','$friday','$saturday','$sunday')";
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