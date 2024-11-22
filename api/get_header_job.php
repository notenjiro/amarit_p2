<?php
require_once '../config_db.php';
require_once '../utils/helper.php';

$job = $_GET['job'];
$type = $_GET['type'];


if($type == "job"){
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
}
else{
    $table = array(
        'transport' => 'worksheet_cargo_transport',
        'cargo_handling' => 'worksheet_cargo_handling',
        'immigration' => 'worksheet_immigration',
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
}
else{
    $arrCheckBy = array(
        'transport' => 'transport_id',
        'cargo_handling' => 'cargo_service_id',
        'immigration' => 'immigration_id',
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



$checkHeader = array(
    'transport' => 'Transport',
    'cargo_handling' => 'Cargo handling',
    'immigration' => 'Immigration',
    'warehousing' => 'Warehouse',
    'utilities' => 'Utilities',
    'rental' => 'Rental',
	'hotelbooking' => 'Booking Service',
	'ticketbooking' => 'Booking Service',
    'serviceother' => 'Service Other',
    'agencyservice' => 'Agency fee',
    'managementfree' => 'Service Other',
    'provisionincome' => 'Provision',
    'customerclearancecargo' => 'Cargo handling',
    'customerclearancevessel' => 'Shipping'
);

$raw = array();
$headerQr = "SELECT top 1 no_group FROM FES.dbo.barcode_group where group_name = '".$checkHeader[$job]."'";
$resultHeader = sqlsrv_query($conn, $headerQr);

if($resultHeader == false){
    $raw['status'] = 0;
    $raw['qr'] =   $headerQr ;
    $raw['error'] = sqlsrv_errors();
}else{
    $rowHeader = sqlsrv_fetch_array( $resultHeader,SQLSRV_FETCH_ASSOC);

    if($rowHeader['no_group']){
        $currentDate = date('ym');
        $fQuery = "SELECT MAX(".$arrCheckBy[$job].") as id FROM FES.dbo.".$table[$job]." WHERE ".$arrCheckBy[$job]." LIKE '".$rowHeader['no_group'].$currentDate."%'";
        $result = sqlsrv_query($conn, $fQuery);

        if($result == false){
            $raw['status'] = 0;
            $raw['qr'] =   $fQuery ;
            $raw['error'] = sqlsrv_errors();
        }else{
             $ws_id = ''; 
            $delimiter = $rowHeader['no_group']; 
            $row = sqlsrv_fetch_array( $result,SQLSRV_FETCH_ASSOC);
            if($row && !empty($row['id'])){
                $ws_id = $row['id'];
            }else{
                $ws_id = $delimiter.$currentDate.'0000';
            }

            if($ws_id){
                $oldId = preg_replace('/\D/', '', $ws_id); 
                $maxNumber = intval($currentDate.'9999');
                $newId = intval($oldId + 1); 
                $header = "";

                if( $newId <= $maxNumber){
                    $header = $delimiter.$newId;
                }else{
                    $currentdt = new DateTime();
                    $currentdt->modify('+1 month');
                    $nextMonth = $currentdt->format('ym');
                    $header = $delimiter.$nextMonth.'0001';
                }

                if(strlen($header) > 0){
                    $raw['status'] = 1;
                    $raw['id'] = $header;   
                }
            
            }
        }
       
    }


}






echo json_encode($raw);
sqlsrv_close($conn);
?>