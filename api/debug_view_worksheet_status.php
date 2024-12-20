<?php
require_once '../config_db.php';
require_once '../utils/helper.php';

$from_date = $_GET["from_date"];
$to_date = $_GET["to_date"];
$show_amount = $_GET["show_amount"];

// $iquery = "update worksheet_cargo_transport set group_name_desc =
// (select description from group_name where code = worksheet_cargo_transport.group_name) where group_name_desc is null

// update worksheet_cargo_transport set type_1_desc = 
// (select description from type_1 where code = worksheet_cargo_transport.type1) where type_1_desc is null

// update worksheet_cargo_transport set type_2_desc = 
// (select description from type_2 where code = worksheet_cargo_transport.type2) where type_2_desc is null

// update worksheet_cargo_transport set type_3_desc = 
// (select description from type_3 where code = worksheet_cargo_transport.type3) where type_3_desc is null

// update worksheet_cargo_transport set type_4_desc = 
// (select description from type_4 where code = worksheet_cargo_transport.type4) where type_4_desc is null

// update worksheet_manpower set group_name_desc = 
// (select description from group_name where code = worksheet_manpower.group_name) where group_name_desc is null

// update worksheet_manpower set type_1_desc = 
// (select description from type_1 where code = worksheet_manpower.type1) where type_1_desc is null

// update worksheet_manpower set type_2_desc = 
// (select description from type_2 where code = worksheet_manpower.type2) where type_2_desc is null

// update worksheet_manpower set type_3_desc = 
// (select description from type_3 where code = worksheet_manpower.type3) where type_3_desc is null

// update worksheet_manpower set type_4_desc = 
// (select description from type_4 where code = worksheet_manpower.type4) where type_4_desc is null

// update worksheet_cargo_handling set group_name_desc = 
// (select description from group_name where code = worksheet_cargo_handling.group_name) where group_name_desc is null

// update worksheet_cargo_handling set type_1_desc = 
// (select description from type_1 where code = worksheet_cargo_handling.type1) where type_1_desc is null

// update worksheet_cargo_handling set type_2_desc = 
// (select description from type_2 where code = worksheet_cargo_handling.type2) where type_2_desc is null

// update worksheet_cargo_handling set type_3_desc = 
// (select description from type_3 where code = worksheet_cargo_handling.type3) where type_3_desc is null

// update worksheet_cargo_handling set type_4_desc = 
// (select description from type_4 where code = worksheet_cargo_handling.type4) where type_4_desc is null

// update worksheet_service set group_name_desc = 
// (select description from group_name where code = worksheet_service.group_name) where group_name_desc is null

// update worksheet_service set type_1_desc = 
// (select description from type_1 where code = worksheet_service.type1) where type_1_desc is null

// update worksheet_service set type_2_desc = 
// (select description from type_2 where code = worksheet_service.type2) where type_2_desc is null

// update worksheet_service set type_3_desc = 
// (select description from type_3 where code = worksheet_service.type3) where type_3_desc is null

// update worksheet_service set type_4_desc = 
// (select description from type_4 where code = worksheet_service.type4) where type_4_desc is null

// update worksheet_immigration set group_name_desc = 
// (select description from group_name where code = worksheet_immigration.group_name) where group_name_desc is null

// update worksheet_immigration set type_1_desc = 
// (select description from type_1 where code = worksheet_immigration.type1) where type_1_desc is null

// update worksheet_immigration set type_2_desc = 
// (select description from type_2 where code = worksheet_immigration.type2) where type_2_desc is null

// update worksheet_immigration set type_3_desc = 
// (select description from type_3 where code = worksheet_immigration.type3) where type_3_desc is null

// update worksheet_immigration set type_4_desc = 
// (select description from type_4 where code = worksheet_immigration.type4) where type_4_desc is null ";
// $stmt = sqlsrv_query($conn, $iquery);

$fQuery = " select 'TRANSPORT' as service_type, a.worksheet_id, w.worksheet_date, a.transport_id, v.registration_no, o.name,a.transport_from, a.transport_to, a.contact1, a.contact2, a.charge_as, a.outsource_charge_as, a.contract_no, a.contract_line, a.remark, a.ref1, a.ref2, a.department, a.cost_center, l.description as u_from, ll.description as u_to, a.mileage_start, a.mileage_end, vt.fuel_km_per_litre, a.actual_start_date as start_date ,a.actual_start_time as start_time,a.actual_finish_date as end_date, a.actual_finish_time as end_time,a.quantity,a.uom,a.customer,u.name as customer_name,a.line_status,w.contract,w.customer_ref,s.description as subject,
a.group_name,w.branch,case when v.outsource = 1 then '13' else '12' end as ttype,a.type1,a.type2,a.type3,a.type4
, a.group_name+'-'+a.branch+'-00-'+case when v.outsource = 1 then '13' else '12' end+'-'+a.type1+'-'+a.type2+'-'+a.type3+'-'+a.type4+'-'+c.universal_location+'-'+cc.universal_location as barcode,
a.group_name_desc as group_name, a.type_1_desc as type1_desc, a.type_2_desc as type2_desc, a.type_3_desc as type3_desc,a.type_4_desc as type4_desc

,w.contract, w.remark, w.worksheet_status, w.request_method, w.request_to, w.client_inform_amarit_date, w.client_inform_amarit_time, w.cs_inform_opr_date, w.cs_inform_opr_time, w.opr_inform_cs_date, w.opr_inform_cs_time, w.cs_inform_client_date, w.cs_inform_client_time

, a.specific_location_from, a.specific_location_to, a.diesel_rate, a.no_charge, a.consolidate, a.vehicle_switch, a.cancel_reason, a.cargo_type, a.cargo_qty, a.cargo_weight, a.dimension, a.actual_start_date, a.actual_start_time, a.actual_finish_date, a.actual_finish_time, w.user_id, '' as position

, a.ref3, a.ref4, a.ref5, a.ref6, w.ref1 as wref1, w.ref2 as wref2, w.ref3 as wref3, w.ref4 as wref4, w.ref5 as wref5, w.ref6 as wref6

, v.vehicle_id_erp, v.outsource, vo.description, a.standby_charge, u.erp_id, a.transport_solution, 0 as amount, lumsum_charge, promotion_code, a.lumsum_charge as lump_sum

from worksheet_cargo_transport a 
left join contract_location c on c.location = a.transport_from
and c.customer = a.customer and c.contract_no = a.contract_no
left join location l on l.code = c.universal_location
left join contract_location cc on cc.location = a.transport_to
and cc.customer = a.customer and cc.contract_no = a.contract_no
left join location ll on ll.code = cc.universal_location
left join vehicle v on v.vehicle_id = a.vehicle 
left join vehicle_owner vo on vo.code = v.vehicle_owner
left join operator o on o.operator_id = a.operator
left join customer u on u.customer_id = a.customer
left join worksheet w on w.worksheet_id = a.worksheet_id
left join subject s on s.code = w.subject
left join vehicle_type vt on vt.code = v.vehicle_type
WHERE w.worksheet_date >= '$from_date' AND w.worksheet_date <= '$to_date' 
union 

select 'MANPOWER' as service_type, a.worksheet_id, w.worksheet_date,a.labor_service_id,'',v.name,a.[location],'', '', '', a.charge_as, a.outsource_charge_as, a.contract_no, a.contract_line, a.remark, a.ref1, a.ref2, a.department, a.cost_center,l.description as u_from,'',0,0,0,
[start_date],start_time,end_date,end_time,quantity,a.uom,a.customer,u.name as customer_name,a.line_status,w.contract,w.customer_ref,s.description as subject,
a.group_name,w.branch,case when v.outsource = 1 then '13' else '12' end as ttype,a.type1,a.type2,a.type3,a.type4
, a.group_name+'-'+a.branch+'-'+c.sub_location+'-'+case when v.outsource = 1 then '13' else '12' end+'-'+a.type1+'-'+a.type2+'-'+a.type3+'-'+a.type4+'-00-00' as barcode,
a.group_name_desc as group_name, a.type_1_desc as type1_desc, a.type_2_desc as type2_desc, a.type_3_desc as type3_desc,a.type_4_desc as type4_desc

,w.contract, w.remark, w.worksheet_status, w.request_method, w.request_to, w.client_inform_amarit_date, w.client_inform_amarit_time, w.cs_inform_opr_date, w.cs_inform_opr_time, w.opr_inform_cs_date, w.opr_inform_cs_time, w.cs_inform_client_date, w.cs_inform_client_time

, '', '', 0, 0, 0, 0, a.cancel_reason, '', 0, 0, '', '', '', '', '', w.user_id, a.position

, a.ref3, a.ref4, a.ref5, a.ref6, w.ref1 as wref1, w.ref2 as wref2, w.ref3 as wref3, w.ref4 as wref4, w.ref5 as wref5, w.ref6 as wref6, '', '', '', '', u.erp_id, 0, 0 as amount,0 as lumsum_charge,'' as promotion_code, a.lump_sum

from worksheet_manpower a
left join contract_location c on c.location = a.location
and c.customer = a.customer and c.contract_no = a.contract_no
left join location l on l.code = c.universal_location
left join manpower v on v.manpower_id = a.labor
left join customer u on u.customer_id = a.customer 
left join worksheet w on w.worksheet_id = a.worksheet_id
left join subject s on s.code = w.subject
WHERE w.worksheet_date >= '$from_date' AND w.worksheet_date <= '$to_date' 

union 

 select 'CARGO HANDLE' as service_type, a.worksheet_id,w.worksheet_date,a.cargo_service_id,v.registration_no,o.name,a.transport_from,'', '', '', a.charge_as, a.outsource_charge_as, a.contract_no, a.contract_line, a.remark, a.ref1, a.ref2, a.department, a.cost_center,l.description as u_from,'',0,0,0,
a.[start_date],a.start_time,a.end_date,a.end_time,a.quantity,a.uom,a.customer,u.name as customer_name,a.line_status,w.contract,w.customer_ref,s.description as subject,
a.group_name,w.branch,case when v.outsource = 1 then '13' else '12' end as ttype,a.type1,a.type2,a.type3,a.type4
, a.group_name+'-'+a.branch+'-'+c.sub_location+'-'+case when v.outsource = 1 then '13' else '12' end+'-'+a.type1+'-'+a.type2+'-'+a.type3+'-'+a.type4+'-00-00' as barcode,
a.group_name_desc as group_name, a.type_1_desc as type1_desc, a.type_2_desc as type2_desc, a.type_3_desc as type3_desc,a.type_4_desc as type4_desc

,w.contract, w.remark, w.worksheet_status, w.request_method, w.request_to, w.client_inform_amarit_date, w.client_inform_amarit_time, w.cs_inform_opr_date, w.cs_inform_opr_time, w.opr_inform_cs_date, w.opr_inform_cs_time, w.cs_inform_client_date, w.cs_inform_client_time

, '', '', a.diesel_rate, 0, 0, 0, a.cancel_reason, '', 0, 0, '', '', '', '', '', w.user_id, ''

, a.ref3, a.ref4, a.ref5, a.ref6, w.ref1 as wref1, w.ref2 as wref2, w.ref3 as wref3, w.ref4 as wref4, w.ref5 as wref5, w.ref6 as wref6

