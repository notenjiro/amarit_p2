<?php
require_once '../config_db.php';
require_once '../utils/helper.php';

$worksheet = $_POST['worksheet_id'];
$name = $_POST['name'];
$nametable = $_POST['table'];
$type = $_POST['type'];

if($type == 'worksheet'){
  $checkColumn = 'worksheet_id';
}else{
  $checkColumn ='contract_no';
}


$fQuery = "SELECT COUNT($checkColumn) as rows FROM ".$nametable." WHERE $checkColumn ='".$worksheet."'";
$result = sqlsrv_query($conn, $fQuery);
$raw['data'] = array();
$raw['qr'] = $fQuery;
if($result == false){
    $raw['status'] = 0;
    $raw['msg'] = "Sorry, can't get data";
}else{
  while($row = sqlsrv_fetch_array( $result, SQLSRV_FETCH_ASSOC)){
    $raw['status'] = 1;
    $data = array(); 
    $data['name'] = $name;
    $data['rows'] = $row['rows'];
    
    array_push($raw['data'],$data);
  }  
}


echo json_encode($raw);
sqlsrv_close($conn);
?>