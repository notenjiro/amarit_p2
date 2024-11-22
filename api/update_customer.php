<?php
error_reporting(1);
require_once '../config_db.php';
require_once '../utils/helper.php';

$customer_id = $_POST['customer_id'];
$erp_id = $_POST['erp_id'];
$name = $_POST['name'];
$abs = $_POST['abs'];
$address = $_POST['address'];
$address2 = $_POST['address2'];
$province = $_POST['province'];
$postcode = $_POST['postcode'];
$tel = $_POST['tel'];
$fax = $_POST['fax'];
$block = isset($_POST['block'])?$_POST['block']:0;
$remark = $_POST['remark'];

$iquery = "UPDATE customer SET customer_id = '$customer_id', erp_id = '$erp_id', name = '$name', abs = '$abs', address = '$address', address2 = '$address2', province = '$province', postcode = '$postcode', tel = '$tel', fax = '$fax', block = '$block', remark = '$remark' WHERE customer_id = '$customer_id'";
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