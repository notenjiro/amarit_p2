<?php
require_once '../config_db.php';
require_once '../utils/helper.php';

$from_date = $_GET["from_date"];
$to_date = $_GET["to_date"];

$fQuery = "select 'TRANSPORT' as service_type, a.worksheet_id, w.worksheet_date, a.transport_id, v.registration_no, o.name,a.transport_from, a.transport_to, a.contact1, a.contact2, a.charge_as, a.outsource_charge_as, a.contract_no, a.contract_line, a.remark, a.ref1, a.ref2, a.department, a.cost_center, l.description as u_from, ll.description as u_to, a.mileage_start, a.mileage_end, a.[start_date],a.start_time,a.end_date,a.end_time,a.quantity,a.uom,a.customer,u.name as customer_name,a.line_status,w.contract,w.customer_ref,s.description as subject,
a.group_name,w.branch,case when v.outsource = 1 then '13' else '12' end as ttype,a.type1,a.type2,a.type3,a.type4
, a.group_name+'-'+a.branch+'-00-'+case when v.outsource = 1 then '13' else '12' end+'-'+a.type1+'-'+a.type2+'-'+a.type3+'-'+a.type4+'-'+c.universal_location+'-'+cc.universal_location as barcode,
a.group_name_desc as group_name, a.type_1_desc as type1_desc, a.type_2_desc as type2_desc, a.type_3_desc as type3_desc,a.type_4_desc as type4_desc

,w.contract, w.remark, w.worksheet_status, w.request_method, w.request_to, w.client_inform_amarit_date, w.client_inform_amarit_time, w.cs_inform_opr_date, w.cs_inform_opr_time, w.opr_inform_cs_date, w.opr_inform_cs_time, w.cs_inform_client_date, w.cs_inform_client_time

, a.specific_location_from, a.specific_location_to, a.diesel_rate, a.no_charge, a.consolidate, a.vehicle_switch, a.cancel_reason, a.cargo_type, a.cargo_qty, a.cargo_weight, a.dimension, a.actual_start_date, a.actual_start_time, a.actual_finish_date, a.actual_finish_time, w.user_id, '' as position, a.transport_solution, 0 as amount

from worksheet_cargo_transport a 
left join contract_location c on c.location = a.transport_from
and c.customer = a.customer and c.contract_no = a.contract_no
left join location l on l.code = c.universal_location
left join contract_location cc on cc.location = a.transport_to
and cc.customer = a.customer and cc.contract_no = a.contract_no
left join location ll on ll.code = cc.universal_location
left join vehicle v on v.vehicle_id = a.vehicle 
left join operator o on o.operator_id = a.operator
left join customer u on u.customer_id = a.customer
left join worksheet w on w.worksheet_id = a.worksheet_id
left join subject s on s.code = w.subject
WHERE w.worksheet_date >= '$from_date' AND w.worksheet_date <= '$to_date'
and w.worksheet_status = 'RCVD by A/R' and a.line_status <> 'Cancelled'
and a.no_charge = 0
union 

select 'MANPOWER', a.worksheet_id,w.worksheet_date,a.labor_service_id,'',v.name,a.[location],'', '', '', a.charge_as, a.outsource_charge_as, a.contract_no, a.contract_line, a.remark, a.ref1, a.ref2, a.department, a.cost_center,l.description as u_from,'',0,0,
[start_date],start_time,end_date,end_time,quantity,uom,a.customer,u.name as customer_name,a.line_status,w.contract,w.customer_ref,s.description as subject,
a.group_name,w.branch,case when v.outsource = 1 then '13' else '12' end as ttype,a.type1,a.type2,a.type3,a.type4
, a.group_name+'-'+a.branch+'-'+c.sub_location+'-'+case when v.outsource = 1 then '13' else '12' end+'-'+a.type1+'-'+a.type2+'-'+a.type3+'-'+a.type4+'-00-00' as barcode,
a.group_name_desc as group_name, a.type_1_desc as type1_desc, a.type_2_desc as type2_desc, a.type_3_desc as type3_desc,a.type_4_desc as type4_desc

,w.contract, w.remark, w.worksheet_status, w.request_method, w.request_to, w.client_inform_amarit_date, w.client_inform_amarit_time, w.cs_inform_opr_date, w.cs_inform_opr_time, w.opr_inform_cs_date, w.opr_inform_cs_time, w.cs_inform_client_date, w.cs_inform_client_time

