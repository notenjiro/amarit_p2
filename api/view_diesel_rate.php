<?php
require_once '../config_db.php';
require_once '../utils/helper.php';

$fQuery = "SELECT  * FROM diesel_rates";
$result = sqlsrv_query($conn, $fQuery);
$raw['data'] = array();

while($row = sqlsrv_fetch_array( $result, SQLSRV_FETCH_ASSOC)){
    $data = [$row['reccode'], date_format($row['diesel_rate_date'],'d/m/Y'), $row['diesel_rate']];
    array_push($raw['data'],$data);
}

echo json_encode($raw);
sqlsrv_close($conn);
?>