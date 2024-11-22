<?php
error_reporting(1);
require_once '../config_db.php';
require_once '../utils/helper.php';

$type = $_POST['type'];
$code = $_POST['code'];
$description = $_POST['description'];

$iquery = "INSERT INTO barcode_sub_type".$type." (no_sub_type".$type.", sub_type".$type.") VALUES ('$code', '$description')";
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