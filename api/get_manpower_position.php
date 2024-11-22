<?php
require_once '../config_db.php';
require_once '../utils/helper.php';

$position = $_GET['position'];

$fQuery = "SELECT  * FROM contract_hourly_rate WHERE position = '$position'";

$result = sqlsrv_query($conn, $fQuery);

$row = sqlsrv_fetch_array( $result, SQLSRV_FETCH_ASSOC);
$raw['universal_position'] = $row['universal_position'];

echo json_encode($raw);
sqlsrv_close($conn);
?>