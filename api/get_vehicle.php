<?php
require_once '../config_db.php';
require_once '../utils/helper.php';

$vehicle_id = $_GET['vehicle_id'];

$fQuery = "SELECT  * FROM vehicle WHERE vehicle_id = '$vehicle_id'";

$result = sqlsrv_query($conn, $fQuery);

$row = sqlsrv_fetch_array( $result, SQLSRV_FETCH_ASSOC);
$raw['vehicle_id'] = $row['vehicle_id'];
$raw['vehicle_id_erp'] = $row['vehicle_id_erp'];
$raw['registration_no'] = $row['registration_no'];
$raw['vehicle_no'] = $row['vehicle_no'];
$raw['brand'] = $row['vehicle_brand'];
$raw['capacity'] = $row['capacity'];
$raw['group'] = $row['vehicle_group'];
$raw['type'] = $row['vehicle_type'];
$raw['outsource'] = $row['outsource'];
$raw['owner'] = $row['vehicle_owner'];
$raw['on_behalf_of'] = $row['on_behalf_of'];
$raw['vlocation'] = $row['location'];
$raw['vbranch'] = $row['branch'];
$raw['category'] = $row['category'];
$raw['block'] = $row['block'];
$raw['remark'] = $row['remark'];
$raw['department'] = $row['department'];
$raw['cost_center'] = $row['cost_center'];

echo json_encode($raw);
sqlsrv_close($conn);
?>