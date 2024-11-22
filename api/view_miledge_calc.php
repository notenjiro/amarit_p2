<?php
ini_set('display_errors', 'On');
require_once '../config_db.php';
require_once '../utils/helper.php';



$fQuery = "SELECT  * FROM miledge_calc";
$result = sqlsrv_query($conn, $fQuery);
$raw['data'] = array();


while($row = sqlsrv_fetch_array( $result, SQLSRV_FETCH_ASSOC)){
	if ($row['long_haul'] == 0)
		$long_haul = 'No';
	else
		$long_haul = 'Yes';
	if ($row['round_trip'] == 0)
		$round_trip = 'No';
	else
		$round_trip = 'Yes';
    $data = [$row['reccode'], $row['miledge_from'], $row['miledge_to'], $row['qty'], $long_haul, $round_trip];
    array_push($raw['data'],$data);
}

echo json_encode($raw);
sqlsrv_close($conn);
?>