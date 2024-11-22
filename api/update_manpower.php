<?php
error_reporting(1);
require_once '../config_db.php';
require_once '../utils/helper.php';

$manpower_id = $_POST['manpower_id'];
$name = $_POST['name'];
$lastname = $_POST['lastname'];
$position = $_POST['position'];
$skill = $_POST['skill'];
$company = $_POST['company'];
$outsource = $_POST['outsource'];
//$day_off = $_POST['day_off'];
$tel = $_POST['tel'];

$monday = isset($_POST['monday'])?$_POST['monday']:false;
$tuesday = isset($_POST['tuesday'])?$_POST['tuesday']:false;
$wednesday = isset($_POST['wednesday'])?$_POST['wednesday']:false;
$thursday = isset($_POST['thursday'])?$_POST['thursday']:false;
$friday = isset($_POST['friday'])?$_POST['friday']:false;
$saturday = isset($_POST['saturday'])?$_POST['saturday']:false;
$sunday = isset($_POST['sunday'])?$_POST['sunday']:false;

$iquery = "UPDATE manpower SET name = '$name',lastname = '$lastname',position = '$position',skill = '$skill',company = '$company',outsource = '$outsource',tel = '$tel',monday = '$monday',tuesday = '$tuesday',wednesday = '$wednesday',thursday = '$thursday',friday = '$friday',saturday = '$saturday',sunday = '$sunday' WHERE manpower_id = '$manpower_id'";
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