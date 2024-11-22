<?php
error_reporting(0);
require_once '../config_db.php';
require_once '../utils/helper.php';

$contract_no = $_GET['contract_no'];
$customer = $_GET['customer'];
$location = $_POST['location'];
$universal_location = $_POST['universal_location'];
$contact1 = $_POST['contact1'];
$tel1 = $_POST['tel1'];
$contact2 = $_POST['contact2'];
$tel2 = $_POST['tel2'];
$sub_location = $_POST['sub_location'];

$iquery = "INSERT INTO contract_location (contract_no, customer, location, universal_location, contact1, tel1, contact2, tel2, sub_location) VALUES ('$contract_no', '$customer', '$location', '$universal_location', '$contact1', '$tel1', '$contact2', '$tel2', '$sub_location')";
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