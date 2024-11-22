<?php
require_once '../config_db.php';
require_once '../utils/helper.php';

$customer = $_GET['customer'];
$location_from = $_GET['location_from'];
$location_to = $_GET['location_to']; 
$diesel_rate = $_GET['diesel_rate'];
$charge_as = $_GET['charge_as'];

$fQuery = " select a.contract_no, a.contract_line from contract_transportation_rate a left join customer_contract b on b.contract_no = a.contract_no  
WHERE a.customer = '$customer' and transportation_from = '$location_from' and transportation_to = '$location_to' and vehicle_type = '$charge_as' and b.active = 1  order by contract_no desc ";
//and diesel_baht_from <= $diesel_rate and diesel_baht_to >= $diesel_rate
//$fQuery = "SELECT  a.location, b.description as universal_location, c.description as sub_location FROM contract_location a left join location b on b.code = a.universal_location left join sub_location c on c.code = a.sub_location WHERE customer = '$customer'";

$result = sqlsrv_query($conn, $fQuery);
$raw = array();
$x = 0;

//while($row = sqlsrv_fetch_array( $result, SQLSRV_FETCH_ASSOC)){
//	$x++;
//    $raw['contract_no'] = $row['contract_no'];
//	$raw['contract_line'] = $row['contract_line'];
//}

while($row = sqlsrv_fetch_array( $result, SQLSRV_FETCH_ASSOC)){
	//$raw[$row['location']] = $row['location'];
	$x++;
    $raw[$row['contract_no']] = $row['contract_no'];
}

//$row = sqlsrv_fetch_array( $result, SQLSRV_FETCH_ASSOC);

//$raw['contract_no'] = $row['contract_no'];
//$raw['contract_line'] = $row['contract_line'];

if ($x == 0) {
	$fQuery = " select a.contract_no, a.contract_line from contract_transportation_rate a left join customer_contract b on b.contract_no = a.contract_no  
WHERE a.customer = '$customer' and transportation_from = '$location_to' and transportation_to = '$location_from' and vehicle_type = '$charge_as' and b.active = 1  order by contract_no desc";
	//$fQuery = " select contract_no, contract_line from contract_transportation_rate WHERE customer = '$customer' and transportation_from = '$location_to' and transportation_to = '$location_from' and vehicle_type = '$charge_as' order by contract_no desc ";
	//and diesel_baht_from <= $diesel_rate and diesel_baht_to >= $diesel_rate
	$result = sqlsrv_query($conn, $fQuery);
	while($row = sqlsrv_fetch_array( $result, SQLSRV_FETCH_ASSOC)){
		//$raw['contract_no'] = $row['contract_no'];
		//$raw['contract_line'] = $row['contract_line'];
		$x++;
		$raw[$row['contract_no']] = $row['contract_no'];
	}
}

if ($x == 0) {
	$fQuery = " select a.contract_no, a.contract_line from contract_service_rate a left join customer_contract b on b.contract_no = a.contract_no   
WHERE a.customer = '$customer' and vehicle_type = '$charge_as' and b.active = 1  order by contract_no desc";
	//$fQuery = " select contract_no, contract_line from contract_transportation_rate WHERE customer = '$customer' and transportation_from = '$location_to' and transportation_to = '$location_from' and vehicle_type = '$charge_as' order by contract_no desc ";
	//and diesel_baht_from <= $diesel_rate and diesel_baht_to >= $diesel_rate
	$result = sqlsrv_query($conn, $fQuery);
	while($row = sqlsrv_fetch_array( $result, SQLSRV_FETCH_ASSOC)){
		//$raw['contract_no'] = $row['contract_no'];
		//$raw['contract_line'] = $row['contract_line'];
		$x++;
		$raw[$row['contract_no']] = $row['contract_no'];
	}
}

//$raw['contract_line'] = $row['contract_line'];

echo json_encode($raw);
sqlsrv_close($conn);
?>