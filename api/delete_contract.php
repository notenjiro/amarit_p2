<?php
require_once '../config_db.php';
require_once '../utils/helper.php';

if(isset($_GET['contract_no'])){

    $contract_no = $_GET['contract_no'];
    $iquery = "DELETE FROM customer_contract WHERE contract_no = '$contract_no'";

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