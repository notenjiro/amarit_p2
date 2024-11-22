<?php
error_reporting(0);
require_once '../config_db.php';
require_once '../utils/helper.php';

$worksheet_id = $_GET['worksheet_id'];
$customer = $_GET['customer'];

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
$type6 = $_POST['type6'];
$barcode_type = $_POST['barcode_type'];
$barcode_location = $_POST['location'];
$barcode_brance = $_POST['branch'];
$barcode_service = $_POST['name'];


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
$contract_line = $_POST['manpower_contract_line'];
$sub_task_name = $_POST['sub_task_name'];
$ot = isset($_POST['manpower_ot'])?$_POST['manpower_ot']:0;
$no_charge = isset($_POST['manpower_no_charge'])?$_POST['manpower_no_charge']:0;
$lumsum_charge = isset($_POST['manpower_lumsum_charge'])?$_POST['manpower_lumsum_charge']:0;

if ($customer == 'CL0423' or $uom == 'EM/TP')
	$no_charge = 1;

$fQuery = "SELECT branch FROM operator where operator_id = '$labor'";
$result = sqlsrv_query($conn, $fQuery);
while($row = sqlsrv_fetch_array( $result, SQLSRV_FETCH_ASSOC)){
	$branch = $row['branch'];
}

if(isset($_POST['manpower_start_date']) && $_POST['manpower_start_date'] != '')
    $_date = $_POST['manpower_start_date'];
else
    $_date = date('Y-m-d');

$y = date('Y', strtotime($_date)) - 2000;
$num = "LS".$y;

//$date_start = '2023-01-01';//date('Y-m-01', strtotime($_date));
//$date_end = '2023-12-31';//date('Y-m-t', strtotime($_date));
$date_start = date('Y-01-01', strtotime($_date));
$date_end = date('Y-12-31', strtotime($_date));

$fQuery = "SELECT count(1) as num FROM worksheet_manpower where start_date between '$date_start' and '$date_end'";

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
$labor_service_id = $num.$count;

$iquery = "INSERT INTO worksheet_manpower (barcode_type,barcode_location,branch,barcode_service,worksheet_id, customer, labor_service_id, timesheet_no, position, labor, location, start_date, start_time, end_date, end_time, quantity, uom, remark, cancel_reason, line_status, group_name, type1, type2, type3, type4, type5,  contact, department, cost_center, charge_as, outsource_charge_as, cost_type, ref1, ref2, ref3, ref4, ref5, ref6, contract_no, contract_line, task_list, ot, create_date, no_charge) 
VALUES ('$barcode_type','$barcode_location' ,'$barcode_brance','$barcode_service','$worksheet_id','$customer', '$labor_service_id', '$timesheet_no', '$position', '$labor', '$location', $start_date, $start_time, $end_date, $end_time, $quantity, '$uom', '$remark', '$cancel_reason', '$line_status', '$group_name', '$type1', '$type2', '$type3', '$type4', '$type5', '$contact', '$department', '$cost_center', '$charge_as', '$outsource_charge_as', '$cost_type', '$ref1', '$ref2', '$ref3', '$ref4', '$ref5', '$ref6', '$contract_no', '$contract_line', '$sub_task_name', '$ot', getdate(), '$no_charge')";
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