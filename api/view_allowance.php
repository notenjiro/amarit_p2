<?php
require_once '../config_db.php';
require_once '../utils/helper.php';



$fQuery = "SELECT  a.*,p.description as position_name,c.name as customer_name FROM allowance_setup a left join position p on p.code = a.position left join customer c on c.customer_id = a.client";
$result = sqlsrv_query($conn, $fQuery);
$raw['data'] = array();

while($row = sqlsrv_fetch_array( $result, SQLSRV_FETCH_ASSOC)){
    $data = [$row['reccode'], $row['branch'], $row['position_name'], $row['vehicle_type'], $row['benefit_type'], $row['service'], $row['customer_name'], $row['allowance_type'], $row['trip'], $row['amount'], $row['special_rate'], $row['location_from'], $row['location_to'], $row['special_ot_rate']];
    array_push($raw['data'],$data);
}

echo json_encode($raw);
sqlsrv_close($conn);
?>