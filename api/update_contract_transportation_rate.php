<?php
error_reporting(0);
require_once '../config_db.php';
require_once '../utils/helper.php';

$reccode = $_GET['reccode'];

$vehicle_type = $_POST['vehicle_type1'];
$diesel_baht_from = $_POST['diesel_baht_from'];
$diesel_baht_to = $_POST['diesel_baht_to'];
$transportation_rate = $_POST['transportation_rate'];
$transportation_from = $_POST['transportation_from'];
$transportation_to = $_POST['transportation_to'];
$backhual = isset($_POST['backhual'])?$_POST['backhual']:false;
$total_km = $_POST['total_km'];
$transport_solution = isset($_POST['transport_solution1'])?$_POST['transport_solution1']:false;
$contract_line = $_POST['contract_line1'];
$uom = $_POST['transportation_uom'];
$category = $_POST['transport_category'];
$round_trip_rate = $_POST['transportation_round_trip_rate'];
$sub1 = $_POST['sub1'];
$sub2 = $_POST['sub2'];
$sub3 = $_POST['sub3'];
$sub4 = $_POST['sub4'];
$sub5 = $_POST['sub5'];
$sub6 = $_POST['sub6'];

$iquery = "UPDATE contract_transportation_rate SET vehicle_type='$vehicle_type', diesel_baht_from='$diesel_baht_from', diesel_baht_to='$diesel_baht_to', transportation_rate='$transportation_rate', transportation_from='$transportation_from', transportation_to='$transportation_to', backhual='$backhual', total_km='$total_km', transport_solution='$transport_solution', contract_line='$contract_line', uom='$uom', category='$category', round_trip_rate='$round_trip_rate',
sub1='$sub1',sub2='$sub2',sub3='$sub3',sub4='$sub4',sub5='$sub5',sub6='$sub6' WHERE reccode='$reccode'";
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