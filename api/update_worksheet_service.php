<?php
session_start();
error_reporting(0);
require_once '../config_db.php';
require_once '../utils/helper.php';

$reccode = $_GET['reccode'];

$cargo_service_id = $_POST['cargo_service_id'];
$vehicle = $_POST['vehicle'];
$operator = $_POST['operator'];
$transport_from = $_POST['transport_from'];
$transport_to = $_POST['transport_to'];
$start_date = $_POST['start_date'];
$start_time = $_POST['start_time'];
$end_date = $_POST['end_date'];
$end_time = $_POST['end_time'];
$trip_type = $_POST['trip_type'];
$charge_type = $_POST['charge_type'];
$additional_charge = $_POST['additional_charge'];
$quantity = $_POST['quantity'];
$uom = $_POST['uom'];
$remark = $_POST['remark'];
$reimbursment = isset($_POST['reimbursment'])?$_POST['reimbursment']:false;

$cancel_reason = $_POST['service_cancel_reason'];
$line_status = $_POST['service_line_status'];

$group_name = $_POST['service_group_name'];
$type1 = $_POST['service_type1'];
$type2 = $_POST['service_type2'];
$type3 = $_POST['service_type3'];
$type4 = $_POST['service_type4'];
$type5 = $_POST['service_type5'];
$ref1 = $_POST['service_ref1'];
$ref2 = $_POST['service_ref2'];
$ref3 = $_POST['service_ref3'];
$ref4 = $_POST['service_ref4'];
$ref5 = $_POST['service_ref5'];
$ref6 = $_POST['service_ref6'];
$no_charge = isset($_POST['service_no_charge'])?$_POST['service_no_charge']:0;
$modify_by = $_SESSION["user_name"];

if ($uom == 'EM/TP')
	$no_charge = 1;

$fQuery = "SELECT branch FROM vehicle where vehicle_id='$vehicle'";
$result = sqlsrv_query($conn, $fQuery);
while($row = sqlsrv_fetch_array( $result, SQLSRV_FETCH_ASSOC)){
	$branch = $row['branch'];
}

$service_number = $_POST['service_number'];
$description = $_POST['service_description'];
$description2 = $_POST['service_description2'];
$amount = $_POST['service_amount'];
$agreement_number = $_POST['service_agreement_number'];
$department = $_POST['service_department'];
$cost_center = $_POST['service_cost_center'];

$iquery = "UPDATE worksheet_service SET cargo_service_id='$cargo_service_id',  vehicle='$vehicle', operator='$operator', transport_from='$transport_from', transport_to='$transport_to',
 start_date='$start_date', start_time='$start_time', end_date='$end_date', end_time='$end_time', trip_type='$trip_type', charge_type='$charge_type', 
 additional_charge='$additional_charge', quantity='$quantity', uom='$uom', remark='$remark', cancel_reason='$cancel_reason', line_status='$line_status', 
 group_name='$group_name', type1='$type1', type2='$type2', type3='$type3', type4='$type4', type5='$type5', branch='$branch', ref1='$ref1', ref2='$ref2', 
 ref3='$ref3', ref4='$ref4', ref5='$ref5', ref6='$ref6', service_number='$service_number', description='$description', description2='$description2', amount='$amount', 
 agreement_number='$agreement_number', department='$department', cost_center='$cost_center', modify_date = getdate(), no_charge='$no_charge', modify_by='$modify_by',
 reimbursment='$reimbursment'
 WHERE reccode='$reccode'";
$stmt = sqlsrv_query($conn, $iquery);

if($stmt === false){
    $Data["Status"] = "Error";
    $Data["msg"] = "มีข้อมูลซ้ำกับที่มีอยู่แล้ว";
    $Data['sql'] = $iquery;
}else{
    $Data["Status"] = "Success";
    $Data["msg"] = "Data has been updated";
}

echo json_encode($Data);

sqlsrv_close($conn);

?>