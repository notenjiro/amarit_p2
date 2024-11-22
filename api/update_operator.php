<?php
error_reporting(1);
require_once '../config_db.php';
require_once '../utils/helper.php';

$operator_id = $_POST['operator_id'];
$name = $_POST['name'];
$lastname = $_POST['lastname'];
$position = $_POST['position'];
$skill = $_POST['skill'];
$company = $_POST['company'];
//$outsource = $_POST['outsource'];
$outsource = isset($_POST['outsource'])?$_POST['outsource']:false;
// $day_off = $_POST['day_off'];
$tel = $_POST['tel'];

$monday = isset($_POST['monday'])?$_POST['monday']:false;
$tuesday = isset($_POST['tuesday'])?$_POST['tuesday']:false;
$wednesday = isset($_POST['wednesday'])?$_POST['wednesday']:false;
$thursday = isset($_POST['thursday'])?$_POST['thursday']:false;
$friday = isset($_POST['friday'])?$_POST['friday']:false;
$saturday = isset($_POST['saturday'])?$_POST['saturday']:false;
$sunday = isset($_POST['sunday'])?$_POST['sunday']:false;
//$sunday = $_POST['sunday'];

$staff_id = $_POST['staff_id'];
$vbranch = $_POST['vbranch'];
$vbranch2 = $_POST['vbranch2'];
$vbranch3 = $_POST['vbranch3'];
$vbranch4 = $_POST['vbranch4'];
$vbranch5 = $_POST['vbranch5'];
$operator = isset($_POST['operator'])?$_POST['operator']:false;
$manpower = isset($_POST['manpower'])?$_POST['manpower']:false;
$employment_type = $_POST['employment_type'];
$remark = $_POST['remark'];
$block = isset($_POST['block'])?$_POST['block']:false;
$vendor = $_POST['vendor'];
$department = $_POST['department'];
$cost_center = $_POST['cost_center'];
$follow_vehicle = isset($_POST['follow_vehicle'])?$_POST['follow_vehicle']:0;
$special_allowance = $_POST['special_allowance'];
$phone_allowance = $_POST['phone_allowance'];
$ot_staff = isset($_POST['ot_staff'])?$_POST['ot_staff']:0;
$lumpsum_ot = isset($_POST['lumpsum_ot'])?$_POST['lumpsum_ot']:0;
$double_allowance = isset($_POST['double_allowance'])?$_POST['double_allowance']:0;
$no_ot_long = isset($_POST['no_ot_long'])?$_POST['no_ot_long']:0;
$ot8 = isset($_POST['ot8'])?$_POST['ot8']:0;
$driver = isset($_POST['driver'])?$_POST['driver']:false;
$start_time = $_POST['start_time'];
$end_time = $_POST['end_time'];

//SEM
if($special_allowance=='')
{
    $special_allowance=0;
}
if($phone_allowance=='')
{
    $phone_allowance=0;
}
//SEM

$iquery = "UPDATE operator SET name = '$name', lastname = '$lastname', position = '$position', skill = '$skill', company = '$company', outsource = '$outsource', tel = '$tel', monday = '$monday', tuesday = '$tuesday', wednesday = '$wednesday', thursday = '$thursday', friday = '$friday', saturday = '$saturday', sunday = '$sunday', staff_id = '$staff_id', branch = '$vbranch', operator = '$operator', manpower = '$manpower', employment_type = '$employment_type', remark = '$remark', block = '$block', vendor = '$vendor', department = '$department', cost_center = '$cost_center', branch2 = '$vbranch2', branch3 = '$vbranch3', branch4 = '$vbranch4', branch5 = '$vbranch5', follow_vehicle = '$follow_vehicle', special_allowance = '$special_allowance', phone_allowance = '$phone_allowance', ot_staff = '$ot_staff', lumpsum_ot = '$lumpsum_ot', double_allowance = '$double_allowance', no_ot_long = '$no_ot_long', ot8 = '$ot8', driver = '$driver', start_time='$start_time', end_time='$end_time' WHERE operator_id = '$operator_id'";
$stmt = sqlsrv_query($conn, $iquery);

if($stmt === false){
    $Data["Status"] = "Error";
    $Data["msg"] = $iquery;//"มีบางอย่างผิดพลาด";
}else{
    $Data["Status"] = "Success";
    $Data["msg"] = "Data has been updated";
}

echo json_encode($Data);

sqlsrv_close($conn);

?>