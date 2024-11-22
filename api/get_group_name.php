<?php
require_once '../config_db.php';
require_once '../utils/helper.php';

$code = $_GET['code'];

$fQuery = "SELECT * FROM group_name WHERE code = '$code'";

$result = sqlsrv_query($conn, $fQuery);

$row = sqlsrv_fetch_array( $result, SQLSRV_FETCH_ASSOC);
$raw['code'] = $row['code'];
$raw['description'] = $row['description'];
$raw['transport'] = $row['transport'];
$raw['manpower'] = $row['manpower'];
$raw['cargo_handling'] = $row['cargo_handling'];
$raw['service_other'] = $row['service_other'];
$raw['immigration'] = $row['immigration'];
$raw['taxi_service'] = $row['taxi_service'];

echo json_encode($raw);
sqlsrv_close($conn);
?>