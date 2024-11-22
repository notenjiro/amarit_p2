<?php
require_once '../config_db.php';
require_once '../utils/helper.php';

if(isset($_GET['date']) && $_GET['date'] != '')
    $_date = $_GET['date'];
else
    $_date = date('Y-m-d');
$y = date('Y', strtotime($_date)) - 2000;

//$num = "TX".$y;

//$date_start = date('Y-m-01', strtotime($_date));
//$date_end = date('Y-m-t', strtotime($_date));

//$fQuery = "SELECT count(1) as num FROM worksheet_taxi where start_date between '$date_start' and '$date_end'";

$num = "TX".$y;
$ws = "WS".$y."%";

$date_start = date('Y-01-01', strtotime($_date));
$date_end = date('Y-12-31', strtotime($_date));
$fQuery = "SELECT count(1) as num FROM worksheet_taxi where worksheet_id like '$ws'";

$result = sqlsrv_query($conn, $fQuery);
$row = sqlsrv_fetch_array( $result, SQLSRV_FETCH_ASSOC);
$count_num = $row['num'] +1;

if($count_num  < 10)
    $count = "0000".$count_num;
else if($count_num  < 100)
    $count = "000".$count_num;
else if($count_num  < 1000)
    $count = "00".$count_num ;
else if($count_num  < 10000)
    $count = "0".$count_num ;
else
    $count = $count_num ;
$data['num'] = $num.$count;

echo json_encode($data);

?>