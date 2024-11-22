<?php
require_once '../config_db.php';
require_once '../utils/helper.php';

$id = $_POST['id'];
$type = $_POST['type'];
$customer_id = $_POST['customer_id'];


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

$fQuery = "DELETE FROM $table[$type] WHERE contract_line_number = '$id' and customer_code = '$customer_id'";

$result = sqlsrv_query($conn, $fQuery);

$raw = array();
if($result == false){
    $raw['status'] = 0;
    $raw['msg'] = "Sorry, can't delete data!";

}else{
    $raw['status'] = 1;
    $raw['msg'] = 'Delete Data Success! ';
}

echo json_encode($raw);
sqlsrv_close($conn);
?>