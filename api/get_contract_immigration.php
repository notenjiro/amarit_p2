<?php
require_once '../config_db.php';
require_once '../utils/helper.php';

$reccode = $_GET['reccode'];

$fQuery = "SELECT * FROM contract_immigration WHERE reccode = '$reccode'";

$result = sqlsrv_query($conn, $fQuery);
$row = sqlsrv_fetch_array( $result, SQLSRV_FETCH_ASSOC);

$raw['contract_line'] = $row['contract_line'];
$raw['description'] = $row['description'];
$raw['unit_price'] = $row['unit_price'];
$raw['location'] = $row['location'];
$raw['uom'] = $row['uom'];
$raw['reccode'] = $row['reccode'];

echo json_encode($raw);
sqlsrv_close($conn);
?>