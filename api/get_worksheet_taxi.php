<?php
require_once '../config_db.php';
require_once '../utils/helper.php';

$reccode = $_GET['reccode'];

$fQuery = "SELECT * FROM worksheet_taxi WHERE reccode = '$reccode'";

$result = sqlsrv_query($conn, $fQuery);
$row = sqlsrv_fetch_array( $result, SQLSRV_FETCH_ASSOC);

$raw['taxi_service_id'] = $row['taxi_service_id'];
$raw['vehicle'] = $row['vehicle'];
$raw['operator'] = $row['operator'];
$raw['transport_from'] = $row['transport_from'];
$raw['transport_to'] = $row['transport_to'];
$raw['start_date'] = date_format($row['start_date'],'Y-m-d');
$raw['start_time'] = date_format($row['start_time'],'H:i');
if(!is_null($row['end_date'])){
  $raw['end_date'] = date_format($row['end_date'],'Y-m-d');  
}
if(!is_null($row['end_time'])){
    $raw['end_time'] = date_format($row['end_time'],'H:i');
  }

$raw['quantity'] = $row['quantity'];
$raw['uom'] = $row['uom'];
$raw['remark'] = $row['remark'];
$raw['cancel_reason'] = $row['cancel_reason'];
$raw['line_status'] = $row['line_status'];
$raw['group_name'] = $row['group_name'];
$raw['type1'] = $row['type1'];
$raw['type2'] = $row['type2'];
$raw['type3'] = $row['type3'];
$raw['type4'] = $row['type4'];
$raw['type5'] = $row['type5'];
$raw['type6'] = $row['type6'];
$raw['barcode_type'] = $_POST['barcode_type'];
$raw['barcode_location'] = $_POST['barcode_location'];
$raw['barcode_brance'] = $_POST['barcode_branch'];
$raw['barcode_service'] = $_POST['barcode_name'];

$raw['ref1'] = $row['ref1'];
$raw['ref2'] = $row['ref2'];
$raw['ref3'] = $row['ref3'];
$raw['ref4'] = $row['ref4'];
$raw['ref5'] = $row['ref5'];
$raw['ref6'] = $row['ref6'];
$raw['actual_start_date'] = !is_null($row['actual_start_date'])?date_format($row['actual_start_date'],'Y-m-d'):'';
$raw['actual_start_time'] = !is_null($row['actual_start_time'])?date_format($row['actual_start_time'],'H:i'):'';
$raw['actual_finish_date'] = !is_null($row['actual_finish_date'])?date_format($row['actual_finish_date'],'Y-m-d'):'';
$raw['actual_finish_time'] = !is_null($row['actual_finish_time'])?date_format($row['actual_finish_time'],'H:i'):'';

$raw['department'] = $row['department'];
$raw['cost_center'] = $row['cost_center'];
$raw['mileage_start'] = $row['mileage_start'];
$raw['mileage_end'] = $row['mileage_end'];
$raw['contact'] = $row['contact'];
$raw['specific_location_from'] = $row['specific_location_from'];
$raw['specific_location_to'] = $row['specific_location_to'];
$raw['charge_as'] = $row['charge_as'];
$raw['outsource_charge_as'] = $row['outsource_charge_as'];
$raw['contract_no'] = $row['contract_no'];
$raw['contract_line'] = $row['contract_line'];
$raw['diesel_rate'] = $row['diesel_rate'];

$raw['reccode'] = $row['reccode'];

echo json_encode($raw);
sqlsrv_close($conn);
?>