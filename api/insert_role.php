<?php
error_reporting(1);
require_once '../config_db.php';
require_once '../utils/helper.php';

$roleName = $_POST['role'];
$allColumn = $_POST['allColumn'];

$queryNewRole = "INSERT INTO FES.dbo.[role] (rolename,status) OUTPUT INSERTED.ID VALUES ('$roleName',1)";
$stmt = sqlsrv_query($conn, $queryNewRole);
sqlsrv_fetch($stmt);
$insertedId = sqlsrv_get_field($stmt, 0);

$result = array();
$result['t'] = $roleName;
   if($stmt === false){
        $result['error'] = sqlsrv_errors();
        $result['status'] = 0;
        echo json_encode($result);
   }else{  
      $result['id'] = $insertedId;

      if($insertedId){
         if($allColumn){
            for ($i=0; $i<count($allColumn); $i++){
               $iquery = "INSERT INTO FES.dbo.roleList (role_id, columnWorksheet_id,status) VALUES ($insertedId, $allColumn[$i],1)";
               $stm = sqlsrv_query($conn, $iquery);

               if($stm === false){
                  $result['error'] = sqlsrv_errors();
                  $result['status'] = 0;
                  echo json_encode($result);
                  break;
               }else{
                    if($i == count($allColumn) - 1){
                        $result['msg'] = 'success'; 
                        $result['status'] = 1;
                        $result['lastindex'] = $i;
                        echo json_encode($result);
                     }
               }
            } 
         }
      }
   }

sqlsrv_close($conn);

?>


