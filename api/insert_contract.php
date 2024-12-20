<?php
error_reporting(0);
require_once '../config_db.php';
require_once '../utils/helper.php';
session_start();

$fQuery = "SELECT count(1) as num FROM customer_contract";
$result = sqlsrv_query($conn, $fQuery);
$row = sqlsrv_fetch_array( $result, SQLSRV_FETCH_ASSOC);
$count_num = $row['num'] +1;

$num = "CO";

if($count_num  < 10)
    $count = "0000".$count_num;
else if($count_num  < 100)
    $count = "000".$count_num;
else if($count_num  < 1000)
    $count = "0".$count_num ;
else if($count_num  < 10000)
    $count = "0".$count_num ;
else
    $count = $count_num ;

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

$iquery = "INSERT INTO customer_contract (contract_no, contract_date, start_date, end_date, customer, customer_ref, active, status, pay_cash, diesel, rounding, diesel1, diesel2, diesel3, rounding1, payment_term, erp_contract_no, round_trip_rate, create_date,user_type) VALUES ('$contract_no', '$contract_date', '$start_date', '$end_date', '$customer', '$customer_ref', '$active', '$status', '$pay_cash', '$diesel', '$rounding', $diesel1, $diesel2, $diesel3, $rounding1, $payment_term, '$erp_contract_no', '$round_trip_rate', getdate(),'".$_SESSION["user_type"]."')";
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