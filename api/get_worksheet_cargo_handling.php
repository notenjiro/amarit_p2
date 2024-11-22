<?php
require_once '../config_db.php';
require_once '../utils/helper.php';

$reccode = $_GET['reccode'];

$fQuery = "SELECT * FROM worksheet_cargo_handling WHERE reccode = '$reccode'";

$result = sqlsrv_query($conn, $fQuery);
$row = sqlsrv_fetch_array( $result, SQLSRV_FETCH_ASSOC);

$raw['cargo_service_id'] = $row['cargo_service_id'];
$raw['vehicle'] = $row['vehicle'];
$raw['operator'] = $row['operator'];
$raw['transport_from'] = $row['transport_from'];
$raw['transport_to'] = $row['transport_to'];
$raw['start_date'] = is_null($row['start_date'])?"":date_format($row['start_date'],'Y-m-d');
$raw['start_time'] = is_null($row['start_time'])?"":date_format($row['start_time'],'H:i');
$raw['end_date'] = is_null($row['end_date'])?"":date_format($row['end_date'],'Y-m-d');
$raw['end_time'] = is_null($row['end_time'])?"":date_format($row['end_time'],'H:i');
$raw['trip_type'] = $row['trip_type'];
$raw['charge_type'] = $row['charge_type'];
$raw['additional_charge'] = $row['additional_charge'];
$raw['quantity'] = $row['quantity'];
$raw['uom'] = $row['uom'];
$raw['remark'] = $row['remark'];

$raw['cargo_type'] = $row['cargo_type'];
$raw['cargo_qty'] = $row['cargo_qty'];
$raw['weight'] = $row['weight'];
$raw['cancel_reason'] = $row['cancel_reason'];
$raw['line_status'] = $row['line_status'];
$raw['group_name'] = $row['group_name'];
$raw['type1'] = $row['type1'];
$raw['type2'] = $row['type2'];
$raw['type3'] = $row['type3'];
$raw['type4'] = $row['type4'];
$raw['type5'] = $row['type5'];
$raw['ref1'] = $row['ref1'];
$raw['ref2'] = $row['ref2'];
$raw['ref3'] = $row['ref3'];
$raw['ref4'] = $row['ref4'];
$raw['ref5'] = $row['ref5'];
$raw['ref6'] = $row['ref6'];
$raw['contact'] = $row['contact'];
$raw['department'] = $row['department'];
$raw['cost_center'] = $row['cost_center'];
$raw['diesel_rate'] = $row['diesel_rate'];
$raw['charge_as'] = $row['charge_as'];
$raw['outsource_charge_as'] = $row['outsource_charge_as'];
$raw['contract_no'] = $row['contract_no'];
$raw['contract_line'] = $row['contract_line'];
$raw['ot'] = $row['ot'];
$raw['no_charge'] = $row['no_charge'];
$raw['ontime'] = $row['ontime'];

$raw['reccode'] = $row['reccode'];

echo json_encode($raw);
sqlsrv_close($conn);
?>