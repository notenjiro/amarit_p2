<?php
require_once '../config_db.php';
require_once '../utils/helper.php';

$customer = $_GET['customer'];
$contract = $_GET['contract'];

if ($contract == '')
  $fQuery = "SELECT  * FROM contract_promotion WHERE customer = '$customer' ";
else
  $fQuery = "SELECT  * FROM contract_promotion WHERE customer = '$customer' and contract_no = '$contract' ";
  //$fQuery = "SELECT  * FROM contract_promotion WHERE customer = '$customer' ";

$result = sqlsrv_query($conn, $fQuery);
$raw = array();

while($row = sqlsrv_fetch_array( $result, SQLSRV_FETCH_ASSOC)){
    $raw[$row['description']] = $row['description'];
}

echo json_encode($raw);
sqlsrv_close($conn);
?>