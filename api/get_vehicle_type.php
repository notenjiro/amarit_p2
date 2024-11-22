<?php
require_once '../config_db.php';
require_once '../utils/helper.php';

$code = $_GET['code'];

$fQuery = "SELECT * FROM vehicle_type WHERE code = '$code'";

$result = sqlsrv_query($conn, $fQuery);

$row = sqlsrv_fetch_array( $result, SQLSRV_FETCH_ASSOC);
$raw['code'] = $row['code'];
$raw['description'] = $row['description'];
$raw['fuel_km_per_litre'] = $row['fuel_km_per_litre'];
$raw['vehicle_group'] = $row['vehicle_group'];
$raw['block_allowance'] = $row['block_allowance'];
$raw['reccode'] = $row['reccode'];


echo json_encode($raw);
sqlsrv_close($conn);
?>