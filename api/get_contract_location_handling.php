<?php
require_once '../config_db.php';
require_once '../utils/helper.php';

$customer = $_GET['customer'];

$fQuery = "SELECT branch FROM contract_equipment_rental WHERE customer = '$customer' group by branch ";

$result = sqlsrv_query($conn, $fQuery);
$raw = array();

while($row = sqlsrv_fetch_array( $result, SQLSRV_FETCH_ASSOC)){
    $raw[$row['branch']] = $row['branch'];
}

echo json_encode($raw);
sqlsrv_close($conn);
?>