, v.vehicle_id_erp, v.outsource, vo.description, '', u.erp_id, 0, 0 as amount,0 as lumsum_charge,'' as promotion_code, 0 as lump_sum

from worksheet_cargo_handling a
left join contract_location c on c.location = a.transport_from
and c.customer = a.customer and c.contract_no = a.contract_no
left join location l on l.code = c.universal_location
left join vehicle v on v.vehicle_id = a.vehicle
left join vehicle_owner vo on vo.code = v.vehicle_owner
left join operator o on o.operator_id = a.operator
left join customer u on u.customer_id = a.customer 
left join worksheet w on w.worksheet_id = a.worksheet_id
left join subject s on s.code = w.subject
WHERE w.worksheet_date >= '$from_date' AND w.worksheet_date <= '$to_date' 
union 

select 'SERVICE - OTHER' as service_type, a.worksheet_id,w.worksheet_date,a.cargo_service_id,v.registration_no,o.name,a.description,a.description2, '', '', '', '', a.agreement_number, '', a.remark, a.ref1, a.ref2, a.department, a.cost_center,l.description as u_from,'',0,0,0,
a.[start_date],a.start_time,a.end_date,a.end_time,a.quantity,a.uom,a.customer,u.name as customer_name,a.line_status,w.contract,w.customer_ref,s.description as subject,
a.group_name,w.branch,case when v.outsource = 1 then '13' else '12' end as ttype,a.type1,a.type2,a.type3,a.type4
, a.group_name+'-'+a.branch+'-'+c.sub_location+'-'+case when v.outsource = 1 then '13' else '12' end+'-'+a.type1+'-'+a.type2+'-'+a.type3+'-'+a.type4+'-00-00' as barcode,
a.group_name_desc as group_name, a.type_1_desc as type1_desc, a.type_2_desc as type2_desc, a.type_3_desc as type3_desc,a.type_4_desc as type4_desc

,w.contract, w.remark, w.worksheet_status, w.request_method, w.request_to, w.client_inform_amarit_date, w.client_inform_amarit_time, w.cs_inform_opr_date, w.cs_inform_opr_time, w.opr_inform_cs_date, w.opr_inform_cs_time, w.cs_inform_client_date, w.cs_inform_client_time

, '', '', 0, 0, 0, 0, a.cancel_reason, '', 0, 0, '', '', '', '', '', w.user_id, ''

, a.ref3, a.ref4, a.ref5, a.ref6, w.ref1 as wref1, w.ref2 as wref2, w.ref3 as wref3, w.ref4 as wref4, w.ref5 as wref5, w.ref6 as wref6

, v.vehicle_id_erp, v.outsource, vo.description, '', u.erp_id, 0 ,a.amount,0 as lumsum_charge,'' as promotion_code, 0 as lump_sum 

from worksheet_service a
left join contract_location c on c.location = a.transport_from
left join location l on l.code = c.universal_location
left join vehicle v on v.vehicle_id = a.vehicle
left join vehicle_owner vo on vo.code = v.vehicle_owner
left join operator o on o.operator_id = a.operator
left join customer u on u.customer_id = a.customer 
left join worksheet w on w.worksheet_id = a.worksheet_id
left join subject s on s.code = w.subject
WHERE w.worksheet_date >= '$from_date' AND w.worksheet_date <= '$to_date'
union 

select 'IMMIGRATION' as service_type,a.worksheet_id,w.worksheet_date,a.immigration_id,'','','','', '', '', '', '', a.agreement_number, a.contract_line, a.remark, a.ref1, a.ref2, a.department, a.cost_center,'' as u_from,'',0,0,0,
a.[start_date],a.start_time,a.end_date,a.end_time,a.quantity,a.uom,a.customer,u.name as customer_name,a.line_status,w.contract,w.customer_ref,s.description as subject,
a.group_name,w.branch,'12' as ttype,a.type1,a.type2,a.type3,a.type4
, a.group_name+'-'+a.branch+'-'+'00'+'-'+'12'+'-'+a.type1+'-'+a.type2+'-'+a.type3+'-'+a.type4+'-00-00' as barcode,
a.group_name_desc as group_name, a.type_1_desc as type1_desc, a.type_2_desc as type2_desc, a.type_3_desc as type3_desc,a.type_4_desc as type4_desc

,w.contract, w.remark, w.worksheet_status, w.request_method, w.request_to, w.client_inform_amarit_date, w.client_inform_amarit_time, w.cs_inform_opr_date, w.cs_inform_opr_time, w.opr_inform_cs_date, w.opr_inform_cs_time, w.cs_inform_client_date, w.cs_inform_client_time

, a.service as specific_location_from, '', 0, 0, 0, 0, a.cancel_reason, '', 0, 0, '', '', '', '', '', w.user_id, ''

, a.ref3, a.ref4, a.ref5, a.ref6, w.ref1 as wref1, w.ref2 as wref2, w.ref3 as wref3, w.ref4 as wref4, w.ref5 as wref5, w.ref6 as wref6, '', '', '', '', u.erp_id, 0, 0 as amount,0 as lumsum_charge,'' as promotion_code, 0 as lump_sum 

from worksheet_immigration a 
left join customer u on u.customer_id = a.customer 
left join worksheet w on w.worksheet_id = a.worksheet_id
left join subject s on s.code = w.subject
WHERE w.worksheet_date >= '$from_date' AND w.worksheet_date <= '$to_date'
union 

select 'PERSONNEL TRANSPORT' as service_type, a.worksheet_id, w.worksheet_date, a.taxi_service_id, v.registration_no, o.name,a.transport_from, a.transport_to, '', '', a.charge_as, a.outsource_charge_as, a.contract_no, a.contract_line, a.remark, a.ref1, a.ref2, a.department, a.cost_center, l.description as u_from, ll.description as u_to, 0, 0,0, a.[start_date],a.start_time,a.end_date,a.end_time,a.quantity,a.uom,a.customer,u.name as customer_name,a.line_status,w.contract,w.customer_ref,s.description as subject,
a.group_name,w.branch,case when v.outsource = 1 then '13' else '12' end as ttype,a.type1,a.type2,a.type3,a.type4
, a.group_name+'-'+a.branch+'-00-'+case when v.outsource = 1 then '13' else '12' end+'-'+a.type1+'-'+a.type2+'-'+a.type3+'-'+a.type4+'-'+c.universal_location+'-'+cc.universal_location as barcode,
a.group_name_desc as group_name, a.type_1_desc as type1_desc, a.type_2_desc as type2_desc, a.type_3_desc as type3_desc,a.type_4_desc as type4_desc

,w.contract, w.remark, w.worksheet_status, w.request_method, w.request_to, w.client_inform_amarit_date, w.client_inform_amarit_time, w.cs_inform_opr_date, w.cs_inform_opr_time, w.opr_inform_cs_date, w.opr_inform_cs_time, w.cs_inform_client_date, w.cs_inform_client_time

, a.specific_location_from, a.specific_location_to, 0, 0, 0, 0, a.cancel_reason, '', 0, 0, '', '', '', '', '', w.user_id, '' as position

, a.ref3, a.ref4, a.ref5, a.ref6, w.ref1 as wref1, w.ref2 as wref2, w.ref3 as wref3, w.ref4 as wref4, w.ref5 as wref5, w.ref6 as wref6

, v.vehicle_id_erp, v.outsource, vo.description, '', u.erp_id, 0, 0 as amount,0 as lumsum_charge,'' as promotion_code, 0 as lump_sum

from worksheet_taxi a 
left join contract_location c on c.location = a.transport_from
and c.customer = a.customer and c.contract_no = a.contract_no
left join location l on l.code = c.universal_location
left join contract_location cc on cc.location = a.transport_to
and cc.customer = a.customer and cc.contract_no = a.contract_no
left join location ll on ll.code = cc.universal_location
left join vehicle v on v.vehicle_id = a.vehicle
left join vehicle_owner vo on vo.code = v.vehicle_owner
left join operator o on o.operator_id = a.operator
left join customer u on u.customer_id = a.customer
left join worksheet w on w.worksheet_id = a.worksheet_id
left join subject s on s.code = w.subject
WHERE w.worksheet_date >= '$from_date' AND w.worksheet_date <= '$to_date'





	
order by service_type desc






";

//if($user_role != 'supervisor'){
//    $fQuery .= " WHERE user_id = '$user_name'";
//}
//echo $fQuery;
//die;
$result = sqlsrv_query($conn, $fQuery);
$raw['data'] = array();

