<?php
error_reporting(1);
require_once '../config_db.php';
require_once '../utils/helper.php';

$diesel_rate_date = $_POST['diesel_rate_date'];
$diesel_rate = $_POST['diesel_rate'];

$iquery = "INSERT INTO diesel_rates (diesel_rate_date, diesel_rate) VALUES ('$diesel_rate_date', '$diesel_rate')";
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