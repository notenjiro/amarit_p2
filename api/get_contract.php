<?php
require_once '../config_db.php';
require_once '../utils/helper.php';

$contract_no = $_GET['contract_no'];

$fQuery = "SELECT * FROM customer_contract WHERE contract_no = '$contract_no'";

$result = sqlsrv_query($conn, $fQuery);
$row = sqlsrv_fetch_array( $result, SQLSRV_FETCH_ASSOC);

$raw['contract_no'] = $row['contract_no'];
$raw['contract_date'] = date_format($row['contract_date'],'Y-m-d');
$raw['start_date'] = date_format($row['start_date'],'Y-m-d');
$raw['end_date'] = date_format($row['end_date'],'Y-m-d');
$raw['customer'] = $row['customer'];
$raw['customer_ref'] = $row['customer_ref'];
$raw['active'] = $row['active'];
$raw['status'] = $row['status'];
$raw['pay_cash'] = $row['pay_cash'];
$raw['diesel'] = $row['diesel'];
$raw['rounding'] = $row['rounding'];
$raw['monday_friday'] = $row['monday_friday'];
$raw['sunday_8'] = $row['sunday_8'];
$raw['sunday_17'] = $row['sunday_17'];
$raw['diesel1'] = $row['diesel1'];
$raw['diesel2'] = $row['diesel2'];
$raw['diesel3'] = $row['diesel3'];
$raw['rounding1'] = $row['rounding1'];
$raw['payment_term'] = $row['payment_term'];
$raw['erp_contract_no'] = $row['erp_contract_no'];
$raw['round_trip_rate'] = $row['round_trip_rate'];
$raw['create_date'] = date_format($row['create_date'],'Y-m-d');

echo json_encode($raw);
sqlsrv_close($conn);
?>