<?php
error_reporting(1);
require_once '../config_db.php';
require_once '../utils/helper.php';

$picture_folder = $_POST['picture_folder'];
$fuel_km_per_litre = $_POST['fuel_km_per_litre'];

$iquery = "UPDATE application_setup SET picture_folder = '$picture_folder', fuel_km_per_litre = '$fuel_km_per_litre'";
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