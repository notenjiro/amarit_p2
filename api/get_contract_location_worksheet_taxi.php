<?php
require_once '../config_db.php';
require_once '../utils/helper.php';

$customer = $_GET['customer'];

//$fQuery = "SELECT  a.location, b.description as universal_location, c.description as sub_location FROM contract_location a left join location b on b.code = a.universal_location left join sub_location c on c.code = a.sub_location WHERE customer = '$customer' and active = 1 order by location ";

$fQuery = "SELECT  a.transport_from as location, b.description as universal_location, c.description as sub_location 
FROM contract_taxi_service a 
left join contract_location_master d on d.location = a.transport_from
left join location b on b.code = d.universal_location
left join sub_location c on c.code = d.sub_location 
WHERE customer = '$customer'
group by a.transport_from,b.description,c.description
union
SELECT  a.transport_to as location, b.description as universal_location, c.description as sub_location 
FROM contract_taxi_service a 
left join contract_location_master d on d.location = a.transport_to
left join location b on b.code = d.universal_location
left join sub_location c on c.code = d.sub_location 
WHERE customer = '$customer'
group by a.transport_to,b.description,c.description ";
//order by a.transportation_from ";

$result = sqlsrv_query($conn, $fQuery);
$raw = array();

while($row = sqlsrv_fetch_array( $result, SQLSRV_FETCH_ASSOC)){
	//$raw[$row['location']] = $row['location'];
    $raw[$row['location']] = $row['location'].' | '.$row['universal_location'];
}

echo json_encode($raw);
sqlsrv_close($conn);
?>