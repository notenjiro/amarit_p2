<?php
require_once '../config_db.php';
require_once '../utils/helper.php';

$customer = $_GET['customer'];
$contract_no = $_GET['contract_no'];

$fQuery = "SELECT  a.location, b.description as universal_location, c.description as sub_location FROM contract_location a left join location b on b.code = a.universal_location
left join sub_location c on c.code = a.sub_location WHERE customer = '$customer' and contract_no = '$contract_no' order by location ";

$result = sqlsrv_query($conn, $fQuery);
$raw = array();

while($row = sqlsrv_fetch_array( $result, SQLSRV_FETCH_ASSOC)){
	//$raw[$row['location']] = $row['location'];
    $raw[$row['location']] = $row['location'].' | '.$row['universal_location'];
}

echo json_encode($raw);
sqlsrv_close($conn);
?>