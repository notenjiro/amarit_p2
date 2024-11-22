<?php
ini_set('display_errors', 'On');
require_once '../config_db.php';
require_once '../utils/helper.php';

$job = $_POST['job'];
$id = $_POST['id'];


$paramCheck = array(
    'transport' => ['sub1', 'sub2', 'sub3', 'sub4', 'sub5', 'sub6', 'uom'],
    'cargo' => ['sub1', 'sub2', 'sub3', 'sub4', 'sub5', 'sub6', 'uom'],
    'taxi' => ['sub1', 'sub2', 'sub3', 'sub4', 'sub5', 'sub6', 'uom'],
    'manpower' => ['sub1', 'sub2', 'sub3', 'sub4', 'sub5', 'sub6', 'uom'],
    'immigration' => ['sub1', 'sub2', 'sub3', 'sub4', 'sub5', 'sub6', 'uom'],
    'warehousing' => ['barcode_service', 'barcode_location', 'barcode_type', 'sub1', 'sub2', 'sub3', 'sub4', 'sub5', 'sub6', 'uom'],
    'utilities' => ['barcode_location', 'barcode_type', 'sub1', 'sub2', 'sub3', 'sub4', 'sub5', 'sub6', 'uom'],
    'rental' => ['barcode_location', 'sub1', 'sub2', 'sub3', 'sub4', 'sub5', 'sub6', 'uom'],
    'hotelbooking' => ['barcode_type', 'sub1', 'sub2', 'sub3', 'sub4', 'sub5', 'sub6', 'uom'],
    'ticketbooking' => ['barcode_type', 'sub1', 'sub2', 'sub3', 'sub4', 'sub5', 'sub6', 'uom'],
    'serviceother' => ['sub1', 'sub2', 'sub3', 'sub4', 'sub5', 'sub6', 'uom'],
    'agencyservice' => ['sub1', 'sub2', 'sub3', 'sub4', 'sub5', 'sub6', 'uom'],
    'managementfree' => ['sub1', 'sub2', 'sub3', 'sub4', 'sub5', 'sub6', 'uom'],
    'provisionincome' => ['sub1', 'sub2', 'sub3', 'sub4', 'sub5', 'sub6', 'uom'],
    'customerclearancecargo' => ['sub1', 'sub2', 'sub3', 'sub4', 'sub5', 'sub6', 'uom'],
    'customerclearancevessel' => ['sub1', 'sub2', 'sub3', 'sub4', 'sub5', 'sub6', 'uom'],

);

$Table = array(
    'transport' => 'contract_transportation_rate',
    'cargo' => 'contract_equipment_rental',
    'taxi' => 'contract_taxi_service',
    'manpower' => 'contract_hourly_rate',
    'immigration' => 'contract_immigration',
    'warehousing' => 'contract_warehousing_space_rental',
    'utilities' => 'contract_utilities',
    'rental' => 'contract_rental',
    'hotelbooking' => 'contract_hotel_booking',
    'ticketbooking' => 'contract_ticket_booking',
    'serviceother' => 'contract_service_other',
    'agencyservice' => 'contract_agency_service',
    'managementfree' => 'contract_management_fee',
    'provisionincome' => 'contract_provision_income',
    'customerclearancecargo' => 'contract_customs_clearance_cargo',
    'customerclearancevessel' => 'contract_customs_clearance_vessel'
);

$fQuery = "";
$raw['data'] = array();

if ($Table[$job] && $paramCheck[$job]) {
    $check = '';
    foreach ($paramCheck[$job] as $value) {
        $check = $check . " and " . $value . " = '" . $_POST[$value] . "'";
    }

    if ($job == 'warehousing' || $job == 'utilities' || $job == 'rental' || $job == 'serviceother' || $job == 'agencyservice' || $job == 'managementfree' || $job == 'provisionincome' || $job == 'customerclearancecargo' || $job == 'customerclearancevessel') {
        $fQuery = " SELECT contract_no,contract_line_number,description FROM " . $Table[$job] . "
                    WHERE customer_code = '" . $id . "'" . $check;
    } else if ($job == 'hotelbooking') {
        $fQuery = " SELECT contract_no,contract_line_number,description ,charge_per_unit 
        FROM " . $Table[$job] . "
        WHERE customer_code = '" . $id . "'" . $check;
    } else if ($job == 'ticketbooking') {
        $fQuery = " SELECT contract_no,contract_line_number,description,charge_per_unit,flight_number,airline_name
        FROM " . $Table[$job] . "
        WHERE customer_code = '" . $id . "'" . $check;
    } else {
        $fQuery = " SELECT contract_no,contract_line as contract_line_number,description 
        FROM " . $Table[$job] . "
        WHERE customer = '" . $id . "'" . $check;
    }


    $raw['m'] = $fQuery;
    $result = sqlsrv_query($conn, $fQuery);

    if ($result == false) {
        $raw['status'] = 0;
        $raw['msg'] = 'error';
    } else {
        while ($row = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC)) {
            $data = array();
            foreach ($row as $value) {
                array_push($data, $value);
            }
            array_push($raw['data'], $data);
        }
        $raw['status'] = 1;

    }
}



echo json_encode($raw);
sqlsrv_close($conn);
?>