<?php
require_once '../config_db.php';
require_once '../utils/helper.php';



$fQuery = "SELECT  * FROM user_log where user_name <> '' order by date desc, time desc";
$result = sqlsrv_query($conn, $fQuery);
$raw['data'] = array();

while($row = sqlsrv_fetch_array( $result, SQLSRV_FETCH_ASSOC)){
    $data = [$row['user_name'],date_format($row['time'],'H:i:s'),date_format($row['date'],'d/m/Y'),$row['action_type'],$row['description']];
    array_push($raw['data'],$data);
}

echo json_encode($raw);
sqlsrv_close($conn);
?>