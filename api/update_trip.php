<?php
error_reporting(0);
require_once '../config_db.php';
require_once '../utils/helper.php';

$reccode = $_POST['reccode'];

$mileage_start = $_POST['mileage_start'];
$mileage_end = $_POST['mileage_end'];

if ($mileage_end <> '') 
	$iquery = "UPDATE worksheet_cargo_transport SET mileage_end=$mileage_end, actual_finish_date = getdate(), actual_finish_time = getdate() WHERE reccode='$reccode'";
$stmt = sqlsrv_query($conn, $iquery);

if ($mileage_start <> '') 
	$iquery = "UPDATE worksheet_cargo_transport SET mileage_start=$mileage_start, actual_start_date = getdate(), actual_start_time = getdate() WHERE reccode='$reccode' and mileage_start is null ";
$stmt = sqlsrv_query($conn, $iquery);

//if ($mileage_start > 0) 
//	$iquery = "UPDATE worksheet_cargo_transport SET  mileage_start=$mileage_start, mileage_end=$mileage_end, miledge_check_in=$miledge_check_in, actual_start_date = getdate(), actual_start_time = getdate()  WHERE reccode='$reccode'";

//$stmt = sqlsrv_query($conn, $iquery); 

//if ($mileage_end <> null) 
//	$iquery = "UPDATE worksheet_cargo_transport SET  mileage_start=$mileage_start, mileage_end=$mileage_end, miledge_check_in=$miledge_check_in, actual_finish_date = getdate(), actual_finish_time = getdate() WHERE reccode='$reccode'";
//$stmt = sqlsrv_query($conn, $iquery);



//if($stmt === false){
//    $Data["Status"] = "Error";
//    $Data["msg"] = "Something went wrong";
//    $Data['sql'] = $iquery;
//}else{
//    $Data["Status"] = "Success";
    $Data["msg"] = "Data has been updated";
//}

echo json_encode($Data);

sqlsrv_close($conn);

?>