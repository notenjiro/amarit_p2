<?php
error_reporting(0);
require_once '../config_db.php';
require_once '../utils/helper.php';

$reccode = $_GET['reccode'];

$equipment = $_POST['equipment'];
$hourly_rate = $_POST['hourly_rate'];
$daily_rate = $_POST['daily_rate'];
$monthly_rate = $_POST['monthly_rate'];
$vehicle_type = $_POST['vehicle_type2'];
$minimum_charge_hour = $_POST['minimum_charge_hour2'];
$transport_solution = isset($_POST['transport_solution2'])?$_POST['transport_solution2']:false;
$standby_charge = isset($_POST['standby_charge'])?$_POST['standby_charge']:false;
$contract_line = $_POST['contract_line2'];
$sub1 = $_POST['sub1'];
$sub2 = $_POST['sub2'];
$sub3 = $_POST['sub3'];
$sub4 = $_POST['sub4'];
$sub5 = $_POST['sub5'];
$sub6 = $_POST['sub6'];
$customerref = $_POST['customerref'];
$ot_rate_hour = $_POST['ot_rate_hour'];


$iquery = "UPDATE contract_service_rate SET equipment='$equipment', hourly_rate='$hourly_rate', daily_rate='$daily_rate', monthly_rate='$monthly_rate', vehicle_type='$vehicle_type', minimum_charge_hour='$minimum_charge_hour', transport_solution='$transport_solution', contract_line='$contract_line', standby_charge='$standby_charge',
sub1='$sub1',sub2='$sub2',sub3='$sub3',sub4='$sub4',sub5='$sub5',sub6='$sub6',customerref='$customerref',ot_rate_hour='$ot_rate_hour' WHERE reccode='$reccode'";
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