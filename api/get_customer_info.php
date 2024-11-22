<?php
require_once '../config_db.php';
require_once '../config_db_erp.php';
require_once '../utils/helper.php';

$erp_id = $_GET['erp_id'];

$serverNamex = "192.168.10.4";
$connectionInfox = array( "Database"=>"AAL Live (01,Aug,2015)", "UID"=>"sa", "PWD"=>"amarit1982", "MultipleActiveResultSets"=>true,"CharacterSet"  => 'UTF-8');
$connx = sqlsrv_connect( $serverNamex, $connectionInfox);
$customer = " and No_ = '$erp_id' ";
$fQuery = ' SELECT NAME, Address, [Address 2], City, [Phone No_], [Post Code]  FROM [AAL LIVE (NEW)$Customer] where blocked = 0 '.$customer;
$result = sqlsrv_query($connx, $fQuery);
$row = sqlsrv_fetch_array( $result, SQLSRV_FETCH_ASSOC);

$data['name'] = $row['NAME'];
$data['address'] = $row['Address'];
$data['address2'] = $row['Address 2'];
$data['province'] = $row['City'];
$data['tel'] = $row['Phone No_'];
$data['postcode'] = $row['Post Code'];

echo json_encode($data);

?>