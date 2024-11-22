<?php
require_once '../config_db.php';
require_once '../utils/helper.php';

$worksheet_id = $_GET['worksheet_id'];

$fQuery = "SELECT fuel_km_per_litre FROM application_setup";
$result = sqlsrv_query($conn, $fQuery);
$raw['data'] = array();
while($row = sqlsrv_fetch_array( $result, SQLSRV_FETCH_ASSOC)){
	$fuel_km_per_litre = $row['fuel_km_per_litre'];
}

$fQuery = "SELECT branch FROM worksheet WHERE worksheet_id = '$worksheet_id' ";
$result = sqlsrv_query($conn, $fQuery);
$raw['data'] = array();
while($row = sqlsrv_fetch_array( $result, SQLSRV_FETCH_ASSOC)){
	$branch = $row['branch'];
}

$fQuery = "SELECT a.*,bs1.sub_type1 as tsub1,bs2.sub_type2 as tsub2,bs3.sub_type3 as tsub3,bs4.sub_type4 as tsub4,bs5.sub_type5 as tsub5,bs6.sub_type6 as tsub6,b.name+' '+b.lastname as operator_name, a.transport_from as from_location, a.transport_to as to_location,e.outsource, a.group_name+'-'+a.branch+'-00-'+case when e.outsource = 1 then '13' else '12' end+'-'+a.type1+'-'+a.type2+'-'+a.type3+'-'+a.type4+'-'+c.universal_location+'-'+d.universal_location as barcode FROM worksheet_cargo_transport a left join operator b on b.operator_id = a.operator 
left join contract_location_master c on c.location = a.transport_from and c.active = 1 
left join contract_location_master d on d.location = a.transport_to and d.active = 1 
left join vehicle e on e.vehicle_id = a.vehicle 
left join barcode_sub_type1 bs1 on a.type1 = bs1.no_sub_type1
left join barcode_sub_type2 bs2 on a.type2 = bs2.no_sub_type2
left join barcode_sub_type3 bs3 on a.type3 = bs3.no_sub_type3
left join barcode_sub_type4 bs4 on a.type4 = bs4.no_sub_type4
left join barcode_sub_type5 bs5 on a.type5 = bs5.no_sub_type5
left join barcode_sub_type6 bs6 on a.type6 = bs6.no_sub_type6 
WHERE a.worksheet_id = '$worksheet_id'";
$result = sqlsrv_query($conn, $fQuery);
$raw['data'] = array();
$raw['$fQuery']=$fQuery;
while($row = sqlsrv_fetch_array( $result, SQLSRV_FETCH_ASSOC)){
    if($row['backhaul'])
        $backhual = "<input type=\"checkbox\" class=\"form-check chkbox\" checked onclick=\"return false;\">";
    else
        $backhual = "<input type=\"checkbox\" class=\"form-check chkbox\" onclick=\"return false;\">";
    
    if($row['no_charge'])
        $no_charge = "<input type=\"checkbox\" class=\"form-check chkbox\" checked onclick=\"return false;\">";
    else
        $no_charge = "<input type=\"checkbox\" class=\"form-check chkbox\" onclick=\"return false;\">";
    $data = [$row['reccode'],$row['transport_id'], $row['vehicle'], $row['operator_name'], $row['from_location'], $row['to_location'], date_format($row['start_date'],'d/m/Y'), date_format($row['end_date'],'d/m/Y'), $row['quantity'], $row['uom'], $row['contract_no'], $row['mileage_start'], $row['mileage_end'], $no_charge, $row['diesel_rate'], ($row['mileage_end']-$row['mileage_start'])/$fuel_km_per_litre, $row['line_status'], $row['barcode'],
    $row['tsub1'],$row['tsub2'],$row['tsub3'],$row['tsub4'],$row['tsub5'],$row['tsub6'],
    $row['ref1'], $row['ref2'], $row['ref3'], $row['ref4'], $row['ref5'], $row['ref6'], $row['reccode'], $row['type1'],$row['type2'],$row['type3'],$row['type4'],$row['type5'],$row['type6']];
    array_push($raw['data'],$data);
}

echo json_encode($raw);
sqlsrv_close($conn);
?>