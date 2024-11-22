<?php
session_start();
error_reporting(0);
require_once '../config_db.php';
require_once '../utils/helper.php';

$worksheet_id = $_GET['worksheet_id'];

$iquery = "select top 1 * from worksheet a
left join worksheet_cargo_transport b on b.worksheet_id = a.worksheet_id
WHERE a.worksheet_id = '$worksheet_id'
and b.contract_no <> ''
and b.mileage_start is not null
and b.mileage_end is not null
and b.department <> ''
and b.cost_center <> ''";

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