<?php
error_reporting(1);
require_once '../config_db.php';
require_once '../utils/helper.php';

$reccode = $_GET['reccode'];

$code = $_POST['code'];
$description = $_POST['description'];
$fuel_km_per_litre = $_POST['fuel_km_per_litre'];
$vehicle_group = $_POST['vehicle_group'];
$block_allowance = $_POST['block_allowance'];

$iquery = "UPDATE vehicle_type SET description = '$description', fuel_km_per_litre = '$fuel_km_per_litre', vehicle_group = '$vehicle_group', code = '$code', block_allowance = $block_allowance WHERE reccode = '$reccode' ";
$stmt = sqlsrv_query($conn, $iquery);

if($stmt === false){
    $Data["Status"] = "Error";
    $Data["msg"] = $iquery;//"มีบางอย่างผิดพลาด";
}else{
    $Data["Status"] = "Success";
    $Data["msg"] = "Data has been updated";
}

echo json_encode($Data);

sqlsrv_close($conn);

?>