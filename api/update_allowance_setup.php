<?php
error_reporting(1);
require_once '../config_db.php';
require_once '../utils/helper.php';

$reccode = $_POST['reccode'];
$branch = $_POST['branch'];
$position = $_POST['position'];
$vehicle_type = $_POST['vehicle_type'];
$benefit_type = $_POST['benefit_type'];
$service = $_POST['service'];
$client = $_POST['client'];
$allowance_type = $_POST['allowance_type'];
$trip = $_POST['trip'];
$amount = null_decimal($_POST['amount']);
$amount2 = null_decimal($_POST['amount2']);
$special_rate = null_decimal($_POST['special_rate']);
$location_from = $_POST['location_from'];
$location_to = $_POST['location_to'];
$special_ot_rate = null_decimal($_POST['special_ot_rate']);
$minimum_hours = null_decimal($_POST['minimum_hours']);

$iquery = "UPDATE allowance_setup SET branch = '$branch', position = '$position', vehicle_type = '$vehicle_type', benefit_type = '$benefit_type', service = '$service', client = '$client', allowance_type = '$allowance_type', trip = '$trip', amount = $amount, special_rate = $special_rate, location_from = '$location_from', location_to = '$location_to', special_ot_rate = $special_ot_rate, minimum_hours = $minimum_hours, amount2 = $amount2 WHERE reccode = $reccode ";
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