, '', '', 0, 0, 0, 0, a.cancel_reason, '', 0, 0, '', '', '', '', '', w.user_id, a.position, 0, 0 as amount
from worksheet_manpower a
left join contract_location c on c.location = a.location
and c.customer = a.customer and c.contract_no = a.contract_no
left join location l on l.code = c.universal_location
left join manpower v on v.manpower_id = a.labor
left join customer u on u.customer_id = a.customer 
left join worksheet w on w.worksheet_id = a.worksheet_id
left join subject s on s.code = w.subject
WHERE w.worksheet_date >= '$from_date' AND w.worksheet_date <= '$to_date'
and w.worksheet_status = 'RCVD by A/R' and a.line_status <> 'Cancelled'

 union 

 select 'CARGO HANDLE',a.worksheet_id,w.worksheet_date,a.cargo_service_id,v.registration_no,o.name,a.transport_from,'', '', '', a.charge_as, a.outsource_charge_as, a.contract_no, a.contract_line, a.remark, a.ref1, a.ref2, a.department, a.cost_center,l.description as u_from,'',0,0,
a.[start_date],a.start_time,a.end_date,a.end_time,a.quantity,a.uom,a.customer,u.name as customer_name,a.line_status,w.contract,w.customer_ref,s.description as subject,
a.group_name,w.branch,case when v.outsource = 1 then '13' else '12' end as ttype,a.type1,a.type2,a.type3,a.type4
, a.group_name+'-'+a.branch+'-'+c.sub_location+'-'+case when v.outsource = 1 then '13' else '12' end+'-'+a.type1+'-'+a.type2+'-'+a.type3+'-'+a.type4+'-00-00' as barcode,
a.group_name_desc as group_name, a.type_1_desc as type1_desc, a.type_2_desc as type2_desc, a.type_3_desc as type3_desc,a.type_4_desc as type4_desc

,w.contract, w.remark, w.worksheet_status, w.request_method, w.request_to, w.client_inform_amarit_date, w.client_inform_amarit_time, w.cs_inform_opr_date, w.cs_inform_opr_time, w.opr_inform_cs_date, w.opr_inform_cs_time, w.cs_inform_client_date, w.cs_inform_client_time

, '', '', a.diesel_rate, 0, 0, 0, a.cancel_reason, '', 0, 0, '', '', '', '', '', w.user_id, '', 0, 0 as amount

from worksheet_cargo_handling a
left join contract_location c on c.location = a.transport_from
and c.customer = a.customer and c.contract_no = a.contract_no
left join location l on l.code = c.universal_location
left join vehicle v on v.vehicle_id = a.vehicle
left join operator o on o.operator_id = a.operator
left join customer u on u.customer_id = a.customer 
left join worksheet w on w.worksheet_id = a.worksheet_id
left join subject s on s.code = w.subject
WHERE w.worksheet_date >= '$from_date' AND w.worksheet_date <= '$to_date'
and w.worksheet_status = 'RCVD by A/R' and a.line_status <> 'Cancelled'

union 

select 'SERVICE - OTHER',a.worksheet_id,w.worksheet_date,a.cargo_service_id,v.registration_no,o.name,a.description,a.description2, '', '', '', '', a.agreement_number, '', a.remark, a.ref1, a.ref2, a.department, a.cost_center,l.description as u_from,'',0,0,
a.[start_date],a.start_time,a.end_date,a.end_time,a.quantity,a.uom,a.customer,u.name as customer_name,a.line_status,w.contract,w.customer_ref,s.description as subject,
a.group_name,w.branch,case when v.outsource = 1 then '13' else '12' end as ttype,a.type1,a.type2,a.type3,a.type4
, a.group_name+'-'+a.branch+'-'+c.sub_location+'-'+case when v.outsource = 1 then '13' else '12' end+'-'+a.type1+'-'+a.type2+'-'+a.type3+'-'+a.type4+'-00-00' as barcode,
a.group_name_desc as group_name, a.type_1_desc as type1_desc, a.type_2_desc as type2_desc, a.type_3_desc as type3_desc,a.type_4_desc as type4_desc

,w.contract, w.remark, w.worksheet_status, w.request_method, w.request_to, w.client_inform_amarit_date, w.client_inform_amarit_time, w.cs_inform_opr_date, w.cs_inform_opr_time, w.opr_inform_cs_date, w.opr_inform_cs_time, w.cs_inform_client_date, w.cs_inform_client_time

