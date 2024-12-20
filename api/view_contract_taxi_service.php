<?php
require_once '../config_db.php';
require_once '../utils/helper.php';

$contract_no = $_GET['contract_no'];

$fQuery = "SELECT  a.*, b.description as vehicle_desc FROM contract_taxi_service a left join vehicle_type b on a.vehicle_type = b.code WHERE a.contract_no = '$contract_no'";
$result = sqlsrv_query($conn, $fQuery);
$raw['data'] = array();

while($row = sqlsrv_fetch_array( $result, SQLSRV_FETCH_ASSOC)){
    $data = [$row['reccode'], $row['contract_line'], $row['vehicle_desc'], $row['transport_from'], $row['transport_to'], $row['transport_rate'], $row['total_km'], $row['uom'], $row['customer_ref'], $row['diesel_baht_from'], $row['diesel_baht_to']];
    array_push($raw['data'],$data);
}

echo json_encode($raw);
sqlsrv_close($conn);
?>