<?php
require_once '../config_db.php';
require_once '../utils/helper.php';

$contract_no = $_GET['contract_no'];

$fQuery = "SELECT  * FROM contract_working_day WHERE contract_no = '$contract_no'";
$result = sqlsrv_query($conn, $fQuery);
$raw['data'] = array();

while($row = sqlsrv_fetch_array( $result, SQLSRV_FETCH_ASSOC)){
    $data = [$row['position'],bit_value($row['monday']),bit_value($row['tuesday']),bit_value($row['wednesday']),bit_value($row['thursday']),bit_value($row['friday']),bit_value($row['saturday']),bit_value($row['sunday']),$row['reccode']];
    array_push($raw['data'],$data);
}

echo json_encode($raw);
sqlsrv_close($conn);
?>