, '', '', 0, 0, 0, 0, a.cancel_reason, '', 0, 0, '', '', '', '', '', w.user_id, '', 0, a.amount

from worksheet_service a
left join contract_location c on c.location = a.transport_from
left join location l on l.code = c.universal_location
left join vehicle v on v.vehicle_id = a.vehicle
left join operator o on o.operator_id = a.operator
left join customer u on u.customer_id = a.customer 
left join worksheet w on w.worksheet_id = a.worksheet_id
left join subject s on s.code = w.subject
WHERE w.worksheet_date >= '$from_date' AND w.worksheet_date <= '$to_date'
and w.worksheet_status = 'RCVD by A/R' and a.line_status <> 'Cancelled'

union 

select 'IMMIGRATION',a.worksheet_id,w.worksheet_date,a.immigration_id,'','','','', '', '', '', '', a.agreement_number, a.contract_line, a.remark, a.ref1, a.ref2, a.department, a.cost_center,'' as u_from,'',0,0,
a.[start_date],a.start_time,a.end_date,a.end_time,a.quantity,a.uom,a.customer,u.name as customer_name,a.line_status,w.contract,w.customer_ref,s.description as subject,
a.group_name,w.branch,'12' as ttype,a.type1,a.type2,a.type3,a.type4
, a.group_name+'-'+a.branch+'-'+'00'+'-'+'12'+'-'+a.type1+'-'+a.type2+'-'+a.type3+'-'+a.type4+'-00-00' as barcode,
a.group_name_desc as group_name, a.type_1_desc as type1_desc, a.type_2_desc as type2_desc, a.type_3_desc as type3_desc,a.type_4_desc as type4_desc

,w.contract, w.remark, w.worksheet_status, w.request_method, w.request_to, w.client_inform_amarit_date, w.client_inform_amarit_time, w.cs_inform_opr_date, w.cs_inform_opr_time, w.opr_inform_cs_date, w.opr_inform_cs_time, w.cs_inform_client_date, w.cs_inform_client_time

, a.service as specific_location_from, '', 0, 0, 0, 0, a.cancel_reason, '', 0, 0, '', '', '', '', '', w.user_id, '', 0, 0 as amount

from worksheet_immigration a 
left join customer u on u.customer_id = a.customer 
left join worksheet w on w.worksheet_id = a.worksheet_id
left join subject s on s.code = w.subject
WHERE w.worksheet_date >= '$from_date' AND w.worksheet_date <= '$to_date'
and w.worksheet_status = 'RCVD by A/R' and a.line_status <> 'Cancelled' 

union 

select 'PERSONNEL TRANSPORT' as service_type, a.worksheet_id, w.worksheet_date, a.taxi_service_id, v.registration_no, o.name,a.transport_from, a.transport_to, '', '', a.charge_as, a.outsource_charge_as, a.contract_no, a.contract_line, a.remark, a.ref1, a.ref2, a.department, a.cost_center, l.description as u_from, ll.description as u_to, 0, 0, a.[start_date],a.start_time,a.end_date,a.end_time,a.quantity,a.uom,a.customer,u.name as customer_name,a.line_status,w.contract,w.customer_ref,s.description as subject,
a.group_name,w.branch,case when v.outsource = 1 then '13' else '12' end as ttype,a.type1,a.type2,a.type3,a.type4
, a.group_name+'-'+a.branch+'-00-'+case when v.outsource = 1 then '13' else '12' end+'-'+a.type1+'-'+a.type2+'-'+a.type3+'-'+a.type4+'-'+c.universal_location+'-'+cc.universal_location as barcode,
a.group_name_desc as group_name, a.type_1_desc as type1_desc, a.type_2_desc as type2_desc, a.type_3_desc as type3_desc,a.type_4_desc as type4_desc

,w.contract, w.remark, w.worksheet_status, w.request_method, w.request_to, w.client_inform_amarit_date, w.client_inform_amarit_time, w.cs_inform_opr_date, w.cs_inform_opr_time, w.opr_inform_cs_date, w.opr_inform_cs_time, w.cs_inform_client_date, w.cs_inform_client_time

, a.specific_location_from, a.specific_location_to, 0, 0, 0, 0, a.cancel_reason, '', 0, 0, '', '', '', '', '', w.user_id, '' as position, 0, 0 as amount

