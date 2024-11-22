<?php
require_once '../config_db.php';
require_once '../utils/helper.php';

if(isset($_GET['id'])){

    $id = $_GET['id'];
    // $iquery = "UPDATE FES.dbo.[role] SET status = 0 WHERE code =".$id;
    $iquery = "DELETE FES.dbo.[poe_pod] WHERE code ='".$id."'";
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