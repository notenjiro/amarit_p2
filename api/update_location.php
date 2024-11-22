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

$iquery = "UPDATE location SET description = '$description', zipcode = '$zipcode', amarit_location = '$amarit_location', department = '$department', cost_center = '$cost_center' ,WHERE code = '$code'";
$stmt = sqlsrv_query($conn, $iquery);

if($stmt === false){
    $Data["Status"] = "Error";
    $Data["msg"] = "มีบางอย่างผิดพลาด";
}else{
    $Data["Status"] = "Success";
    $Data["msg"] = "Data has been updated";
}

echo json_encode($Data);

sqlsrv_close($conn);

?>