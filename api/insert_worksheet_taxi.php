<?php
error_reporting(0);
require_once '../config_db.php';
require_once '../utils/helper.php';

$worksheet_id = $_GET['worksheet_id'];
$customer = $_GET['customer'];

$taxi_service_id = $_POST['taxi_service_id'];
$vehicle = $_POST['taxi_vehicle'];
$operator = $_POST['taxi_operator'];
$transport_from = $_POST['taxi_from'];
$transport_to = $_POST['taxi_to'];
$start_date = null_val($_POST['taxi_start_date']);
$start_time = null_val($_POST['taxi_start_time']);
$end_date = null_val($_POST['taxi_end_date']);
$end_time = null_val($_POST['taxi_end_time']);
$quantity = null_decimal($_POST['taxi_quantity']);
$quantity = $_POST['taxi_quantity'];
$uom = $_POST['taxi_uom'];
$remark = $_POST['taxi_remark'];

$cancel_reason = $_POST['taxi_cancel_reason'];
$line_status = $_POST['taxi_line_status'];

$group_name = $_POST['taxi_roup_name'];
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


$fQuery = "SELECT branch FROM vehicle where vehicle_id='$vehicle'";
$result = sqlsrv_query($conn, $fQuery);
while($row = sqlsrv_fetch_array( $result, SQLSRV_FETCH_ASSOC)){
	$branch = $row['branch'];
}

$department = $_POST['taxi_department'];
$cost_center = $_POST['taxi_cost_center'];
$ref1 = $_POST['taxi_ref1'];
$ref2 = $_POST['taxi_ref2'];
$ref3 = $_POST['taxi_ref3'];
$ref4 = $_POST['taxi_ref4'];
$ref5 = $_POST['taxi_ref5'];
$ref6 = $_POST['taxi_ref6'];
$specific_location_from = $_POST['taxi_specific_location_from'];
$specific_location_to = $_POST['taxi_specific_location_to'];
$charge_as = $_POST['taxi_charge_as'];
$amount = null_decimal($_POST['taxi_amont_system']);
$outsource_charge_as = $_POST['taxi_outsource_charge_as'];
$contact = $_POST['taxi_contact'];
$contract_no = $_POST['taxi_contract'];
$contract_line = $_POST['taxi_contract_line'];
$diesel_rate = null_decimal($_POST['taxi_diesel_rate']);
$mileage_start = null_decimal($_POST['taxi_mileage_start']);
$mileage_end = null_decimal($_POST['taxi_mileage_end']);
$no_charge = isset($_POST['taxi_no_charge'])?$_POST['taxi_no_charge']:0;

if ($customer == 'CL0423' or $uom == 'EM/TP')
	$no_charge = 1;

if(isset($_POST['taxi_start_date']) && $_POST['taxi_start_date'] != '')
    $_date = $_POST['taxi_start_date'];
else
    $_date = date('Y-m-d');
$y = date('Y', strtotime($_date)) - 2000;

$num = "TX".$y;

//$date_start = '2023-01-01';//date('Y-m-01', strtotime($_date));
//$date_end = '2023-12-31';//date('Y-m-t', strtotime($_date));
$date_start = date('Y-01-01', strtotime($_date));
$date_end = date('Y-12-31', strtotime($_date));

$fQuery = "SELECT count(1) as num FROM worksheet_taxi where start_date between '$date_start' and '$date_end'";

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
$taxi_service_id = $num.$count;

$iquery = "INSERT INTO worksheet_taxi (barcode_type,barcode_location,branch,barcode_service,worksheet_id, customer, taxi_service_id, vehicle, operator, transport_from, transport_to, start_date, start_time, end_date, end_time, quantity, uom, remark,service_number, description, description2, agreement_number, department, cost_center, line_status, group_name, type1, type2, type3, type4, type5, type6, ref1, ref2, ref3, ref4, ref5, ref6, specific_location_from, specific_location_to, charge_as, outsource_charge_as, contact, contract_no, contract_line, diesel_rate, create_date, mileage_start, mileage_end, no_charge,amount)
 VALUES ('$barcode_type','$barcode_location' ,'$barcode_brance','$barcode_service','$worksheet_id','$customer', '$taxi_service_id', '$vehicle', '$operator', '$transport_from', '$transport_to', $start_date, $start_time, $end_date, $end_time, $quantity, '$uom', '$remark',  '$service_number', '$description', '$description2', '$agreement_number', '$department', '$cost_center', '$line_status', '$group_name', '$type1', '$type2', '$type3', '$type4', '$type5','$type6', '$ref1', '$ref2', '$ref3', '$ref4', '$ref5', '$ref6', '$specific_location_from', '$specific_location_to', '$charge_as', '$outsource_charge_as', '$contact', '$contract_no', '$contract_line', $diesel_rate, getdate(), $mileage_start, $mileage_end, $no_charge,$amount)";

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