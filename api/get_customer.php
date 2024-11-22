<?php
require_once '../config_db.php';
require_once '../utils/helper.php';

$customer_id = $_GET['customer_id'];
$concuserp = sqlsrv_connect( $serverName, $connectionInfo);

$fQuery = "SELECT  * FROM customer WHERE customer_id = '$customer_id'";

$result = sqlsrv_query($concuserp, $fQuery);

$row = sqlsrv_fetch_array( $result, SQLSRV_FETCH_ASSOC);
$raw['customer_id'] = $row['customer_id'];
$raw['erp_id'] = $row['erp_id'];
$raw['name'] = $row['name'];
$raw['abs'] = $row['abs'];
$raw['address'] = $row['address'];
$raw['address2'] = $row['address2'];
$raw['province'] = $row['province'];
$raw['postcode'] = $row['postcode'];
$raw['tel'] = $row['tel'];
$raw['fax'] = $row['fax'];
$raw['block'] = $row['block'];
$raw['remark'] = $row['remark'];

echo json_encode($raw);
sqlsrv_close($concuserp);
?>