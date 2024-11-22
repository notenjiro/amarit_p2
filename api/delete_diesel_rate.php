<?php
require_once '../config_db.php';
require_once '../utils/helper.php';

if(isset($_GET['diesel_rate_date'])){

    $diesel_rate_date = $_GET['diesel_rate_date'];
    $iquery = "DELETE FROM diesel_rates WHERE diesel_rate_date = '$diesel_rate_date'";

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