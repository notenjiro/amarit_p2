<?php
require_once '../config_db.php';
require_once '../utils/helper.php';

$code = $_GET['code'];

$fQuery = " SELECT  * FROM contract_location_master WHERE reccode = '$code' ";

$result = sqlsrv_query($conn, $fQuery);

$row = sqlsrv_fetch_array( $result, SQLSRV_FETCH_ASSOC);
$raw['reccode'] = $row['reccode'];
$raw['location'] = $row['location'];
$raw['universal_location'] = $row['universal_location'];
$raw['sub_location'] = $row['sub_location'];
$raw['post_code'] = $row['post_code'];

echo json_encode($raw);
sqlsrv_close($conn);
?>