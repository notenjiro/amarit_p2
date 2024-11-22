<?php
require_once '../config_db.php';
require_once '../utils/helper.php';

$contract_no = $_GET['contract_no'];

$fQuery = "SELECT  * FROM contract_immigration WHERE contract_no = '$contract_no'";
$result = sqlsrv_query($conn, $fQuery);
$raw['data'] = array();

while($row = sqlsrv_fetch_array( $result, SQLSRV_FETCH_ASSOC)){
    $data = [$row['reccode'], $row['contract_line'], $row['description'], $row['unit_price'], $row['uom']];
    array_push($raw['data'],$data);
}

echo json_encode($raw);
sqlsrv_close($conn);
?>