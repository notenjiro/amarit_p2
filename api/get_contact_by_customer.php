<?php
require_once '../config_db.php';
require_once '../utils/helper.php';

$customer_id = $_GET['customer_id'];

$fQuery = "SELECT reccode,contact_name FROM customer_contact WHERE customer_id='$customer_id'";

$result = sqlsrv_query($conn, $fQuery);
$raw = array();

while($row = sqlsrv_fetch_array( $result, SQLSRV_FETCH_ASSOC)){
    $raw[$row['reccode']] = $row['contact_name'];
}

echo json_encode($raw);
sqlsrv_close($conn);
?>