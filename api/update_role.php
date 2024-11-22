<?php
error_reporting(1);
require_once '../config_db.php';
require_once '../utils/helper.php';

$id = $_POST['id'];
$roleName = $_POST['role'];
$allColumn = $_POST['allColumn'];

$queryNewRole = "UPDATE FES.dbo.[role] SET rolename = '".$roleName."' OUTPUT inserted.id  WHERE id =".$id ;
$stmt = sqlsrv_query($conn, $queryNewRole);
sqlsrv_fetch($stmt);
$insertedId = sqlsrv_get_field($stmt, 0);

$result = array();
   if($stmt === false){
        $result['error'] = sqlsrv_errors();
        $result['status'] = 0;
        echo json_encode($result);
   }else{  
      if($insertedId){ 
         if($allColumn){

            $checkAllColumn = "SELECT * FROM FES.dbo.roleList WHERE role_id =". $insertedId ;
            $qrCheckAllColumn = sqlsrv_query($conn, $checkAllColumn);
            $rowAllColumn = array();
            while($row = sqlsrv_fetch_array($qrCheckAllColumn, SQLSRV_FETCH_ASSOC)) {
               array_push($rowAllColumn,$row);
            }

            $result['column'] = $rowAllColumn;
            $column = array();
            
            
            //ckeck Columm เก่าว่ามีใน data ที่ add ใหม่มั้ย ถ้าไม่มี ต้อง update sttus = 0
            for ($i=0; $i<count($rowAllColumn); $i++){ 
               array_push($column,$rowAllColumn[$i]['columnWorksheet_id']);
               $checkSame = in_array($rowAllColumn[$i]['columnWorksheet_id'],$allColumn);
               if(!$checkSame){// update Column เก่า
                  $udStatus = "UPDATE FES.dbo.roleList SET status = 0 WHERE role_id = " . $rowAllColumn[$i]['role_id'] ."and columnWorksheet_id =".$rowAllColumn[$i]['columnWorksheet_id'] ;
                  $qrUdStatus = sqlsrv_query($conn, $udStatus);
                  if($qrUdStatus == false){
                     $result['error'] = sqlsrv_errors();
                     $result['status'] = 0;
                     echo json_encode($result);
                  }
               }
            }
            
            //add New 
               for ($i=0; $i<count($allColumn); $i++){ 
                  // check ว่ามีใน data ที่มีอยู่ก่อนแล้วมั้ยถ้าไม่มีให้ insert ใหม่ ถ้ามีให้ update status เป็น 1
                  $checkNew = in_array($allColumn[$i],$column);
                  $result['c'] = $allColumn[$i];
                  $id = (int)$allColumn[$i];
                  if(!$checkNew){
                     
                     $isquery = "INSERT INTO FES.dbo.roleList (role_id, columnWorksheet_id,status) VALUES ($insertedId, $id,1)";
                     $isqr = sqlsrv_query($conn, $isquery);
                        if($isqr === false){
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
                  }else{
                     $udStatusColumn = "UPDATE FES.dbo.roleList SET status = 1 WHERE role_id = " . $insertedId ."and columnWorksheet_id =".$id ;
                     $qrUdStatusColumn = sqlsrv_query($conn, $udStatusColumn);
                     if($qrUdStatusColumn == false){
                        $result['error'] = sqlsrv_errors();
                        $result['status'] = 0;
                        echo json_encode($result);
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
   }

sqlsrv_close($conn);

?>


