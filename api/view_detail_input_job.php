<?php
require_once '../config_db.php';
require_once '../utils/helper.php';


$id = $_GET['contractLineId'];
$contractId = $_GET['contractId'];
$customer = $_GET['customer'];
$type = $_GET['type'];
$job = $_GET['job'];


$arrTable = array(
  'transport' => 'contract_transportation_rate',
  'manpower' => 'contract_hourly_rate',
  'cargo' => 'contract_equipment_rental',
  'taxi' => 'contract_taxi_service',
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


$checkTable = array(
  'transport' => 'contract_line',
  'manpower' => 'contract_line',
  'cargo' => 'contract_line',
  'taxi' => 'contract_line',
  'immigration' => 'contract_line',
  'warehousing' => 'contract_line_number',
  'utilities' => 'contract_line_number',
  'rental' => 'contract_line_number',
  'hotelbooking' => 'contract_line_number',
  'ticketbooking' => 'contract_line_number',
  'serviceother' => 'contract_line_number',
  'agencyservice' => 'contract_line_number',
  'managementfree' => 'contract_line_number',
  'provisionincome' => 'contract_line_number',
  'customerclearancecargo' => 'contract_line_number',
  'customerclearancevessel' => 'contract_line_number'
);

$raw = array();
$fQuery = '';

if ($type == 'location') {
  $fQuery = "SELECT lct.department ,lct.cost_center  FROM FES.dbo.barcode_location bcl Left join location lct on bcl.location_code  = lct.code WHERE  bcl.no_location = " . $id;
} else if ($type == 'contract_number') {
  $column = '';
  if ($job == 'ticketbooking') {
    $column = ',destination,destination_date,airline_name,flight_number ';
  }

  if ($job == 'transport' || $job == 'immigration' || $job == 'manpower' || $job == 'cargo' || $job == 'taxi') {
    $fQuery = "SELECT description FROM " . $arrTable[$job] . " where contract_line = '" . $id . "' and contract_no ='$contractId' ";
  } else {
    $fQuery = "SELECT description,charge_per_unit" . $column . " FROM " . $arrTable[$job] . " where contract_line_number = '" . $id . "' and contract_no ='$contractId' ";
  }

} else if ($type == 'hotel') {
  $fQuery = "SELECT lct.department,lct.cost_center  FROM FES.dbo.hotel ht Left join location lct on ht.location  = lct.code WHERE  ht.hotel_id = '" . $id . "' ";
} else if ($type == 'contract_desc') {
  $fQuery = "SELECT ct.* FROM " . $arrTable[$job] . " ct
left join customer_contract cc on cc.contract_no = ct.contract_no 
WHERE cc.active = 1 and ct.".$checkTable[$job]." = '" . $id . "' and ct.contract_no ='$contractId' ";
} else if ($type == 'contract_desc_all') {
  $fQuery = " SELECT ct.contract_no , ct.customer,cc.".$checkTable[$job].",cc.description  FROM  customer_contract  ct
  left join " . $arrTable[$job] . " cc on cc.contract_no = ct.contract_no 
  WHERE ct.active = 1 and ct.customer = '" . $customer . "'";
}

$result = sqlsrv_query($conn, $fQuery);
$raw['job'] = $job;
$raw['error'] = $fQuery;
if ($result == false) {
  $raw['status'] = 0;


  $raw['msg'] = 'Sorry, Error';
} else {
  $data = array();

  while ($row = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC)) {
    $raw['status'] = 1;

    if ($type == 'location' || $type == 'hotel') {
      $raw['department'] = $row['department'];
      $raw['cost_center'] = $row['cost_center'];
    } else if ($type == 'contract_number') {
      $raw['charge_per_unit'] = $row['charge_per_unit'];
      $raw['description'] = $row['description'];

      if ($job == 'ticketbooking') {
        $raw['destination'] = $row['destination'];
        $raw['destination_date'] = $row['destination_date'];
        $raw['airline_name'] = $row['airline_name'];
        $raw['flight_number'] = $row['flight_number'];
      }

    }

    if ($type == 'contract_desc' || $type == 'contract_desc_all') {
      array_push($data, $row); ;
    }
  }

  $raw['data'] = $data;
 
  // 
}

echo json_encode($raw);
sqlsrv_close($conn);
?>