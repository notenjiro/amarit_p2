<?php
require_once '../config_db.php';
require_once '../utils/helper.php';



$fQuery = "SELECT  * FROM users";
$result = sqlsrv_query($conn, $fQuery);
$raw['data'] = array();

while($row = sqlsrv_fetch_array( $result, SQLSRV_FETCH_ASSOC)){
    $data =   [$row['user_role'],$row['name'], $row['email'], $row['email']];
    array_push($raw['data'],$data);
}

echo json_encode($raw);
sqlsrv_close($conn);
?>