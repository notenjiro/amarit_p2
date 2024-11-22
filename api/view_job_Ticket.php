<?php
require_once '../config_db.php';
require_once '../utils/helper.php';

$job_id = $_GET['job_id'];

$fQuery = "SELECT  a.* FROM job_ticket_booking a WHERE a.job_id = '$job_id'";
$result = sqlsrv_query($conn, $fQuery);
$raw['data'] = array();

while($row = sqlsrv_fetch_array( $result, SQLSRV_FETCH_ASSOC)){
    $data = [$row['reccode'], $row['ticket_booking_id'], date_format($row['start_date'],'d/m/Y'), date_format($row['start_time'],'H:i'), $row['quantity'],$row['uom'], $row['remark'], $row['line_status'], $row['ref1'], $row['ref2'], $row['ref3'], $row['ref4'], $row['ref5'], $row['ref6'], $row['reccode']];
    array_push($raw['data'],$data);
}

echo json_encode($raw);
sqlsrv_close($conn);
?>