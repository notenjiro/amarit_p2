<?php
require_once '../config_db.php';
require_once '../utils/helper.php';

$manpower_id = $_GET['manpower_id'];

$fQuery = "SELECT  * FROM manpower WHERE manpower_id = '$manpower_id'";

$result = sqlsrv_query($conn, $fQuery);

$row = sqlsrv_fetch_array( $result, SQLSRV_FETCH_ASSOC);
$raw['manpower_id'] = $row['manpower_id'];
$raw['name'] = $row['name'];
$raw['lastname'] = $row['lastname'];
$raw['position'] = $row['position'];
$raw['skill'] = $row['skill'];
$raw['company'] = $row['company'];
$raw['outsource'] = $row['outsource'];
//$raw['day_off'] = $row['day_off'];
$raw['monday'] = $row['monday'];
$raw['tuesday'] = $row['tuesday'];
$raw['wednesday'] = $row['wednesday'];
$raw['thursday'] = $row['thursday'];
$raw['friday'] = $row['friday'];
$raw['saturday'] = $row['saturday'];
$raw['sunday'] = $row['sunday'];
$raw['tel'] = $row['tel'];

echo json_encode($raw);
sqlsrv_close($conn);
?>