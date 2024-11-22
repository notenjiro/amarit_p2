<?php
error_reporting(0);
require_once '../config_db.php';
require_once '../utils/helper.php';

$contract_no = $_GET['contract_no'];
$customer = $_GET['customer'];
$contract_line = $_POST['promotion_contract_line'];
$description = $_POST['promotion_description'];
$discount = $_POST['promotion_discount'];

$iquery = "INSERT INTO contract_promotion (contract_no, customer, contract_line, description, discount) VALUES ('$contract_no', '$customer', '$contract_line', '$description', '$discount')";
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