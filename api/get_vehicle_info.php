<?php
require_once '../config_db.php';
require_once '../utils/helper.php';

$vehicle_id = $_GET['vehicle_id'];

$fQuery = "SELECT  * FROM vehicle WHERE vehicle_id = '$vehicle_id'";

$result = sqlsrv_query($conn, $fQuery);

$row = sqlsrv_fetch_array( $result, SQLSRV_FETCH_ASSOC);
$data['vehicle_id'] = $row['vehicle_id'];
$data['vehicle_id_erp'] = $row['vehicle_id_erp'];
$data['registration_no'] = $row['registration_no'];
$data['vehicle_no'] = $row['vehicle_no'];
$data['brand'] = $row['vehicle_brand'];
$data['capacity'] = $row['capacity'];
$data['group'] = $row['vehicle_group'];
$data['type'] = $row['vehicle_type'];
$data['outsource'] = $row['outsource'];
$data['owner'] = $row['vehicle_owner'];
$data['on_behalf_of'] = $row['on_behalf_of'];
$data['vlocation'] = $row['location'];
$data['vbranch'] = $row['branch'];
$data['category'] = $row['category'];
$data['block'] = $row['block'];
$data['remark'] = $row['remark'];

echo json_encode($data);
sqlsrv_close($conn);
?>