<?php
session_start();
error_reporting(0);
require_once '../config_db.php';
require_once '../utils/helper.php';

$reccode = $_GET['reccode'];

$taxi_service_id = $_POST['taxi_service_id'];
$vehicle = $_POST['taxi_vehicle'];
$operator = $_POST['taxi_operator'];
$transport_from = $_POST['taxi_from'];
$transport_to = $_POST['taxi_to'];
$start_date = $_POST['taxi_start_date'];
$start_time = $_POST['taxi_start_time'];
$end_date = $_POST['taxi_end_date'];
$end_time = $_POST['taxi_end_time'];
$quantity = $_POST['taxi_quantity'];
$uom = $_POST['taxi_uom'];
$remark = $_POST['taxi_remark'];

$cancel_reason = $_POST['taxi_cancel_reason'];
$line_status = $_POST['taxi_line_status'];

$group_name = $_POST['taxi_group_name'];
$type1 = $_POST['type1'];
$type2 = $_POST['type2'];
$type3 = $_POST['type3'];
$type4 = $_POST['type4'];
$type5 = $_POST['type5'];
$barcode_type = $_POST['barcode_type'];
$barcode_location = $_POST['location'];
$barcode_brance = $_POST['branch'];
$barcode_service = $_POST['name'];

$ref1 = $_POST['taxi_ref1'];
$ref2 = $_POST['taxi_ref2'];
$ref3 = $_POST['taxi_ref3'];
$ref4 = $_POST['taxi_ref4'];
$ref5 = $_POST['taxi_ref5'];
$ref6 = $_POST['taxi_ref6'];
$contract_no = $_POST['taxi_contract'];
$contract_line = $_POST['taxi_contract_line'];

$fQuery = "SELECT branch FROM vehicle where vehicle_id='$vehicle'";
$result = sqlsrv_query($conn, $fQuery);
while($row = sqlsrv_fetch_array( $result, SQLSRV_FETCH_ASSOC)){
	$branch = $row['branch'];
}

//$service_number = $_POST['service_number'];
//$description = $_POST['service_description'];
//$description2 = $_POST['service_description2'];
//$amount = $_POST['service_amount'];
//$agreement_number = $_POST['service_agreement_number'];
$department = $_POST['taxi_department'];
$cost_center = $_POST['taxi_cost_center'];
$contact = $_POST['taxi_contact'];
$specific_location_from = $_POST['taxi_specific_location_from'];
$specific_location_to = $_POST['taxi_specific_location_to'];
$charge_as = $_POST['taxi_charge_as'];
$outsource_charge_as = $_POST['taxi_outsource_charge_as'];
$actual_start_date = null_val($_POST['taxi_actual_start_date']);
$actual_start_time = null_val($_POST['taxi_actual_start_time']);
$actual_finish_date = null_val($_POST['taxi_actual_finish_date']);
$actual_finish_time = null_val($_POST['taxi_actual_finish_time']);
$diesel_rate = null_decimal($_POST['taxi_diesel_rate']);
$mileage_start = null_decimal($_POST['taxi_mileage_start']);
$mileage_end = null_decimal($_POST['taxi_mileage_end']);
$no_charge = isset($_POST['taxi_no_charge'])?$_POST['taxi_no_charge']:0;
$modify_by = $_SESSION["user_name"];

if ($uom == 'EM/TP')
	$no_charge = 1;

$iquery = "UPDATE worksheet_taxi SET barcode_type = '$barcode_type',barcode_location ='$barcode_location' ,branch = '$barcode_brance',barcode_service = '$barcode_service',taxi_service_id='$taxi_service_id',  vehicle='$vehicle', operator='$operator', transport_from='$transport_from', transport_to='$transport_to', start_date='$start_date', start_time='$start_time', end_date='$end_date', end_time='$end_time', quantity='$quantity', uom='$uom', remark='$remark', cancel_reason='$cancel_reason', line_status='$line_status', group_name='$group_name', type1='$type1', type2='$type2', type3='$type3', type4='$type4', type5='$type5', ref1='$ref1', ref2='$ref2', ref3='$ref3', ref4='$ref4', ref5='$ref5', ref6='$ref6', service_number='$service_number', description='$description', description2='$description2', agreement_number='$agreement_number', department='$department', cost_center='$cost_center', contact='$contact', specific_location_from='$specific_location_from', specific_location_to='$specific_location_to', charge_as='$charge_as', outsource_charge_as='$outsource_charge_as', contract_no='$contract_no', contract_line='$contract_line', actual_start_date=$actual_start_date, actual_start_time=$actual_start_time, actual_finish_date=$actual_finish_date, actual_finish_time=$actual_finish_time, diesel_rate=$diesel_rate, mileage_start=$mileage_start, mileage_end=$mileage_end, modify_date = getdate(), no_charge='$no_charge', modify_by='$modify_by' WHERE reccode='$reccode'";
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