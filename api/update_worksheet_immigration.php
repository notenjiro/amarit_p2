<?php
session_start();
error_reporting(0);
require_once '../config_db.php';
require_once '../utils/helper.php';

$reccode = $_GET['reccode'];

$immigration_id = $_POST['immigration_id'];
$start_date = $_POST['immigration_start_date'];
$start_time = $_POST['immigration_start_time'];
$end_date = $_POST['immigration_end_date'];
$end_time = $_POST['immigration_end_time'];
$quantity = $_POST['immigration_quantity'];
$uom = $_POST['immigration_uom'];
$remark = $_POST['immigration_remark'];

$cancel_reason = $_POST['immigration_cancel_reason'];
$line_status = $_POST['immigration_line_status'];

$group_name = $_POST['immigration_group_name'];
$type1 = $_POST['type1'];
$type2 = $_POST['type2'];
$type3 = $_POST['type3'];
$type4 = $_POST['type4'];
$type5 = $_POST['type5'];
$type6 = $_POST['type6'];

$barcode_type = $_POST['barcode_type'];
$barcode_location = $_POST['location'];
$barcode_brance = $_POST['branch'];
$barcode_service = $_POST['name'];


$immigration_number = $_POST['immigration_number'];
$description = $_POST['immigration_description'];
$expat_name = $_POST['immigration_expat_name'];
$amount = null_decimal($_POST['taxi_amont_system']);
$agreement_number = $_POST['immigration_agreement_number'];
$department = $_POST['immigration_department'];
$cost_center = $_POST['immigration_cost_center'];
$ref1 = $_POST['immigration_ref1'];
$ref2 = $_POST['immigration_ref2'];
$ref3 = $_POST['immigration_ref3'];
$ref4 = $_POST['immigration_ref4'];
$ref5 = $_POST['immigration_ref5'];
$ref6 = $_POST['immigration_ref6'];
$service = $_POST['immigration_service'];
$no_charge = isset($_POST['immigration_no_charge'])?$_POST['immigration_no_charge']:0;
$reimbursment = isset($_POST['immigration_reimbursment'])?$_POST['immigration_reimbursment']:false;
$modify_by = $_SESSION["user_name"];

if ($uom == 'EM/TP')
	$no_charge = 1;

$iquery = "UPDATE worksheet_immigration SET barcode_type = '$barcode_type',barcode_location ='$barcode_location' ,branch = '$barcode_brance',barcode_service = '$barcode_service',immigration_id='$immigration_id', start_date='$start_date', start_time='$start_time', end_date='$end_date', end_time='$end_time', quantity=$quantity, uom='$uom', remark='$remark', cancel_reason='$cancel_reason', line_status='$line_status', group_name='$group_name', type1='$type1', type2='$type2', type3='$type3', type4='$type4', type5='$type5', type6='$type6', ref1='$ref1', ref2='$ref2', ref3='$ref3', ref4='$ref4', ref5='$ref5', ref6='$ref6', immigration_number='$immigration_number', description='$description', expat_name='$expat_name', agreement_number='$agreement_number', department='$department', cost_center='$cost_center', service='$service', modify_date = getdate(), no_charge='$no_charge', reimbursment='$reimbursment', modify_by='$modify_by' WHERE reccode='$reccode'";


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