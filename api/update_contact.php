<?php
error_reporting(1);
require_once '../config_db.php';
require_once '../utils/helper.php';

$contact_id = $_POST['contact_id'];
$customer_name = $_POST['customer_name'];
$tel = $_POST['tel'];
$email = $_POST['email'];


$iquery = "UPDATE customer_contact SET customer_name = '$customer_name', tel = '$tel', email = '$email' WHERE reccode = '$contact_id'";
$stmt = sqlsrv_query($conn, $iquery);

if($stmt === false){
    $Data["Status"] = "Error";
    $Data["msg"] = "มีบางอย่างผิดพลาด";
}else{
    $Data["Status"] = "Success";
    $Data["msg"] = "Data has been updated";
}

echo json_encode($Data);

sqlsrv_close($conn);

?>