while($row = sqlsrv_fetch_array( $result, SQLSRV_FETCH_ASSOC)){
	if (is_null($row['mileage_end'])) {
		$tatalkm = 0;
	} else {
		$tatalkm = $row['mileage_end']- $row['mileage_start'];
	}
	if (is_null($row['start_time'])) {
		$start_time = '';
	} else {
		$start_time = date_format($row['start_time'],'H:i');
	}
	if (is_null($row['end_time'])) {
		$end_time = '';
	} else {
		$end_time = date_format($row['end_time'],'H:i');
	}
	if (is_null($row['client_inform_amarit_date'])) {
		$client_inform_amarit_date = '';
	} else {
		$client_inform_amarit_date = date_format($row['client_inform_amarit_date'],'d/m/Y');
	}
	if (is_null($row['client_inform_amarit_time'])) {
		$client_inform_amarit_time = '';
	} else {
		$client_inform_amarit_time = date_format($row['client_inform_amarit_time'],'H:i');
	}
	if (is_null($row['cs_inform_opr_date'])) {
		$cs_inform_opr_date = '';
	} else {
		$cs_inform_opr_date = date_format($row['cs_inform_opr_date'],'d/m/Y');
	}
	if (is_null($row['cs_inform_opr_time'])) {
		$cs_inform_opr_time = '';
	} else {
		$cs_inform_opr_time = date_format($row['cs_inform_opr_time'],'H:i');
	}
	if (is_null($row['opr_inform_cs_date'])) {
		$opr_inform_cs_date = '';
	} else {
		$opr_inform_cs_date = date_format($row['opr_inform_cs_date'],'d/m/Y');
	}
	if (is_null($row['opr_inform_cs_time'])) {
		$opr_inform_cs_time = '';
	} else {
		$opr_inform_cs_time = date_format($row['opr_inform_cs_time'],'H:i');
	}
	if (is_null($row['cs_inform_client_date'])) {
		$cs_inform_client_date = '';
	} else {
		$cs_inform_client_date = date_format($row['cs_inform_client_date'],'d/m/Y');
	}
	if (is_null($row['cs_inform_client_time'])) {
		$cs_inform_client_time = '';
	} else {
		$cs_inform_client_time = date_format($row['cs_inform_client_time'],'H:i');
	}
	if (is_null($row['actual_start_date'])) {
		$actual_start_date = '';
	} else {
		$actual_start_date = date_format($row['actual_start_date'],'d/m/Y');
	}
	if (is_null($row['start_date'])) {
		$start_date = '';
	} else {
		$start_date = date_format($row['start_date'],'d/m/Y');
	}
	if (is_null($row['end_date'])) {
		$end_date = '';
	} else {
		$end_date = date_format($row['end_date'],'d/m/Y');
	}
	if (is_null($row['actual_start_time'])) {
		$actual_start_time = '';
	} else {
		$actual_start_time = date_format($row['actual_start_time'],'H:i');
	}
	if (is_null($row['actual_finish_date'])) {
		$actual_finish_date = '';
	} else {
		$actual_finish_date = date_format($row['actual_finish_date'],'d/m/Y');
	}
	if (is_null($row['actual_finish_time'])) {
		$actual_finish_time = '';
	} else {
		$actual_finish_time = date_format($row['actual_finish_time'],'H:i');
	}
	if (is_null($row['worksheet_date'])) {
		$worksheet_date = '';
	} else {
		$worksheet_date = date_format($row['worksheet_date'],'d/m/Y');
	}
	$total_km = 0;

	$customer = $row["customer"];
	$transport_from = $row["transport_from"];
	$transport_to = $row["transport_to"];
	$contract_no = $row["contract_no"];
	$position = $row["position"];
	$service = $row["specific_location_from"];
	$vehicle_type = $row["charge_as"];
	$UOM = $row["uom"];
	$Service_type = $row['service_type'];

	if (is_null($row['start_date'])) 
		$nameOfday = '';
	else 
		$nameOfday = date('D', strtotime(date_format($row['start_date'],'m/d/Y')));
	
	$amount = 0;
	if ($row['service_type'] == 'TRANSPORT') {
		$aQuery = "select a.transportation_rate, a.diesel_baht_to, c.diesel1, a.total_km, a.round_trip_rate from contract_transportation_rate a left join customer_contract c on c.contract_no = a.contract_no where a.customer = '$customer' and a.transportation_from = '$transport_from' and a.transportation_to = '$transport_to' and a.contract_no = '$contract_no' and a.vehicle_type = '$vehicle_type' order by diesel_baht_to ";;
		$resultamount = sqlsrv_query($conn, $aQuery);
		$amount = 0;
		//while($rowamount = sqlsrv_fetch_array( $resultamount, SQLSRV_FETCH_ASSOC)){
		//	$amount = $rowamount['transportation_rate'];
		//	$total_km = $rowamount['total_km'];
		//	if ($row['diesel_rate'] > $rowamount['diesel_baht_to'] or $rowamount['diesel1'] == 30) {
		//		if ($row['diesel_rate'] < 31)
		//		  $amount = $rowamount['transportation_rate']*1.02;
		//		else if ($row['diesel_rate'] < 32)
		//			$amount = $rowamount['transportation_rate']*1.04;
		//		else if ($row['diesel_rate'] < 33)
		//			$amount = $rowamount['transportation_rate']*1.06;
		//		else if ($row['diesel_rate'] < 34)
		//			$amount = $rowamount['transportation_rate']*1.08;
		//		else if ($row['diesel_rate'] < 35)
		//			$amount = $rowamount['transportation_rate']*1.10;
		//	}
		//}
		while($rowamount = sqlsrv_fetch_array( $resultamount, SQLSRV_FETCH_ASSOC)){
			$amount = $rowamount['transportation_rate'];
			if ($UOM == 'R/Tp' and $rowamount['round_trip_rate'] > 0)
				$amount = $rowamount['round_trip_rate'];
			$total_km = $rowamount['total_km'];
			if ($row['diesel_rate'] > $rowamount['diesel_baht_to'] and $rowamount['diesel1'] == 30) {
				if ($row['diesel_rate'] < 31)
					$amount = $amount*1.02;
				else if ($row['diesel_rate'] < 32)
					$amount = $amount*1.04;
				else if ($row['diesel_rate'] < 33)
					$amount = $amount*1.06;
				else if ($row['diesel_rate'] < 34)
					$amount = $amount*1.08;
				else if ($row['diesel_rate'] < 35)
					$amount = $amount*1.10;
				else if ($row['diesel_rate'] < 36)
					$amount = $amount*1.12;
				else if ($row['diesel_rate'] < 37)
					$amount = $amount*1.14;
				else if ($row['diesel_rate'] < 38)
					$amount = $amount*1.16;
				else if ($row['diesel_rate'] < 39)
					$amount = $amount*1.18;
				else if ($row['diesel_rate'] < 40)
					$amount = $amount*1.20;
				else if ($row['diesel_rate'] < 41)
					$amount = $amount*1.22;

			}
			if ($row['diesel_rate'] > $rowamount['diesel_baht_to'] and $rowamount['diesel1'] == 33) {
				if ($row['diesel_rate'] < 35)
					$amount = $amount *1.05;
				else if ($row['diesel_rate'] < 37)
					$amount = $amount *1.10;
				else if ($row['diesel_rate'] < 39)
					$amount = $amount *1.15;
				}
		}
		if ($amount == 0) {
			$aQuery2 = "select a.transportation_rate, a.diesel_baht_to, c.diesel1, a.total_km, a.round_trip_rate from contract_transportation_rate a left join customer_contract c on c.contract_no = a.contract_no where a.customer = '$customer' and a.transportation_to = '$transport_from' and a.transportation_from = '$transport_to' and a.contract_no = '$contract_no' and a.vehicle_type = '$vehicle_type' ";// and a.uom = '$UOM' ";
			$resultamount2 = sqlsrv_query($conn, $aQuery2);
			$amount = 0;
			while($rowamount2 = sqlsrv_fetch_array( $resultamount2, SQLSRV_FETCH_ASSOC)){
				$amount = $rowamount2['transportation_rate'];
				if ($UOM == 'R/Tp' and $rowamount2['round_trip_rate'] > 0)
					$amount = $rowamount2['round_trip_rate'];
				$total_km = $rowamount2['total_km'];
				if ($row['diesel_rate'] > $rowamount2['diesel_baht_to'] and $rowamount2['diesel1'] == 30) {
					if ($row['diesel_rate'] < 31)
						$amount = $amount*1.02;
					else if ($row['diesel_rate'] < 32)
						$amount = $amount*1.04;
					else if ($row['diesel_rate'] < 33)
						$amount = $amount*1.06;
					else if ($row['diesel_rate'] < 34)
						$amount = $amount*1.08;
					else if ($row['diesel_rate'] < 35)
						$amount = $amount*1.10;
					else if ($row['diesel_rate'] < 36)
						$amount = $amount*1.12;
					else if ($row['diesel_rate'] < 37)
						$amount = $amount*1.14;
					else if ($row['diesel_rate'] < 38)
						$amount = $amount*1.16;
					else if ($row['diesel_rate'] < 39)
						$amount = $amount*1.18;
					else if ($row['diesel_rate'] < 40)
						$amount = $amount*1.20;
					else if ($row['diesel_rate'] < 41)
						$amount = $amount*1.22;
				}
				if ($row['diesel_rate'] > $rowamount2['diesel_baht_to'] and $rowamount2['diesel1'] == 33) {
				if ($row['diesel_rate'] < 35)
					$amount = $amount *1.05;
				else if ($row['diesel_rate'] < 37)
					$amount = $amount *1.10;
				else if ($row['diesel_rate'] < 39)
					$amount = $amount *1.15;
				}
			}
		}
		$diesel_rate = $row['diesel_rate'];
		$aQuery = "select a.transportation_rate, a.diesel_baht_to, c.diesel1, a.total_km, a.round_trip_rate from contract_transportation_rate a left join customer_contract c on c.contract_no = a.contract_no where a.customer = '$customer' and a.transportation_from = '$transport_from' and a.transportation_to = '$transport_to' and a.contract_no = '$contract_no' and a.vehicle_type = '$vehicle_type' and diesel_baht_from <= '$diesel_rate' and diesel_baht_to >= '$diesel_rate' ";// and a.uom = '$UOM' ";
		$resultamount = sqlsrv_query($conn, $aQuery);
		while($rowamount = sqlsrv_fetch_array( $resultamount, SQLSRV_FETCH_ASSOC)){
			$amount = $rowamount['transportation_rate'];
			if ($UOM == 'R/Tp' and $rowamount['round_trip_rate'] > 0)
					$amount = $rowamount['round_trip_rate'];
			$total_km = $rowamount['total_km'];
			if ($row['diesel_rate'] > $rowamount['diesel_baht_to'] and $rowamount['diesel1'] == 30) {
					if ($row['diesel_rate'] < 31)
					$amount = $amount*1.02;
					else if ($row['diesel_rate'] < 32)
						$amount = $amount*1.04;
					else if ($row['diesel_rate'] < 33)
						$amount = $amount*1.06;
					else if ($row['diesel_rate'] < 34)
						$amount = $amount*1.08;
					else if ($row['diesel_rate'] < 35)
						$amount = $amount*1.10;
					else if ($row['diesel_rate'] < 36)
						$amount = $amount*1.12;
					else if ($row['diesel_rate'] < 37)
						$amount = $amount*1.14;
					else if ($row['diesel_rate'] < 38)
						$amount = $amount*1.16;
					else if ($row['diesel_rate'] < 39)
						$amount = $amount*1.18;
					else if ($row['diesel_rate'] < 40)
						$amount = $amount*1.20;
					else if ($row['diesel_rate'] < 41)
						$amount = $amount*1.22;
				}
			if ($row['diesel_rate'] > $rowamount['diesel_baht_to'] and $rowamount['diesel1'] == 33) {
				if ($row['diesel_rate'] < 35)
					$amount = $amount *1.05;
				else if ($row['diesel_rate'] < 37)
					$amount = $amount *1.10;
				else if ($row['diesel_rate'] < 39)
					$amount = $amount *1.15;
				}
		}
		$aQuery = "select a.transportation_rate, a.diesel_baht_to, c.diesel1, a.total_km, a.round_trip_rate from contract_transportation_rate a left join customer_contract c on c.contract_no = a.contract_no where a.customer = '$customer' and a.transportation_to = '$transport_from' and a.transportation_from = '$transport_to' and a.contract_no = '$contract_no' and a.vehicle_type = '$vehicle_type' and diesel_baht_from <= '$diesel_rate' and diesel_baht_to >= '$diesel_rate' ";// and a.uom = '$UOM' ";
		$resultamount = sqlsrv_query($conn, $aQuery);
		while($rowamount = sqlsrv_fetch_array( $resultamount, SQLSRV_FETCH_ASSOC)){
			$amount = $rowamount['transportation_rate'];
			if ($UOM == 'R/Tp' and $rowamount['round_trip_rate'] > 0)
					$amount = $rowamount['round_trip_rate'];
			$total_km = $rowamount['total_km'];
			if ($row['diesel_rate'] > $rowamount['diesel_baht_to'] and $rowamount['diesel1'] == 30) {
					if ($row['diesel_rate'] < 31)
					$amount = $amount*1.02;
					else if ($row['diesel_rate'] < 32)
						$amount = $amount*1.04;
					else if ($row['diesel_rate'] < 33)
						$amount = $amount*1.06;
					else if ($row['diesel_rate'] < 34)
						$amount = $amount*1.08;
					else if ($row['diesel_rate'] < 35)
						$amount = $amount*1.10;
					else if ($row['diesel_rate'] < 36)
						$amount = $amount*1.12;
					else if ($row['diesel_rate'] < 37)
						$amount = $amount*1.14;
					else if ($row['diesel_rate'] < 38)
						$amount = $amount*1.16;
					else if ($row['diesel_rate'] < 39)
						$amount = $amount*1.18;
					else if ($row['diesel_rate'] < 40)
						$amount = $amount*1.20;
					else if ($row['diesel_rate'] < 41)
						$amount = $amount*1.22;
				}
			if ($row['diesel_rate'] > $rowamount['diesel_baht_to'] and $rowamount['diesel1'] == 33) {
				if ($row['diesel_rate'] < 35)
					$amount = $amount *1.05;
				else if ($row['diesel_rate'] < 37)
					$amount = $amount *1.10;
				else if ($row['diesel_rate'] < 39)
					$amount = $amount *1.15;
				}
		}
		if ($row['transport_solution'] == 1){
			$aQuery = "select hourly_rate, daily_rate, minimum_charge_hour from contract_service_rate where contract_no = '$contract_no' and vehicle_type = '$vehicle_type' ";
			$resultamount = sqlsrv_query($conn, $aQuery);
			while($rowamount = sqlsrv_fetch_array( $resultamount, SQLSRV_FETCH_ASSOC)){
				if ($UOM == 'Hour') {
					if ($row['quantity'] < $rowamount['minimum_charge_hour']){
						$amount = $rowamount['hourly_rate'];//*$rowamount['minimum_charge_hour'];
						$qty_contract = $rowamount['minimum_charge_hour'];
					} else
						$amount = $rowamount['hourly_rate'];
				} else {
					$amount = $rowamount['daily_rate'];
				}
			}
			$total_km = 0;
			$Service_type = 'TRANSPORT SOLUTION';
			$GL = '411110';
			
		}
		if ($row['lumsum_charge'] == 1){
			$aQuery = "select a.transportation_rate, a.diesel_baht_to, c.diesel1, a.total_km from contract_transportation_rate a left join customer_contract c on c.contract_no = a.contract_no where a.customer = '$customer' and a.transportation_from = '$transport_from' and a.transportation_to = '$transport_to' and a.contract_no = '$contract_no' and a.transport_solution = 1 ";
			$resultamount = sqlsrv_query($conn, $aQuery);
			while($rowamount = sqlsrv_fetch_array( $resultamount, SQLSRV_FETCH_ASSOC)){
				$amount = $rowamount['transportation_rate'];
			}
			$total_km = 0;
			//$Service_type = 'TRANSPORT SOLUTION';
			//$GL = '411110';
		}
		if ($row['promotion_code'] <> ''){
			$pro = $row['promotion_code'];
			$aQuery = "SELECT * FROM contract_promotion WHERE customer = '$customer' and contract_no = '$contract_no' and description = '$pro' ";
			$resultamount = sqlsrv_query($conn, $aQuery);
			while($rowamount = sqlsrv_fetch_array( $resultamount, SQLSRV_FETCH_ASSOC)){
				$amount = $amount*($rowamount['discount']/100);
			}
			$total_km = 0;
			//$Service_type = 'TRANSPORT SOLUTION';
			//$GL = '411110';
		}
	} else if ($row['service_type'] == 'MANPOWER') {		
		$aQuery = "select normal, after_normal, s_normal, s_after_normal, minimum_charge, sunday, saturday, lamsum_charge_rate from contract_hourly_rate where customer = '$customer' and position = '$position' and contract_no = '$contract_no' ";
		$resultamount = sqlsrv_query($conn, $aQuery);
		$amount = 0;
		$GL = '411500';
		if (is_null($row['start_date'])) {
			$s_date = '';
		} else {
			$s_date = date_format($row['start_date'],'Y/m/d');
		}
		$nonwork = 0;
		$dQuery = " select * from contract_non_working_date where non_working_date = '$s_date' ";
		$resultnonwork = sqlsrv_query($conn, $dQuery);
		while($rownonwork = sqlsrv_fetch_array( $resultnonwork, SQLSRV_FETCH_ASSOC)){
			$nonwork = 1;
		}

		while($rowamount = sqlsrv_fetch_array( $resultamount, SQLSRV_FETCH_ASSOC)){
			if ($row['lump_sum'] == 1){ 
				$amount = $rowamount['lamsum_charge_rate'];
			} else if (($nameOfday == 'Sun' and $rowamount['sunday'] == 0) or ($nameOfday == 'Sat' and $rowamount['saturday'] == 0)){
				if ($row['uom'] == 'Day'){
					if ($start_time == '08:00' or $start_time == '09:00' or $start_time == '10:00' or $start_time == '13:00' or ($start_time >= '07:30' and $start_time <= '13:00') or $start_time == '15:00' or $start_time == '16:00' or $start_time == '14:30' or $start_time == '14:00') {
						$amount = $rowamount['s_normal'];//*$rowamount['minimum_charge'];
						$qty_contract = $rowamount['minimum_charge'];
					} else if ($start_time == '17:00' or $start_time == '06:00' or $start_time == '20:00' or $start_time == '01:00' or $start_time == '19:00' or $start_time == '18:00') {
						$amount = $rowamount['s_after_normal'];//*$rowamount['minimum_charge'];
						$qty_contract = $rowamount['minimum_charge'];
					}
				} else if ($row['uom'] == 'Hour'){
					if ($start_time == '08:00' or $start_time == '09:00' or $start_time == '10:00' or $start_time == '13:00' or ($start_time >= '07:30' and $start_time <= '13:00') or $start_time == '15:00' or $start_time == '16:00' or $start_time == '14:30' or $start_time == '14:00')
						$amount = $rowamount['s_normal'];
					else if ($start_time == '17:00' or $start_time == '06:00' or $start_time == '20:00' or $start_time == '01:00' or $start_time == '19:00' or $start_time == '18:00')
						$amount = $rowamount['s_after_normal'];
				}
			} else if ($nonwork == 1){ 
				$amount = $rowamount['s_normal'];
			} else {
				if ($row['uom'] == 'Day') {
					$amount = $rowamount['normal'];//*$rowamount['minimum_charge'];
					$qty_contract = $rowamount['minimum_charge'];
				} else if ($row['uom'] == 'Hour') {
					if ($start_time == '08:00' or $start_time == '09:00' or $start_time == '10:00' or $start_time == '13:00' or ($start_time >= '07:30' and $start_time <= '13:00') or $start_time == '15:00' or $start_time == '16:00' or $start_time == '14:30' or $start_time == '14:00')
						$amount = $rowamount['normal'];
					else if ($start_time == '17:00' or $start_time == '06:00' or $start_time == '20:00' or $start_time == '01:00' or $start_time == '19:00' or $start_time == '18:00')
						$amount = $rowamount['after_normal'];
				}
			}
			$qty_contract = $rowamount['minimum_charge'];
		}
	} else if ($row['service_type'] == 'IMMIGRATION') {		
		$aQuery = "select unit_price from contract_immigration where customer = '$customer' and description = '$service' and contract_no = '$contract_no' ";
		$resultamount = sqlsrv_query($conn, $aQuery);
		$amount = 0;
		$GL = '411810';
		while($rowamount = sqlsrv_fetch_array( $resultamount, SQLSRV_FETCH_ASSOC)){
			$amount = $rowamount['unit_price'];
		}
	} else if ($row['service_type'] == 'PERSONNEL TRANSPORT') {
		$aQuery = "select a.transport_rate, c.diesel2, a.total_km, diesel_baht_to, diesel1 from contract_taxi_service a left join customer_contract c on c.contract_no = a.contract_no where a.customer = '$customer' and a.transport_from = '$transport_from' and a.transport_to = '$transport_to' and a.contract_no = '$contract_no' and a.vehicle_type = '$vehicle_type' ";
		$resultamount = sqlsrv_query($conn, $aQuery);
		$amount = 0;
		$GL = '411820';
		while($rowamount = sqlsrv_fetch_array( $resultamount, SQLSRV_FETCH_ASSOC)){
			$amount = $rowamount['transport_rate'];
			if ($row['diesel_rate'] > $rowamount['diesel_baht_to'] and $rowamount['diesel1'] == 30) {
					if ($row['diesel_rate'] < 31)
					$amount = $rowamount['transport_rate']*1.02;
					else if ($row['diesel_rate'] < 32)
						$amount = $rowamount['transport_rate']*1.04;
					else if ($row['diesel_rate'] < 33)
						$amount = $rowamount['transport_rate']*1.06;
					else if ($row['diesel_rate'] < 34)
						$amount = $rowamount['transport_rate']*1.08;
					else if ($row['diesel_rate'] < 35)
						$amount = $rowamount['transport_rate']*1.10;
					else if ($row['diesel_rate'] < 36)
						$amount = $rowamount['transport_rate']*1.12;
					else if ($row['diesel_rate'] < 37)
						$amount = $rowamount['transport_rate']*1.14;
					else if ($row['diesel_rate'] < 38)
						$amount = $rowamount['transport_rate']*1.16;
					else if ($row['diesel_rate'] < 39)
						$amount = $rowamount['transport_rate']*1.18;
					else if ($row['diesel_rate'] < 40)
						$amount = $rowamount['transport_rate']*1.20;
					else if ($row['diesel_rate'] < 41)
						$amount = $rowamount['transport_rate']*1.22;
				}
		}
		if ($amount == 0) {
			$aQuery2 = "select a.transport_rate, c.diesel2, a.total_km, diesel_baht_to, diesel1 from contract_taxi_service a left join customer_contract c on c.contract_no = a.contract_no where a.customer = '$customer' and a.transport_to = '$transport_from' and a.transport_from = '$transport_to' and a.contract_no = '$contract_no' and a.vehicle_type = '$vehicle_type' ";
			$resultamount2 = sqlsrv_query($conn, $aQuery2);
			while($rowamount2 = sqlsrv_fetch_array( $resultamount2, SQLSRV_FETCH_ASSOC)){
				$amount = $rowamount2['transport_rate'];
				if ($row['diesel_rate'] > $rowamount2['diesel_baht_to'] and $rowamount2['diesel1'] == 30) {
					if ($row['diesel_rate'] < 31)
					$amount = $rowamount2['transport_rate']*1.02;
					else if ($row['diesel_rate'] < 32)
						$amount = $rowamount2['transport_rate']*1.04;
					else if ($row['diesel_rate'] < 33)
						$amount = $rowamount2['transport_rate']*1.06;
					else if ($row['diesel_rate'] < 34)
						$amount = $rowamount2['transport_rate']*1.08;
					else if ($row['diesel_rate'] < 35)
						$amount = $rowamount2['transport_rate']*1.10;
					else if ($row['diesel_rate'] < 36)
						$amount = $rowamount2['transport_rate']*1.12;
					else if ($row['diesel_rate'] < 37)
						$amount = $rowamount2['transport_rate']*1.14;
					else if ($row['diesel_rate'] < 38)
						$amount = $rowamount2['transport_rate']*1.16;
					else if ($row['diesel_rate'] < 39)
						$amount = $rowamount2['transport_rate']*1.18;
					else if ($row['diesel_rate'] < 40)
						$amount = $rowamount2['transport_rate']*1.20;
					else if ($row['diesel_rate'] < 41)
						$amount = $rowamount2['transport_rate']*1.22;
				}
			}
		}
	} else if ($row['service_type'] == 'CARGO HANDLE') {		
		$aQuery = "select a.contract_no, contract_line, diesel_baht_from, diesel_baht_to, rate, minimum_charge_hour, c.diesel1, a.day_rate from contract_equipment_rental a left join customer_contract c on c.contract_no = a.contract_no WHERE a.customer = '$customer'  and equipment = '$vehicle_type' and branch = '$transport_from' and uom = '$UOM' and a.contract_no = '$contract_no' ";
		$resultamount = sqlsrv_query($conn, $aQuery);
		$amount = 0;
		$GL = '411400';
		while($rowamount = sqlsrv_fetch_array( $resultamount, SQLSRV_FETCH_ASSOC)){			
			if ($UOM == 'Hour') {
				if ($row['quantity'] < $rowamount['minimum_charge_hour'])
					$qty_contract = $rowamount['minimum_charge_hour'];
				$amount = $rowamount['rate'];
				if ($row['diesel_rate'] > $rowamount['diesel_baht_to'] and $rowamount['diesel1'] == 30) {
					if ($row['diesel_rate'] < 31)
						$amount = $amount*1.02;
					else if ($row['diesel_rate'] < 32)
						$amount = $amount*1.04;
					else if ($row['diesel_rate'] < 33)
						$amount = $amount*1.06;
					else if ($row['diesel_rate'] < 34)
						$amount = $amount*1.08;
					else if ($row['diesel_rate'] < 35)
						$amount = $amount*1.10;
					else if ($row['diesel_rate'] < 36)
						$amount = $amount*1.12;
					else if ($row['diesel_rate'] < 37)
						$amount = $amount*1.14;
					else if ($row['diesel_rate'] < 38)
						$amount = $amount*1.16;
					else if ($row['diesel_rate'] < 39)
						$amount = $amount*1.18;
					else if ($row['diesel_rate'] < 40)
						$amount = $amount*1.20;
					else if ($row['diesel_rate'] < 41)
						$amount = $amount*1.22;

				}
				if ($row['diesel_rate'] > $rowamount['diesel_baht_to'] and $rowamount['diesel1'] == 33) {
				if ($row['diesel_rate'] < 35)
					$amount = $amount *1.05;
				else if ($row['diesel_rate'] < 37)
					$amount = $amount *1.10;
				else if ($row['diesel_rate'] < 39)
					$amount = $amount *1.15;
				}
			}
			if ($UOM == 'Day') {
				$amount = $rowamount['day_rate'];
				if ($row['diesel_rate'] > $rowamount['diesel_baht_to'] and $rowamount['diesel1'] == 30) {
					if ($row['diesel_rate'] < 31)
						$amount = $amount*1.02;
					else if ($row['diesel_rate'] < 32)
						$amount = $amount*1.04;
					else if ($row['diesel_rate'] < 33)
						$amount = $amount*1.06;
					else if ($row['diesel_rate'] < 34)
						$amount = $amount*1.08;
					else if ($row['diesel_rate'] < 35)
						$amount = $amount*1.10;
					else if ($row['diesel_rate'] < 36)
						$amount = $amount*1.12;
					else if ($row['diesel_rate'] < 37)
						$amount = $amount*1.14;
					else if ($row['diesel_rate'] < 38)
						$amount = $amount*1.16;
					else if ($row['diesel_rate'] < 39)
						$amount = $amount*1.18;
					else if ($row['diesel_rate'] < 40)
						$amount = $amount*1.20;
					else if ($row['diesel_rate'] < 41)
						$amount = $amount*1.22;

				}
				if ($row['diesel_rate'] > $rowamount['diesel_baht_to'] and $rowamount['diesel1'] == 33) {
				if ($row['diesel_rate'] < 35)
					$amount = $amount *1.05;
				else if ($row['diesel_rate'] < 37)
					$amount = $amount *1.10;
				else if ($row['diesel_rate'] < 39)
					$amount = $amount *1.15;
				}
			}
		}
		//$diesel_rate = $row['diesel_rate'];
		//$aQuery = "select a.contract_no, contract_line, diesel_baht_from, diesel_baht_to, rate, minimum_charge_hour, c.diesel1, a.day_rate from contract_equipment_rental a left join customer_contract c on c.contract_no = a.contract_no WHERE a.customer = '$customer'  and equipment = '$vehicle_type' and branch = '$transport_from' and uom = '$UOM' and a.contract_no = '$contract_no' and diesel_baht_from <= '$diesel_rate' and diesel_baht_to >= '$diesel_rate' ";// and a.uom = '$UOM' ";
		//$resultamount = sqlsrv_query($conn, $aQuery);
		//while($rowamount = sqlsrv_fetch_array( $resultamount, SQLSRV_FETCH_ASSOC)){
		//	$amount = $rowamount['rate'];
		//	if ($row['diesel_rate'] > $rowamount['diesel_baht_to'] and $rowamount['diesel1'] == 30) {
		//			if ($row['diesel_rate'] < 31)
		//			$amount = $amount*1.02;
		//			else if ($row['diesel_rate'] < 32)
		//				$amount = $amount*1.04;
		//			else if ($row['diesel_rate'] < 33)
		//				$amount = $amount*1.06;
		//			else if ($row['diesel_rate'] < 34)
		//				$amount = $amount*1.08;
		//			else if ($row['diesel_rate'] < 35)
		//				$amount = $amount*1.10;
		//			else if ($row['diesel_rate'] < 36)
		//				$amount = $amount*1.12;
		//			else if ($row['diesel_rate'] < 37)
		//				$amount = $amount*1.14;
		//			else if ($row['diesel_rate'] < 38)
		//				$amount = $amount*1.16;
		//			else if ($row['diesel_rate'] < 39)
		//				$amount = $amount*1.18;
		//			else if ($row['diesel_rate'] < 40)
		//				$amount = $amount*1.20;
		//			else if ($row['diesel_rate'] < 41)
		//				$amount = $amount*1.22;
		//		}
		//}

	}  else if ($row['service_type'] == 'SERVICE - OTHER') {
		$amount = $row['amount'];
	}

	if ($show_amount != 1){
		$amount = 0;
		$totalamount = 0;
	}
	if ($row['no_charge'] == 0)
		$nocharge = 'No';
	else
		$nocharge = 'Yes';
	if ($row['consolidate'] == 0)
		$consolidate = 'No';
	else
		$consolidate = 'Yes';
	if ($row['vehicle_switch'] == 0)
		$vehicle_switch = 'No';
	else
		$vehicle_switch = 'Yes';
	if ($row['outsource'] == 0)
		$outsource = 'No';
	else
		$outsource = 'Yes';
	if ($row['standby_charge'] == 0)
		$standby_charge = 'No';
	else
		$standby_charge = 'Yes';

	if ($row['quantity'] >= 0)
		$totalamount = $row['quantity']*$amount;

	$outsource_reason = '';

    $data = [$row['user_id'], $row['branch'], $client_inform_amarit_date, $client_inform_amarit_time, $row['worksheet_status'], $row['line_status'], $row['worksheet_id'], $worksheet_date, $Service_type, $row['transport_id'], $row['customer'], $row['erp_id'], $row['customer_name'], $row['subject'], $row['contract_no'], $row['contract_line'], 
		
	    $row['customer_ref'], $row['contract'], $row['remark'], $row['request_method'], $row['request_to'],  $cs_inform_opr_date, $cs_inform_opr_time, $opr_inform_cs_date, $opr_inform_cs_time, $cs_inform_client_date, $cs_inform_client_time
		, $row['registration_no'], $row['vehicle_id_erp'], $outsource, $row['description'] , $row['name'], $row['position'], $row['transport_from'], $row['transport_to'],$row['specific_location_from'], $row['specific_location_to'], $row['contact1'], $row['contact2'], $row['charge_as'], $row['outsource_charge_as'],  $row['remark'], $row['department'], $row['cost_center'], $row['u_from'], $row['u_to'], $row['mileage_start'], $row['mileage_end'], $row['fuel_km_per_litre'], $tatalkm, $total_km, $start_date, $start_time, $end_date, $end_time, $row['quantity'], $row['uom'],
	
	$amount, $totalamount, $row['diesel_rate'], $nocharge, $consolidate, $vehicle_switch, $standby_charge, $row['cancel_reason'], $row['cargo_type'], $row['cargo_qty'], $row['cargo_weight'], $row['dimension'],  
		
	$row['group_name'], $row['ttype'],$row['type1'], $row['type2'], $row['type3'], $row['type4'], $row['barcode'],$row['type1_desc'], $row['type2_desc'], $row['type3_desc'], $row['type4_desc'], $row['wref1'], $row['wref2'], $row['wref3'], $row['wref4'], $row['wref5'], $row['wref6'], $row['ref1'], $row['ref2'], $row['ref3'], $row['ref4'], $row['ref5'], $row['ref6'], $outsource_reason];
    array_push($raw['data'],$data);
}

