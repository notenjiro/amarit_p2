<?php
error_reporting(1);
require_once '../config_db.php';
require_once '../utils/helper.php';

$wsid = $_GET['wsid'];
$idWsFind =  $_GET['idWsFind'];
$idWorksheet = $_GET['idService'];
$Data = array();
$type = $_GET['type'];
$nameservice =  $_GET['nameservice'];
$table = array(
    "worksheet" => "worksheet",
    "job" => "job"
);

$check = array(
    "worksheet" => "worksheet_id",
    "job" => "job_id"
);



if($type == "job"){ //check uniq service id
    $checkSevice = array(
         // 'transport'=>'_cargo_transport',
         'manpower'=>'manpower_id',
         // 'cargo'=>'_cargo_handling',
         'immigration'=>'immigration_id',
         'taxi'=>'taxi_service_job_id',
        'warehousing' => 'warehousing_space_rental_id',
        'utilities' => 'utilities_id',
        'rental' => 'rental_id',
        'hotelbooking' => 'hotelbooking_id',
        'ticketbooking' => 'ticketbooking_id',
        'serviceother' => 'serviceother_id',
        'agencyservice' => 'agencyservice_id',
        'managementfree' => 'managementfree_id',
        'provisionincome' => 'provisionincome_id',
        'customerclearancecargo' => 'clearance_cargo_id',
        'customerclearancevessel' => 'clearance_vessel_id'
    );    
}else{
   $checkSevice = array(
    'transport'=>'transport_id',
    'manpower'=>'labor_service_id',
    'cargo'=>'cargo_service_id',
    'immigration'=>'immigration_id',
    'taxi'=>'taxi_service_id',
    'warehousing' => 'warehousing_space_rental_id',
    'utilities' => 'utilities_id',
    'rental' => 'rental_id',
	'hotelbooking' => 'hotelbooking_id',
	'ticketbooking' => 'ticketbooking_id',
    'serviceother' => 'serviceother_id',
    'agencyservice' => 'agencyservice_id',
    'managementfree' => 'managementfree_id',
    'provisionincome' => 'provisionincome_id',
    'customerclearancecargo' => 'customerclearancecargo_id',
    'customerclearancevessel' => 'customerclearancevessel_id'
);
 
}





if($type == "job"){
    $service = array(
        // 'transport'=>'_cargo_transport',
        'manpower'=>'_manpower',
        // 'cargo'=>'_cargo_handling',
        'immigration'=>'_immigration',
        'taxi'=>'_taxi_service',
        'warehousing' => '_warehousing_space_rental',
        'utilities' => '_utilities',
        'rental' => '_rental',
        'hotelbooking' => '_hotel_booking',
        'ticketbooking' => '_ticket_booking',
        'serviceother' => '_service_other',
        'agencyservice' => '_agency_service',
        'managementfree' => '_management_fee',
        'provisionincome' => '_provision_income',
        'customerclearancecargo' => '_clearance_cargo',
        'customerclearancevessel' => '_clearance_vessel'
    ); 
}else{
   $service = array( 
    'transport'=>'_cargo_transport',
    'manpower'=>'_manpower',
    'cargo'=>'_cargo_handling',
    'immigration'=>'_immigration',
    'taxi'=>'_taxi',
    'warehousing' => '_warehousing_space_rental',
    'utilities' => '_utilities',
    'rental' => '_rental',
	'hotelbooking' => '_hotel_booking',
	'ticketbooking' => '_ticket_booking_job',
    'serviceother' => '_service_other_job',
    'agencyservice' => '_agency_service',
    'managementfree' => '_management_free',
    'provisionincome' => '_provision_income',
    'customerclearancecargo' => '_customer_clearance_cargo',
    'customerclearancevessel' => '_customer_clearance_vessel'
    ); 
}

$headerSevice = array(
    'transport'=>'TP',
    'manpower'=>'LS',
    'cargo'=>'CH',
    'immigration'=>'IM',
    'taxi'=>'PT',
    'warehousing' => 'WH',
    'utilities' => 'UT',
    'rental' => 'RN',
	'hotelbooking' => 'BS',
	'ticketbooking' => 'BS',
    'serviceother' => 'SO',
    'agencyservice' => 'AG',
    'managementfree' => 'SO',
    'provisionincome' => 'PV',
    'customerclearancecargo' => 'CH',
    'customerclearancevessel' => 'SH'
); 

