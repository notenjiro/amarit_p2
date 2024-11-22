<?php
error_reporting(0);
require_once '../config_db.php';
require_once '../utils/helper.php';

$worksheet_id = $_GET['worksheet_id'];
$customer = $_GET['customer'];

$cargo_service_id = $_POST['cargo_service_id'];
$vehicle = $_POST['vehicle'];
$operator = $_POST['operator'];
$transport_from = $_POST['service_transport_from'];
$transport_to = $_POST['service_transport_to'];
$start_date = null_val($_POST['start_date']);
$start_time = null_val($_POST['start_time']);
$end_date = null_val($_POST['end_date']);
$end_time = null_val($_POST['end_time']);
$trip_type = $_POST['trip_type'];
$charge_type = $_POST['charge_type'];
$additional_charge = $_POST['additional_charge'];
$quantity = $_POST['quantity'];
$uom = $_POST['uom'];
$remark = $_POST['remark'];
$reimbursment = isset($_POST['reimbursment'])?$_POST['reimbursment']:false;

$cancel_reason = $_POST['cancel_reason'];
$line_status = $_POST['service_line_status'];

$group_name = $_POST['service_group_name'];
$type1 = $_POST['service_type1'];
$type2 = $_POST['service_type2'];
$type3 = $_POST['service_type3'];
$type4 = $_POST['service_type4'];
$type5 = $_POST['service_type5'];

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
$contact = $_POST['service_contact'];
$ref1 = $_POST['service_ref1'];
$ref2 = $_POST['service_ref2'];
$ref3 = $_POST['service_ref3'];
$ref4 = $_POST['service_ref4'];
$ref5 = $_POST['service_ref5'];
$ref6 = $_POST['service_ref6'];
$no_charge = isset($_POST['service_no_charge'])?$_POST['service_no_charge']:0;

if ($customer == 'CL0423' or $uom == 'EM/TP')
	$no_charge = 1;

// if(isset($_POST['worksheet_date']) && $_POST['worksheet_date'] != '')
//     $_date = $_POST['worksheet_date'];
// else
//     $_date = date('Y-m-d');
// $y = date('Y', strtotime($_date)) - 2000;

//start
$maxIdQuery = "SELECT MAX(cargo_service_id) AS max_id FROM worksheet_service";
$maxIdStmt = sqlsrv_query($conn, $maxIdQuery);
if ($maxIdStmt === false) {
    die("Error in fetching maximum cargo_service_id: " . print_r(sqlsrv_errors(), true));
}
$maxIdRow = sqlsrv_fetch_array($maxIdStmt, SQLSRV_FETCH_ASSOC);
$maxId = $maxIdRow['max_id'];


//$num = "SO".$y;
$currentYearSuffix = date('y');
$nextNumber = intval(substr($maxId, 4)) + 1;
$cargo_service_id = 'SO' . $currentYearSuffix . str_pad($nextNumber, 5, '0', STR_PAD_LEFT);
//endhere

//$date_start = '2023-01-01';//date('Y-m-01', strtotime($_date));
//$date_end = '2023-12-31';//date('Y-m-t', strtotime($_date));
//$date_start = date('Y-01-01', strtotime($_date));
//$date_end = date('Y-12-31', strtotime($_date));

// $fQuery = "SELECT count(1) as num FROM worksheet_service where start_date between '$date_start' and '$date_end'";

// $result = sqlsrv_query($conn, $fQuery);
// $row = sqlsrv_fetch_array( $result, SQLSRV_FETCH_ASSOC);
// $count_num = $row['num'] +1;

// if($count_num  < 10)
//     $count = "0000".$count_num;
// else if($count_num  < 100)
//     $count = "000".$count_num;
// else if($count_num  < 1000)
//     $count = "00".$count_num ;
// else if($count_num  < 10000)
//     $count = "0".$count_num ;
// else
//     $count = $count_num ;
// $cargo_service_id = $num.$count;

$iquery = "INSERT INTO worksheet_service (worksheet_id, customer, cargo_service_id, vehicle, operator, transport_from, transport_to, start_date, start_time, end_date, end_time, quantity, uom, remark, branch,
 service_number, description, description2, amount, agreement_number, department, cost_center, line_status, group_name, type1, type2, type3, type4, type5, contact, ref1, ref2, ref3, ref4, ref5, ref6,
  create_date, no_charge,reimbursment) 
VALUES ('$worksheet_id','$customer', '$cargo_service_id', '$vehicle', '$operator', '$transport_from', '$transport_to', $start_date, $start_time, $end_date, $end_time, $quantity, '$uom', '$remark', '$branch',
 '$service_number', '$description', '$description2', $amount, '$agreement_number', '$department', '$cost_center', '$line_status', '$group_name', '$type1', '$type2', '$type3', '$type4', '$type5', '$contact', '$ref1', '$ref2', '$ref3', '$ref4', '$ref5', '$ref6',
  getdate(), '$no_charge', '$reimbursment')";

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