$fQuery = "
SELECT
	'UTILITIES' AS service_type,
	a.worksheet_id,
	w.worksheet_date,
	a.utilities_id,
	'',
	'',
	'',
	'',
	'',
	'',
	'',
	'',
	'a.agreement_number',
	'a.contract_line',
	a.remark,
	a.ref1,
	a.ref2,
	a.department,
	a.cost_center,
	'' AS u_from,
	'',
	0,
	0,
	0,
	a.[start_date],
	'a.start_time',
	a.end_date,
	'a.end_time',
	a.qty,
	a.uom,
	a.customer,
	u.name AS customer_name,
	a.status,
	w.contract,
	w.customer_ref,
	s.description AS subject,
	'a.group_name',
	w.branch,
	'12' AS ttype,
	'a.type1',
	'a.type2',
	'a.type3',
	a.type4 ,
	'a.group_name'+ '-' + 'a.branch' + '-' + '00' + '-' + '12' + '-' + 'a.type1' + '-' + 'a.type2' + '-' + 'a.type3' + '-' + a.type4+ '-00-00' AS barcode,
	'a.group_name_desc' AS group_name,
	'a.type_1_desc' AS type1_desc,
	'a.type_2_desc' AS type2_desc,
	'a.type_3_desc' AS type3_desc,
	'a.type_4_desc' AS type4_desc,
	w.contract,
	w.remark,
	w.worksheet_status,
	w.request_method,
	w.request_to,
	w.client_inform_amarit_date,
	w.client_inform_amarit_time,
	w.cs_inform_opr_date,
	w.cs_inform_opr_time,
	w.opr_inform_cs_date,
	w.opr_inform_cs_time,
	w.cs_inform_client_date,
	w.cs_inform_client_time ,
	'a.service' AS specific_location_from,
	'',
	0,
	0,
	0,
	0,
	'a.cancel_reason',
	'',
	0,
	0,
	'',
	'',
	'',
	'',
	'',
	w.user_id,
	'',
	a.ref3,
	a.ref4,
	a.ref5,
	a.ref6,
	w.ref1 AS wref1,
	w.ref2 AS wref2,
	w.ref3 AS wref3,
	w.ref4 AS wref4,
	w.ref5 AS wref5,
	w.ref6 AS wref6,
	'',
	'',
	'',
	'',
	u.erp_id,
	0,
	0 AS amount,
	0 AS lumsum_charge,
	'' AS promotion_code,
	0 AS lump_sum 

	, a.contract_number