if($idWorksheet && $service[$nameservice]){
    $newWorksheet = "";
    $getquery = "SELECT * FROM ".$table[$type].$service[$nameservice]." WHERE ".$checkSevice[$nameservice]." ='".$idWorksheet."' and ".$check[$type]."  = '".$idWsFind."'";
    $result = sqlsrv_query($conn, $getquery);
   
    if($result === false){
        $Data["status"] = 0;
        $Data['error'] = sqlsrv_errors();
        $Data["msg"] = "Sorry, Can't find worksheet";
    }else{
      
        //add service 
       
                $nameserviceeyservice = array();
                $valueservice = array();
                 while($results = sqlsrv_fetch_array( $result, SQLSRV_FETCH_ASSOC)){
                    $Data["mg"] = $results;
                                    foreach ($results as $nameserviceey => $value) {
                                        if($nameserviceey !== 'reccode'){
                                            array_push($nameserviceeyservice,$nameserviceey);

                                            $val = "";
                                            
                                            
                                            if(is_string($value) && strlen($value) == 0 || $value == null){
                                                $value = "-";  
                                            }

                                            if(is_object($value) || (str_contains($nameserviceey, 'time') && $nameserviceey !==  'ontime') || ( str_contains($nameserviceey, 'date') && $nameserviceey !== 'consolidate')){
                                                if(is_null($value)){
                                                    $val = "NULL";
                                                 
                                                }else{
                                                      $date = array_values((array) $value);
                                                $val =  "'".$date[0]."'";
                                                
                                                    if (str_contains($nameserviceey, 'time')) {
                                                        $timestamp = strtotime($date[0]);
                                                        $val = "'".date("H:i:s", $timestamp)."'";
                                                    }else{
                                                        $val = "'".date("Y-m-d", strtotime($date[0]))."'";
                                                    }
                                                }
                                            }else{
                                                // if (is_string($value) || is_integer($value) ) {

                                                    if($nameserviceey == $check[$type]){
                                                    
                                                        $val = "'".$wsid."'"; 

                                                    }else if($nameserviceey == $checkSevice[$nameservice]){
                                                            $currentDate = date('ym');
                                                            $getlastsvIdquery = "SELECT MAX( ".$checkSevice[$nameservice].") as id FROM ".$table[$type].$service[$nameservice]." WHERE  ".$checkSevice[$nameservice]." LIKE '".$headerSevice[$nameservice].$currentDate."%'";
                                                            $rsgsv = sqlsrv_query($conn, $getlastsvIdquery);
                                                        
                                                            if($rsgsv != false){
                                                                $serviceid = "";
                                                                $ressv = sqlsrv_fetch_array( $rsgsv, SQLSRV_FETCH_ASSOC);
                                                                if($ressv['id']){
                                                                    $serviceid  = $ressv['id'];  
                                                                }else{
                                                                    $serviceid  =  $headerSevice[$nameservice].$currentDate.'0000';
                                                                }
                                                                $oldId = preg_replace('/\D/', '',  $serviceid );
                    
                                                                $maxNumber = intval($currentDate.'9999');
                                                                $newId = intval($oldId + 1); 
                    
                                                                $Data['max'] = $maxNumber;
                                                                $Data["id"] = $newId;
                                                                
                                                                if( $newId <= $maxNumber){ 
                                                                    $val = $headerSevice[$nameservice].$newId;
                                                                }
                                                                else{
                            
                                                                            $currentdt = new DateTime();
                                                                            $currentdt->modify('+1 month');
                                                                            $nextMonth = $currentdt->format('ym');
                                                                            $ws = $headerSevice[$nameservice].$nextMonth."%";
                                                                            $getlastIdquerynm = "SELECT MAX( ".$checkSevice[$nameservice].") as id FROM ".$table[$type].$service[$nameservice]." WHERE  ".$checkSevice[$nameservice]." LIKE '".$ws."%'";
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
                                                                                        $newidNext =  "'".$headerSevice[$nameservice].$new."'";
                                                                                    }else{
                                                                                    $next = intval($nextMonth + 1); 
                                                                                    $newidNext =  "'".$headerSevice[$nameservice].$next."0001'";
                                                                                    }
                                                                                }else{
                                                                                    $newidNext =  "'".$headerSevice[$nameservice].$nextMonth."0001'";
                                                                                }
        
                                                                                $val = $newidNext;
                                                                            
                                                                            }
                                                                }
                                                            }
                                                            $val = "'".$val."'"; 
                                                            // $Data["neid".$val] = $val;
        
                                                    }else{
                
                                                            if(is_string($value)){
                                                                if (is_null($value)) {
                                                                    $value = "NULL";  
                                                                } 
                                                                $val = "'".$value."'"; 
                                                            }else{
                                                                if (is_null($value)) {
                                                                    $value = "NULL";  
                                                                } 

                                                                
                                                                $val = $value; 
                                                            }

                                                            $Data['ffg'] = $val;
                                                            
                                                            if (preg_match('/\.\d+$/', $val) || preg_match('/^[0-9,.]+$/', $val)) {
                                                                $num = number_format($val, 2); 
                                                                $val = $num;
                                                            }

                                                            
                                                    }
                                                
                                                // }
                                            }
                                      
                                           
                                            
                                            
                                            array_push($valueservice,$val);
                                        }
                                    }
                            
                    
                }  
                $Data['k'] = $nameserviceeyservice;
                            $Data['v'] = $valueservice;
            if($nameserviceeyservice && $valueservice){

                        $column = '(' . implode(',', $nameserviceeyservice) . ')';
                        $value =  '(' . implode(',', $valueservice) . ')';
                        
                        $isquery = "INSERT INTO ".$table[$type].$service[$nameservice]." ".$column."VALUES".$value;
                        
                        $r = sqlsrv_query($conn, $isquery);
                        if($r === false){
                            $Data["status"] = 0;
                            $Data['q'] = $isquery;
                            
                            $Data['error'] = sqlsrv_errors();
                            $Data["msg"] = "Sorry, Can't copy worksheet";
                        }
                        else{
                            $Data["status"] = 1;
                        }
            }
    }

}

echo json_encode($Data);

sqlsrv_close($conn);

?>

