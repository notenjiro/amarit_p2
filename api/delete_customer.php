<?php
require_once '../config_db.php';
require_once '../utils/helper.php';

if(isset($_GET['customer_id'])){

    $customer_id = $_GET['customer_id'];
    $iquery = "DELETE FROM customer WHERE customer_id = '$customer_id'";

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