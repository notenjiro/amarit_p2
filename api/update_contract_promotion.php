<?php
error_reporting(0);
require_once '../config_db.php';
require_once '../utils/helper.php';

$reccode = $_GET['reccode'];

$contract_line = $_POST['promotion_contract_line'];
$description = $_POST['promotion_description'];
$discount = $_POST['promotion_discount'];

$iquery = "UPDATE contract_promotion SET contract_line='$contract_line', description='$description', discount='$discount' WHERE reccode='$reccode'";

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