FROM
	worksheet_utilities a
	LEFT JOIN customer u ON u.customer_id= a.customer
	LEFT JOIN worksheet w ON w.worksheet_id= a.worksheet_id
	LEFT JOIN subject s ON s.code= w.subject 
WHERE w.worksheet_date >= '$from_date' AND w.worksheet_date <= '$to_date' 
";
//echo $fQuery;
$result = sqlsrv_query($conn, $fQuery);
//$raw['data'] = array();

while($custom = sqlsrv_fetch_array( $result, SQLSRV_FETCH_ASSOC)){


	
	if (is_null($custom['mileage_end'])) {
		$tatalkm = 0;
	} else {
		$tatalkm = $custom['mileage_end']- $custom['mileage_start'];
	}
	if (is_null($custom['start_time'])) {
		$start_time = '';
	} else {
		$start_time = date_format($custom['start_time'],'H:i');
	}
	if (is_null($custom['end_time'])) {
		$end_time = '';
	} else {
		$end_time = date_format($custom['end_time'],'H:i');
	}
	if (is_null($custom['client_inform_amarit_date'])) {
		$client_inform_amarit_date = '';
	} else {
		$client_inform_amarit_date = date_format($custom['client_inform_amarit_date'],'d/m/Y');
	}
	if (is_null($custom['client_inform_amarit_time'])) {
		$client_inform_amarit_time = '';
	} else {
		$client_inform_amarit_time = date_format($custom['client_inform_amarit_time'],'H:i');
	}
	if (is_null($custom['cs_inform_opr_date'])) {
		$cs_inform_opr_date = '';
	} else {
		$cs_inform_opr_date = date_format($custom['cs_inform_opr_date'],'d/m/Y');
	}
	if (is_null($custom['cs_inform_opr_time'])) {
		$cs_inform_opr_time = '';
	} else {
		$cs_inform_opr_time = date_format($custom['cs_inform_opr_time'],'H:i');
	}
	if (is_null($custom['opr_inform_cs_date'])) {
		$opr_inform_cs_date = '';
	} else {
		$opr_inform_cs_date = date_format($custom['opr_inform_cs_date'],'d/m/Y');
	}
	if (is_null($custom['opr_inform_cs_time'])) {
		$opr_inform_cs_time = '';
	} else {
		$opr_inform_cs_time = date_format($custom['opr_inform_cs_time'],'H:i');
	}
	if (is_null($custom['cs_inform_client_date'])) {
		$cs_inform_client_date = '';
	} else {
		$cs_inform_client_date = date_format($custom['cs_inform_client_date'],'d/m/Y');
	}
	if (is_null($custom['cs_inform_client_time'])) {
		$cs_inform_client_time = '';
	} else {
		$cs_inform_client_time = date_format($custom['cs_inform_client_time'],'H:i');
	}
	if (is_null($custom['actual_start_date'])) {
		$actual_start_date = '';
	} else {
		$actual_start_date = date_format($custom['actual_start_date'],'d/m/Y');
	}
	if (is_null($custom['start_date'])) {
		$start_date = '';
	} else {

//		$start_date = date_format($custom['start_date'],'d/m/Y');
		$start_date = (new DateTime($custom['start_date']))->format('d/m/Y');
	}
	if (is_null($custom['end_date'])) {
		$end_date = '';
	} else {
		//$end_date = date_format($custom['end_date'],'d/m/Y');
		$end_date = (new DateTime($custom['end_date']))->format('d/m/Y');
	}
	if (is_null($custom['actual_start_time'])) {
		$actual_start_time = '';
	} else {
		$actual_start_time = date_format($custom['actual_start_time'],'H:i');
	}
	if (is_null($custom['actual_finish_date'])) {
		$actual_finish_date = '';
	} else {
		$actual_finish_date = date_format($custom['actual_finish_date'],'d/m/Y');
	}
	if (is_null($custom['actual_finish_time'])) {
		$actual_finish_time = '';
	} else {
		$actual_finish_time = date_format($custom['actual_finish_time'],'H:i');
	}
	if (is_null($custom['worksheet_date'])) {
		$worksheet_date = '';
	} else {
		$worksheet_date = date_format($custom['worksheet_date'],'d/m/Y');
	}
	$total_km = 0;

	$customer = $custom["customer"];
	$transport_from = $custom["transport_from"];
	$transport_to = $custom["transport_to"];
	$contract_no = $custom["contract_number"];
	$position = $custom["position"];
	$service = $custom["specific_location_from"];
	$vehicle_type = $custom["charge_as"];
	$UOM = $custom["uom"];
	$Service_type = $custom['service_type'];
$service_id = $custom['utilities_id'];


    $data = [$custom['user_id'], $custom['branch'], $client_inform_amarit_date, $client_inform_amarit_time, $custom['worksheet_status'], $custom['status'], $custom['worksheet_id'], $worksheet_date, $Service_type, $service_id, $custom['customer'], $custom['erp_id'], $custom['customer_name'], $custom['subject'], $contract_no, $custom['contract_line'], 
		
	    $custom['customer_ref'], $custom['contract'], $custom['remark'], $custom['request_method'], $custom['request_to'],  $cs_inform_opr_date, $cs_inform_opr_time, $opr_inform_cs_date, $opr_inform_cs_time, $cs_inform_client_date, $cs_inform_client_time
		, $custom['registration_no'], $custom['vehicle_id_erp'], $outsource, $custom['description'] , $custom['name'], $custom['position'], $custom['transport_from'], $custom['transport_to'],$custom['specific_location_from'], $custom['specific_location_to'], $custom['contact1'], $custom['contact2'], $custom['charge_as'], $custom['outsource_charge_as'],  $custom['remark'], $custom['department'], $custom['cost_center'], $custom['u_from'], $custom['u_to'], $custom['mileage_start'], $custom['mileage_end'], $custom['fuel_km_per_litre'], $tatalkm, $total_km, $start_date, $start_time, $end_date, $end_time, $custom['quantity'], $custom['uom'],
	
	$amount, $totalamount, $custom['diesel_rate'], $nocharge, $consolidate, $vehicle_switch, $standby_charge, $custom['cancel_reason'], $custom['cargo_type'], $custom['cargo_qty'], $custom['cargo_weight'], $custom['dimension'],  
		
	$custom['group_name'], $custom['ttype'],$custom['type1'], $custom['type2'], $custom['type3'], $custom['type4'], $custom['barcode'],$custom['type1_desc'], $custom['type2_desc'], $custom['type3_desc'], $custom['type4_desc'], $custom['wref1'], $custom['wref2'], $custom['wref3'], $custom['wref4'], $custom['wref5'], $custom['wref6'], $custom['ref1'], $custom['ref2'], $custom['ref3'], $custom['ref4'], $custom['ref5'], $custom['ref6'], $outsource_reason];
    array_push($raw['data'],$data);
}





