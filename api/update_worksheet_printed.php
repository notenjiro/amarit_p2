<?php
error_reporting(0);
require_once '../config_db.php';
require_once '../utils/helper.php';

$worksheet_id = $_GET['worksheet_id'];

$iquery = "UPDATE worksheet SET printed='Printed', print_date = DATEADD(HOUR, 7, CURRENT_TIMESTAMP) WHERE worksheet_id = '$worksheet_id'";
$stmt = sqlsrv_query($conn, $iquery);

if($stmt === false){
    $Data["Status"] = "Error";
    $Data["msg"] = "มีข้อมูลซ้ำกับที่มีอยู่แล้ว";
    $Data["sql"] = $iquery;
}else{ 
    $Data["Status"] = "Success";
    $Data["msg"] = "Data has been updated";
}

echo json_encode($Data);

sqlsrv_close($conn);

?>