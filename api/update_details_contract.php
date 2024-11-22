<?php
require_once '../config_db.php';
require_once '../utils/helper.php';


$type = $_POST['type'];
$data = $_POST['data'];
$id = $data['contract_line_number'];
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

$keyData =  array_keys($data);
$valueData =  array_values($data);
$column = array();

$index = 0;
foreach ($valueData as $key => $value) {
    if(strlen($value) == 0 ){
        $value = '-';
    }
    $val = "'" . $value . "'";
    $keyData[$index] = $keyData[$index]."=".$val;
    $index++;
}

$column = '' . implode(',', $keyData) . '';


$fQuery = "UPDATE $table[$type] SET $column  WHERE contract_line_number = '$id' and customer_code = '$customer_id'" ;

$result = sqlsrv_query($conn, $fQuery);

$raw = array();
$raw['q'] = $fQuery;

if($result == false){
    $raw['status'] = 0;
    
}else{
     $row = sqlsrv_fetch_array( $result, SQLSRV_FETCH_ASSOC);
     $raw['status'] = 1;
     $raw['id'] = $id;

}

echo json_encode($raw);
sqlsrv_close($conn);
?>
