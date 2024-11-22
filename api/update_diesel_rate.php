<?php
error_reporting(1);
require_once '../config_db.php';
require_once '../utils/helper.php';

$diesel_rate_date = $_POST['diesel_rate_date'];
$diesel_rate = $_POST['diesel_rate'];

$iquery = "UPDATE diesel_rates SET diesel_rate = '$diesel_rate' WHERE diesel_rate_date = '$diesel_rate_date'";
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