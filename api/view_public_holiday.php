<?php
require_once '../config_db.php';
require_once '../utils/helper.php';

$fQuery = "SELECT  * FROM calendar_public_holiday";
$result = sqlsrv_query($conn, $fQuery);
$raw['data'] = array();

while($row = sqlsrv_fetch_array( $result, SQLSRV_FETCH_ASSOC)){
    $data = [$row['reccode'], date_format($row['non_working_date'],'d/m/Y'), $row['holiday_name']];
    array_push($raw['data'],$data);
}

echo json_encode($raw);
sqlsrv_close($conn);
?>