<?php
session_start();
error_reporting(1);
require_once '../config_db.php';
require_once '../utils/helper.php';

$reccode = $_GET['reccode'];

$labor_service_id = $_POST['labor_service_id'];
$timesheet_no = $_POST['timesheet_no'];
$position = $_POST['position'];
$labor = $_POST['labor'];
$location = $_POST['location'];
$start_date = null_val($_POST['manpower_start_date']);
$start_time = null_val($_POST['manpower_start_time']);
$end_date = null_val($_POST['manpower_end_date']);
$end_time = null_val($_POST['manpower_end_time']);
$quantity = null_decimal($_POST['manpower_quantity']);
$uom = $_POST['manpower_uom'];
$remark = $_POST['manpower_remark'];

$cancel_reason = $_POST['manpower_cancel_reason'];
$line_status = $_POST['manpower_line_status'];

$group_name = $_POST['manpower_group_name'];
$type1 = $_POST['type1'];
$type2 = $_POST['type2'];
$type3 = $_POST['type3'];
$type4 = $_POST['type4'];
$type5 = $_POST['type5'];

$barcode_type = $_POST['barcode_type'];
$barcode_location = $_POST['location'];
$barcode_brance = $_POST['branch'];
$barcode_service = $_POST['name'];

$on_time = isset($_POST['on_time'])?$_POST['on_time']:0;
$task_list = $_POST['sub_task_name'];
$ref1 = $_POST['manpower_ref1'];
$ref2 = $_POST['manpower_ref2'];
$contact = $_POST['manpower_contact'];
$department = $_POST['manpower_department'];
$cost_center = $_POST['manpower_cost_center'];
$charge_as = $_POST['manpower_charge_as'];
$outsource_charge_as = $_POST['manpower_outsource_charge_as'];
$cost_type = $_POST['manpower_cost_type'];
$ref1 = $_POST['manpower_ref1'];
$ref2 = $_POST['manpower_ref2'];
$ref3 = $_POST['manpower_ref3'];
$ref4 = $_POST['manpower_ref4'];
$ref5 = $_POST['manpower_ref5'];
$ref6 = $_POST['manpower_ref6'];
$contract_no = $_POST['manpower_contract_no'];
$contract_no1_1 = $_POST['manpower_contract_no_1'];
$contract_line = $_POST['manpower_contract_line'];
$sub_task_name = $_POST['sub_task_name'];
$ot = isset($_POST['manpower_ot'])?$_POST['manpower_ot']:0;
$no_charge = isset($_POST['manpower_no_charge'])?$_POST['manpower_no_charge']:0;
$lumsum_charge = isset($_POST['manpower_lumsum_charge'])?$_POST['manpower_lumsum_charge']:0;
$modify_by = $_SESSION["user_name"];

if ($uom == 'EM/TP')
	$no_charge = 1;

if ($contract_no == '')
  $contract_no = $contract_no1_1;

$fQuery = "SELECT branch FROM operator where operator_id = '$labor'";
$result = sqlsrv_query($conn, $fQuery);
while($row = sqlsrv_fetch_array( $result, SQLSRV_FETCH_ASSOC)){
	$branch = $row['branch'];
}

$iquery = "UPDATE worksheet_manpower SET barcode_type = '$barcode_type',barcode_location ='$barcode_location' ,branch = '$barcode_brance',barcode_service = '$barcode_service',labor_service_id='$labor_service_id',  timesheet_no='$timesheet_no', position='$position', labor='$labor', location='$location', start_date=$start_date, start_time=$start_time, end_date=$end_date, end_time=$end_time, quantity=$quantity, uom='$uom', remark='$remark', cancel_reason='$cancel_reason', line_status='$line_status', group_name='$group_name', type1='$type1', type2='$type2', type3='$type3', type4='$type4', type5='$type5', on_time=$on_time, cost_type='$cost_type', task_list='$task_list',  contact='$contact', department='$department', cost_center='$cost_center', charge_as='$charge_as', outsource_charge_as='$outsource_charge_as', ref1='$ref1', ref2='$ref2', ref3='$ref3', ref4='$ref4', ref5='$ref5', ref6='$ref6', contract_no='$contract_no', contract_line='$contract_line', ot='$ot', modify_date = getdate(), no_charge='$no_charge', lump_sum='$lumsum_charge', modify_by='$modify_by' WHERE reccode='$reccode'";

//$iquery = "UPDATE worksheet_manpower SET labor_service_id='$labor_service_id',  timesheet_no='$timesheet_no', position='$position', labor='$labor', location='$location', start_date=$start_date, start_time=$start_time, end_date=$end_date, end_time=$end_time, quantity=$quantity, uom='$uom', remark='$remark', cancel_reason='$cancel_reason', line_status='$line_status', group_name='$group_name', type1='$type1', type2='$type2', type3='$type3', type4='$type4', type5='$type5', on_time=$on_time, cost_type='$cost_type', task_list='$task_list', branch='$branch', contact='$contact', department='$department', cost_center='$cost_center', charge_as='$charge_as', outsource_charge_as='$outsource_charge_as', ref1='$ref1', ref2='$ref2', ref3='$ref3', ref4='$ref4', ref5='$ref5', ref6='$ref6' WHERE reccode='$reccode'";

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