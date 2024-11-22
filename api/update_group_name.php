<?php
error_reporting(1);
require_once '../config_db.php';
require_once '../utils/helper.php';

$code = $_POST['code'];
$description = $_POST['description'];
$transport = isset($_POST['transport'])?$_POST['transport']:0;
$manpower = isset($_POST['manpower'])?$_POST['manpower']:0;
$cargo_handling = isset($_POST['cargo_handling'])?$_POST['cargo_handling']:0;
$service_other = isset($_POST['service_other'])?$_POST['service_other']:0;
$immigration = isset($_POST['immigration'])?$_POST['immigration']:0;
$taxi_service = isset($_POST['taxi_service'])?$_POST['taxi_service']:0;

$iquery = "UPDATE group_name SET description = '$description', transport = $transport, manpower = $manpower, cargo_handling = $cargo_handling, service_other = $service_other, immigration = $immigration, taxi_service = $taxi_service WHERE code = '$code'";
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