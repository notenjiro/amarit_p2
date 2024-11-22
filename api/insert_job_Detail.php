<?php
error_reporting(1);
require_once '../config_db.php';
require_once '../utils/helper.php';
$type = $_GET['type'];
$name = $_POST['name'];
$data = $_POST['data'];
$keyData =  array_keys($data);
$valueData =  array_values($data);
$column = '(' . implode(',', $keyData) . ')';
$values = array();

foreach ($valueData as $key => $value) {
    if(strlen($value) == 0 ){
        $value = '-';
    }
    $val = "'" . $value . "'";
   array_push($values,$val);
}

$arrValues = '(' . implode(',', $values) . ')';
// obj เก็บชื่อ table ที่จะ insert



if($type == "job"){
    $Table = array(
        'warehousing' => 'job_warehousing_space_rental',
        'utilities' => 'job_utilities',
        'rental' => 'job_rental',
        'hotelbooking' => 'job_hotel_booking',
        'ticketbooking' => 'job_ticket_booking',
        'serviceother' => 'job_service_other',
        'agencyservice' => 'job_agency_service',
        'managementfree' => 'job_management_fee',
        'provisionincome' => 'job_provision_income',
        'customerclearancecargo' => 'job_clearance_cargo',
        'customerclearancevessel' => 'job_clearance_vessel'
    ); 
}else{
    $Table = array(
        'warehousing' => 'worksheet_warehousing_space_rental',
        'utilities' => 'worksheet_utilities',
        'rental' => 'worksheet_rental',
        'hotelbooking' => 'worksheet_hotel_booking',
        'ticketbooking' => 'worksheet_ticket_booking_job',
        'serviceother' => 'worksheet_service_other_job',
        'agencyservice' => 'worksheet_agency_service',
        'managementfree' => 'worksheet_management_free',
        'provisionincome' => 'worksheet_provision_income',
        'customerclearancecargo' => 'worksheet_customer_clearance_cargo',
        'customerclearancevessel' => 'worksheet_customer_clearance_vessel'
    );
}

if($type == "job"){
    $Check_id = array(
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
   $Check_id = array(
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


// 'utilities' => 'worksheet_utilities',
// 'rental' => 'worksheet_rental',
// 'customer_clearance_cargo' => 'worksheet_customer_clearance_cargo',
// 'customer_clearance_vessel' => 'worksheet_customer_clearance_vessel',
// 'hotel_booking' => 'worksheet_hotel_booking',
// 'ticket_booking_job' => 'worksheet_ticket_booking_job',
// 'rental' => 'worksheet_rental',

$getquery = "SELECT top 1 $Check_id[$name] FROM $Table[$name] WHERE $Check_id[$name] ='".$data[$Check_id[$name]]."'";
$stmt = sqlsrv_query($conn, $getquery);

if($stmt === false){
    $Data['error'] = sqlsrv_errors();
}else{
    $r = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC);
    $Data["us"] = $r[$Check_id[$name]];
        if(!$r[$Check_id[$name]]){
            $iquery = "INSERT INTO $Table[$name] $column VALUES $arrValues";
            $mt = sqlsrv_query($conn, $iquery);

            if($mt === false){
                $Data["status"] = 0;
                $Data['error'] = sqlsrv_errors();
                $Data['qr'] = $iquery;
            }else{
                $Data["status"] = 1;
                $Data["msg"] = "Success";
            }
        }
}




echo json_encode($Data);

sqlsrv_close($conn);

?>
