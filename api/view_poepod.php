<?php
require_once '../config_db.php';
require_once '../utils/helper.php';

$fQuery = "SELECT code,description FROM FES.dbo.[poe_pod]";
$result = sqlsrv_query($conn, $fQuery);
$raw['data'] = array();

while($row = sqlsrv_fetch_array( $result, SQLSRV_FETCH_ASSOC)){
    array_push($raw['data'],[$row['code'],$row['code'],$row['description']]);
}

echo json_encode($raw);
sqlsrv_close($conn);
?>