<?php
require_once '../config_db.php';
require_once '../utils/helper.php';

$customer = $_GET['customer'];

$fQuery = "SELECT  * FROM contract_immigration WHERE customer = '$customer'";

$result = sqlsrv_query($conn, $fQuery);
$raw = array();

while($row = sqlsrv_fetch_array( $result, SQLSRV_FETCH_ASSOC)){
    $raw[$row['description']] = $row['description'];
}

echo json_encode($raw);
sqlsrv_close($conn);
?>