<?php
require_once '../config_db.php';
require_once '../utils/helper.php';

$operator_id = $_GET['operator_id'];

$fQuery = "SELECT  * FROM operator WHERE operator_id = '$operator_id'";

$result = sqlsrv_query($conn, $fQuery);

$row = sqlsrv_fetch_array( $result, SQLSRV_FETCH_ASSOC);
$raw['operator_id'] = $row['operator_id'];
$raw['name'] = $row['name'];
$raw['lastname'] = $row['lastname'];
$raw['position'] = $row['position'];
$raw['skill'] = $row['skill'];
$raw['company'] = $row['company'];
$raw['outsource'] = $row['outsource'];
// $raw['day_off'] = $row['day_off'];
$raw['monday'] = $row['monday'];
$raw['tuesday'] = $row['tuesday'];
$raw['wednesday'] = $row['wednesday'];
$raw['thursday'] = $row['thursday'];
$raw['friday'] = $row['friday'];
$raw['saturday'] = $row['saturday'];
$raw['sunday'] = $row['sunday'];
$raw['tel'] = $row['tel'];
$raw['staff_id'] = $row['staff_id'];
$raw['vbranch'] = $row['branch'];
$raw['vbranch2'] = $row['branch2'];
$raw['vbranch3'] = $row['branch3'];
$raw['vbranch4'] = $row['branch4'];
$raw['vbranch5'] = $row['branch5'];
$raw['operator'] = $row['operator'];
$raw['manpower'] = $row['manpower'];
$raw['employment_type'] = $row['employment_type'];
$raw['remark'] = $row['remark'];
$raw['block'] = $row['block'];
$raw['vendor'] = $row['vendor'];
$raw['department'] = $row['department'];
$raw['cost_center'] = $row['cost_center'];
$raw['follow_vehicle'] = $row['follow_vehicle'];
$raw['special_allowance'] = $row['special_allowance'];
$raw['phone_allowance'] = $row['phone_allowance'];
$raw['ot_staff'] = $row['ot_staff'];
$raw['lumpsum_ot'] = $row['lumpsum_ot'];
$raw['double_allowance'] = $row['double_allowance'];
$raw['no_ot_long'] = $row['no_ot_long'];
$raw['ot8'] = $row['ot8'];
echo json_encode($raw);
sqlsrv_close($conn);
?>