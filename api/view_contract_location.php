<?php
require_once '../config_db.php';
require_once '../utils/helper.php';

$contract_no = $_GET['contract_no'];

$fQuery = "SELECT  a.*,b.description as universal_location_name,c.description as sub_location_name FROM contract_location a left join location b on b.code = a.universal_location left join sub_location c on c.code = a.sub_location WHERE contract_no = '$contract_no' order by a.location";
$result = sqlsrv_query($conn, $fQuery);
$raw['data'] = array();

while($row = sqlsrv_fetch_array( $result, SQLSRV_FETCH_ASSOC)){
    $data = [$row['reccode'], $row['location'], $row['universal_location_name'], $row['sub_location_name'], $row['contact1'], $row['tel1'], $row['contact2'], $row['tel2'], $row['reccode'], $row['universal_location'], $row['sub_location']];
    array_push($raw['data'],$data);
}

echo json_encode($raw);
sqlsrv_close($conn);
?>