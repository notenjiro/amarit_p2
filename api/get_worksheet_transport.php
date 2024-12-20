<?php
require_once '../config_db.php';
require_once '../utils/helper.php';

$reccode = $_GET['reccode'];

$fQuery = "SELECT * FROM worksheet_cargo_transport WHERE reccode = '$reccode'";

$result = sqlsrv_query($conn, $fQuery);
$row = sqlsrv_fetch_array( $result, SQLSRV_FETCH_ASSOC);

$raw['transport_id'] = $row['transport_id'];
$raw['vehicle'] = $row['vehicle'];
$raw['operator'] = $row['operator'];
$raw['transport_from'] = $row['transport_from'];
$raw['transport_to'] = $row['transport_to'];
$raw['start_date'] = !is_null($row['start_date'])?date_format($row['start_date'],'Y-m-d'):''; 
$raw['start_time'] = !is_null($row['start_time'])?date_format($row['start_time'],'H:i'):''; 
$raw['end_date'] = !is_null($row['end_date'])?date_format($row['end_date'],'Y-m-d'):''; 
$raw['end_time'] = !is_null($row['end_time'])?date_format($row['end_time'],'H:i'):''; 
$raw['quantity'] = $row['quantity'];
$raw['uom'] = $row['uom'];
$raw['actual_finish_date'] = !is_null($row['actual_finish_date'])?date_format($row['actual_finish_date'],'Y-m-d'):'';
$raw['actual_finish_time'] = !is_null($row['actual_finish_time'])?date_format($row['actual_finish_time'],'H:i'):'';
$raw['mileage_start'] = $row['mileage_start'];
$raw['mileage_end'] = $row['mileage_end'];
$raw['backhaul'] = $row['backhaul'];
$raw['no_charge'] = $row['no_charge'];
$raw['diesel_rate'] = $row['diesel_rate'];
$raw['trip_type1'] = $row['trip_type1'];
$raw['charge_type1'] = $row['charge_type1'];
$raw['additional_charge1'] = $row['additional_charge1'];
$raw['quantity1'] = $row['quantity1'];
$raw['uom1'] = $row['uom1'];
$raw['consolidate'] = $row['consolidate'];
$raw['vehicle_switch'] = $row['vehicle_switch'];
$raw['outsource'] = $row['outsource'];
$raw['vehicle_type'] = $row['vehicle_type'];
$raw['charge_as'] = $row['charge_as'];
$raw['vendor'] = $row['vendor'];
$raw['actual_start_date'] = !is_null($row['actual_start_date'])?date_format($row['actual_start_date'],'Y-m-d'):'';
$raw['actual_start_time'] = !is_null($row['actual_start_time'])?date_format($row['actual_start_time'],'H:i'):'';
$raw['line_status'] = $row['line_status'];
$raw['cancel_reason'] = $row['cancel_reason'];
$raw['remark'] = $row['remark'];
$raw['ref1'] = $row['ref1'];
$raw['ref2'] = $row['ref2'];
$raw['ref3'] = $row['ref3'];
$raw['ref4'] = $row['ref4'];
$raw['ref5'] = $row['ref5'];
$raw['ref6'] = $row['ref6'];
$raw['cargo_type'] = $row['cargo_type'];
$raw['cargo_qty'] = $row['cargo_qty'];
$raw['cargo_weight'] = $row['cargo_weight'];
$raw['group_name'] = $row['group_name'];
$raw['type1'] = $row['type1'];
$raw['type2'] = $row['type2'];
$raw['type3'] = $row['type3'];
$raw['type4'] = $row['type4'];
$raw['type5'] = $row['type5'];
$raw['type6'] = $row['type6'];
$raw['barcode_type'] = $row['barcode_type'];
$raw['barcode_location'] = $row['barcode_location'];
$raw['barcode_branch'] =$row['barcode_branch'];
$raw['barcode_service'] = $row['barcode_service'];
$raw['contract_description'] = $row['contract_description'];

$raw['outsource_charge_as'] = $row['outsource_charge_as'];
$raw['contract_no'] = $row['contract_no'];
$raw['contract_line'] = $row['contract_line'];
$raw['contact1'] = $row['contact1'];
$raw['contact2'] = $row['contact2'];
$raw['dimension'] = $row['dimension'];
$raw['department'] = $row['department'];
$raw['cost_center'] = $row['cost_center'];
$raw['specific_location_from'] = $row['specific_location_from'];
$raw['specific_location_to'] = $row['specific_location_to'];
$raw['promotion_code'] = $row['promotion_code'];
$raw['confirm_contract'] = $row['confirm_contract'];
$raw['standby_charge'] = $row['standby_charge'];
$raw['standby_no_charge'] = $row['standby_no_charge'];
$raw['transport_solution'] = $row['transport_solution'];
$raw['outsource_reason'] = $row['outsource_reason'];
$raw['round_trip'] = $row['round_trip'];
$raw['lumsum_charge'] = $row['lumsum_charge'];
$raw['no_allowance'] = $row['no_allowance'];

$raw['reccode'] = $row['reccode'];

echo json_encode($raw);
sqlsrv_close($conn);
?>