<?php
error_reporting(1);
require_once '../config_db.php';
require_once '../utils/helper.php';

$vehicle_id = $_POST['vehicle_id'];
$vehicle_id_erp = $_POST['vehicle_id_erp'];
$registration_no = $_POST['registration_no'];
$vehicle_no = $_POST['vehicle_no'];
$brand = $_POST['brand'];
$capacity = $_POST['capacity'];
$group = $_POST['group'];
$type = $_POST['type'];
$outsource = $_POST['outsource'];
$owner = $_POST['owner'];
$on_behalf_of = $_POST['on_behalf_of'];
$vlocation = $_POST['vlocation'];
$vbranch = $_POST['vbranch'];
$block = $_POST['block'];
$remark = $_POST['remark'];
$category = $_POST['category'];
$department = $_POST['department'];
$cost_center = $_POST['cost_center'];

$iquery = "INSERT INTO vehicle (vehicle_id, vehicle_id_erp, registration_no, vehicle_no, vehicle_brand, capacity, vehicle_group, vehicle_type, outsource, vehicle_owner, on_behalf_of, location, branch, block, remark, category, department, cost_center) VALUES ('$vehicle_id', '$vehicle_id_erp', '$registration_no', '$vehicle_no', '$brand', '$capacity', '$group', '$type', '$outsource', '$owner', '$on_behalf_of', '$vlocation', '$vbranch', '$block', '$remark', '$category', '$department', '$cost_center')";
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