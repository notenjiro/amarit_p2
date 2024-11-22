<?php
require_once '../config_db.php';
require_once '../utils/helper.php';

$customer = $_GET['customer'];
$vehicle = $_GET['vehicle'];
$cargo_location = $_GET['cargo_location']; 
$diesel_rate = $_GET['diesel_rate'];

$fQuery = " select contract_no, contract_line, diesel_baht_from, diesel_baht_to from contract_equipment_rental WHERE customer = '$customer'  and equipment = '$vehicle' and branch = '$cargo_location' ";

//$fQuery = " select contract_no, contract_line from contract_equipment_rental WHERE customer = '$customer'  and equipment = '$vehicle' and diesel_baht_from <= $diesel_rate and diesel_baht_to >= $diesel_rate and branch = '$cargo_location' ";

$result = sqlsrv_query($conn, $fQuery);
$raw = array();
$x = 0;
while($row = sqlsrv_fetch_array( $result, SQLSRV_FETCH_ASSOC)){
	$x++;
    $raw[$row['contract_no']] = $row['contract_no'];
}

//$result = sqlsrv_query($conn, $fQuery);
//$row = sqlsrv_fetch_array( $result, SQLSRV_FETCH_ASSOC);
//$raw['contract_no'] = $row['contract_no'];
//$raw['contract_line'] = $row['contract_line'];

echo json_encode($raw);
sqlsrv_close($conn);
?>