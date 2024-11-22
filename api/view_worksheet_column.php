 <?php
//  session_start();
 



//  if(!isset($_SESSION["user_role"])){
    // echo json_encode(array("status"=>0));
// return false;
//  }

//  
function debug_get_worksheet_column(){
  require_once './config_db.php';
  global $conn;
  $fQuery = 'SELECT 

  rl.columnWorksheet_id ,
  rl.status 
  FROM 
  FES.dbo.roleList rl 
  LEFT JOIN FES.dbo.[role] r on r.id = rl.role_id 
  WHERE 
  r.rolename = \''.$_SESSION["user_role"].'\'
  AND 
  rl.status = 1';
   $result = sqlsrv_query($conn, $fQuery);

   $rows = [];
   while($row = sqlsrv_fetch_array( $result, SQLSRV_FETCH_ASSOC)){
  $rows[] = $row;
   }

echo $fQuery;
   echo '<pre>';
   print_r($rows);
   echo '</pre>';

   echo '<pre>';
   print_r($_SESSION);
   echo '</pre>';
   
   sqlsrv_close($conn);
}


function get_worksheet_column(){
  require_once './config_db.php';
  // require_once './../config_db.php';
  global $conn;

$data = array();
// $column_list = ["User ID", "Branch", "Client request date", "time", "Worksheet status", "line status", "Worksheet ID", "Date", "Service Type", "Service ID", "Customer No.", "Customer ERP ID", "Customer", "Subject", "Contract number", "Contract line number", "Customer ref.", "Requester", "Remark", "Request method", "Request to", "CS inform OPR", "time (2)", "OPR inform CS", "time (3)", "CS inform client", "time (4)", "Vehicle", "Vehicle ERP ID", "Outsource", "Vendor Name", "Operator/Manpower", "Position", "From (Contract)", "To (Contract)", "Specific location from", "Specific location to", "Contact person (from)", "Contact person (to)", "Charge as", "Outsource charge as", "Remark (2)", "Department", "Cost center", "Universal Location/From", "Universal To", "Mileage start", "Mileage end", "Fuel ratio", "Total Km.", "Km. from contract", "Start date", "Start time", "End date", "End time", "Qty", "UOM", "Amount", "Total amount", "Diesel rate", "No charge", "Consolidate", "Vehicle switch", "Standby charge", "Cancel reason", "Cargo type", "Cargo quantity", "Cargo weight", "Dimension", "Name", "Type", "Sub type 1", "Sub type 2", "Sub type 3", "Sub type 4", "Barcode", "type 1", "type 2", "type 3", "type 4", "worksheet reference 1", "worksheet reference 2", "worksheet reference 3", "worksheet reference 4", "worksheet reference 5", "worksheet reference 6", "line reference 1", "line reference 2", "line reference 3", "line reference 4", "line reference 5", "line reference 6", "Reason for outsource"];
$column_title = ["User ID", "Branch", "Client request date", "time", "Worksheet status", "line status", "Worksheet ID", "Date", "Service Type", "Service ID", "Customer No.", "Customer ERP ID", "Customer", "Subject", "Contract number", "Contract line number", "Customer ref.", "Requester", "Remark", "Request method", "Request to", "CS inform OPR", "time", "OPR inform CS", "time", "CS inform client", "time", "Vehicle", "Vehicle ERP ID", "Outsource", "Vendor Name", "Operator/Manpower", "Position", "From (Contract)", "To (Contract)", "Specific location from", "Specific location to", "Contact person (from)", "Contact person (to)", "Charge as", "Outsource charge as", "Remark", "Department", "Cost center", "Universal Location/From", "Universal To", "Mileage start", "Mileage end", "Fuel ratio", "Total Km.", "Km. from contract", "Start date", "Start time", "End date", "End time", "Qty", "UOM", "Amount", "Total amount", "Diesel rate", "No charge", "Consolidate", "Vehicle switch", "Standby charge", "Cancel reason", "Cargo type", "Cargo quantity", "Cargo weight", "Dimension", "Name", "Type", "Sub type 1", "Sub type 2", "Sub type 3", "Sub type 4", "Barcode", "type 1", "type 2", "type 3", "type 4", "worksheet reference 1", "worksheet reference 2", "worksheet reference 3", "worksheet reference 4", "worksheet reference 5", "worksheet reference 6", "line reference 1", "line reference 2", "line reference 3", "line reference 4", "line reference 5", "line reference 6", "Reason for outsource"];
//$column_title = ["User ID", "Branch", "Client request date", "time", "Worksheet status", "line status", "Worksheet ID", "Date", "Service Type", "Service ID", "Customer No.", "Customer ERP ID", "Customer", "Subject", "Contract number", "Contract line number", "Customer ref.", "Requester", "Remark", "Request method", "Request to", "CS inform OPR", "time", "OPR inform CS", "time", "CS inform client", "time", "Vehicle", "Vehicle ERP ID", "Outsource", "Vendor Name", "Operator/Manpower", "Position", "From (Contract)", "To (Contract)", "Specific location from", "Specific location to", "Contact person (from)", "Contact person (to)", "Charge as", "Outsource charge as", "Remark", "Department", "Cost center", "Universal Location/From", "Universal To", "Mileage start", "Mileage end", "Fuel ratio", "Total Km.", "Km. from contract", "Start date", "Start time", "End date", "End time", "Qty", "UOM", "Amount", "Total amount", "Diesel rate", "No charge", "Consolidate", "Vehicle switch", "Standby charge", "Cancel reason", "Cargo type", "Cargo quantity", "Cargo weight", "Dimension", "Name", "Type", "Sub type 1", "Sub type 2", "Sub type 3", "Sub type 4", "Barcode", "sub 1", "sub 2", "sub 3", "sub 4", "worksheet reference 1", "worksheet reference 2", "worksheet reference 3", "worksheet reference 4", "worksheet reference 5", "worksheet reference 6", "line reference 1", "line reference 2", "line reference 3", "line reference 4", "line reference 5", "line reference 6", "Reason for outsource"];

// 0 - 92 : 93
for($i=0;$i<93;$i++){
    $data[$i]["name"] = $column_title[$i];
    $data[$i]["status"] = 0;
}
  $fQuery = 'SELECT 

rl.columnWorksheet_id ,
rl.status 
FROM 
FES.dbo.roleList rl 
LEFT JOIN FES.dbo.[role] r on r.id = rl.role_id 
WHERE 
r.rolename = \''.$_SESSION["user_role"].'\'
AND 
rl.status = 1';
 $result = sqlsrv_query($conn, $fQuery);

 $rows = [];
 while($row = sqlsrv_fetch_array( $result, SQLSRV_FETCH_ASSOC)){

    // $data[$row["columnWorksheet_id"]]["status"] = $row["status"];
    $data[((int)$row["columnWorksheet_id"])-1]["status"] = $row["status"];
    // $column_list[$i]
// $rows[] = $row;
 }
sqlsrv_close($conn);

// echo '<pre>';
// print_r($data);
// echo '</pre>';
//  header('Content-Type: application/json');
return $data;
// json_encode(array("status"=>1,"data"=>$data));
}
 ?>