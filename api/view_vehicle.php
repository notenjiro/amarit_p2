<?php
require_once '../config_db.php';
require_once '../utils/helper.php';

$fQuery = "SELECT  * FROM vehicle";

$result = sqlsrv_query($conn, $fQuery);
$raw['data'] = array();

while($row = sqlsrv_fetch_array( $result, SQLSRV_FETCH_ASSOC)){
    $data = [$row['vehicle_id'], $row['vehicle_id'], $row['vehicle_id_erp'], $row['registration_no'], $row['category'], $row['vehicle_brand'], $row['branch'], $row['vehicle_no']];
    array_push($raw['data'],$data);
}

echo json_encode($raw);
sqlsrv_close($conn);
?>