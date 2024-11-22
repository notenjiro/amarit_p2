<?php
error_reporting(0);
require_once '../config_db.php';
require_once '../utils/helper.php';

$worksheet_id = $_GET['worksheet_id'];
$customer = $_GET['customer'];

$transport_id = $_POST['transport_id'];
$vehicle = $_POST['vehicle'];
$operator = $_POST['operator'];
$transport_from = $_POST['transport_from'];
$transport_to = $_POST['transport_to'];
$start_date = null_val($_POST['start_date']);
$start_time = null_val($_POST['start_time']);
$end_date = null_val($_POST['end_date']);
$end_time = null_val($_POST['end_time']);
$quantity = $_POST['quantity'];
$uom = $_POST['uom'];
$actual_finish_date = null_val($_POST['actual_finish_date']);
$actual_finish_time = null_val($_POST['actual_finish_time']);
$mileage_start = null_decimal($_POST['mileage_start']);
$mileage_end = null_decimal($_POST['mileage_end']);
$backhaul = isset($_POST['backhaul']) ? $_POST['backhaul'] : false;
if ($customer == 'CL0423')
    $no_charge = 1;
else
    $no_charge = isset($_POST['no_charge']) ? $_POST['no_charge'] : 0;
$diesel_rate = null_decimal($_POST['diesel_rate']);
$trip_type1 = $_POST['trip_type1'];
$charge_type1 = $_POST['charge_type1'];
$additional_charge1 = $_POST['additional_charge1'];
$quantity1 = null_decimal($_POST['quantity1']);
$uom1 = $_POST['uom1'];
$cargo_type = $_POST['transport_cargo_type'];
$cargo_qty = null_decimal($_POST['transport_cargo_qty']);
$cargo_weight = null_decimal($_POST['transport_cargo_weight']);
$group_name = $_POST['transport_group_name'];
$type1 = $_POST['type1'];
$type2 = $_POST['type2'];
$type3 = $_POST['type3'];
$type4 = $_POST['type4'];
$type5 = $_POST['type5'];
$type6 = $_POST['type6'];

$on_time = isset($_POST['on_time']) ? $_POST['on_time'] : 0;
$cost_type = $_POST['cost_type'];
$task_list = $_POST['sub_task_name'];
$consolidate = isset($_POST['consolidate']) ? $_POST['consolidate'] : 0;
$vehicle_switch = isset($_POST['vehicle_switch']) ? $_POST['vehicle_switch'] : 0;
$outsource = isset($_POST['outsource']) ? $_POST['outsource'] : 0;
$vehicle_type = $_POST['vehicle_type'];
$charge_as = $_POST['charge_as'];
$vendor = $_POST['vendor'];
$actual_start_date = null_val($_POST['actual_start_date']);
$actual_start_time = null_val($_POST['actual_start_time']);
$line_status = 'Open'; //$_POST['line_status'];
$cancel_reason = $_POST['transport_cancel_reason'];
$remark = $_POST['transport_remark'];
$ref1 = $_POST['ref1'];
$ref2 = $_POST['ref2'];
$ref3 = $_POST['ref3'];
$ref4 = $_POST['ref4'];
$ref5 = $_POST['ref5'];
$ref6 = $_POST['ref6'];
$outsource_charge_as = $_POST['outsource_charge_as'];
$outsource_reason = $_POST['transport_outsource_reason'];

$branch = '';
$fQuery = "SELECT branch FROM vehicle where vehicle_id='$vehicle'";
$result = sqlsrv_query($conn, $fQuery);
while ($row = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC)) {
    $branch = $row['branch'];
}

$contract_description = $_POST['contract_description'];
$contract_no = $_POST['contract_number'];
$contract_line = $_POST['contract_line1'];
$contact1 = $_POST['contact1'];
$contact2 = $_POST['contact2'];
$dimension = $_POST['dimension'];
$department = $_POST['transport_department'];
$cost_center = $_POST['transport_cost_center'];
$specific_location_from = $_POST['specific_location_from'];
$specific_location_to = $_POST['specific_location_to'];
$promotion_code = $_POST['transport_promotion_code'];
$confirm_contract = isset($_POST['transport_confirm_contract']) ? $_POST['transport_confirm_contract'] : 0;
$standby_charge = isset($_POST['standby_charge']) ? $_POST['standby_charge'] : 0;
$standby_no_charge = isset($_POST['standby_no_charge']) ? $_POST['standby_no_charge'] : 0;
$transport_solution = isset($_POST['transport_solution']) ? $_POST['transport_solution'] : 0;
$round_trip = isset($_POST['round_trip']) ? $_POST['round_trip'] : 0;
$lumsum_charge = isset($_POST['lumsum_charge']) ? $_POST['lumsum_charge'] : 0;
$no_allowance = isset($_POST['no_allowance']) ? $_POST['no_allowance'] : 0;

