<?php
require_once '../config_db.php';
require_once '../utils/helper.php';

$id = $_GET['id'];
$type = $_GET['type'];
$contract_no = $_GET['contract_no'];


$table = array(
    'warehouse' => 'contract_warehousing_space_rental',
    'utilities' => 'contract_utilities',
    'retal' => 'contract_rental',
    'hotelbooking' => 'contract_hotel_booking',
    'ticketbooking' => 'contract_ticket_booking',
    'serviceother' => 'contract_service_other',
    'agencyservice' => 'contract_agency_service',
    'managementfee' => 'contract_management_fee',
    'provisionincome' => 'contract_provision_income',
    'customerclearancecargo' => 'contract_customs_clearance_cargo',
    'customerclearancevessle' => 'contract_customs_clearance_vessel',
);


$fQuery = "SELECT  * FROM $table[$type] WHERE contract_line_number = '$id' and contract_no = '$contract_no'";

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