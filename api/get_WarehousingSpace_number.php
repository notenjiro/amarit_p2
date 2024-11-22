<?php
require_once '../config_db.php';
require_once '../utils/helper.php';

//$worksheet_id = $_GET["worksheet_id"];
$maxIdQuery = "SELECT MAX(WarehousingSpace_id) AS max_id FROM job_warehousing_space_rental";
$maxIdStmt = sqlsrv_query($conn, $maxIdQuery);
if ($maxIdStmt === false) {
    die("Error in fetching maximum job_id: " . print_r(sqlsrv_errors(), true));
}
$maxIdRow = sqlsrv_fetch_array($maxIdStmt, SQLSRV_FETCH_ASSOC);
$maxId = $maxIdRow['max_id'];


//$num = "SO".$y;
$currentYearSuffix = date('y');
$nextNumber = intval(substr($maxId, 5)) + 1;
$warehousingSpace_id = 'WSR' . $currentYearSuffix . str_pad($nextNumber, 5, '0', STR_PAD_LEFT);


echo json_encode($data);

?>