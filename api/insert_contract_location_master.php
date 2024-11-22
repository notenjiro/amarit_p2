<?php
error_reporting(0);
require_once '../config_db.php';
require_once '../utils/helper.php';

$location = $_POST['location'];
$universal_location = $_POST['universal_location'];
$sub_location = $_POST['sub_location'];

$iquery = "INSERT INTO contract_location_master (location, universal_location, sub_location, active) VALUES ('$location', '$universal_location', '$sub_location', 1)";
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