$fQuery = "
SELECT
'WAREHOUSING' AS service_type,
a.worksheet_id,
w.worksheet_date,
a.warehousing_space_rental_id,
'',
'',
'',
'',
'',
'',
'',
'',
'a.agreement_number',
'a.contract_line',
a.remark,
a.ref1,
a.ref2,
a.department,
a.cost_center,
'' AS u_from,
'',
0,
0,
0,
a.[start_date],
'a.start_time',
a.end_date,
'a.end_time',
a.qty,
a.uom,
a.customer,
u.name AS customer_name,
'a.line_status',
w.contract,
w.customer_ref,
s.description AS subject,
'a.group_name',
w.branch,
'12' AS ttype,
'a.type1',
'a.type2',
'a.type3',
'a.type4',
'a.group_name'+ '-' + 'a.branch' + '-' + '00' + '-' + '12' + '-' + 'a.type1' + '-' + 'a.type2' + '-' + 'a.type3' + '-' +
'a.type4' + '-00-00' AS barcode,
'a.group_name_desc' AS group_name,
'a.type_1_desc' AS type1_desc,
'a.type_2_desc' AS type2_desc,
'a.type_3_desc' AS type3_desc,
'a.type_4_desc' AS type4_desc,
w.contract,
w.remark,
w.worksheet_status,
w.request_method,
w.request_to,
w.client_inform_amarit_date,
w.client_inform_amarit_time,
w.cs_inform_opr_date,
w.cs_inform_opr_time,
w.opr_inform_cs_date,
w.opr_inform_cs_time,
w.cs_inform_client_date,
w.cs_inform_client_time ,
'a.service' AS specific_location_from,
'',
0,
0,
0,
0,
'a.cancel_reason',
'',
0,
0,
'',
'',
'',
'',
'',
w.user_id,
'',
a.ref3,
a.ref4,
a.ref5,
a.ref6,
w.ref1 AS wref1,
w.ref2 AS wref2,
w.ref3 AS wref3,
w.ref4 AS wref4,
w.ref5 AS wref5,
w.ref6 AS wref6,
'',
'',
'',
'',
u.erp_id,
0,
0 AS amount,
0 AS lumsum_charge,
'' AS promotion_code,
0 AS lump_sum


	, a.contract_number
	, a.status
FROM
worksheet_warehousing_space_rental a
	LEFT JOIN customer u ON u.customer_id= a.customer
	LEFT JOIN worksheet w ON w.worksheet_id= a.worksheet_id
	LEFT JOIN subject s ON s.code= w.subject 
WHERE w.worksheet_date >= '$from_date' AND w.worksheet_date <= '$to_date' 
";
//echo $fQuery;
$result = sqlsrv_query($conn, $fQuery);
//$raw['data'] = array();

