<?php
error_reporting(0);
require_once '../config_db.php';
require_once '../utils/helper.php';

$reccode = $_GET['reccode'];

$position = $_POST['manpower_position'];
$universal_position = $_POST['universal_position'];
$type = $_POST['type'];
$normal = null_decimal($_POST['normal']);
$after_normal = null_decimal($_POST['after_normal']);
$s_normal = null_decimal($_POST['s_normal']);
$s_after_normal = null_decimal($_POST['s_after_normal']);
$description = $_POST['description'];
$monday = isset($_POST['monday'])?$_POST['monday']:0;
$tuesday = isset($_POST['tuesday'])?$_POST['tuesday']:0;
$wednesday = isset($_POST['wednesday'])?$_POST['wednesday']:0;
$thursday = isset($_POST['thursday'])?$_POST['thursday']:0;
$friday = isset($_POST['friday'])?$_POST['friday']:0;
$saturday = isset($_POST['saturday'])?$_POST['saturday']:0;
$sunday = isset($_POST['sunday'])?$_POST['sunday']:0;
$start_ship = null_val($_POST['start_ship']);
$start_break = null_val($_POST['start_break']);
$end_ship = null_val($_POST['end_ship']);
$minimum_charge = null_decimal($_POST['minimum_charge']);
$ot_lamsam = null_decimal($_POST['ot_lamsam']);
$sunday_lamsam = null_decimal($_POST['sunday_lamsam']);
$lamsum_charge_rate = null_decimal($_POST['lamsum_charge_rate']);

$contract_line = $_POST['contract_line_number'];

$iquery = "UPDATE contract_hourly_rate SET position='$position', universal_position='$universal_position', type='$type', normal=$normal, after_normal=$after_normal, monday = $monday, tuesday = $tuesday, wednesday = $wednesday, thursday = $thursday, friday = $friday, saturday = $saturday, sunday = $sunday, start_ship = $start_ship, start_break = $start_break, end_ship = $end_ship, s_normal=$s_normal, s_after_normal=$s_after_normal, minimum_charge=$minimum_charge, ot_lamsam=$ot_lamsam, sunday_lamsam=$sunday_lamsam, contract_line='$contract_line', lamsum_charge_rate=$lamsum_charge_rate , description = '$description' WHERE reccode='$reccode'";

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