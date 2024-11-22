<?php
require_once '../config_db.php';
require_once '../utils/helper.php';

$diesel_rate_date = $_GET['diesel_rate_date'];

$fQuery = "SELECT * FROM diesel_rate WHERE diesel_rate_date = '$diesel_rate_date'";

$result = sqlsrv_query($conn, $fQuery);

$row = sqlsrv_fetch_array( $result, SQLSRV_FETCH_ASSOC);
$raw['diesel_rate_date'] = $row['diesel_rate_date'];
$raw['diesel_rate'] = $row['diesel_rate'];

echo json_encode($raw);
sqlsrv_close($conn);
?>