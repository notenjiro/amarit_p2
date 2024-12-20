<?php
require_once '../config_db.php';
require_once '../utils/helper.php';

$reccode = $_GET['reccode'];

$fQuery = "SELECT * FROM contract_hourly_rate WHERE reccode = '$reccode'";

$result = sqlsrv_query($conn, $fQuery);
$row = sqlsrv_fetch_array( $result, SQLSRV_FETCH_ASSOC);

$raw['position'] = $row['position'];
$raw['universal_position'] = $row['universal_position'];
$raw['type'] = $row['type'];
$raw['normal'] = $row['normal'];
$raw['after_normal'] = $row['after_normal'];
$raw['s_normal'] = $row['s_normal'];
$raw['s_after_normal'] = $row['s_after_normal'];

$raw['monday'] = $row['monday'];
$raw['tuesday'] = $row['tuesday'];
$raw['wednesday'] = $row['wednesday'];
$raw['thursday'] = $row['thursday'];
$raw['friday'] = $row['friday'];
$raw['saturday'] = $row['saturday'];
$raw['sunday'] = $row['sunday'];

$raw['start_ship'] = date_format($row['start_ship'],'H:i');
$raw['start_break'] = date_format($row['start_break'],'H:i');
$raw['end_ship'] = date_format($row['end_ship'],'H:i');

$raw['minimum_charge'] = $row['minimum_charge'];
$raw['ot_lamsam'] = $row['ot_lamsam'];
$raw['sunday_lamsam'] = $row['sunday_lamsam'];
$raw['contract_line'] = $row['contract_line'];
$raw['lamsum_charge_rate'] = $row['lamsum_charge_rate'];

$raw['reccode'] = $row['reccode'];

echo json_encode($raw);
sqlsrv_close($conn);
?>