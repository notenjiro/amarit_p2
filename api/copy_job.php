<?php
error_reporting(1);
require_once '../config_db.php';
require_once '../utils/helper.php';
 
$idWorksheet = $_GET['id'];
$Data = array();
$type = $_GET['type'];

$table = array(
    "worksheet" => "worksheet",
    "job" => "job"
);

$check = array(
    "worksheet" => "worksheet_id",
    "job" => "job_id"
);

$heeder = array(
    "worksheet" => "WS",
    "job" => "JS"
);

$checkSevice = array(
    'warehousing' => 'warehousing_space_rental_id',
    'utilities' => 'utilities_id',
    'rental' => 'rental_id',
	'hotelbooking' => 'hotelbooking_id',
	'ticketbooking' => 'ticketbooking_id'
);

$service = array(
    'warehousing' => '_warehousing_space_rental',
    'utilities' => '_utilities',
    'rental' => '_rental',
	'hotelbooking' => '_hotel_booking',
	'ticketbooking' => '_ticket_booking_job'
);

$headerSevice = array(
    'warehousing' => 'WH',
    'utilities' => 'UT',
    'rental' => 'RN',
	'hotelbooking' => 'BS',
	'ticketbooking' => 'BS'
); 

if($idWorksheet){
    $newWorksheet = "";
    $getquery = "SELECT * FROM ".$table[$type]." WHERE ".$check[$type]." ='".$idWorksheet."'";
    $result = sqlsrv_query($conn, $getquery);
    if($result === false){
        $Data["status"] = 0;
        $Data['error'] = sqlsrv_errors();
        $Data["msg"] = "Sorry, Can't find worksheet";
    }else{
        $keys = array();
        $values = array();
        while($row = sqlsrv_fetch_array( $result, SQLSRV_FETCH_ASSOC)){
            if(count($row) > 0){ 
                    foreach ($row as $key => $value) {
                        if($key !== 'reccode'){
                            array_push($keys,$key);

                            $val = "''";
                            if($key == 'printed'){
                                $value = "";
                            }
                             if($key == 'worksheet_status' ){
                                $value = "Open";
                            }
                             if($key == 'modify_date' || $key == 'create_date' || $key == 'worksheet_date' ){
                                $value = date('Y-m-d');
                            } 
                            if($key == 'send_date' ||$key == 'send_time' || $key == 'rcvd_date'|| $key == 'rcvd_time'|| $key =='close_date'|| $key =='close_time' || 
                            $key == 'print_date'  ||$key == ' client_inform_amarit_date'  ||$key == 'client_inform_amarit_time' ||$key == ' cs_inform_opr_date'  ||$key == 'cs_inform_opr_time' ||$key == 'opr_inform_cs_date' ||$key == 'opr_inform_cs_time' ||$key == 'cs_inform_client_date'  ||$key == 'cs_inform_client_time'  ||$key == ' date_in_vendor_invoice'  ||$key == 'date_vendor_submit_to_amarit' ||$key == 'vendor_invoice_due_date' ||$key == 'expense_sub_date' ||$key == 'date_job_ws_sent_to_manage'  ||$key == 'date_job_ws_received_back'){
                                $value = date('Y-m-d H:i:s');
                            }

                            if(is_object($value) ){
                                $date = array_values((array) $value);
                                $val =  "'".$date[0]."'";
                            }elseif (is_string($value)) {
                                $val = "'".$value."'"; 
                            }

                            array_push($values,$val);
                        }
                        
                    } 
            }
        }

        if($keys && $values){
            
            $currentDate = date('ym');
            $getlastIdquery = "SELECT MAX( ".$check[$type].") as id FROM ".$table[$type]." WHERE  ".$check[$type]." LIKE '".$heeder[$type].$currentDate."%'";
            
            $rs = sqlsrv_query($conn, $getlastIdquery);
                if($rs != false){
                    $worksheet = "";
                    while($res = sqlsrv_fetch_array( $rs, SQLSRV_FETCH_ASSOC)){
                        if($res['id']){
                          $worksheet = $res['id'];  
                        }else{
                          $worksheet =  $heeder[$type].$currentDate.'00000';
                        }
                    }
                    
                    $oldId = preg_replace('/\D/', '', $worksheet);

                    $maxNumber = intval($currentDate.'99999');
                    $newId = intval($oldId + 1); 

                    $Data['max'] = $maxNumber;
                    $Data["id"] = $newId;

                    if( $newId <= $maxNumber){
                        $values[0] =  "'".$heeder[$type].$newId."'";
                        $newWorksheet =  $values[0];

                        $column = '(' . implode(',', $keys) . ')';
                        $value = '(' . implode(',', $values) . ')';
                        
                        $iquery = "INSERT INTO ".$table[$type].$column."VALUES".$value;
                        $r = sqlsrv_query($conn, $iquery);
                        if($r === false){
                            $Data["status"] = 0;
                            $Data['q'] = $iquery;
                            $Data['error'] = sqlsrv_errors();
                            $Data["msg"] = "Sorry, Can't copy worksheet";
                        }
                        else{
                            $Data["status"] = 1;
                            $Data["msg"] = "Copy Worksheet success!";
                        }
                    }else{
                        $currentdt = new DateTime();
                        $currentdt->modify('+1 month');
                        $nextMonth = $currentdt->format('ym');
                        $ws = $heeder[$type].$nextMonth."%";
                        // $getlastIdquerynm = "SELECT worksheet_id as id FROM worksheet WHERE worksheet_id LIKE 'WS".$nextMonth."00001'";
                        $getlastIdquerynm = "SELECT MAX(".$check[$type].") as id FROM ".$table[$type]." WHERE ".$check[$type]." LIKE '". $ws."'";
 
                        $resultid = sqlsrv_query($conn, $getlastIdquerynm);
                            
                        if($resultid  != false){
                             
                            $res = sqlsrv_fetch_array( $resultid, SQLSRV_FETCH_ASSOC);
                            $Data['e'] =  $res ;
                            
                            if($res['id'] !==  null){
                                $old = preg_replace('/\D/', '', $res['id']);

                                $max = intval($nextMonth.'99999');
                                $new = intval($old + 1); 
                                if( $new <= $max){
                                    $values[0] =  "'".$heeder[$type].$new."'";
                                }
                            }else{
                                $values[0] =  "'".$heeder[$type].$nextMonth."00001'";
                            }
                            $newWorksheet =  $values[0];
                            $column = '(' . implode(',', $keys) . ')';
                            $value = '(' . implode(',', $values) . ')';
                          
                            $iquery = "INSERT INTO ".$table[$type].$column."VALUES".$value;
                            $r = sqlsrv_query($conn, $iquery);
                            if($r === false){
                                $Data["status"] = 0;
                                $Data['q'] = $iquery;
                                $Data['error'] = sqlsrv_errors();
                                $Data["msg"] = "Sorry, Can't copy ";
                            }
                            else{
                                $Data["status"] = 1;
                                $Data["msg"] = "Copy Worksheet success!";
                            }
                        }
                    }

                   
                }

            
        }

        //add service 
        foreach($service as $k => $v) {
            
                $getsv = "SELECT * FROM ".$type.$v." WHERE ".$check[$type]." ='".$idWorksheet."'"; //check ใน 
                $qsv = sqlsrv_query($conn, $getsv);
                
                if($qsv === false){
                    $Data["status"] = 0;
                    $Data['error'] = sqlsrv_errors();
                    $Data["msg"] = "Sorry, Can't find service from ".$v;
                    break;
                }else{    
                    $keyservice = array();
                    $valueservice = '';
                    $i = 0;
                    while($resultsv = sqlsrv_fetch_array($qsv, SQLSRV_FETCH_ASSOC)){
                          if($i == 0){ 
                                    $newValues = '';
                                    $index = 0;
                                    foreach ($resultsv as $key => $value) {
                                        if($key !== 'reccode'){
                                            array_push($keyservice,$key);

                                            $val = "";
                                            if(strlen($value) == 0){
                                                $value = "-";  
                                            }
                                            if(is_object($value) ){
                                                $date = array_values((array) $value);
                                                $val =  "'".$date[0]."'";
                                            }elseif (is_string($value) || is_integer($value)) {

                                                if($key == $check[$type]){
                                                    $val = $newWorksheet; 
                                                }else{
                                                    $val = "'".$value."'"; 
                                                }
                                                
                                            }
                                            
                                            if($index == 0){
                                                $newValues .= "(".$val.",";  
                                            }elseif($index == (count($resultsv)-2) ){ // -2 เพราะตัด column reccord ไปดด้วย
                                                $newValues .= $val.")";  
                                            }
                                            else{
                                               $newValues .= $val.",";  
                                            }
                                           
                                            $index++;
                                        }
                                    }
                                    $valueservice = $valueservice.$newValues;
                            }
                            if($i > 0){
                                $newValues = '';
                                $index = 0;
                                foreach ($resultsv as $key => $value) {
                                 
                                    if($key !== 'reccode'){
                                        $val = "";
                                        if(strlen($value) == 0){
                                            $value = "-";  
                                        }
                                        if(is_object($value) ){
                                            $date = array_values((array) $value);
                                            $val =  "'".$date[0]."'";
                                        }elseif (is_string($value) || is_integer($value)) {

                                            if($key == $check[$type]){
                                                $val = $newWorksheet; 
                                            }else{
                                                $val = "'".$value."'"; 
                                            }
                                            
                                        }
                                        
                                        if($index == 0){
                                            $newValues .= "(".$val.",";  
                                        }elseif($index == (count($resultsv)-2) ){ // -2 เพราะตัด column reccord ไปดด้วย
                                            $newValues .= $val.")";  
                                        }
                                        else{
                                           $newValues .= $val.",";  
                                        }
                                       
                                        $index++;
                                    }
                                   
                                } 
                                $valueservice = $valueservice.",".$newValues;
                                
                            }
                            
                        
                        
                        $i++;
                    }
                }  
            
            if($keyservice && $valueservice){
                        $column = '(' . implode(',', $keyservice) . ')';
                        $value =  $valueservice;

                        $iquery = "INSERT INTO ".$type.$v.$column."VALUES".$value;
                        $r = sqlsrv_query($conn, $iquery);
                        if($r === false){
                            $Data["status"] = 0;
                            $Data['q'] = $iquery;
                            $Data['error'] = sqlsrv_errors();
                            $Data["msg"] = "Sorry, Can't copy worksheet";
                            break;
                        }
                        else{
                            $findlastsvIdquery  = "SELECT * FROM ".$type.$v." WHERE ".$check[$type]." = ".$newWorksheet." order by reccode ASC" ; 
                            $rsFind= sqlsrv_query($conn, $findlastsvIdquery);
                            
                            if($rsFind === false){
                                $Data["status"] = 0;
                                $Data['q'] = $findlastsvIdquery;
                                $Data['error'] = sqlsrv_errors();
                                $Data["msg"] = "Sorry, Can't find service ".$k." form newid";
                                break;
                            }else{
                                while($rsLast = sqlsrv_fetch_array($rsFind, SQLSRV_FETCH_ASSOC)){
                                    if($rsLast['reccode']){
                                        $currentDate = date('ym');
                                        $getlastsvIdquery = "SELECT MAX( ".$checkSevice[$k].") as id FROM ".$type.$v." WHERE  ".$checkSevice[$k]." LIKE '".$headerSevice[$k].$currentDate."%'";
                                        $rsgsv = sqlsrv_query($conn, $getlastsvIdquery);
                                       
                                        if($rsgsv != false){
                                            $service = "";
                                            $ressv = sqlsrv_fetch_array( $rsgsv, SQLSRV_FETCH_ASSOC);
                                            if($ressv['id']){
                                                $service  = $ressv['id'];  
                                            }else{
                                                $service  =  $headerSevice[$k].$currentDate.'0000';
                                            }
                                            $oldId = preg_replace('/\D/', '',  $service );

                                            $maxNumber = intval($currentDate.'9999');
                                            $newId = intval($oldId + 1); 

                                            $Data['max'] = $maxNumber;
                                            $Data["id"] = $newId;
                                            
                                            if( $newId <= $maxNumber){
                                                $udquery = "UPDATE ".$type.$v." SET ".$checkSevice[$k]." = '".$headerSevice[$k].$newId ."' WHERE  reccode =".$rsLast['reccode']." and ".$check[$type]." = ".$newWorksheet;
                                                $rud= sqlsrv_query($conn, $udquery);
                                                if($rud === false){
                                                    $Data["status"] = 0;
                                                    $Data['q'] = $iquery;
                                                    $Data['error'] = sqlsrv_errors();
                                                    $Data["msg"] = "Sorry, Can't update id set".$k;
                                                    break;
                                                }
                                            }
                                            else{
                                                        $currentdt = new DateTime();
                                                        $currentdt->modify('+1 month');
                                                        $nextMonth = $currentdt->format('ym');
                                                        $ws = $headerSevice[$k].$nextMonth."%";
                                                        $getlastIdquerynm = "SELECT MAX( ".$checkSevice[$k].") as id FROM ".$type.$v." WHERE  ".$checkSevice[$k]." LIKE '".$ws."%'";
                                                        $resultid = sqlsrv_query($conn, $getlastIdquerynm);
                                                            
                                                        if($resultid  != false){
                                                            $res = sqlsrv_fetch_array( $resultid, SQLSRV_FETCH_ASSOC);
                                                            $Data['e'] =  $res ;
                                                            $newidNext = '';
                                                            if($res['id'] !==  null){
                                                                $old = preg_replace('/\D/', '', $res['id']);
                                
                                                                $max = intval($nextMonth.'9999');
                                                                $new = intval($old + 1); 
                                                                if( $new <= $max){
                                                                    $newidNext =  "'".$headerSevice[$k].$new."'";
                                                                }else{
                                                                   $next = intval($nextMonth + 1); 
                                                                   $newidNext =  "'".$headerSevice[$k].$next."0001'";
                                                                }
                                                            }else{
                                                                $newidNext =  "'".$headerSevice[$k].$nextMonth."0001'";
                                                            }
                                                            echo $newidNext;
                                                            $upquery = "UPDATE ".$type.$v." SET ".$checkSevice[$k]." = ".$newidNext ."WHERE  reccode =".$rsLast['reccode']." and ".$check[$type]." = ".$newWorksheet;
                                                            $r = sqlsrv_query($conn, $upquery);
                                                            if($r === false){
                                                                $Data["status"] = 0;
                                                                $Data['q'] = $upquery;
                                                                $Data['error'] = sqlsrv_errors();
                                                                $Data["msg"] = "Sorry, Can't copy ";
                                                                break;
                                                            }
                                                            else{
                                                                $Data["status"] = 1;
                                                                $Data["msg"] = "Copy Worksheet success!";
                                                            }
                                                        }
                                            }
                                        }
                                    }
                                }
                                
                            }

                        }

            
            }

                
            
        }
        }
    }



echo json_encode($Data);

sqlsrv_close($conn);

?>

