<?php
error_reporting(1);
require_once '../config_db.php';
require_once '../utils/helper.php';

$code = $_POST['code'];
$description = $_POST['description'];
if ($_POST['fuel_km_per_litre'] == '') 
	$fuel_km_per_litre = 0;
else
	$fuel_km_per_litre = $_POST['fuel_km_per_litre'];

$fuel_km_per_litre = 0;
$vehicle_group = $_POST['vehicle_group'];

$iquery = "INSERT INTO vehicle_type (code, description, fuel_km_per_litre, vehicle_group) VALUES ('$code', '$description', '$fuel_km_per_litre', '$vehicle_group')";
$stmt = sqlsrv_query($conn, $iquery);

if($stmt === false){
    $Data["Status"] = "Error";
    $Data["msg"] = $iquery;//"มีข้อมูลซ้ำกับที่มีอยู่แล้ว";
}else{
    $Data["Status"] = "Success";
    $Data["msg"] = "Data has been updated";
}

echo json_encode($Data);

sqlsrv_close($conn);

?>