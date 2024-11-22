<?php
require_once '../config_db.php';
require_once '../utils/helper.php';



$fQuery = "select o.*,p.description as position_name,c.description as branch_name FROM operator o left join position p on p.code = o.position left join location c on o.branch = c.code ";
$result = sqlsrv_query($conn, $fQuery);
$raw['data'] = array();

while($row = sqlsrv_fetch_array( $result, SQLSRV_FETCH_ASSOC)){
    $dayoff = "";
    $dayoff .= $row["monday"]?" Mon":"";
    $dayoff .= $row["tuesday"]?" Tue":"";
    $dayoff .= $row["wednesday"]?" Wed":"";
    $dayoff .= $row["thursday"]?" Thu":"";
    $dayoff .= $row["friday"]?" Fri":"";
    $dayoff .= $row["saturday"]?" Sat":"";
    $dayoff .= $row["sunday"]?" Sun":"";
    $data = [$row['operator_id'], $row['operator_id'], $row['name'], $row['lastname'], $dayoff, $row['staff_id'], $row['branch_name'], $row['position_name']];
    array_push($raw['data'],$data);
}

echo json_encode($raw);
sqlsrv_close($conn);
?>