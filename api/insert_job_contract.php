<?php 
error_reporting(1);
require_once '../config_db.php';
require_once '../utils/helper.php';
session_start();

if($_SESSION["user_type"] == 'Admin'){
	$userType =	"AAL";
}else{
	$userType =	$_SESSION["user_type"];
}

$name = $_POST['name'];
$data = $_POST['data'];
$data['user_type'] = $userType;
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
$Table = array(
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


$iquery = "INSERT INTO $Table[$name] $column VALUES $arrValues";
$stmt = sqlsrv_query($conn, $iquery);

if($stmt === false){
    $Data["status"] = 0;
    // $Data['error'] = sqlsrv_errors();
    $Data['error'] = $iquery;
    $Data['qr'] = $iquery;
}else{
    $Data["status"] = 1;
    $Data["msg"] = "Success !";
}

echo json_encode($Data);

sqlsrv_close($conn);

?>
