<?php
require_once '../config_db.php';
require_once '../utils/helper.php';

//$worksheet_id = $_GET["worksheet_id"];
if(isset($_GET['date']) && $_GET['date'] != '')
    $_date = $_GET['date'];
else
    $_date = date('Y-m-d');
$y = date('Y', strtotime($_date)) - 2000;

//$num = "CH".$y;

//$date_start = '2022-01-01';//date('Y-m-01', strtotime($_date));
//$date_end = '2022-12-31';//date('Y-m-t', strtotime($_date));

//$fQuery = "SELECT count(1) as num FROM worksheet_cargo_handling where worksheet_id = '$worksheet_id'";
//$fQuery = "SELECT count(1) as num FROM worksheet_cargo_handling where start_date between '$date_start' and '$date_end'";

$num = "CH".$y;
$ws = "WS".$y."%";

$date_start = date('Y-01-01', strtotime($_date));
$date_end = date('Y-12-31', strtotime($_date));
$fQuery = "SELECT count(1) as num FROM worksheet_cargo_handling where worksheet_id like '$ws'";

$result = sqlsrv_query($conn, $fQuery);
$row = sqlsrv_fetch_array( $result, SQLSRV_FETCH_ASSOC);
$count_num = $row['num'] +1;

//$num = "CH";

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