<?php
require_once '../config_db.php';
require_once '../utils/helper.php';

$fQuery = "SELECT  * FROM application_setup";

$result = sqlsrv_query($conn, $fQuery);

$row = sqlsrv_fetch_array( $result, SQLSRV_FETCH_ASSOC);
$raw['picture_folder'] = $row['picture_folder'];
$raw['fuel_km_per_litre'] = $row['fuel_km_per_litre'];
$raw['long_haul'] = $row['long_haul'];

echo json_encode($raw);
sqlsrv_close($conn);
?>