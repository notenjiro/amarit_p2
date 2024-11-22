<?php
require_once '../config_db.php';
require_once '../utils/helper.php';

$fQuery = "SELECT * FROM FES.dbo.[role] WHERE status = 1 ORDER BY id ASC";
$result = sqlsrv_query($conn, $fQuery);
$raw['data'] = array();

while($row = sqlsrv_fetch_array( $result, SQLSRV_FETCH_ASSOC)){
    
    $iquery = "SELECT wc.name_column FROM FES.dbo.roleList rl 
    Left join worksheetColumn wc on rl.columnWorksheet_id = wc.id 
    WHERE role_id = ". $row["id"] ."and status = 1 ";
    $stm = sqlsrv_query($conn, $iquery);

    $arr = array();
    while($rs = sqlsrv_fetch_array( $stm, SQLSRV_FETCH_ASSOC)){
        array_push($arr, " ".$rs['name_column']." ");
    }
    
    $data = ['',$row['id'], $row['rolename'],$arr];
    array_push($raw['data'],$data);
}

echo json_encode($raw);
sqlsrv_close($conn);
?>