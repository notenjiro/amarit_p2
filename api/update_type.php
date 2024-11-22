<?php
error_reporting(1);
require_once '../config_db.php';
require_once '../utils/helper.php';

$type_id = $_POST['type_id'];
$type_no = $_POST['type_no'];
$type_col = $_POST['type_col'];
$type_val = $_POST['type_val'];

if($type_id=="p"){
    $iquery = "update barcode_group set ".$type_col." = '".$type_val."' where  no_group = '".$type_no."'";
}
else{
    $iquery = "update barcode_sub_type".$type_id." set ".$type_col." = '".$type_val."' where  no_sub_type".$type_id." = '".$type_no."'";
}

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