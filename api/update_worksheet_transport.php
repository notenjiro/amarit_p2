<?php
session_start();
error_reporting(0);
require_once '../config_db.php';
require_once '../utils/helper.php';

$reccode = $_GET['reccode'];

$transport_id = $_POST['transport_id'];
$vehicle = $_POST['vehicle'];
$operator = $_POST['operator'];
$transport_from = $_POST['transport_from'];
$transport_to = $_POST['transport_to'];
$start_date = $_POST['start_date'];
$start_time = $_POST['start_time'];
$end_date = $_POST['end_date'];
$end_time = $_POST['end_time'];
$quantity = $_POST['quantity'];
$uom = $_POST['uom'];
$actual_finish_date = null_val($_POST['actual_finish_date']);
$actual_finish_time = null_val($_POST['actual_finish_time']);
$mileage_start = null_decimal($_POST['mileage_start']);
$mileage_end = null_decimal($_POST['mileage_end']);
$backhaul = isset($_POST['backhaul'])?$_POST['backhaul']:0;
$no_charge = isset($_POST['no_charge'])?$_POST['no_charge']:0;
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

$consolidate = isset($_POST['consolidate'])?$_POST['consolidate']:0;
$vehicle_switch = isset($_POST['vehicle_switch'])?$_POST['vehicle_switch']:0;
$outsource = isset($_POST['outsource'])?$_POST['outsource']:0;
$contract_no = $_POST['contract_no'];
$vehicle_type = $_POST['vehicle_type'];
$charge_as = $_POST['charge_as'];
$vendor = $_POST['vendor'];
$actual_start_date = null_val($_POST['actual_start_date']);
$actual_start_time = null_val($_POST['actual_start_time']);
$line_status = $_POST['transport_line_status'];
$cancel_reason = $_POST['transport_cancel_reason'];
$remark = $_POST['transport_remark'];
$ref1 = $_POST['ref1'];
$ref2 = $_POST['ref2'];
$ref3 = $_POST['ref3'];
$ref4 = $_POST['ref4'];
$ref5 = $_POST['ref5'];
$ref6 = $_POST['ref6'];
$outsource_charge_as = $_POST['outsource_charge_as'];

$branch = '';
$fQuery = "SELECT branch FROM vehicle where vehicle_id='$vehicle'";
$result = sqlsrv_query($conn, $fQuery);
while($row = sqlsrv_fetch_array( $result, SQLSRV_FETCH_ASSOC)){
	$branch = $row['branch'];
}
$barcode_type = $_POST['barcode_type'];
$barcode_location = $_POST['location'];
$barcode_brance = $_POST['branch'];
$barcode_service = $_POST['name'];

$contract_no = $_POST['contract_no1'];
$contract_no1_1 = $_POST['contract_no1_1'];
$contract_line = $_POST['contract_line1'];
$contact1 = $_POST['contact1'];
$contact2 = $_POST['contact2'];
$dimension = $_POST['dimension'];
$department = $_POST['transport_department'];
$cost_center = $_POST['transport_cost_center'];
$specific_location_from = $_POST['specific_location_from'];
$specific_location_to = $_POST['specific_location_to'];
$promotion_code = $_POST['transport_promotion_code'];
$confirm_contract = isset($_POST['transport_confirm_contract'])?$_POST['transport_confirm_contract']:0;
$standby_charge = isset($_POST['standby_charge'])?$_POST['standby_charge']:0;
$standby_no_charge = isset($_POST['standby_no_charge'])?$_POST['standby_no_charge']:0;
$transport_solution = isset($_POST['transport_solution'])?$_POST['transport_solution']:0;
$outsource_reason = $_POST['transport_outsource_reason'];
$round_trip = isset($_POST['round_trip'])?$_POST['round_trip']:0;
$lumsum_charge = isset($_POST['lumsum_charge'])?$_POST['lumsum_charge']:0;
$no_allowance = isset($_POST['no_allowance'])?$_POST['no_allowance']:0;
$modify_by = $_SESSION["user_name"];

if ($uom == 'EM/TP')
	$no_charge = 1;

if ($contract_no == '')
  $contract_no = $contract_no1_1;

$contract_description = $_POST['contract_description'];
$contract_no = $_POST['contract_number'];

$iquery = "UPDATE worksheet_cargo_transport SET  contract_description  = '$contract_description ', barcode_type = '$barcode_type',
barcode_location ='$barcode_location' ,
branch = '$barcode_brance',
barcode_service = '$barcode_service', transport_id='$transport_id', vehicle='$vehicle', operator='$operator', transport_from='$transport_from', transport_to='$transport_to',  start_date='$start_date', start_time='$start_time', end_date='$end_date', end_time='$end_time', quantity='$quantity', uom='$uom', trip_type1='$trip_type1', charge_type1='$charge_type1', additional_charge1='$additional_charge1', quantity1=$quantity1, uom1='$uom1', actual_finish_date=$actual_finish_date, actual_finish_time=$actual_finish_time, mileage_start=$mileage_start, mileage_end=$mileage_end, backhaul=$backhaul, no_charge=$no_charge, diesel_rate=$diesel_rate, consolidate=$consolidate, vehicle_switch=$vehicle_switch, outsource=$outsource, contract_no='$contract_no', vehicle_type='$vehicle_type', charge_as='$charge_as', vendor='$vendor', actual_start_date=$actual_start_date, actual_start_time=$actual_start_time, line_status='$line_status', cancel_reason='$cancel_reason', remark='$remark', ref1='$ref1', ref2='$ref2', cargo_type='$cargo_type', cargo_qty=$cargo_qty, cargo_weight=$cargo_weight, group_name='$group_name', type1='$type1', type2='$type2', type3='$type3', type4='$type4', type5='$type5', type6='$type6', outsource_charge_as='$outsource_charge_as', contract_line='$contract_line', contact1='$contact1', contact2='$contact2', dimension='$dimension', department='$department', cost_center='$cost_center', specific_location_from='$specific_location_from', specific_location_to='$specific_location_to', ref3='$ref3', ref4='$ref4', ref5='$ref5', ref6='$ref6', promotion_code='$promotion_code', confirm_contract='$confirm_contract', standby_charge='$standby_charge', transport_solution='$transport_solution', outsource_reason='$outsource_reason', round_trip='$round_trip', lumsum_charge='$lumsum_charge', modify_date = getdate(), standby_no_charge='$standby_no_charge', no_allowance='$no_allowance', modify_by='$modify_by' WHERE reccode='$reccode'";

if ($_POST['mileage_end'] < $_POST['mileage_start']){
  $Data["msg"] = "mileage is wrong, please check.";
  $stmt = false;
}else
  $stmt = sqlsrv_query($conn, $iquery);

if($stmt == false){
    $Data["Status"] = "Error";
	if ($Data["msg"] == "")
      $Data["msg"] = "Error update";
    $Data['sql'] = $iquery;
}else{
    $Data["Status"] = "Success";
    $Data["msg"] = "Data has been updated";
}

echo json_encode($Data);

sqlsrv_close($conn);

?>