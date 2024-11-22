<?php
error_reporting(0);
require_once '../config_db.php';
require_once '../utils/helper.php';

$worksheet_id = $_GET['worksheet_id'];
$customer = $_GET['customer'];

$immigration_id = $_POST['immigration_id'];
$start_date = null_val($_POST['immigration_start_date']);
$start_time = null_val($_POST['immigration_start_time']);
$end_date = null_val($_POST['immigration_end_date']);
$end_time = null_val($_POST['immigration_end_time']);
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


$location = $_POST['location'];
$branch = $_POST['branch'];
$amount = $_POST['immigration_amount'];

$immigration_number = $_POST['immigration_number'];
$description = $_POST['immigration_description'];
$expat_name = $_POST['immigration_expat_name'];
//$charge_as = //null_decimal($_POST['immigration_amount']);
$charge_as = $_POST['immigration_charge_as'];
$expat_name = $_POST['immigration_charge_as'];
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

if ($customer == 'CL0423' or $uom == 'EM/TP')
	$no_charge = 1;

$_date = $_POST['immigration_start_date'];//date('Y-m-d');
$y = date('Y', strtotime($_date)) - 2000;
$num = "IM".$y;

//$date_start = '2023-01-01';//date('Y-m-01', strtotime($_date));
//$date_end = '2023-12-31';//date('Y-m-t', strtotime($_date));
$date_start = date('Y-01-01', strtotime($_date));
$date_end = date('Y-12-31', strtotime($_date));

$fQuery = "SELECT count(1) as num FROM worksheet_immigration where start_date between '$date_start' and '$date_end'";

$result = sqlsrv_query($conn, $fQuery);
$row = sqlsrv_fetch_array( $result, SQLSRV_FETCH_ASSOC);
$count_num = $row['num'] +1;

if($count_num  < 10)
    $count = "0000".$count_num;
else if($count_num  < 100)
    $count = "000".$count_num;
else if($count_num  < 1000)
    $count = "00".$count_num ;
else if($count_num  < 10000)
    $count = "0".$count_num ;
else
    $count = $count_num ;
// $immigration_id = $num.$count;

$iquery = "INSERT INTO worksheet_immigration (barcode_type,barcode_location,branch,barcode_service,worksheet_id, customer, immigration_id, start_date, start_time, end_date, end_time, quantity, uom, remark, immigration_number, description, expat_name, amount, agreement_number, department, cost_center, line_status, group_name, type1, type2, type3, type4, type5, type6, service, ref1, ref2, ref3, ref4, ref5, ref6, create_date, no_charge,charge_as,location)
 VALUES ('$barcode_type','$barcode_location' ,'$barcode_brance','$barcode_service','$worksheet_id','$customer', '$immigration_id', $start_date, $start_time, $end_date, $end_time, $quantity, '$uom', '$remark', '$immigration_number', '$description', '$expat_name', $amount, '$agreement_number', '$department', '$cost_center', '$line_status', '$group_name', '$type1', '$type2', '$type3', '$type4', '$type5', '$type6', '$service', '$ref1', '$ref2', '$ref3', '$ref4', '$ref5', '$ref6', getdate(), '$no_charge','$charge_as','$location')";
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