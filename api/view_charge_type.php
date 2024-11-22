<?php
require_once '../config_db.php';
require_once '../utils/helper.php';



$fQuery = "SELECT  * FROM charge_type";
$result = sqlsrv_query($conn, $fQuery);
$raw['data'] = array();

while($row = sqlsrv_fetch_array( $result, SQLSRV_FETCH_ASSOC)){
    $data = [$row['code'],$row['description'],$row['description2']];
    array_push($raw['data'],$data);
}

echo json_encode($raw);
sqlsrv_close($conn);
?>