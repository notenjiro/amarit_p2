<?php
error_reporting(1);
require_once '../config_db.php';
require_once '../utils/helper.php';

$reccode = $_GET['reccode'];

$code = $_POST['code'];
$description = $_POST['description'];
$sort_id = $_POST['sort_id'];

$iquery = "UPDATE position SET description = '$description', sort_id = '$sort_id', code = '$code' WHERE reccode = '$reccode' ";
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