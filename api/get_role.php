<?php
require_once '../config_db.php';
require_once '../utils/helper.php';

$id = $_GET['id'];
$fQuery = "SELECT * FROM FES.dbo.[role] WHERE id =".$id;
$result = sqlsrv_query($conn, $fQuery);
$raw['data'] = array();

while($row = sqlsrv_fetch_array( $result, SQLSRV_FETCH_ASSOC)){
    
    $iquery = "SELECT wc.id,wc.name_column FROM FES.dbo.roleList rl Left join worksheetColumn wc on rl.columnWorksheet_id = wc.id WHERE role_id = ". $row["id"] ."and status = 1 ";
    $stm = sqlsrv_query($conn, $iquery);

    $arr = array();
    while($rs = sqlsrv_fetch_array( $stm, SQLSRV_FETCH_ASSOC)){
        $objData = array();
        $objData['id'] = $rs['id'];
        $objData['name'] = $rs['name_column'];
        array_push($arr, $objData);
    }

    $raw['data']['role'] = $row['rolename'];
    $raw['data']['column'] = $arr;
}

echo json_encode($raw);
sqlsrv_close($conn);
?>