<?php
error_reporting(1);
require_once '../config_db.php';
require_once '../utils/helper.php';

$fQuery = "SELECT count(1) as num FROM customer";
$result = sqlsrv_query($conn, $fQuery);
$row = sqlsrv_fetch_array( $result, SQLSRV_FETCH_ASSOC);
$count_num = $row['num'] +1;

$num = "C";

if($count_num  < 10)
    $count = "0000".$count_num;
else if($count_num  < 100)
    $count = "000".$count_num;
else if($count_num  < 1000)
    $count = "0".$count_num ;
else if($count_num  < 10000)
    $count = "0".$count_num ;
else
    $count = $count_num ;

$customer_id = $num.$count;//$_POST['customer_id'];
$erp_id = $_POST['erp_id'];
$name = $_POST['name'];
$abs = $_POST['abs'];
$address = $_POST['address'];
$address2 = $_POST['address2'];
$province = $_POST['province'];
$postcode = $_POST['postcode'];
$tel = $_POST['tel'];
$fax = $_POST['fax'];
$block = isset($_POST['block'])?$_POST['block']:0;
$remark = $_POST['remark'];

$iquery = "INSERT INTO customer (customer_id, erp_id, name, abs, address, address2, province, postcode, tel, fax, block, remark) VALUES ('$customer_id', '$erp_id', '$name', '$abs', '$address', '$address2', '$province', '$postcode', '$tel', '$fax', '$block', '$remark')";
$stmt = sqlsrv_query($conn, $iquery);

if($stmt === false){
    $Data["Status"] = "Error";
    $Data["msg"] = $iquery;//"มีข้อมูลซ้ำกับที่มีอยู่แล้ว";
}else{
    $Data["Status"] = "Success";
    $Data["msg"] = "Data has been updated";
}

echo json_encode($Data);

sqlsrv_close($conn);

?>