while($custom = sqlsrv_fetch_array( $result, SQLSRV_FETCH_ASSOC)){


	
	if (is_null($custom['mileage_end'])) {
		$tatalkm = 0;
	} else {
		$tatalkm = $custom['mileage_end']- $custom['mileage_start'];
	}
	if (is_null($custom['start_time'])) {
		$start_time = '';
	} else {
		$start_time = date_format($custom['start_time'],'H:i');
	}
	if (is_null($custom['end_time'])) {
		$end_time = '';
	} else {
		$end_time = date_format($custom['end_time'],'H:i');
	}
	if (is_null($custom['client_inform_amarit_date'])) {
		$client_inform_amarit_date = '';
	} else {
		$client_inform_amarit_date = date_format($custom['client_inform_amarit_date'],'d/m/Y');
	}
	if (is_null($custom['client_inform_amarit_time'])) {
		$client_inform_amarit_time = '';
	} else {
		$client_inform_amarit_time = date_format($custom['client_inform_amarit_time'],'H:i');
	}
	if (is_null($custom['cs_inform_opr_date'])) {
		$cs_inform_opr_date = '';
	} else {
		$cs_inform_opr_date = date_format($custom['cs_inform_opr_date'],'d/m/Y');
	}
	if (is_null($custom['cs_inform_opr_time'])) {
		$cs_inform_opr_time = '';
	} else {
		$cs_inform_opr_time = date_format($custom['cs_inform_opr_time'],'H:i');
	}
	if (is_null($custom['opr_inform_cs_date'])) {
		$opr_inform_cs_date = '';
	} else {
		$opr_inform_cs_date = date_format($custom['opr_inform_cs_date'],'d/m/Y');
	}
	if (is_null($custom['opr_inform_cs_time'])) {
		$opr_inform_cs_time = '';
	} else {
		$opr_inform_cs_time = date_format($custom['opr_inform_cs_time'],'H:i');
	}
	if (is_null($custom['cs_inform_client_date'])) {
		$cs_inform_client_date = '';
	} else {
		$cs_inform_client_date = date_format($custom['cs_inform_client_date'],'d/m/Y');
	}
	if (is_null($custom['cs_inform_client_time'])) {
		$cs_inform_client_time = '';
	} else {
		$cs_inform_client_time = date_format($custom['cs_inform_client_time'],'H:i');
	}
	if (is_null($custom['actual_start_date'])) {
		$actual_start_date = '';
	} else {
		$actual_start_date = date_format($custom['actual_start_date'],'d/m/Y');
	}
	if (is_null($custom['start_date'])) {
		$start_date = '';
	} else {

//		$start_date = date_format($custom['start_date'],'d/m/Y');
		$start_date = (new DateTime($custom['start_date']))->format('d/m/Y');
	}
	if (is_null($custom['end_date'])) {
		$end_date = '';
	} else {
		//$end_date = date_format($custom['end_date'],'d/m/Y');
		$end_date = (new DateTime($custom['end_date']))->format('d/m/Y');
	}
	if (is_null($custom['actual_start_time'])) {
		$actual_start_time = '';
	} else {
		$actual_start_time = date_format($custom['actual_start_time'],'H:i');
	}
	if (is_null($custom['actual_finish_date'])) {
		$actual_finish_date = '';
	} else {
		$actual_finish_date = date_format($custom['actual_finish_date'],'d/m/Y');
	}
	if (is_null($custom['actual_finish_time'])) {
		$actual_finish_time = '';
	} else {
		$actual_finish_time = date_format($custom['actual_finish_time'],'H:i');
	}
	if (is_null($custom['worksheet_date'])) {
		$worksheet_date = '';
	} else {
		$worksheet_date = date_format($custom['worksheet_date'],'d/m/Y');
	}
	$total_km = 0;

	$customer = $custom["customer"];
	$transport_from = $custom["transport_from"];
	$transport_to = $custom["transport_to"];
	$contract_no = $custom["contract_number"];
	$position = $custom["position"];
	$service = $custom["specific_location_from"];
	$vehicle_type = $custom["charge_as"];
	$UOM = $custom["uom"];
	$Service_type = $custom['service_type'];
$service_id = $custom['warehousing_space_rental_id'];


    $data = [$custom['user_id'], $custom['branch'], $client_inform_amarit_date, $client_inform_amarit_time, $custom['worksheet_status'], $custom['status'], $custom['worksheet_id'], $worksheet_date, $Service_type, $service_id, $custom['customer'], $custom['erp_id'], $custom['customer_name'], $custom['subject'], $contract_no, $custom['contract_line'], 
		
	    $custom['customer_ref'], $custom['contract'], $custom['remark'], $custom['request_method'], $custom['request_to'],  $cs_inform_opr_date, $cs_inform_opr_time, $opr_inform_cs_date, $opr_inform_cs_time, $cs_inform_client_date, $cs_inform_client_time
		, $custom['registration_no'], $custom['vehicle_id_erp'], $outsource, $custom['description'] , $custom['name'], $custom['position'], $custom['transport_from'], $custom['transport_to'],$custom['specific_location_from'], $custom['specific_location_to'], $custom['contact1'], $custom['contact2'], $custom['charge_as'], $custom['outsource_charge_as'],  $custom['remark'], $custom['department'], $custom['cost_center'], $custom['u_from'], $custom['u_to'], $custom['mileage_start'], $custom['mileage_end'], $custom['fuel_km_per_litre'], $tatalkm, $total_km, $start_date, $start_time, $end_date, $end_time, $custom['quantity'], $custom['uom'],
	
	$amount, $totalamount, $custom['diesel_rate'], $nocharge, $consolidate, $vehicle_switch, $standby_charge, $custom['cancel_reason'], $custom['cargo_type'], $custom['cargo_qty'], $custom['cargo_weight'], $custom['dimension'],  
		
	$custom['group_name'], $custom['ttype'],$custom['type1'], $custom['type2'], $custom['type3'], $custom['type4'], $custom['barcode'],$custom['type1_desc'], $custom['type2_desc'], $custom['type3_desc'], $custom['type4_desc'], $custom['wref1'], $custom['wref2'], $custom['wref3'], $custom['wref4'], $custom['wref5'], $custom['wref6'], $custom['ref1'], $custom['ref2'], $custom['ref3'], $custom['ref4'], $custom['ref5'], $custom['ref6'], $outsource_reason];
    array_push($raw['data'],$data);
}











$fQuery = "
SELECT
'HOTEL BOOKING' AS service_type,
a.worksheet_id,
w.worksheet_date,
a.hotelbooking_id,
'',
'',
'',
'',
'',
'',
'',
'',
'a.agreement_number',
'a.contract_line',
a.remark,
a.ref1,
a.ref2,
a.department,
a.cost_center,
'' AS u_from,
'',
0,
0,
0,
a.checkin_date as \"start_date\",
	'' as \"start_time\",
	a.checkout_date AS \"end_date\",
	'' as \"end_time\",
a.qty,
a.uom,
a.customer,
u.name AS customer_name,
'a.line_status',
w.contract,
w.customer_ref,
s.description AS subject,
'a.group_name',
w.branch,
'12' AS ttype,
'a.type1',
'a.type2',
'a.type3',
'a.type4',
'a.group_name'+ '-' + 'a.branch' + '-' + '00' + '-' + '12' + '-' + 'a.type1' + '-' + 'a.type2' + '-' + 'a.type3' + '-' +
'a.type4' + '-00-00' AS barcode,
'a.group_name_desc' AS group_name,
'a.type_1_desc' AS type1_desc,
'a.type_2_desc' AS type2_desc,
'a.type_3_desc' AS type3_desc,
'a.type_4_desc' AS type4_desc,
w.contract,
w.remark,
w.worksheet_status,
w.request_method,
w.request_to,
w.client_inform_amarit_date,
w.client_inform_amarit_time,
w.cs_inform_opr_date,
w.cs_inform_opr_time,
w.opr_inform_cs_date,
w.opr_inform_cs_time,
w.cs_inform_client_date,
w.cs_inform_client_time ,
'a.service' AS specific_location_from,
'',
0,
0,
0,
0,
'a.cancel_reason',
'',
0,
0,
'',
'',
'',
'',
'',
w.user_id,
'',
a.ref3,
a.ref4,
a.ref5,
a.ref6,
w.ref1 AS wref1,
w.ref2 AS wref2,
w.ref3 AS wref3,
w.ref4 AS wref4,
w.ref5 AS wref5,
w.ref6 AS wref6,
'',
'',
'',
'',
u.erp_id,
0,
0 AS amount,
0 AS lumsum_charge,
'' AS promotion_code,
0 AS lump_sum


	, a.contract_number
	, a.status
FROM
worksheet_hotel_booking a
	LEFT JOIN customer u ON u.customer_id= a.customer
	LEFT JOIN worksheet w ON w.worksheet_id= a.worksheet_id
	LEFT JOIN subject s ON s.code= w.subject 
WHERE w.worksheet_date >= '$from_date' AND w.worksheet_date <= '$to_date' 
";
//echo $fQuery;
//die;
$result = sqlsrv_query($conn, $fQuery);
//$raw['data'] = array();

while($custom = sqlsrv_fetch_array( $result, SQLSRV_FETCH_ASSOC)){


	
	if (is_null($custom['mileage_end'])) {
		$tatalkm = 0;
	} else {
		$tatalkm = $custom['mileage_end']- $custom['mileage_start'];
	}
	if ($custom['start_time']=="") {
		$start_time = '';
	} else {
		$start_time = date_format($custom['start_time'],'H:i');
	}
	if ($custom['end_time']=="") {
		$end_time = '';
	} else {
		$end_time = date_format($custom['end_time'],'H:i');
	}
	if (is_null($custom['client_inform_amarit_date'])) {
		$client_inform_amarit_date = '';
	} else {
		$client_inform_amarit_date = date_format($custom['client_inform_amarit_date'],'d/m/Y');
	}
	if (is_null($custom['client_inform_amarit_time'])) {
		$client_inform_amarit_time = '';
	} else {
		$client_inform_amarit_time = date_format($custom['client_inform_amarit_time'],'H:i');
	}
	if (is_null($custom['cs_inform_opr_date'])) {
		$cs_inform_opr_date = '';
	} else {
		$cs_inform_opr_date = date_format($custom['cs_inform_opr_date'],'d/m/Y');
	}
	if (is_null($custom['cs_inform_opr_time'])) {
		$cs_inform_opr_time = '';
	} else {
		$cs_inform_opr_time = date_format($custom['cs_inform_opr_time'],'H:i');
	}
	if (is_null($custom['opr_inform_cs_date'])) {
		$opr_inform_cs_date = '';
	} else {
		$opr_inform_cs_date = date_format($custom['opr_inform_cs_date'],'d/m/Y');
	}
	if (is_null($custom['opr_inform_cs_time'])) {
		$opr_inform_cs_time = '';
	} else {
		$opr_inform_cs_time = date_format($custom['opr_inform_cs_time'],'H:i');
	}
	if (is_null($custom['cs_inform_client_date'])) {
		$cs_inform_client_date = '';
	} else {
		$cs_inform_client_date = date_format($custom['cs_inform_client_date'],'d/m/Y');
	}
	if (is_null($custom['cs_inform_client_time'])) {
		$cs_inform_client_time = '';
	} else {
		$cs_inform_client_time = date_format($custom['cs_inform_client_time'],'H:i');
	}
	if (is_null($custom['actual_start_date'])) {
		$actual_start_date = '';
	} else {
		$actual_start_date = date_format($custom['actual_start_date'],'d/m/Y');
	}
	if (is_null($custom['start_date'])) {
		$start_date = '';
	} else {

//		$start_date = date_format($custom['start_date'],'d/m/Y');
		$start_date = (new DateTime($custom['start_date']))->format('d/m/Y');
	}
	if (is_null($custom['end_date'])) {
		$end_date = '';
	} else {
		//$end_date = date_format($custom['end_date'],'d/m/Y');
		$end_date = (new DateTime($custom['end_date']))->format('d/m/Y');
	}
	if (is_null($custom['actual_start_time'])) {
		$actual_start_time = '';
	} else {
		$actual_start_time = date_format($custom['actual_start_time'],'H:i');
	}
	if (is_null($custom['actual_finish_date'])) {
		$actual_finish_date = '';
	} else {
		$actual_finish_date = date_format($custom['actual_finish_date'],'d/m/Y');
	}
	if (is_null($custom['actual_finish_time'])) {
		$actual_finish_time = '';
	} else {
		$actual_finish_time = date_format($custom['actual_finish_time'],'H:i');
	}
	if (is_null($custom['worksheet_date'])) {
		$worksheet_date = '';
	} else {
		$worksheet_date = date_format($custom['worksheet_date'],'d/m/Y');
	}
	$total_km = 0;

	$customer = $custom["customer"];
	$transport_from = $custom["transport_from"];
	$transport_to = $custom["transport_to"];
	$contract_no = $custom["contract_number"];
	$position = $custom["position"];
	$service = $custom["specific_location_from"];
	$vehicle_type = $custom["charge_as"];
	$UOM = $custom["uom"];
	$Service_type = $custom['service_type'];
$service_id = $custom['hotelbooking_id'];


    $data = [$custom['user_id'], $custom['branch'], $client_inform_amarit_date, $client_inform_amarit_time, $custom['worksheet_status'], $custom['status'], $custom['worksheet_id'], $worksheet_date, $Service_type, $service_id, $custom['customer'], $custom['erp_id'], $custom['customer_name'], $custom['subject'], $contract_no, $custom['contract_line'], 
		
	    $custom['customer_ref'], $custom['contract'], $custom['remark'], $custom['request_method'], $custom['request_to'],  $cs_inform_opr_date, $cs_inform_opr_time, $opr_inform_cs_date, $opr_inform_cs_time, $cs_inform_client_date, $cs_inform_client_time
		, $custom['registration_no'], $custom['vehicle_id_erp'], $outsource, $custom['description'] , $custom['name'], $custom['position'], $custom['transport_from'], $custom['transport_to'],$custom['specific_location_from'], $custom['specific_location_to'], $custom['contact1'], $custom['contact2'], $custom['charge_as'], $custom['outsource_charge_as'],  $custom['remark'], $custom['department'], $custom['cost_center'], $custom['u_from'], $custom['u_to'], $custom['mileage_start'], $custom['mileage_end'], $custom['fuel_km_per_litre'], $tatalkm, $total_km, $start_date, $start_time, $end_date, $end_time, $custom['quantity'], $custom['uom'],
	
	$amount, $totalamount, $custom['diesel_rate'], $nocharge, $consolidate, $vehicle_switch, $standby_charge, $custom['cancel_reason'], $custom['cargo_type'], $custom['cargo_qty'], $custom['cargo_weight'], $custom['dimension'],  
		
	$custom['group_name'], $custom['ttype'],$custom['type1'], $custom['type2'], $custom['type3'], $custom['type4'], $custom['barcode'],$custom['type1_desc'], $custom['type2_desc'], $custom['type3_desc'], $custom['type4_desc'], $custom['wref1'], $custom['wref2'], $custom['wref3'], $custom['wref4'], $custom['wref5'], $custom['wref6'], $custom['ref1'], $custom['ref2'], $custom['ref3'], $custom['ref4'], $custom['ref5'], $custom['ref6'], $outsource_reason];
    array_push($raw['data'],$data);

    echo '<pre>';
    print_r($data);
    echo '</pre>';
}





























