<?php
require_once '../config_db.php';
require_once '../utils/helper.php';

//$fQuery = " SELECT a.reccode,a.location, b.description as universal_location_name, c.description as sub_location_name,a.post_code FROM contract_location_master a left join location b on b.code = a.universal_location left join sub_location c on c.code = a.sub_location where active = 1 ";
$fQuery = "select a.*,b.place,b.district1 from contract_location_master a left outer join post_code b on b.post_code = a.post_code where active = 1";
$result = sqlsrv_query($conn, $fQuery);
$raw['data'] = array();

while($row = sqlsrv_fetch_array( $result, SQLSRV_FETCH_ASSOC)){
    $data = [$row['reccode'], $row['location'], $row['place'], $row['district1'], $row['post_code']];
    array_push($raw['data'],$data);
}

echo json_encode($raw);
sqlsrv_close($conn);
?>