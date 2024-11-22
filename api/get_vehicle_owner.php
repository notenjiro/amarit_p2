<?php
require_once '../config_db.php';
require_once '../utils/helper.php';

$code = $_GET['code'];

$fQuery = "SELECT  * FROM vehicle_owner WHERE code = '$code'";

$result = sqlsrv_query($conn, $fQuery);

$row = sqlsrv_fetch_array( $result, SQLSRV_FETCH_ASSOC);
$raw['code'] = $row['code'];
$raw['description'] = $row['description'];
$raw['outsource'] = $row['outsource'];
$raw['erp_vendor_id'] = $row['erp_vendor_id'];

echo json_encode($raw);
sqlsrv_close($conn);
?>