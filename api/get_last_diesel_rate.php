<?php
require_once '../config_db.php';
require_once '../utils/helper.php';

$date = date('Y-m-d');

$fQuery = "SELECT TOP 1 diesel_rate  FROM diesel_rates where diesel_rate_date <= '$date' order by diesel_rate_date desc";
$result = sqlsrv_query($conn, $fQuery);
$row = sqlsrv_fetch_array( $result, SQLSRV_FETCH_ASSOC);

$raw['diesel_rate'] = $row['diesel_rate'];

echo json_encode($raw);
sqlsrv_close($conn);
?>