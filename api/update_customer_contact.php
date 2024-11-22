<?php
error_reporting(1);
require_once '../config_db.php';
require_once '../utils/helper.php';

$reccode = $_POST['reccode'];
$customer_id = $_POST['customer_id'];
$contact_name = $_POST['contact_name'];
$tel = $_POST['tel'];
$email = $_POST['email'];

$iquery = "UPDATE customer_contact SET customer_id = '$customer_id', contact_name = '$contact_name', tel = '$tel', email = '$email' WHERE reccode = '$reccode'";
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