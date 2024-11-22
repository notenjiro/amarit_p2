<?php
require_once '../config_db.php';
require_once '../utils/helper.php';

$code = $_GET['code'];

$fQuery = "SELECT  * FROM day_type WHERE code = '$code'";

$result = sqlsrv_query($conn, $fQuery);

$row = sqlsrv_fetch_array( $result, SQLSRV_FETCH_ASSOC);
$raw['code'] = $row['code'];
$raw['description'] = $row['description'];
$raw['day_type'] = $row['day_type'];

echo json_encode($raw);
sqlsrv_close($conn);
?>