$barcode_type = $_POST['barcode_type'];
$barcode_location = $_POST['location'];
$barcode_brance = $_POST['branch'];
$barcode_service = $_POST['name'];



if ($customer == 'CL0423' or $uom == 'EM/TP')
    $no_charge = 1;

if (isset($_POST['start_date']) && $_POST['start_date'] != '')
    $_date = $_POST['start_date'];
else
    $_date = date('Y-m-d');
$y = date('Y', strtotime($_date)) - 2000;

$num = "TP" . $y;

//$date_start = '2023-01-01';//date('Y-m-01', strtotime($_date));
//$date_end = '2023-12-31';//date('Y-m-t', strtotime($_date));
$date_start = date('Y-01-01', strtotime($_date));
$date_end = date('Y-12-31', strtotime($_date));

$fQuery = "SELECT count(1) as num FROM worksheet_cargo_transport where start_date between '$date_start' and '$date_end'";

$result = sqlsrv_query($conn, $fQuery);
$row = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC);
$count_num = $row['num'] + 1;

if ($count_num  < 10)
    $count = "0000" . $count_num;
else if ($count_num  < 100)
    $count = "000" . $count_num;
else if ($count_num  < 1000)
    $count = "00" . $count_num;
else if ($count_num  < 10000)
    $count = "0" . $count_num;
else
    $count = $count_num;
// $transport_id = $num.$count;

$iquery = "INSERT INTO worksheet_cargo_transport (contract_no,contract_description,barcode_type,barcode_location,branch,barcode_service, worksheet_id,transport_id, customer, vehicle, operator, transport_from, transport_to, start_date, start_time, end_date, end_time, quantity, uom, actual_finish_date, actual_finish_time, mileage_start, mileage_end, backhaul, no_charge, diesel_rate, consolidate, vehicle_switch, outsource, contract_no, vehicle_type, charge_as, vendor, actual_start_date, actual_start_time, line_status, cancel_reason, remark, ref1, ref2, cargo_type, cargo_qty, cargo_weight, group_name, type1, type2, type3, type4, type5, type6, outsource_charge_as, contract_line, contact1, contact2, dimension, department, cost_center, specific_location_from, specific_location_to, ref3, ref4, ref5, ref6, promotion_code, confirm_contract, standby_charge, transport_solution, outsource_reason, round_trip, lumsum_charge, create_date, standby_no_charge, no_allowance) 
VALUES ('$contract_no','$contract_description','$barcode_type',
'$barcode_location' ,
'$barcode_brance',
'$barcode_service','$worksheet_id','$transport_id', '$customer', '$vehicle', '$operator', '$transport_from', '$transport_to', $start_date, $start_time, $end_date, $end_time, $quantity, '$uom', $actual_finish_date, $actual_finish_time, $mileage_start, $mileage_end, '$backhaul', '$no_charge', $diesel_rate, '$consolidate', '$vehicle_switch', '$outsource', '$contract_no', '$vehicle_type', '$charge_as', '$vendor', $actual_start_date, $actual_start_time, '$line_status', '$cancel_reason', '$remark', '$ref1', '$ref2', '$cargo_type', $cargo_qty, $cargo_weight, '$group_name', '$type1', '$type2', '$type3', '$type4', '$type5', '$type6', '$outsource_charge_as', '$contract_line', '$contact1', '$contact2', '$dimension', '$department', '$cost_center', '$specific_location_from', '$specific_location_to', '$ref3', '$ref4', '$ref5', '$ref6', '$promotion_code', '$confirm_contract', '$standby_charge', '$transport_solution', '$outsource_reason', '$round_trip', '$lumsum_charge', getdate(), '$standby_no_charge', '$no_allowance')";
$stmt = sqlsrv_query($conn, $iquery);

if ($stmt === false) {
    $Data["Status"] = "Error";
    $Data["msg"] = $iquery; //"Data Error";
    $Data["query"] = $iquery;
} else {
    $Data["Status"] = "Success";
    $Data["msg"] = "Data has been updated";
}

echo json_encode($Data);

sqlsrv_close($conn);
