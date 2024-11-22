<?php
require_once '../config_db.php';
require_once '../utils/helper.php';

if(isset($_GET['code'])){

    $manpower_id = $_GET['code'];
    $iquery = "DELETE FROM manpower WHERE manpower_id = '$manpower_id'";

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