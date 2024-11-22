<?php
error_reporting(1);
require_once '../config_db.php';
require_once '../utils/helper.php';

$code = $_POST['code'];
$description = $_POST['description'];
$day_type = $_POST['day_type'];

$iquery = "INSERT INTO day_type (code, description, day_type) VALUES ('$code', '$description', '$day_type')";
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