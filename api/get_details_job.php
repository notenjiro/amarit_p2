<?php
require_once '../config_db.php';
require_once '../utils/helper.php';

$id = $_GET['id'];
$type = $_GET['type'];
$worksheet_id = $_GET['worksheet_id'];
$typeSheet = $_GET['typeSheet'];


if($typeSheet  == "job"){
    $table = array(
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
    $table = array(
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


if($typeSheet  == "job"){
    $arrCheckBy = array(
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
    $arrCheckBy = array(
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


$fQuery = "SELECT  * FROM $table[$type] WHERE $arrCheckBy[$type] = '$id' and worksheet_id = '$worksheet_id'";

$result = sqlsrv_query($conn, $fQuery);

$raw = array();
while($row = sqlsrv_fetch_array( $result, SQLSRV_FETCH_ASSOC)){

   foreach($row as $key=>$value){
    if($key != 'worksheet_id')
    $raw[$key] = $value;
   } 
}

echo json_encode($raw);
sqlsrv_close($conn);
?>