<?php
require_once '../config_db.php';
require_once '../utils/helper.php';

$code = $_GET['reccode'];

$fQuery = "SELECT  * FROM calendar_public_holiday WHERE reccode = '$code'";

$result = sqlsrv_query($conn, $fQuery);

$row = sqlsrv_fetch_array( $result, SQLSRV_FETCH_ASSOC);
$raw['reccode'] = $row['reccode'];
$raw['non_working_date'] = date_format($row['non_working_date'],'Y-m-d');
//$raw['non_working_date'] = $row['non_working_date'];
$raw['holiday_name'] = $row['holiday_name'];

echo json_encode($raw);
sqlsrv_close($conn);
?>