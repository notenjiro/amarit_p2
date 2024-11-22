<?php
error_reporting(0);
require_once '../config_db.php';
require_once '../utils/helper.php';

$reccode = $_GET['reccode'];

$location = $_POST['location'];
$universal_location = $_POST['universal_location'];
$contact1 = $_POST['contact1'];
$tel1 = $_POST['tel1'];
$contact2 = $_POST['contact2'];
$tel2 = $_POST['tel2'];
$sub_location = $_POST['sub_location'];
$post_code = $_POST['post_code'];

$iquery = "UPDATE contract_location SET location='$location', universal_location='$universal_location', contact1='$contact1', tel1='$tel1', contact2='$contact2', tel2='$tel2', sub_location='$sub_location', post_code='$post_code' WHERE reccode='$reccode'";
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