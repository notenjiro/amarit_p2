<?php
error_reporting(1);
require_once '../config_db.php';
require_once '../utils/helper.php';

$reccode = $_GET['reccode'];

$miledge_from = $_POST['miledge_from'];
$miledge_to = $_POST['miledge_to'];
$qty = $_POST['qty'];
$long_haul = isset($_POST['long_haul'])?$_POST['long_haul']:0;
$round_trip = isset($_POST['round_trip'])?$_POST['round_trip']:0;

$iquery = "UPDATE miledge_calc SET miledge_from = '$miledge_from', miledge_to = '$miledge_to', qty = '$qty', long_haul = '$long_haul', round_trip = '$round_trip' WHERE reccode = '$reccode' ";
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