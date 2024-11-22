<?php
require_once '../config_db.php';
require_once '../utils/helper.php';
session_start();

$fQuery = "";

if($_SESSION["user_type"] == 'Admin'){
    $fQuery = "SELECT  a.*,b.name as customer_name FROM customer_contract a left join customer b on b.customer_id = a.customer "; 
}else{
    $fQuery = "SELECT  a.*,b.name as customer_name FROM customer_contract a left join customer b on b.customer_id = a.customer where a.user_type ='".$_SESSION["user_type"]."'"; 
}

$result = sqlsrv_query($conn, $fQuery);
$raw['data'] = array();

while($row = sqlsrv_fetch_array( $result, SQLSRV_FETCH_ASSOC)){
    $data = [$row['contract_no'],$row['contract_no'],$row['erp_contract_no'],date_format($row['contract_date'],'d/m/Y'),date_format($row['start_date'],'d/m/Y'),date_format($row['end_date'],'d/m/Y'),$row['customer_name'],$row['customer_ref'],bit_value($row['active']),$row['status'],bit_value($row['pay_cash']),bit_value($row['diesel']),bit_value($row['rounding']),$row['monday_friday'],$row['sunday_8'],$row['sunday_17']];
    array_push($raw['data'],$data);
}

echo json_encode($raw);
sqlsrv_close($conn);
?>