<?php
error_reporting(0);
require_once '../config_db.php';
require_once '../utils/helper.php';

$contract_no = $_GET['contract_no'];

$monday_friday = $_POST['monday_friday'];
$sunday_8 = $_POST['sunday_8'];
$sunday_17 = $_POST['sunday_17'];

$iquery = "UPDATE customer_contract SET monday_friday='$monday_friday',sunday_8='$sunday_8',sunday_17='$sunday_17' WHERE contract_no = '$contract_no'";
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