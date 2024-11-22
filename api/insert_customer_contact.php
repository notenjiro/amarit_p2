<?php
error_reporting(1);
require_once '../config_db.php';
require_once '../utils/helper.php';

$reccode = $_POST['reccode'];
$customer_id = $_POST['customer_id'];
$contact_name = $_POST['contact_name'];
$tel = $_POST['tel'];
$email = $_POST['email'];

$iquery = "INSERT INTO customer_contact (customer_id, contact_name, tel, email) VALUES ('$customer_id', '$contact_name', '$tel', '$email')";
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