$fQuery = "
SELECT
	'TICKET BOOKING' AS service_type,
	a.worksheet_id,
	w.worksheet_date,
	a.ticketbooking_id,
	'',
	'',
	'',
	'',
	'',
	'',
	'',
	'',
	'a.agreement_number',
	'a.contract_line',
	a.remark,
	a.ref1,
	a.ref2,
	a.department,
	a.cost_center,
	'' AS u_from,
	'',
	0,
	0,
	0,
	a.departure_date AS \"start_date\",
	'' AS \"start_time\",
	'' AS \"end_date\",
	'' AS \"end_time\",
    a.qty,
	a.uom,
	a.customer,
	u.name AS customer_name,
	'a.line_status',
	w.contract,
	w.customer_ref,
	s.description AS subject,
	'a.group_name',
	w.branch,
	'12' AS ttype,
	'a.type1',
	'a.type2',
	'a.type3',
	'a.type4',
	'a.group_name' + '-' + 'a.branch' + '-' + '00' + '-' + '12' + '-' + 'a.type1' + '-' + 'a.type2' + '-' + 'a.type3' + '-' + 'a.type4' + '-00-00' AS barcode,
	'a.group_name_desc' AS group_name,
	'a.type_1_desc' AS type1_desc,
	'a.type_2_desc' AS type2_desc,
	'a.type_3_desc' AS type3_desc,
	'a.type_4_desc' AS type4_desc,
	w.contract,
	w.remark,
	w.worksheet_status,
	w.request_method,
	w.request_to,
	w.client_inform_amarit_date,
	w.client_inform_amarit_time,
	w.cs_inform_opr_date,
	w.cs_inform_opr_time,
	w.opr_inform_cs_date,
	w.opr_inform_cs_time,
	w.cs_inform_client_date,
	w.cs_inform_client_time ,
	'a.service' AS specific_location_from,
	'',
	0,
	0,
	0,
	0,
	'a.cancel_reason',
	'',
	0,
	0,
	'',
	'',
	'',
	'',
	'',
	w.user_id,
	'',
	a.ref3,
	a.ref4,
	a.ref5,
	a.ref6,
	w.ref1 AS wref1,
	w.ref2 AS wref2,
	w.ref3 AS wref3,
	w.ref4 AS wref4,
	w.ref5 AS wref5,
	w.ref6 AS wref6,
	'',
	'',
	'',
	'',
	u.erp_id,
	0,
	0 AS amount,
	0 AS lumsum_charge,
	'' AS promotion_code,
	0 AS lump_sum,
	a.contract_number ,
	a.status 
FROM
	worksheet_ticket_booking_job a
	LEFT JOIN customer u ON u.customer_id= a.customer
	LEFT JOIN worksheet w ON w.worksheet_id= a.worksheet_id
	LEFT JOIN subject s ON s.code= w.subject 
WHERE w.worksheet_date >= '$from_date' AND w.worksheet_date <= '$to_date' 
";

$result = sqlsrv_query($conn, $fQuery);
//$raw['data'] = array();

while($custom = sqlsrv_fetch_array( $result, SQLSRV_FETCH_ASSOC)){


	
	if (is_null($custom['mileage_end'])) {
		$tatalkm = 0;
	} else {
		$tatalkm = $custom['mileage_end']- $custom['mileage_start'];
	}
	if ($custom['start_time']=="") {
		$start_time = '';
	} else {
		$start_time = date_format($custom['start_time'],'H:i');
	}
	if ($custom['end_time']=="") {
		$end_time = '';
	} else {
		$end_time = date_format($custom['end_time'],'H:i');
	}
	if (is_null($custom['client_inform_amarit_date'])) {
		$client_inform_amarit_date = '';
	} else {
		$client_inform_amarit_date = date_format($custom['client_inform_amarit_date'],'d/m/Y');
	}
	if (is_null($custom['client_inform_amarit_time'])) {
		$client_inform_amarit_time = '';
	} else {
		$client_inform_amarit_time = date_format($custom['client_inform_amarit_time'],'H:i');
	}
	if (is_null($custom['cs_inform_opr_date'])) {
		$cs_inform_opr_date = '';
	} else {
		$cs_inform_opr_date = date_format($custom['cs_inform_opr_date'],'d/m/Y');
	}
	if (is_null($custom['cs_inform_opr_time'])) {
		$cs_inform_opr_time = '';
	} else {
		$cs_inform_opr_time = date_format($custom['cs_inform_opr_time'],'H:i');
	}
	if (is_null($custom['opr_inform_cs_date'])) {
		$opr_inform_cs_date = '';
	} else {
		$opr_inform_cs_date = date_format($custom['opr_inform_cs_date'],'d/m/Y');
	}
	if (is_null($custom['opr_inform_cs_time'])) {
		$opr_inform_cs_time = '';
	} else {
		$opr_inform_cs_time = date_format($custom['opr_inform_cs_time'],'H:i');
	}
	if (is_null($custom['cs_inform_client_date'])) {
		$cs_inform_client_date = '';
	} else {
		$cs_inform_client_date = date_format($custom['cs_inform_client_date'],'d/m/Y');
	}
	if (is_null($custom['cs_inform_client_time'])) {
		$cs_inform_client_time = '';
	} else {
		$cs_inform_client_time = date_format($custom['cs_inform_client_time'],'H:i');
	}
	if (is_null($custom['actual_start_date'])) {
		$actual_start_date = '';
	} else {
		$actual_start_date = date_format($custom['actual_start_date'],'d/m/Y');
	}
	if (is_null($custom['start_date'])) {
		$start_date = '';
	} else {

//		$start_date = date_format($custom['start_date'],'d/m/Y');
		$start_date = (new DateTime($custom['start_date']))->format('d/m/Y');
	}
	if (is_null($custom['end_date'])) {
		$end_date = '';
	} else {
		//$end_date = date_format($custom['end_date'],'d/m/Y');
		$end_date = (new DateTime($custom['end_date']))->format('d/m/Y');
	}
	if (is_null($custom['actual_start_time'])) {
		$actual_start_time = '';
	} else {
		$actual_start_time = date_format($custom['actual_start_time'],'H:i');
	}
	if (is_null($custom['actual_finish_date'])) {
		$actual_finish_date = '';
	} else {
		$actual_finish_date = date_format($custom['actual_finish_date'],'d/m/Y');
	}
	if (is_null($custom['actual_finish_time'])) {
		$actual_finish_time = '';
	} else {
		$actual_finish_time = date_format($custom['actual_finish_time'],'H:i');
	}
	if (is_null($custom['worksheet_date'])) {
		$worksheet_date = '';
	} else {
		$worksheet_date = date_format($custom['worksheet_date'],'d/m/Y');
	}
	$total_km = 0;

	$customer = $custom["customer"];
	$transport_from = $custom["transport_from"];
	$transport_to = $custom["transport_to"];
	$contract_no = $custom["contract_number"];
	$position = $custom["position"];
	$service = $custom["specific_location_from"];
	$vehicle_type = $custom["charge_as"];
	$UOM = $custom["uom"];
	$Service_type = $custom['service_type'];
$service_id = $custom['ticketbooking_id'];


    $data = [$custom['user_id'], $custom['branch'], $client_inform_amarit_date, $client_inform_amarit_time, $custom['worksheet_status'], $custom['status'], $custom['worksheet_id'], $worksheet_date, $Service_type, $service_id, $custom['customer'], $custom['erp_id'], $custom['customer_name'], $custom['subject'], $contract_no, $custom['contract_line'], 
		
	    $custom['customer_ref'], $custom['contract'], $custom['remark'], $custom['request_method'], $custom['request_to'],  $cs_inform_opr_date, $cs_inform_opr_time, $opr_inform_cs_date, $opr_inform_cs_time, $cs_inform_client_date, $cs_inform_client_time
		, $custom['registration_no'], $custom['vehicle_id_erp'], $outsource, $custom['description'] , $custom['name'], $custom['position'], $custom['transport_from'], $custom['transport_to'],$custom['specific_location_from'], $custom['specific_location_to'], $custom['contact1'], $custom['contact2'], $custom['charge_as'], $custom['outsource_charge_as'],  $custom['remark'], $custom['department'], $custom['cost_center'], $custom['u_from'], $custom['u_to'], $custom['mileage_start'], $custom['mileage_end'], $custom['fuel_km_per_litre'], $tatalkm, $total_km, $start_date, $start_time, $end_date, $end_time, $custom['quantity'], $custom['uom'],
	
	$amount, $totalamount, $custom['diesel_rate'], $nocharge, $consolidate, $vehicle_switch, $standby_charge, $custom['cancel_reason'], $custom['cargo_type'], $custom['cargo_qty'], $custom['cargo_weight'], $custom['dimension'],  
		
	$custom['group_name'], $custom['ttype'],$custom['type1'], $custom['type2'], $custom['type3'], $custom['type4'], $custom['barcode'],$custom['type1_desc'], $custom['type2_desc'], $custom['type3_desc'], $custom['type4_desc'], $custom['wref1'], $custom['wref2'], $custom['wref3'], $custom['wref4'], $custom['wref5'], $custom['wref6'], $custom['ref1'], $custom['ref2'], $custom['ref3'], $custom['ref4'], $custom['ref5'], $custom['ref6'], $outsource_reason];

    echo '<pre>';
    print_r($data);
    echo '</pre>';
    array_push($raw['data'],$data);
}

die;




























//echo count($raw);
//die;
echo json_encode($raw);
sqlsrv_close($conn);
?>