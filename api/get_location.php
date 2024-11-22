<?php
require_once '../config_db.php';
require_once '../utils/helper.php';

$code = $_GET['code'];

$fQuery = "SELECT  * FROM location WHERE code = '$code'";

$result = sqlsrv_query($conn, $fQuery);

$row = sqlsrv_fetch_array( $result, SQLSRV_FETCH_ASSOC);
$raw['code'] = $row['code'];
$raw['description'] = $row['description'];
$raw['zipcode'] = $row['zipcode'];
$raw['amarit_location'] = $row['amarit_location'];
$raw['department'] = $row['department'];
$raw['cost_center'] = $row['cost_center'];

echo json_encode($raw);
sqlsrv_close($conn);
?>