<?php
error_reporting(0);
require_once '../config_db.php';
require_once '../utils/helper.php';

$reccode = $_POST['reccode'];

$location = $_POST['location'];
$universal_location = $_POST['universal_location'];
$sub_location = $_POST['sub_location'];
$post_code = $_POST['post_code'];

$iquery = "UPDATE contract_location_master SET location='$location', universal_location='$universal_location', sub_location='$sub_location', post_code='$post_code' WHERE reccode=$reccode ";
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