<?php
require_once '../config_db.php';
require_once '../utils/helper.php';

$customer = $_GET['customer'];
$location_from = $_GET['location_from'];
$location_to = $_GET['location_to']; 
$vehicle_type = $_GET['vehicle_type'];

$fQuery = " select contract_no, contract_line from contract_taxi_service WHERE customer = '$customer' and transport_from = '$location_from' and transport_to = '$location_to' and vehicle_type = '$vehicle_type' ";
//and diesel_baht_from <= $diesel_rate and diesel_baht_to >= $diesel_rate
//$fQuery = "SELECT  a.location, b.description as universal_location, c.description as sub_location FROM contract_location a left join location b on b.code = a.universal_location left join sub_location c on c.code = a.sub_location WHERE customer = '$customer'";

$result = sqlsrv_query($conn, $fQuery);
$raw = array();
$x = 0;

while($row = sqlsrv_fetch_array( $result, SQLSRV_FETCH_ASSOC)){
	$x++;
    $raw['contract_no'] = $row['contract_no'];
	$raw['contract_line'] = $row['contract_line'];
}

//$row = sqlsrv_fetch_array( $result, SQLSRV_FETCH_ASSOC);

//$raw['contract_no'] = $row['contract_no'];
//$raw['contract_line'] = $row['contract_line'];

if ($x == 0) {
	$fQuery = " select contract_no, contract_line from contract_taxi_service WHERE customer = '$customer' and transport_from = '$location_to' and transport_to = '$location_from' and vehicle_type = '$vehicle_type' ";
	//and diesel_baht_from <= $diesel_rate and diesel_baht_to >= $diesel_rate
	$result = sqlsrv_query($conn, $fQuery);
	while($row = sqlsrv_fetch_array( $result, SQLSRV_FETCH_ASSOC)){
		$raw['contract_no'] = $row['contract_no'];
		$raw['contract_line'] = $row['contract_line'];
	}
}

echo json_encode($raw);
sqlsrv_close($conn);
?>