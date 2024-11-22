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

$iquery = "UPDATE vehicle SET vehicle_id = '$vehicle_id', vehicle_id_erp = '$vehicle_id_erp', registration_no = '$registration_no', vehicle_no = '$vehicle_no', vehicle_brand = '$brand', capacity = '$capacity', vehicle_group = '$group', vehicle_type = '$type',outsource = '$outsource', vehicle_owner = '$owner', on_behalf_of = '$on_behalf_of', location = '$vlocation', branch = '$vbranch', block = '$block', remark = '$remark', category = '$category', department = '$department', cost_center = '$cost_center' WHERE vehicle_id = '$vehicle_id'";
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