<?php
error_reporting(0);
require_once '../config_db.php';
require_once '../utils/helper.php';

$contract_no = $_POST['contract_no'];
$contract_date = $_POST['contract_date'];
$start_date = $_POST['start_date'];
$end_date = $_POST['end_date'];
$customer = $_POST['customer'];
$customer_ref = $_POST['customer_ref'];
$active = $_POST['active'];
$status = $_POST['status'];
$pay_cash = $_POST['pay_cash'];
$diesel = $_POST['diesel'];
$rounding = $_POST['rounding'];
$erp_contract_no = $_POST['erp_contract_no'];

$diesel1 = null_decimal($_POST['diesel1']);
$diesel2 = null_decimal($_POST['diesel2']);
$diesel3 = null_decimal($_POST['diesel3']);
$rounding1 = null_decimal($_POST['rounding1']);
$payment_term = null_decimal($_POST['payment_term']);
$round_trip_rate = $_POST['round_trip_rate'];

if ($round_trip_rate > 0) {
	$r_rate = 1+($_POST['round_trip_rate']/100);
	$fQuery = "update contract_transportation_rate set round_trip_rate = $r_rate*transportation_rate  where contract_no='$contract_no'";
	$result = sqlsrv_query($conn, $fQuery);
}

$iquery = "UPDATE customer_contract SET contract_date='$contract_date', start_date='$start_date', end_date='$end_date', customer='$customer', customer_ref='$customer_ref', active='$active', status='$status', pay_cash='$pay_cash', diesel='$diesel', rounding='$rounding', diesel1=$diesel1, diesel2=$diesel2, diesel3=$diesel3, rounding1=$rounding1, payment_term=$payment_term, erp_contract_no='$erp_contract_no',round_trip_rate='$round_trip_rate' WHERE contract_no = '$contract_no'";
$stmt = sqlsrv_query($conn, $iquery);

if($stmt === false){
    $Data["Status"] = "Error";
    $Data["msg"] = "มีข้อมูลซ้ำกับที่มีอยู่แล้ว";
}else{
    $Data["Status"] = "Success";
    $Data["msg"] = "Data has been updated";
}

echo json_encode($Data);

sqlsrv_close($conn);

?>