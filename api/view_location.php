<?php
require_once '../config_db.php';
require_once '../utils/helper.php';

$fQuery = "SELECT  * FROM location";
$result = sqlsrv_query($conn, $fQuery);
$raw['data'] = array();

while($row = sqlsrv_fetch_array( $result, SQLSRV_FETCH_ASSOC)){
    $data = [$row['code'], $row['code'], $row['description'], $row['zipcode'], $row['department'], $row['cost_center']];
    array_push($raw['data'],$data);
}

echo json_encode($raw);
sqlsrv_close($conn);
?>