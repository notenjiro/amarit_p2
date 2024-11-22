<?php
require_once '../config_db.php';
require_once '../utils/helper.php';

$worksheet_id = $_GET['worksheet_id'];

$fQuery = "SELECT branch FROM worksheet WHERE worksheet_id = '$worksheet_id' ";
$result = sqlsrv_query($conn, $fQuery);
$raw['data'] = array();
while($row = sqlsrv_fetch_array( $result, SQLSRV_FETCH_ASSOC)){
	$branch = $row['branch'];
}

$fQuery = "SELECT  a.*, a.position as position_name, c.name+' '+c.lastname as lobour_name, d.location as location_name,e.outsource, a.group_name+'-'+a.branch+'-'+d.sub_location+'-'+case when e.outsource = 1 then '13' else '12' end+'-'+a.type1+'-'+a.type2+'-'+a.type3+'-'+a.type4+'-00-00' as barcode FROM worksheet_manpower a left outer join position b on b.code = a.position left outer join operator c on c.operator_id = a.labor left join contract_location d on d.location = a.location and d.customer = a.customer and d.contract_no = a.contract_no left join manpower e on e.manpower_id = a.labor WHERE a.worksheet_id = '$worksheet_id'";
$result = sqlsrv_query($conn, $fQuery);
$raw['data'] = array();

while($row = sqlsrv_fetch_array( $result, SQLSRV_FETCH_ASSOC)){
    $data = [$row['reccode'],$row['labor_service_id'], $row['timesheet_no'], $row['position_name'],$row['lobour_name'], $row['location_name'], date_format($row['start_date'],'d/m/Y'), date_format($row['start_time'],'H:i'), $row['quantity'],$row['uom'],$row['remark'], $row['line_status'], $row['barcode'], $row['ref1'], $row['ref2'], $row['ref3'], $row['ref4'], $row['ref5'], $row['ref6'], $row['reccode']];
    array_push($raw['data'],$data);
}

echo json_encode($raw);
sqlsrv_close($conn);
?>