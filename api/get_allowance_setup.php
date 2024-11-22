<?php
require_once '../config_db.php';
require_once '../utils/helper.php';

$reccode = $_GET['reccode'];

$fQuery = "SELECT  * FROM allowance_setup WHERE reccode = $reccode ";

$result = sqlsrv_query($conn, $fQuery);

$row = sqlsrv_fetch_array( $result, SQLSRV_FETCH_ASSOC);
$raw['reccode'] = $row['reccode'];
$raw['branch'] = $row['branch'];
$raw['position'] = $row['position'];
$raw['vehicle_type'] = $row['vehicle_type'];
$raw['benefit_type'] = $row['benefit_type'];
$raw['service'] = $row['service'];
$raw['client'] = $row['client'];

$raw['allowance_type'] = $row['allowance_type'];
$raw['trip'] = $row['trip'];
$raw['amount'] = $row['amount'];
$raw['amount2'] = $row['amount2'];
$raw['special_rate'] = $row['special_rate'];
$raw['location_from'] = $row['location_from'];
$raw['location_to'] = $row['location_to'];
$raw['special_ot_rate'] = $row['special_ot_rate'];
$raw['minimum_hours'] = $row['minimum_hours'];

echo json_encode($raw);
sqlsrv_close($conn);
?>