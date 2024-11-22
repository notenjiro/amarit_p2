<?php
require_once '../config_db.php';
require_once '../utils/helper.php';

$reccode = $_GET['reccode'];

$fQuery = "SELECT  * FROM customer_contact WHERE reccode = '$reccode'";

$result = sqlsrv_query($conn, $fQuery);

$row = sqlsrv_fetch_array( $result, SQLSRV_FETCH_ASSOC);
$raw['customer_id'] = $row['customer_id'];
$raw['contact_name'] = $row['contact_name'];
$raw['tel'] = $row['tel'];
$raw['email'] = $row['email'];

echo json_encode($raw);
sqlsrv_close($conn);
?>