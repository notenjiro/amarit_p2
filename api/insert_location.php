<?php
error_reporting(1);
require_once '../config_db.php';
require_once '../utils/helper.php';

$code = $_POST['code'];
$description = $_POST['description'];
$zipcode = $_POST['zipcode'];
$amarit_location = isset($_POST['amarit_location'])?$_POST['amarit_location']:0;
$department = $_POST['department'];
$cost_center = $_POST['cost_center'];

$iquery = "INSERT INTO FES.dbo.location (code, description, zipcode, amarit_location, department) VALUES (N'$code', N'$description', N'$zipcode', $amarit_location, N'$department')";

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


