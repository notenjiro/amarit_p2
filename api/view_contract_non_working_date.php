<?php
require_once '../config_db.php';
require_once '../utils/helper.php';

$contract_no = $_GET['contract_no'];

$fQuery = "SELECT  * FROM contract_non_working_date WHERE contract_no = '$contract_no' order by convert(date,non_working_date) ";
$result = sqlsrv_query($conn, $fQuery);
$raw['data'] = array();

while($row = sqlsrv_fetch_array( $result, SQLSRV_FETCH_ASSOC)){
    $data = [$row['reccode'], date_format($row['non_working_date'],'d/m/Y'), $row['holiday_name'], $row['reccode'],date_format($row['non_working_date'],'Y-m-d')];
    array_push($raw['data'],$data);
}

echo json_encode($raw);
sqlsrv_close($conn);
?>