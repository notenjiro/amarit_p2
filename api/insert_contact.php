<?php
error_reporting(1);
require_once '../config_db.php';
require_once '../utils/helper.php';

$id = $_GET['id'];

$contact_name = $_POST['contact_name'];
$tel = $_POST['tel'];
$email = $_POST['email'];

$iquery = "INSERT INTO customer_contact (customer_id, contact_name, tel, email) VALUES ('$id', '$contact_name', '$tel', '$email')";
$stmt = sqlsrv_query($conn, $iquery);

if($stmt === false){
    $Data['qr'] = $iquery;
    $Data["Status"] = "Error";
    $Data["msg"] = "มีข้อมูลซ้ำกับที่มีอยู่แล้ว";
}else{
    $Data["Status"] = "Success";
    $Data["msg"] = "Data has been updated";
}

echo json_encode($Data);

sqlsrv_close($conn);

?>