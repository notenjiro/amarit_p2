<?php
require_once '../config_db.php';
require_once '../utils/helper.php';

if(isset($_GET['operator_id'])){

    $operator_id = $_GET['operator_id'];
    $iquery = "DELETE FROM operator WHERE operator_id = '$operator_id'";

    $stmt = sqlsrv_query($conn, $iquery);
    if($stmt === false){
        $Data["Status"] = "Error";
        $Data["msg"] = "มีบางอย่างผิดพลาด";
    }else{
      $Data["Status"] = "Success";
      $Data["msg"] = "Record has been deleted";
    }
}else{
  $Data["Status"] = "Error";
  $Data["msg"] = "มีบางอย่างผิดพลาด";
}
echo json_encode($Data);

?>