<?php
require_once '../config_db.php';
require_once '../utils/helper.php';

$customer = $_GET['customer'];
$position = $_GET['position'];

$fQuery = " select contract_no, contract_line from contract_hourly_rate WHERE customer = '$customer' and position = '$position' ";

$result = sqlsrv_query($conn, $fQuery);
$raw = array();
$x = 0;

while($row = sqlsrv_fetch_array( $result, SQLSRV_FETCH_ASSOC)){
	//$raw[$row['location']] = $row['location'];
	$x++;
    $raw[$row['contract_no']] = $row['contract_no'];
}

//$row = sqlsrv_fetch_array( $result, SQLSRV_FETCH_ASSOC);

//$raw['contract_no'] = $row['contract_no'];
$raw['contract_line'] = $row['contract_line'];

echo json_encode($raw);
sqlsrv_close($conn);
?>