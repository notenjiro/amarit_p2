<?php
require_once '../config_db.php';
require_once '../utils/helper.php';

$contract_no = $_GET['contract_no'];

$fQuery = "SELECT  a.*,b.description as u_position FROM contract_hourly_rate a LEFT JOIN position b ON (a.universal_position = b.code) WHERE a.contract_no = '$contract_no'";
$result = sqlsrv_query($conn, $fQuery);
$raw['data'] = array();

while($row = sqlsrv_fetch_array( $result, SQLSRV_FETCH_ASSOC)){
	$workingday = "";
    $workingday .= $row["monday"]?" Mon":"";
    $workingday .= $row["tuesday"]?" Tue":"";
    $workingday .= $row["wednesday"]?" Wed":"";
    $workingday .= $row["thursday"]?" Thu":"";
    $workingday .= $row["friday"]?" Fri":"";
    $workingday .= $row["saturday"]?" Sat":"";
    $workingday .= $row["sunday"]?" Sun":"";
    $data = [$row['reccode'], $row['contract_line'], $row['position'], $row['u_position'], $row['normal'], $row['after_normal'], $row['lamsum_charge_rate'], $workingday, $row['reccode']];
    array_push($raw['data'],$data);
}

echo json_encode($raw);
sqlsrv_close($conn);
?>