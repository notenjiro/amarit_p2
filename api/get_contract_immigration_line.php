<?php
require_once '../config_db.php';
require_once '../utils/helper.php';

$customer = $_GET['customer'];
$service = $_GET['service'];


$fQuery = " select a.contract_no, a.contract_line, b.erp_contract_no from contract_immigration a left join customer_contract b on b.contract_no = a.contract_no WHERE b.customer = '$customer' and description = '$service'  ";

$result = sqlsrv_query($conn, $fQuery);
$raw = array();
$x = 0;

while($row = sqlsrv_fetch_array( $result, SQLSRV_FETCH_ASSOC)){
	$x++;
    $raw['contract_no'] = $row['contract_no'];
	$raw['contract_line'] = $row['contract_line'];
}

echo json_encode($raw);
sqlsrv_close($conn);
?>