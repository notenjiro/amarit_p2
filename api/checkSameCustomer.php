<?php
require_once '../config_db.php';
require_once '../utils/helper.php';

$wsid = $_GET['wsid'];
    $iquery = "SELECT TOP 1 worksheet_id,customer FROM worksheet WHERE worksheet_id = '$wsid'";

    $stmt = sqlsrv_query($conn, $iquery);
    if($stmt === false){
        $Data["Status"] = 0;
        $Data["msg"] = "มีบางอย่างผิดพลาด";
    }else{
        $data = [];
        while($rs = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC)){
            $objData['worksheet_id'] = $rs['worksheet_id'];
            $objData['customer'] = $rs['customer'];
            array_push($data, $objData);
        }
      $Data["Status"] = 1;
      $Data["data"] = $data;
    }

echo json_encode($Data);

?>