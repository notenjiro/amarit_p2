<?php
require_once '../config_db.php';
require_once '../utils/helper.php';

$contract_no = $_GET['contract_no'];

$fQuery = "SELECT  a.*,b.description as equipment_desc, a.branch as branch_name FROM contract_equipment_rental a LEFT JOIN vehicle_type b ON a.equipment = b.code left join location c on c.code = a.branch WHERE contract_no = '$contract_no'";
$result = sqlsrv_query($conn, $fQuery);
$raw['data'] = array();

while($row = sqlsrv_fetch_array( $result, SQLSRV_FETCH_ASSOC)){
    $data = [$row['reccode'], $row['contract_line'], $row['branch_name'], $row['equipment_desc'], $row['diesel_baht_from'], $row['diesel_baht_to'], $row['rate'], $row['minimum_charge_hour'], $row['day_rate'], $row['uom'], $row['reccode'], $row['equipment'], $row['ton_rate']];
    array_push($raw['data'],$data);
}

echo json_encode($raw);
sqlsrv_close($conn);
?>