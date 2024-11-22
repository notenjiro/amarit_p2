<?php
error_reporting(1);
require_once '../config_db.php';
require_once '../utils/helper.php';

$code = $_POST['code'];
$description = $_POST['description'];


$iquery = "INSERT INTO poe_pod (code, description) VALUES ('$code', '$description')";
$stmt = sqlsrv_query($conn, $iquery);

if($stmt === false){
    $Data["status"] = "0";
    $Data["Status"] = "Error";
    $Data["msg"] = "Code มีข้อมูลซ้ำกับที่มีอยู่แล้ว";
}else{
    $Data["status"] = "1";
    $Data["Status"] = "Success";
    $Data["msg"] = "Data has been updated";
}

echo json_encode($Data);

sqlsrv_close($conn);

?>