from worksheet_taxi a 
left join contract_location c on c.location = a.transport_from
and c.customer = a.customer and c.contract_no = a.contract_no
left join location l on l.code = c.universal_location
left join contract_location cc on cc.location = a.transport_to
and cc.customer = a.customer and cc.contract_no = a.contract_no
left join location ll on ll.code = cc.universal_location
left join vehicle v on v.vehicle_id = a.vehicle 
left join operator o on o.operator_id = a.operator
left join customer u on u.customer_id = a.customer
left join worksheet w on w.worksheet_id = a.worksheet_id
left join subject s on s.code = w.subject
WHERE w.worksheet_date >= '$from_date' AND w.worksheet_date <= '$to_date'
and w.worksheet_status = 'RCVD by A/R' and a.line_status <> 'Cancelled'

order by worksheet_id";

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
		$aQuery = "select a.transportation_rate, a.diesel_baht_to, c.diesel1, a.total_km from contract_transportation_rate a left join customer_contract c on c.contract_no = a.contract_no where a.customer = '$customer' and a.transportation_from = '$transport_from' and a.transportation_to = '$transport_to' and a.contract_no = '$contract_no' and a.vehicle_type = '$vehicle_type' ";
		$resultamount = sqlsrv_query($conn, $aQuery);
		$amount = 0;
		while($rowamount = sqlsrv_fetch_array( $resultamount, SQLSRV_FETCH_ASSOC)){
			$amount = $rowamount['transportation_rate'];
			$total_km = $rowamount['total_km'];
			if ($row['diesel_rate'] > $rowamount['diesel_baht_to'] or $rowamount['diesel1'] == 30) {
				if ($row['diesel_rate'] < 31)
				  $amount = $rowamount['transportation_rate']*1.02;
				else if ($row['diesel_rate'] < 32)
					$amount = $rowamount['transportation_rate']*1.04;
				else if ($row['diesel_rate'] < 33)
					$amount = $rowamount['transportation_rate']*1.06;
				else if ($row['diesel_rate'] < 34)
					$amount = $rowamount['transportation_rate']*1.08;
				else if ($row['diesel_rate'] < 35)
					$amount = $rowamount['transportation_rate']*1.10;
			}
		}
		if ($amount == 0) {
			$aQuery2 = "select a.transportation_rate, a.diesel_baht_to, c.diesel1, a.total_km from contract_transportation_rate a left join customer_contract c on c.contract_no = a.contract_no where a.customer = '$customer' and a.transportation_to = '$transport_from' and a.transportation_from = '$transport_to' and a.contract_no = '$contract_no' and a.vehicle_type = '$vehicle_type' ";
			$resultamount2 = sqlsrv_query($conn, $aQuery2);
			$amount = 0;
			while($rowamount2 = sqlsrv_fetch_array( $resultamount2, SQLSRV_FETCH_ASSOC)){
				$amount = $rowamount2['transportation_rate'];
				$total_km = $rowamount2['total_km'];
				if ($row['diesel_rate'] > $rowamount2['diesel_baht_to'] or $rowamount2['diesel1'] == 30) {
					if ($row['diesel_rate'] < 31)
					$amount = $rowamount2['transportation_rate']*1.02;
					else if ($row['diesel_rate'] < 32)
						$amount = $rowamount2['transportation_rate']*1.04;
					else if ($row['diesel_rate'] < 33)
						$amount = $rowamount2['transportation_rate']*1.06;
					else if ($row['diesel_rate'] < 34)
						$amount = $rowamount2['transportation_rate']*1.08;
					else if ($row['diesel_rate'] < 35)
						$amount = $rowamount2['transportation_rate']*1.10;
				}
			}
		}
		$diesel_rate = $row['diesel_rate'];
		$aQuery = "select a.transportation_rate, a.diesel_baht_to, c.diesel1, a.total_km from contract_transportation_rate a left join customer_contract c on c.contract_no = a.contract_no where a.customer = '$customer' and a.transportation_from = '$transport_from' and a.transportation_to = '$transport_to' and a.contract_no = '$contract_no' and a.vehicle_type = '$vehicle_type' and diesel_baht_from <= '$diesel_rate' and diesel_baht_to >= '$diesel_rate' ";
		$resultamount = sqlsrv_query($conn, $aQuery);
		while($rowamount = sqlsrv_fetch_array( $resultamount, SQLSRV_FETCH_ASSOC)){
			$amount = $rowamount['transportation_rate'];
			$total_km = $rowamount['total_km'];
		}
		$aQuery = "select a.transportation_rate, a.diesel_baht_to, c.diesel1, a.total_km from contract_transportation_rate a left join customer_contract c on c.contract_no = a.contract_no where a.customer = '$customer' and a.transportation_to = '$transport_from' and a.transportation_from = '$transport_to' and a.contract_no = '$contract_no' and a.vehicle_type = '$vehicle_type' and diesel_baht_from <= '$diesel_rate' and diesel_baht_to >= '$diesel_rate' ";
		$resultamount = sqlsrv_query($conn, $aQuery);
		while($rowamount = sqlsrv_fetch_array( $resultamount, SQLSRV_FETCH_ASSOC)){
			$amount = $rowamount['transportation_rate'];
			$total_km = $rowamount['total_km'];
		}
		if ($row['transport_solution'] == 1){
			$aQuery = "select hourly_rate, daily_rate, minimum_charge_hour from contract_service_rate where contract_no = '$contract_no' and vehicle_type = '$vehicle_type' ";
			$resultamount = sqlsrv_query($conn, $aQuery);
			while($rowamount = sqlsrv_fetch_array( $resultamount, SQLSRV_FETCH_ASSOC)){
				if ($UOM == 'Hour') {
					if ($row['quantity'] < $rowamount['minimum_charge_hour'])
					$amount = $rowamount['hourly_rate']*$rowamount['minimum_charge_hour'];
					else
						$amount = $rowamount['hourly_rate'];
				} else {
					$amount = $rowamount['daily_rate'];
				}
			}
			$total_km = 0;
			$Service_type = 'TRANSPORT SOLUTION';
		}
	} else if ($row['service_type'] == 'MANPOWER') {		
		$aQuery = "select normal, after_normal, s_normal, s_after_normal, minimum_charge,sunday  from contract_hourly_rate where customer = '$customer' and position = '$position' and contract_no = '$contract_no' ";
		$resultamount = sqlsrv_query($conn, $aQuery);
		$amount = 0;
		while($rowamount = sqlsrv_fetch_array( $resultamount, SQLSRV_FETCH_ASSOC)){
			if ($nameOfday == 'Sun' and $rowamount['sunday'] == 0){
				if ($row['uom'] == 'Day'){
					if ($start_time == '08:00' or $start_time == '09:00' or $start_time == '13:00' or ($start_time >= '07:30' and $start_time <= '13:00'))
						$amount = $rowamount['s_normal']*$rowamount['minimum_charge'];
					else if ($start_time == '17:00' or $start_time == '06:00' or $start_time == '20:00' or $start_time == '01:00' or $start_time == '19:00')
						$amount = $rowamount['s_after_normal']*$rowamount['minimum_charge'];
				}else if ($row['uom'] == 'Hour'){
					if ($start_time == '08:00' or $start_time == '09:00' or $start_time == '13:00' or ($start_time >= '07:30' and $start_time <= '13:00') or $start_time == '15:00' or $start_time == '16:00')
						$amount = $rowamount['s_normal'];
					else if ($start_time == '17:00' or $start_time == '06:00' or $start_time == '20:00' or $start_time == '01:00' or $start_time == '19:00')
						$amount = $rowamount['s_after_normal'];
				}
			} else {
				if ($row['uom'] == 'Day')
					$amount = $rowamount['normal']*$rowamount['minimum_charge'];
				else if ($row['uom'] == 'Hour'){
					if ($start_time == '08:00' or $start_time == '09:00' or $start_time == '13:00' or ($start_time >= '07:30' and $start_time <= '13:00') or $start_time == '15:00' or $start_time == '16:00')
						$amount = $rowamount['normal'];
					else if ($start_time == '17:00' or $start_time == '06:00' or $start_time == '20:00' or $start_time == '01:00' or $start_time == '19:00')
						$amount = $rowamount['after_normal'];
				}
			}
		}
	} else if ($row['service_type'] == 'IMMIGRATION') {		
		$aQuery = "select unit_price from contract_immigration where customer = '$customer' and description = '$service' and contract_no = '$contract_no' ";
		$resultamount = sqlsrv_query($conn, $aQuery);
		$amount = 0;
		while($rowamount = sqlsrv_fetch_array( $resultamount, SQLSRV_FETCH_ASSOC)){
			$amount = $rowamount['unit_price'];
		}
	} else if ($row['service_type'] == 'PERSONNEL TRANSPORT') {
		$aQuery = "select a.transport_rate, c.diesel2, a.total_km from contract_taxi_service a left join customer_contract c on c.contract_no = a.contract_no where a.customer = '$customer' and a.transport_from = '$transport_from' and a.transport_to = '$transport_to' and a.contract_no = '$contract_no' ";
		$resultamount = sqlsrv_query($conn, $aQuery);
		$amount = 0;
		while($rowamount = sqlsrv_fetch_array( $resultamount, SQLSRV_FETCH_ASSOC)){
			$amount = $rowamount['transport_rate'];
		}
		if ($amount == 0) {
			$aQuery2 = "select a.transport_rate, c.diesel2, a.total_km from contract_taxi_service a left join customer_contract c on c.contract_no = a.contract_no where a.customer = '$customer' and a.transport_to = '$transport_from' and a.transport_from = '$transport_to' and a.contract_no = '$contract_no' ";
			$resultamount2 = sqlsrv_query($conn, $aQuery2);
			while($rowamount2 = sqlsrv_fetch_array( $resultamount2, SQLSRV_FETCH_ASSOC)){
				$amount = $rowamount2['transport_rate'];
			}
		}
	} else if ($row['service_type'] == 'CARGO HANDLE') {		
		$aQuery = "select a.contract_no, contract_line, diesel_baht_from, diesel_baht_to, rate, minimum_charge_hour, c.diesel1, a.day_rate from contract_equipment_rental a left join customer_contract c on c.contract_no = a.contract_no WHERE a.customer = '$customer'  and equipment = '$vehicle_type' and branch = '$transport_from' and uom = '$UOM' and a.contract_no = '$contract_no' ";
		$resultamount = sqlsrv_query($conn, $aQuery);
		$amount = 0;
		while($rowamount = sqlsrv_fetch_array( $resultamount, SQLSRV_FETCH_ASSOC)){
			if ($UOM == 'Hour') {
				if ($row['quantity'] < $rowamount['minimum_charge_hour'])
					$amount = $rowamount['rate']*$rowamount['minimum_charge_hour'];
				else
					$amount = $rowamount['rate'];
				if ($row['diesel_rate'] > $rowamount['diesel_baht_to'] or $rowamount['diesel1'] == 30) {
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
					}
			} else {
				$amount = $rowamount['day_rate'];
			}
		}
	} else if ($row['service_type'] == 'SERVICE - OTHER') {
		$amount = $row['amount'];
	}
    $data = ["", $row['worksheet_id'], $worksheet_date, $Service_type, $row['transport_id'], $row['customer'], $row['customer_name'], $row['subject'], $row['contract_no'], $row['contract_line'], 
		
	$row['customer_ref'], $row['contract'], $row['remark'], $row['request_method'], $row['request_to'],  $cs_inform_opr_date, $cs_inform_opr_time, $opr_inform_cs_date, $opr_inform_cs_time, $cs_inform_client_date, $cs_inform_client_time, 
		
	$row['registration_no'] , $row['name'], $row['position'], $row['transport_from'], $row['transport_to'],$row['specific_location_from'], $row['specific_location_to'], $row['contact1'], $row['contact2'], $row['charge_as'],
	 $row['outsource_charge_as'],  $row['remark'], $row['ref1'], $row['ref2'], $row['department'], $row['cost_center'], $row['u_from'], $row['u_to'], $row['mileage_start'], $row['mileage_end'],
	  $tatalkm, $total_km, date_format($row['start_date'],'d/m/Y'), $start_time, date_format($row['end_date'],'d/m/Y'), $end_time, $row['quantity'],$row['uom'],
	
	$amount, $row['diesel_rate'], $row['no_charge'], $row['consolidate'], $row['vehicle_switch'], $row['cancel_reason'], $row['cargo_type']
		, $row['cargo_qty'], $row['cargo_weight'], $row['dimension'], $actual_start_date, $actual_start_time, $actual_finish_date, $actual_finish_time, 
		
	$row['group_name'], $row['ttype'],$row['type1'], $row['type2'], $row['type3'], $row['type4'], $row['barcode'], $row['line_status'],$row['type1_desc'], $row['type2_desc'], $row['type3_desc'], $row['type4_desc'],$row['user_id'], $row['branch'],$client_inform_amarit_date, $client_inform_amarit_time, $row['worksheet_status']];
    array_push($raw['data'],$data);
}

echo json_encode($raw);
sqlsrv_close($conn);
?>