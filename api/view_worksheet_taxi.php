<?php
require_once '../config_db.php';
require_once '../utils/helper.php';

$worksheet_id = $_GET['worksheet_id'];

$fQuery = "SELECT a.*,b.registration_no as vehicle_no, c.name+' '+c.lastname as operator_name, a.transport_from as from_location, a.transport_to as to_location,b.outsource, a.group_name+'-'+a.branch+'-'+d.universal_location+'-'+case when b.outsource = 1 then '13' else '12' end+'-'+a.type1+'-'+a.type2+'-'+a.type3+'-'+a.type4+'-00-00' as barcode FROM worksheet_taxi a left outer join vehicle b on b.vehicle_id = a.vehicle left join operator c on c.operator_id = a.operator left join contract_location d on d.location = a.transport_from and d.customer = a.customer and d.contract_no = a.contract_no left join contract_location e on e.location = a.transport_to and e.customer = a.customer and e.contract_no = a.contract_no WHERE a.worksheet_id = '$worksheet_id'";
$result = sqlsrv_query($conn, $fQuery);
$raw['data'] = array();

while($row = sqlsrv_fetch_array( $result, SQLSRV_FETCH_ASSOC)){
    $data = [$row['reccode'], $row['taxi_service_id'], date_format($row['start_date'],'d/m/Y'), $row['quantity'],$row['uom'], $row['remark'], $row['line_status'], $row['barcode'], $row['ref1'], $row['ref2'], $row['ref3'], $row['ref4'], $row['ref5'], $row['ref6'], $row['reccode']];
    array_push($raw['data'],$data);
}

echo json_encode($raw);
sqlsrv_close($conn);
?>