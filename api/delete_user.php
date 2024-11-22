<?php
require_once '../config_db.php';
require_once '../utils/helper.php';

if(isset($_GET['user_name'])){

    $user_name = $_GET['user_name'];
    $iquery = "DELETE FROM users WHERE user_name = '$user_name'";

    $stmt = sqlsrv_query($conn, $iquery);
    if($stmt === false){
        $Data["Status"] = "Error";
        $Data["msg"] = "มีบางอย่างผิดพลาด";
    }else{
        $user_name = $_GET['user_name'];
        $iquery = "DELETE FROM user_permission WHERE user_name = '$user_name'";
        $stmt = sqlsrv_query($conn, $iquery);
        $Data["status"] = "Success";
        $Data["msg"] = "ลบข้อมูลเรียบร้อย";
    }
}else{
  $Data["Status"] = "Error";
  $Data["msg"] = "มีบางอย่างผิดพลาด";
}
echo json_encode($Data);

?>