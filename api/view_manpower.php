<?php
require_once '../config_db.php';
require_once '../utils/helper.php';



$fQuery = "SELECT  * FROM manpower";
$result = sqlsrv_query($conn, $fQuery);
$raw['data'] = array();

//while($row = sqlsrv_fetch_array( $result, SQLSRV_FETCH_ASSOC)){
//    $data = [$row['manpower_id'],$row['name'],$row['lastname']];
//    array_push($raw['data'],$data);
//}

while($row = sqlsrv_fetch_array( $result, SQLSRV_FETCH_ASSOC)){
    $dayoff = "";
    $dayoff .= $row["monday"]?" Mon":"";
    $dayoff .= $row["tuesday"]?" Tue":"";
    $dayoff .= $row["wednesday"]?" Wed":"";
    $dayoff .= $row["thursday"]?" Thu":"";
    $dayoff .= $row["friday"]?" Fri":"";
    $dayoff .= $row["saturday"]?" Sat":"";
    $dayoff .= $row["sunday"]?" Sun":"";
    $data = [$row['manpower_id'], $row['manpower_id'],$row['name'],$row['lastname'],$dayoff];
    array_push($raw['data'],$data);
}

echo json_encode($raw);
sqlsrv_close($conn);
?>