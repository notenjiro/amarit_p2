<?php
require_once '../config_db.php';
require_once '../utils/helper.php';

$customer = $_GET['customer'];
$location_from = $_GET['location_from'];

$fQuery = " select a.transportation_to as location, b.description as universal_location, c.description as sub_location from contract_transportation_rate a
left join contract_location d on d.location = a.transportation_to
and d.contract_no = a.contract_no
left join location b on b.code = d.universal_location
left join sub_location c on c.code = d.sub_location
WHERE a.customer = '$customer' and a.transportation_from = '$location_from'
group by a.transportation_to, b.description, c.description
union
select a.transportation_from as location, b.description as universal_location, c.description as sub_location from contract_transportation_rate a
	left join contract_location d on d.location = a.transportation_from
	and d.contract_no = a.contract_no
	left join location b on b.code = d.universal_location
	left join sub_location c on c.code = d.sub_location
	WHERE a.customer = '$customer' and a.transportation_to = '$location_from'
	group by a.transportation_from, b.description, c.description
";

//$fQuery = "SELECT  a.location, b.description as universal_location, c.description as sub_location FROM contract_location a left join location b on b.code = a.universal_location left join sub_location c on c.code = a.sub_location WHERE customer = '$customer'";

$result = sqlsrv_query($conn, $fQuery);
$raw = array();
$x = 0;

while($row = sqlsrv_fetch_array( $result, SQLSRV_FETCH_ASSOC)){
	//$raw[$row['location']] = $row['location'];
	$x++;
    $raw[$row['location']] = $row['location'].' | '.$row['universal_location'];
}

if ($x == 0) {
	$fQuery = " select a.transportation_from as location, b.description as universal_location, c.description as sub_location from contract_transportation_rate a
	left join contract_location d on d.location = a.transportation_from 
	left join location b on b.code = d.universal_location
	left join sub_location c on c.code = d.sub_location
	WHERE a.customer = '$customer' and a.transportation_to = '$location_from'
	group by a.transportation_from, b.description, c.description ";
	$result = sqlsrv_query($conn, $fQuery);
	while($row = sqlsrv_fetch_array( $result, SQLSRV_FETCH_ASSOC)){
		$raw[$row['location']] = $row['location'].' | '.$row['universal_location'];
	}
}

echo json_encode($raw);
sqlsrv_close($conn);
?>