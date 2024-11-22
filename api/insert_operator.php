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
$outsource = isset($_POST['outsource'])?$_POST['outsource']:0;
// $day_off = $_POST['day_off'];
$tel = $_POST['tel'];

$monday = isset($_POST['monday'])?$_POST['monday']:0;
$tuesday = isset($_POST['tuesday'])?$_POST['tuesday']:0;
$wednesday = isset($_POST['wednesday'])?$_POST['wednesday']:0;
$thursday = isset($_POST['thursday'])?$_POST['thursday']:0;
$friday = isset($_POST['friday'])?$_POST['friday']:0;
$saturday = isset($_POST['saturday'])?$_POST['saturday']:0;
$sunday = isset($_POST['sunday'])?$_POST['sunday']:0;

$staff_id = $_POST['staff_id'];
$vbranch = $_POST['vbranch'];
$vbranch2 = $_POST['vbranch2'];
$vbranch3 = $_POST['vbranch3'];
$vbranch4 = $_POST['vbranch4'];
$vbranch5 = $_POST['vbranch5'];
$operator = isset($_POST['operator'])?$_POST['operator']:0;
$manpower = isset($_POST['manpower'])?$_POST['manpower']:0;
$employment_type = $_POST['employment_type'];
$remark = $_POST['remark'];
$block = isset($_POST['block'])?$_POST['block']:0;
$vendor = $_POST['vendor'];
$department = $_POST['department'];
$cost_center = $_POST['cost_center'];
$follow_vehicle = isset($_POST['follow_vehicle'])?$_POST['follow_vehicle']:0;
$special_allowance = $_POST['special_allowance'];
$phone_allowance = $_POST['phone_allowance'];

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



$iquery = "INSERT INTO operator (operator_id, name,lastname, position, skill, company, outsource, tel, monday, tuesday, wednesday, thursday, friday, saturday, sunday, staff_id, branch, operator, manpower, employment_type, remark, block, vendor, department, cost_center, branch2, branch3, branch4, branch5, follow_vehicle, special_allowance, phone_allowance) VALUES ('$operator_id', '$name', '$lastname', '$position', '$skill', '$company', $outsource, '$tel', $monday, $tuesday, $wednesday, $thursday, $friday, $saturday, $sunday, '$staff_id', '$vbranch', $operator, $manpower, '$employment_type', '$remark', $block, '$vendor', '$department', '$cost_center', '$vbranch2', '$vbranch3', '$vbranch4', '$vbranch5', '$follow_vehicle', $special_allowance, $phone_allowance)";
$stmt = sqlsrv_query($conn, $iquery);

if($stmt === false){
    $Data["Status"] = "Error";
    $Data["msg"] = $iquery;//"มีข้อมูลซ้ำกับที่มีอยู่แล้ว";
}else{
    $Data["Status"] = "Success";
    $Data["msg"] = "Data has been updated";
}

echo json_encode($Data);

sqlsrv_close($conn);

?>