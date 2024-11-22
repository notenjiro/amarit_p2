<?php
require_once '../config_db.php';
require_once '../utils/helper.php';

$id = $_GET['id'];

$fQuery = "SELECT  * FROM customer_contact WHERE customer_id = '$id' ";
$result = sqlsrv_query($conn, $fQuery);
$raw['data'] = array();

while($row = sqlsrv_fetch_array( $result, SQLSRV_FETCH_ASSOC)){
    $data = [$row['contact_name'],$row['tel'],$row['email'],$row['reccode']];
    array_push($raw['data'],$data);
}

echo json_encode($raw);
sqlsrv_close($conn);
?>