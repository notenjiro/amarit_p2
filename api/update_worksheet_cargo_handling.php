<?php
session_start();
error_reporting(0);
require_once '../config_db.php';
require_once '../utils/helper.php';

$reccode = $_GET['reccode'];

$cargo_service_id = $_POST['cargo_service_id'];
$vehicle = $_POST['cargo_vehicle'];
$operator = $_POST['operator'];
$transport_from = $_POST['cargo_transport_from'];
$transport_to = $_POST['transport_to'];
$start_date = $_POST['start_date'];
$start_time = $_POST['start_time'];
$end_date = $_POST['end_date'];
$end_time = $_POST['end_time'];
$quantity = $_POST['quantity'];
$uom = $_POST['uom'];
$remark = $_POST['cargo_remark'];

$cancel_reason = $_POST['cancel_reason'];
$line_status = $_POST['cargo_line_status'];

$group_name = $_POST['cargo_group_name'];
$type1 = $_POST['type1'];
$type2 = $_POST['type2'];
$type3 = $_POST['type3'];
$type4 = $_POST['type4'];
$type5 = $_POST['type5'];

$barcode_type = $_POST['barcode_type'];
$barcode_location = $_POST['location'];
$barcode_brance = $_POST['branch'];
$barcode_service = $_POST['name'];


$ref1 = $_POST['cargo_ref1'];
$ref2 = $_POST['cargo_ref2'];
$ref3 = $_POST['cargo_ref3'];
$ref4 = $_POST['cargo_ref4'];
$ref5 = $_POST['cargo_ref5'];
$ref6 = $_POST['cargo_ref6'];
$contact = $_POST['cargo_handling_contact'];
$department = $_POST['cargo_department'];
$cost_center = $_POST['cargo_cost_center'];
$charge_as = $_POST['cargo_charge_as'];
$outsource_charge_as = $_POST['cargo_outsource_charge_as'];
$diesel_rate = null_decimal($_POST['cargo_diesel_rate']);
$contract_no = $_POST['cargo_contract_no'];
$contract_no1_1 = $_POST['cargo_contract_no_1'];
$confirm_contract = isset($_POST['cargo_confirm_contract'])?$_POST['cargo_confirm_contract']:0;
$ot = isset($_POST['cargo_ot'])?$_POST['cargo_ot']:0;
$no_charge = isset($_POST['cargo_no_charge'])?$_POST['cargo_no_charge']:0;
$modify_by = $_SESSION["user_name"];
$ontime = isset($_POST['cargo_ontime'])?$_POST['cargo_ontime']:0;

if ($uom == 'EM/TP')
	$no_charge = 1;

if ($contract_no == '')
  $contract_no = $contract_no1_1;

$fQuery = "SELECT branch FROM vehicle where vehicle_id='$vehicle'";
$result = sqlsrv_query($conn, $fQuery);
while($row = sqlsrv_fetch_array( $result, SQLSRV_FETCH_ASSOC)){
	$branch = $row['branch'];
}

$iquery = "UPDATE worksheet_cargo_handling SET barcode_type = '$barcode_type',barcode_location ='$barcode_location' ,branch = '$barcode_brance',barcode_service = '$barcode_service',
cargo_service_id='$cargo_service_id',  vehicle='$vehicle', operator='$operator', transport_from='$transport_from', transport_to='$transport_to', start_date='$start_date', start_time='$start_time', end_date='$end_date', end_time='$end_time', quantity=$quantity, uom='$uom', remark='$remark', cancel_reason='$cancel_reason', line_status='$line_status', group_name='$group_name', type1='$type1', type2='$type2', type3='$type3', type4='$type4', type5='$type5',  ref1='$ref1', ref2='$ref2', ref3='$ref3', ref4='$ref4', ref5='$ref5', ref6='$ref6', contact='$contact', department='$department', cost_center='$cost_center', charge_as='$charge_as', outsource_charge_as='$outsource_charge_as', diesel_rate=$diesel_rate, contract_no='$contract_no', confirm_contract='$confirm_contract', ot='$ot', modify_date = getdate(), no_charge='$no_charge', modify_by='$modify_by', ontime='$ontime' WHERE reccode='$reccode'";
$stmt = sqlsrv_query($conn, $iquery);

if($stmt === false){
    $Data["Status"] = "Error";
    $Data["msg"] = $iquery;//"มีข้อมูลซ้ำกับที่มีอยู่แล้ว";
    $Data['sql'] = $iquery;
}else{
    $Data["Status"] = "Success";
    $Data["msg"] = "Data has been updated";
}

echo json_encode($Data);

sqlsrv_close($conn);

?>