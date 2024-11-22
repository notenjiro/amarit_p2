<?php
require_once '../config_db.php';
require_once '../utils/helper.php';

$contract_no = $_GET['contract_no'];

$fQuery = "SELECT  a.*,bs1.sub_type1 as tsub1,bs2.sub_type2 as tsub2,bs3.sub_type3 as tsub3,bs4.sub_type4 as tsub4,bs5.sub_type5 as tsub5,bs6.sub_type6 as tsub6,b.description as equipment_desc, c.description as vehicle_desc FROM contract_service_rate a LEFT JOIN equipment b ON a.equipment = b.code left join vehicle_type c on a.vehicle_type = c.code
left join barcode_sub_type1 bs1 on a.sub1 = bs1.no_sub_type1
left join barcode_sub_type2 bs2 on a.sub2 = bs2.no_sub_type2
left join barcode_sub_type3 bs3 on a.sub3 = bs3.no_sub_type3
left join barcode_sub_type4 bs4 on a.sub4 = bs4.no_sub_type4
left join barcode_sub_type5 bs5 on a.sub5 = bs5.no_sub_type5
left join barcode_sub_type6 bs6 on a.sub6 = bs6.no_sub_type6 WHERE contract_no = '$contract_no'";
$result = sqlsrv_query($conn, $fQuery);
$raw['data'] = array();

while($row = sqlsrv_fetch_array( $result, SQLSRV_FETCH_ASSOC)){
    $data = [$row['reccode'], $row['contract_line'], $row['vehicle_desc'], number_format((float)$row['hourly_rate'], 2), number_format((float)$row['daily_rate'], 2) ,  number_format((float)$row['monthly_rate'], 2),  number_format((float)$row['minimum_charge_hour'], 2), bit_value($row['transport_solution']), $row['ot_rate_hour'], 
    $row['customerref'], $row['tsub1'], $row['tsub2'], $row['tsub3'], $row['tsub4'], $row['tsub5'], $row['tsub6'],$row['sub1'], $row['sub2'], $row['sub3'], $row['sub4'], $row['sub5'], $row['sub6']];
    array_push($raw['data'],$data);
}

echo json_encode($raw);
sqlsrv_close($conn);
?>