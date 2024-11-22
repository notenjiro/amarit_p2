<?php
require_once '../config_db.php';
require_once '../utils/helper.php';

$fQuery = "SELECT count(1) as num FROM vehicle_owner ";

$result = sqlsrv_query($conn, $fQuery);
$row = sqlsrv_fetch_array( $result, SQLSRV_FETCH_ASSOC);
$count_num = $row['num'] +1;

if($count_num  < 10)
    $count = "000".$count_num;
else if($count_num  < 100)
    $count = "00".$count_num;
else if($count_num  < 1000)
    $count = "0".$count_num ;
else
    $count = $count_num ;
$data['num'] = 'V'.$count;

echo json_encode($data);

?>