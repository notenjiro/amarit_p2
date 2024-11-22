<?php
require_once '../config_db.php';
require_once '../utils/helper.php';

$trip_number = $_POST['trip_number'];

$fQuery = "SELECT a.*,b.registration_no FROM worksheet_cargo_transport a left join vehicle b on b.vehicle_id = a.vehicle WHERE a.transport_id = '$trip_number'";

$result = sqlsrv_query($conn, $fQuery);
$row = sqlsrv_fetch_array( $result, SQLSRV_FETCH_ASSOC);
if(isset($row['transport_id'])){
    $raw['status'] = "success";

    $raw['transport_id'] = $row['transport_id'];
    $raw['mileage_start'] = $row['mileage_start'];
    $raw['mileage_end'] = $row['mileage_end'];
    $raw['miledge_check_in'] = $row['miledge_check_in'];
	$raw['vehicle'] = $row['registration_no'];

    $raw['reccode'] = $row['reccode'];
    $raw['worksheet_id'] = $row['worksheet_id'];
}else{
    $raw['status'] = "error";
    $raw['msg'] = "Not found trip number";
}

echo json_encode($raw);
sqlsrv_close($conn);
?>