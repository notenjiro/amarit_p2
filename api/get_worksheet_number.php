<?php
require_once '../config_db.php';
require_once '../utils/helper.php';

if(isset($_GET['date']) && $_GET['date'] != '' && isset($_GET['type']) )
    $_date = $_GET['date'];
else
    $_date = date('Y-m-d');
$y = date('Y', strtotime($_date)) - 2000;
$m = date('m', strtotime($_date));

$num = '';

if($_GET['type'] == 'worksheet'){
 $num = "WS".$y.$m;   
}else{
 $num = "JO".$y.$m;   
}


$date_start = date('Y-m-01', strtotime($_date));
$date_end = date('Y-m-t', strtotime($_date));

$fQuery = "";
if($_GET['type'] == 'worksheet'){
    $fQuery = "SELECT count(1) as num FROM worksheet where worksheet_date between '$date_start' and '$date_end'";
}else{
    $fQuery = "SELECT count(1) as num FROM job where job_date between '$date_start' and '$date_end'";
}

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