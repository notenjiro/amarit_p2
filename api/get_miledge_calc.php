<?php
require_once '../config_db.php';
require_once '../utils/helper.php';

$reccode = $_GET['reccode'];

$fQuery = "SELECT * FROM miledge_calc WHERE reccode = '$reccode'";

$result = sqlsrv_query($conn, $fQuery);

$row = sqlsrv_fetch_array( $result, SQLSRV_FETCH_ASSOC);
$raw['miledge_from'] = $row['miledge_from'];
$raw['miledge_to'] = $row['miledge_to'];
$raw['qty'] = $row['qty'];
$raw['long_haul'] = $row['long_haul'];
$raw['round_trip'] = $row['round_trip'];
$raw['reccode'] = $row['reccode'];

echo json_encode($raw);
sqlsrv_close($conn);
?>