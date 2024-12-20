<?php
error_reporting(0);
require_once '../config_db.php';
require_once '../utils/helper.php';

$worksheet_id = $_GET['worksheet_id'];
$customer = $_GET['customer'];

$cargo_service_id = $_POST['cargo_service_id'];
$vehicle = $_POST['cargo_vehicle'];
$operator = $_POST['operator'];
$transport_from = $_POST['cargo_transport_from'];
$transport_to = $_POST['transport_to'];
$start_date = null_val($_POST['start_date']);
$start_time = null_val($_POST['start_time']);
$end_date = null_val($_POST['end_date']);
$end_time = null_val($_POST['end_time']);
// $trip_type = $_POST['trip_type'];
// $charge_type = $_POST['charge_type'];
$additional_charge = $_POST['additional_charge'];
$quantity = $_POST['quantity'];
$uom = $_POST['uom'];
$remark = $_POST['cargo_remark'];

$cargo_type = $_POST['cargo_type'];
$cargo_qty = $_POST['cargo_qty'];
$weight = $_POST['weight'];
$cancel_reason = $_POST['cancel_reason'];
$line_status = 'Open';//$_POST['line_status'];

$group_name = $_POST['cargo_group_name'];
$type1 = $_POST['type1'];
$type2 = $_POST['type2'];
$type3 = $_POST['type3'];
$type4 = $_POST['type4'];
$type5 = $_POST['type5'];
$type6 = $_POST['type6'];
$contract_no = $_POST['contract_number'];
$contract_description = $_POST['contract_description'];

$barcode_type = $_POST['barcode_type'];
$barcode_location = $_POST['location'];
$barcode_brance = $_POST['branch'];
$barcode_service = $_POST['name'];


$contact = $_POST['crago_handling_contact'];
$department = $_POST['cargo_department'];
$cost_center = $_POST['cargo_cost_center'];
$ref1 = $_POST['cargo_ref1'];
$ref2 = $_POST['cargo_ref2'];
$ref3 = $_POST['cargo_ref3'];
$ref4 = $_POST['cargo_ref4'];
$ref5 = $_POST['cargo_ref5'];
$ref6 = $_POST['cargo_ref6'];
$charge_as = $_POST['cargo_charge_as'];
$outsource_charge_as = $_POST['cargo_outsource_charge_as'];
$ot = isset($_POST['cargo_ot'])?$_POST['cargo_ot']:0;
$no_charge = isset($_POST['cargo_no_charge'])?$_POST['cargo_no_charge']:0;
$ontime = isset($_POST['cargo_ontime'])?$_POST['cargo_ontime']:0;

if ($customer == 'CL0423' or $uom == 'EM/TP')
	$no_charge = 1;

$fQuery = "SELECT branch FROM vehicle where vehicle_id='$vehicle'";
$result = sqlsrv_query($conn, $fQuery);
while($row = sqlsrv_fetch_array( $result, SQLSRV_FETCH_ASSOC)){
	$branch = $row['branch'];
}


if(isset($_POST['start_date']) && $_POST['start_date'] != '')
    $_date = $_POST['start_date'];
else
    $_date = date('Y-m-d');
$y = date('Y', strtotime($_date)) - 2000;

$num = "CH".$y;

//$date_start = '2023-01-01';//date('Y-m-01', strtotime($_date));
//$date_end = '2023-12-31';//date('Y-m-t', strtotime($_date));
$date_start = date('Y-01-01', strtotime($_date));
$date_end = date('Y-12-31', strtotime($_date));

$fQuery = "SELECT count(1) as num FROM worksheet_cargo_handling where start_date between '$date_start' and '$date_end'";

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
// $cargo_service_id = $num.$count;

$iquery = "INSERT INTO worksheet_cargo_handling (barcode_type,barcode_location,branch,barcode_service,
worksheet_id, customer, cargo_service_id, vehicle, operator, transport_from, transport_to, start_date, start_time, end_date, end_time,additional_charge, quantity, uom, remark, group_name, type1, type2, type3, type4, type5, type6, contact, department, cost_center, ref1, ref2, ref3, ref4, ref5, ref6, charge_as, outsource_charge_as, line_status, ot, create_date, no_charge, ontime,contract_no) 
VALUES ('$barcode_type','$barcode_location' ,'$barcode_brance','$barcode_service',
'$worksheet_id','$customer', '$cargo_service_id', '$vehicle', '$operator', '$transport_from', '$transport_to', $start_date, $start_time, $end_date, $end_time,'$additional_charge', '$quantity', '$uom', '$remark', '$group_name', '$type1', '$type2', '$type3', '$type4', '$type5', '$type6',  '$contact', '$department', '$cost_center', '$ref1', '$ref2', '$ref3', '$ref4', '$ref5', '$ref6', '$charge_as', '$outsource_charge_as', '$line_status', '$ot', getdate(), '$no_charge', '$ontime','$contract_no')";
$stmt = sqlsrv_query($conn, $iquery);
// --   '$trip_type', '$charge_type', 

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