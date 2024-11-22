<?php
error_reporting(0);
require_once '../config_db.php';
require_once '../utils/helper.php';

$contract_no = $_GET['contract_no'];
$customer = $_GET['customer'];
$non_working_date = $_POST['non_working_date'];
$holiday_name = $_POST['holiday_name'];

$iquery = "INSERT INTO contract_non_working_date (contract_no, customer, non_working_date, holiday_name) VALUES ('$contract_no', '$customer','$non_working_date', '$holiday_name')";
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