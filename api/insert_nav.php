<?php
//error_reporting(0);
//require_once '../config_db.php';
require_once '../utils/helper.php';

//$service_id = $_GET['service_id'];
$json = file_get_contents('php://input');
$data = json_decode($json);

foreach($data as $val){
	$service_id = $val;

$worksheet_status = 'RCVD by A/R';

$aQuery = " select 'TRANSPORT' as service_type, a.worksheet_id, b.worksheet_date, a.transport_id, v.registration_no, o.name,a.transport_from, a.transport_to, a.contact1, a.contact2, a.charge_as, a.outsource_charge_as, a.contract_no, a.contract_line, a.remark, a.ref1, a.ref2, a.department, a.cost_center, l.description as u_from, ll.description as u_to, a.mileage_start, a.mileage_end, a.[start_date],a.start_time,a.end_date,a.end_time,a.quantity,a.uom,u.erp_id as erp_customer, a.customer, u.name as customer_name,a.line_status,w.contract,w.customer_ref,s.description as subject,
a.group_name,b.branch,case when v.outsource = 1 then '13' else '12' end as ttype,a.type1,a.type2,a.type3,a.type4
, a.group_name+'-'+a.branch+'-00-'+case when v.outsource = 1 then '13' else '12' end+'-'+a.type1+'-'+a.type2+'-'+a.type3+'-'+a.type4+'-'+c.universal_location+'-'+cc.universal_location as barcode,
n.description as group_name,t1.description as type1_desc,t2.description as type2_desc,t3.description as type3_desc,t4.description as type4_desc

,w.contract, w.remark, w.worksheet_status, w.request_method, w.request_to, w.client_inform_amarit_date, w.client_inform_amarit_time, w.cs_inform_opr_date, w.cs_inform_opr_time, w.opr_inform_cs_date, w.opr_inform_cs_time, w.cs_inform_client_date, w.cs_inform_client_time, w.rcvd_date as rcvd_date

, a.specific_location_from, a.specific_location_to, a.diesel_rate, a.no_charge, a.consolidate, a.vehicle_switch, a.cancel_reason, a.cargo_type, a.cargo_qty, a.cargo_weight, a.dimension, a.actual_start_date, a.actual_start_time, a.actual_finish_date, a.actual_finish_time
, w.ref1 as worksheet_ref1, w.ref2 as worksheet_ref2, w.ref3 as worksheet_ref3, w.ref4 as worksheet_ref4, w.ref5 as worksheet_ref5, w.ref6 as worksheet_ref6, a.ref1 as service_ref1, a.ref2 as service_ref2, a.ref3 as service_ref3, a.ref4 as service_ref4, a.ref5 as service_ref5, a.ref6 as service_ref6, v.vehicle_id_erp, co.customer_ref, uom.description as uom_desc, w.opr_inform_cs_date, co.diesel1, a.transport_solution 
from worksheet_cargo_transport a left join worksheet b on b.worksheet_id = a.worksheet_id
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
left join group_name n on n.code = a.group_name
left join type_1 t1 on t1.code = a.type1
left join type_2 t2 on t2.code = a.type2
left join type_3 t3 on t3.code = a.type3
left join type_4 t4 on t4.code = a.type4
left join customer_contract co on co.contract_no = a.contract_no
left join uom on uom.code = a.uom
WHERE a.transport_id = '$service_id'
and a.no_charge = 0 
and w.worksheet_status = '$worksheet_status' ";
$result = sqlsrv_query($conn, $aQuery);

//$Data["msg"] = $fQuery;

while($row = sqlsrv_fetch_array( $result, SQLSRV_FETCH_ASSOC)){
	$service_type = $row['service_type'];
	$worksheet_date = date_format($row['end_date'],'m/d/Y');
	$actual_start_date = date_format($row['actual_finish_date'],'m/d/Y');
	$opr_inform_cs = date_format($row['actual_finish_date'],'m/d/Y');
	$rcvd_date = date_format($row['rcvd_date'],'m/d/Y');
	$start_time = date_format($row['start_time'],'H:i');
	$end_time = date_format($row['end_time'],'H:i');
	$worksheet_id = $row['worksheet_id'];
	$worksheet_ref1 = $row['worksheet_ref1'];
	$worksheet_ref2 = $row['worksheet_ref2'];
	$worksheet_ref3 = $row['worksheet_ref3'];
	$worksheet_ref4 = $row['worksheet_ref4'];
	$worksheet_ref5 = $row['worksheet_ref5'];
	$worksheet_ref6 = $row['worksheet_ref6'];
	$service_ref1 = $row['service_ref1'];
	$service_ref2 = $row['service_ref2'];
	$service_ref3 = $row['service_ref3'];
	$service_ref4 = $row['service_ref4'];
	$service_ref5 = $row['service_ref5'];
	$service_ref6 = $row['service_ref6'];
	$charge_as = $row['charge_as'];
	$specific_location_from = $row['specific_location_from'];
	$specific_location_to = $row['specific_location_to'];
	$quantity = $row['quantity'];
	$erp_customer = $row["erp_customer"];
	$UOM = $row["uom"];

	$customer = $row["customer"];
	$transport_from = $row["transport_from"];
	$transport_to = $row["transport_to"];
	$contract_no = $row["contract_no"];
	$vehicle_type = $row["charge_as"];
	$aQuery = "select a.transportation_rate, a.diesel_baht_to, c.diesel1, a.total_km from contract_transportation_rate a left join customer_contract c on c.contract_no = a.contract_no where a.customer = '$customer' and a.transportation_from = '$transport_from' and a.transportation_to = '$transport_to' and a.contract_no = '$contract_no' and a.vehicle_type = '$vehicle_type' ";
		$resultamount = sqlsrv_query($conn, $aQuery);
		$amount = 0;
		while($rowamount = sqlsrv_fetch_array( $resultamount, SQLSRV_FETCH_ASSOC)){
			//$amount = $rowamount['transportation_rate'];
			//$total_km = $rowamount['total_km'];
			//if ($row['diesel_rate'] > $rowamount['diesel_baht_to'] or $rowamount['diesel1'] == 30) {
			//	if ($row['diesel_rate'] < 31)
			//	  $amount = $rowamount['transportation_rate']*1.02;
			//	else if ($row['diesel_rate'] < 32)
			//		$amount = $rowamount['transportation_rate']*1.04;
			//	else if ($row['diesel_rate'] < 33)
			//		$amount = $rowamount['transportation_rate']*1.06;
			//	else if ($row['diesel_rate'] < 34)
			//		$amount = $rowamount['transportation_rate']*1.08;
			//	else if ($row['diesel_rate'] < 35)
			//		$amount = $rowamount['transportation_rate']*1.10;
			//}
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
			//$aQuery2 = "select a.transportation_rate, a.diesel_baht_to, c.diesel1, a.total_km from contract_transportation_rate a left join customer_contract c on c.contract_no = a.contract_no where a.customer = '$customer' and a.transportation_to = '$transport_from' and a.transportation_from = '$transport_to' and a.contract_no = '$contract_no' and a.vehicle_type = '$vehicle_type' ";
			//$resultamount2 = sqlsrv_query($conn, $aQuery2);
			//$amount = 0;
			//while($rowamount2 = sqlsrv_fetch_array( $resultamount2, SQLSRV_FETCH_ASSOC)){
			//	$amount = $rowamount2['transportation_rate'];
			//	$total_km = $rowamount2['total_km'];
			//	if ($row['diesel_rate'] > $rowamount2['diesel_baht_to'] or $rowamount2['diesel1'] == 30) {
			//		if ($row['diesel_rate'] < 31)
			//		$amount = $rowamount2['transportation_rate']*1.02;
			//		else if ($row['diesel_rate'] < 32)
			//			$amount = $rowamount2['transportation_rate']*1.04;
			//		else if ($row['diesel_rate'] < 33)
			//			$amount = $rowamount2['transportation_rate']*1.06;
			//		else if ($row['diesel_rate'] < 34)
			//			$amount = $rowamount2['transportation_rate']*1.08;
			//		else if ($row['diesel_rate'] < 35)
			//			$amount = $rowamount2['transportation_rate']*1.10;
			//	}
			//}
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
		$aQuery = "select a.transportation_rate, a.diesel_baht_to, c.diesel1, a.total_km from contract_transportation_rate a left join customer_contract c on c.contract_no = a.contract_no where a.customer = '$customer' and a.transportation_from = '$transport_from' and a.transportation_to = '$transport_to' and a.contract_no = '$contract_no' and a.vehicle_type = '$vehicle_type' and diesel_baht_from <= '$diesel_rate' and diesel_baht_to >= '$diesel_rate' ";
		$resultamount = sqlsrv_query($conn, $aQuery);
		while($rowamount = sqlsrv_fetch_array( $resultamount, SQLSRV_FETCH_ASSOC)){
			//$amount = $rowamount['transportation_rate'];
			//$total_km = $rowamount['total_km'];
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
		$aQuery = "select a.transportation_rate, a.diesel_baht_to, c.diesel1, a.total_km from contract_transportation_rate a left join customer_contract c on c.contract_no = a.contract_no where a.customer = '$customer' and a.transportation_to = '$transport_from' and a.transportation_from = '$transport_to' and a.contract_no = '$contract_no' and a.vehicle_type = '$vehicle_type' and diesel_baht_from <= '$diesel_rate' and diesel_baht_to >= '$diesel_rate' ";
		$resultamount = sqlsrv_query($conn, $aQuery);
		while($rowamount = sqlsrv_fetch_array( $resultamount, SQLSRV_FETCH_ASSOC)){
			//$amount = $rowamount['transportation_rate'];
			//$total_km = $rowamount['total_km'];
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
					if ($row['quantity'] < $rowamount['minimum_charge_hour'])
					$amount = $rowamount['hourly_rate']*$rowamount['minimum_charge_hour'];
					else
						$amount = $rowamount['hourly_rate'];
				} else {
					$amount = $rowamount['daily_rate'];
				}
			}
			$total_km = 0;
			$service_type = 'TRANSPORT SOLUTION';
		}
	
	$uom = $row['uom_desc'];
	$department = $row['department'];
	$cost_center = $row['cost_center']; 
	$vehicle_erp_id = $row['vehicle_id_erp'];
	$contract_number = $row['contract_no'];
	$customer = $row['customer'];
	$customer_ref = $row['customer_ref'];
	$manpower_name = '-';
	$position = '-';
	if ($row['transport_solution'] == 1)
		$transport_solution = 1;
	else
		$transport_solution = 0;

	$serverNamex = '192.168.10.4';
	$connectionInfox = array( 'Database'=>'AAL Live (01,Aug,2015)', 'UID'=>'sa', 'PWD'=>'amarit@2019', 'MultipleActiveResultSets'=>true,'CharacterSet'  => 'UTF-8');
	$connx = sqlsrv_connect( $serverNamex, $connectionInfox);
	$value = " VALUES ('$service_id', '$service_type', '$worksheet_date', '$worksheet_id', '$worksheet_ref1', '$worksheet_ref2', '$worksheet_ref3', '$worksheet_ref4', '$worksheet_ref5', '$worksheet_ref6', '$service_ref1', '$service_ref2', '$service_ref3', '$service_ref4', '$service_ref5', '$service_ref6', '$charge_as', '$specific_location_from', '$specific_location_to',  $quantity, $amount, '$uom', '$department', '$cost_center', '$vehicle_erp_id', '$contract_number', '$erp_customer', '$customer_ref', '$actual_start_date', '$opr_inform_cs', '$rcvd_date', '$manpower_name', '$position', '$start_time', '$end_time', 0, $transport_solution) ";
	$fQuery = ' INSERT INTO [AAL LIVE (NEW)$worksheet] (service_id, service_type ,worksheet_date, worksheet_id, worksheet_ref1, worksheet_ref2, worksheet_ref3, worksheet_ref4, worksheet_ref5, worksheet_ref6, service_ref1, service_ref2, service_ref3, service_ref4, service_ref5, service_ref6, charge_as, specific_location_from, specific_location_to, quantity, amount, uom, department, cost_center, vehicle_erp_id, contract_number, customer, customer_ref, actual_start_date, opr_inform_cs, rcvd_date, manpower_name, position, start_time, end_time, invoice, transport_solution) '.$value;
	$result_skill = sqlsrv_query($connx, $fQuery);

	$iquery = "UPDATE worksheet SET worksheet_status = 'Send to NAV' WHERE worksheet_id = '$worksheet_id' ";
	$stmt = sqlsrv_query($conn, $iquery);

	
}

$aQuery = " select 'CARGO HANDLE' as service_type, a.worksheet_id, b.worksheet_date, v.registration_no, o.name,a.transport_from, a.transport_to, a.charge_as, a.outsource_charge_as, a.contract_no, a.contract_line, a.remark, a.ref1, a.ref2, a.department, a.cost_center, l.description as u_from, a.[start_date],a.start_time,a.end_date,a.end_time,a.quantity,a.uom,u.erp_id as erp_customer, a.customer,u.name as customer_name,a.line_status,w.contract,w.customer_ref,s.description as subject,
a.group_name,b.branch

,w.contract, w.remark, w.worksheet_status, w.request_method, w.request_to, w.client_inform_amarit_date, w.client_inform_amarit_time, w.cs_inform_opr_date, w.cs_inform_opr_time, w.opr_inform_cs_date, w.opr_inform_cs_time, w.cs_inform_client_date, w.cs_inform_client_time, w.rcvd_date as rcvd_date

, a.diesel_rate, a.cancel_reason, a.cargo_type, a.cargo_qty
, w.ref1 as worksheet_ref1, w.ref2 as worksheet_ref2, w.ref3 as worksheet_ref3, w.ref4 as worksheet_ref4, w.ref5 as worksheet_ref5, w.ref6 as worksheet_ref6, a.ref1 as service_ref1, a.ref2 as service_ref2, a.ref3 as service_ref3, a.ref4 as service_ref4, a.ref5 as service_ref5, a.ref6 as service_ref6, v.vehicle_id_erp, co.customer_ref, uom.description as uom_desc, w.opr_inform_cs_date

from worksheet_cargo_handling a
left join contract_location c on c.location = a.transport_from
and c.customer = a.customer and c.contract_no = a.contract_no
left join location l on l.code = c.universal_location
left join vehicle v on v.vehicle_id = a.vehicle
left join operator o on o.operator_id = a.operator
left join customer u on u.customer_id = a.customer 
left join worksheet w on w.worksheet_id = a.worksheet_id
left join subject s on s.code = w.subject
left join worksheet b on b.worksheet_id = a.worksheet_id
left join customer_contract co on co.contract_no = a.contract_no
left join uom on uom.code = a.uom
WHERE a.cargo_service_id = '$service_id'
and a.no_charge = 0
and w.worksheet_status = '$worksheet_status' ";
$result = sqlsrv_query($conn, $aQuery);

//$Data["msg"] = $fQuery;

while($row = sqlsrv_fetch_array( $result, SQLSRV_FETCH_ASSOC)){
	$service_type = $row['service_type'];
	$worksheet_date = date_format($row['end_date'],'m/d/Y');
	$actual_start_date = date_format($row['start_date'],'m/d/Y');
	$opr_inform_cs = date_format($row['start_date'],'m/d/Y');
	$rcvd_date = date_format($row['rcvd_date'],'m/d/Y');
	$start_time = date_format($row['start_time'],'H:i');
	$end_time = date_format($row['end_time'],'H:i');
	$worksheet_id = $row['worksheet_id'];
	$worksheet_ref1 = $row['worksheet_ref1'];
	$worksheet_ref2 = $row['worksheet_ref2'];
	$worksheet_ref3 = $row['worksheet_ref3'];
	$worksheet_ref4 = $row['worksheet_ref4'];
	$worksheet_ref5 = $row['worksheet_ref5'];
	$worksheet_ref6 = $row['worksheet_ref6'];
	$service_ref1 = $row['service_ref1'];
	$service_ref2 = $row['service_ref2'];
	$service_ref3 = $row['service_ref3'];
	$service_ref4 = $row['service_ref4'];
	$service_ref5 = $row['service_ref5'];
	$service_ref6 = $row['service_ref6'];
	$charge_as = $row['charge_as'];
	$specific_location_from = '-';//$row['specific_location_from'];
	$specific_location_to = '-';//$row['specific_location_to'];
	$quantity = $row['quantity'];
	$erp_customer = $row["erp_customer"];

	$customer = $row["customer"];
	$transport_from = $row["transport_from"];
	$transport_to = '-';//$row["transport_to"];
	$contract_no = $row["contract_no"];
	$vehicle_type = $row["charge_as"];
	$UOM = $row["uom"];

	$amount = 0;
	//$aQuery = "select contract_no, contract_line, diesel_baht_from, diesel_baht_to, rate from contract_equipment_rental WHERE customer = '$customer'  and equipment = '$charge_as' and branch = '$transport_from' ";
	//$resultamount = sqlsrv_query($conn, $aQuery);
	//while($rowamount = sqlsrv_fetch_array( $resultamount, SQLSRV_FETCH_ASSOC)){
	//	$amount = $rowamount['rate'];
	//}

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
	
	$uom = $row['uom_desc'];
	$department = $row['department'];
	$cost_center = $row['cost_center']; 
	$vehicle_erp_id = $row['vehicle_id_erp'];
	$contract_number = $row['contract_no'];
	$customer = $row['customer'];
	$customer_ref = $row['customer_ref'];
	$manpower_name = '-';
	$position = '-';

	$serverNamex = '192.168.10.4';
	$connectionInfox = array( 'Database'=>'AAL Live (01,Aug,2015)', 'UID'=>'sa', 'PWD'=>'amarit@2019', 'MultipleActiveResultSets'=>true,'CharacterSet'  => 'UTF-8');
	$connx = sqlsrv_connect( $serverNamex, $connectionInfox);
	$value = " VALUES ('$service_id', '$service_type', '$worksheet_date', '$worksheet_id', '$worksheet_ref1', '$worksheet_ref2', '$worksheet_ref3', '$worksheet_ref4', '$worksheet_ref5', '$worksheet_ref6', '$service_ref1', '$service_ref2', '$service_ref3', '$service_ref4', '$service_ref5', '$service_ref6', '$charge_as', '$specific_location_from', '$specific_location_to',  $quantity, $amount, '$uom', '$department', '$cost_center', '$vehicle_erp_id', '$contract_number', '$erp_customer', '$customer_ref', '$actual_start_date', '$opr_inform_cs', '$rcvd_date', '$manpower_name', '$position', '$start_time', '$end_time', 0, 0) ";
	$fQuery = ' INSERT INTO [AAL LIVE (NEW)$worksheet] (service_id, service_type ,worksheet_date, worksheet_id, worksheet_ref1, worksheet_ref2, worksheet_ref3, worksheet_ref4, worksheet_ref5, worksheet_ref6, service_ref1, service_ref2, service_ref3, service_ref4, service_ref5, service_ref6, charge_as, specific_location_from, specific_location_to, quantity, amount, uom, department, cost_center, vehicle_erp_id, contract_number, customer, customer_ref, actual_start_date, opr_inform_cs, rcvd_date, manpower_name, position, start_time, end_time, invoice, transport_solution) '.$value;
	$result_skill = sqlsrv_query($connx, $fQuery);

	$iquery = "UPDATE worksheet SET worksheet_status = 'Send to NAV' WHERE worksheet_id = '$worksheet_id' ";
	$stmt = sqlsrv_query($conn, $iquery);
	
}

$aQuery = " select 'MANPOWER' as service_type, a.worksheet_id,b.worksheet_date,a.labor_service_id,v.name,a.[location], a.charge_as, a.outsource_charge_as, a.contract_no, a.contract_line, a.remark, a.ref1, a.ref2, a.department, a.cost_center,l.description as u_from,
a.start_date,start_time,end_date,end_time,quantity,uom,u.erp_id as erp_customer,a.customer,u.name as customer_name,a.line_status,w.contract,w.customer_ref,s.description as subject,
a.group_name,b.branch
,w.contract, w.remark, w.worksheet_status, w.request_method, w.request_to, w.client_inform_amarit_date, w.client_inform_amarit_time, w.cs_inform_opr_date, w.cs_inform_opr_time, w.opr_inform_cs_date, w.opr_inform_cs_time, w.cs_inform_client_date, w.cs_inform_client_time

, w.ref1 as worksheet_ref1, w.ref2 as worksheet_ref2, w.ref3 as worksheet_ref3, w.ref4 as worksheet_ref4, w.ref5 as worksheet_ref5, w.ref6 as worksheet_ref6, a.ref1 as service_ref1, a.ref2 as service_ref2, a.ref3 as service_ref3, a.ref4 as service_ref4, a.ref5 as service_ref5, a.ref6 as service_ref6, uom.description as uom_desc, w.rcvd_date as rcvd_date, a.position

from worksheet_manpower a left join worksheet b on b.worksheet_id = a.worksheet_id
left join contract_location c on c.location = a.location
and c.customer = a.customer and c.contract_no = a.contract_no
left join location l on l.code = c.universal_location
left join manpower v on v.manpower_id = a.labor
left join customer u on u.customer_id = a.customer 
left join worksheet w on w.worksheet_id = a.worksheet_id
left join subject s on s.code = w.subject
left join uom on uom.code = a.uom
WHERE a.labor_service_id = '$service_id'
and a.no_charge = 0 
and w.worksheet_status = '$worksheet_status' ";
$result = sqlsrv_query($conn, $aQuery);

while($row = sqlsrv_fetch_array( $result, SQLSRV_FETCH_ASSOC)){
	$service_type = $row['service_type'];
	$worksheet_date = date_format($row['end_date'],'m/d/Y');
	$start_date = date_format($row['start_date'],'m/d/Y');
	$actual_start_date = date_format($row['end_date'],'m/d/Y');
	//date_format($row['start_date'],'m/d/Y');
	$rcvd_date = date_format($row['rcvd_date'],'m/d/Y');
	$start_time = date_format($row['start_time'],'H:i');
	$end_time = date_format($row['end_time'],'H:i');
	$worksheet_id = $row['worksheet_id'];
	$worksheet_ref1 = $row['worksheet_ref1'];
	$worksheet_ref2 = $row['worksheet_ref2'];
	$worksheet_ref3 = $row['worksheet_ref3'];
	$worksheet_ref4 = $row['worksheet_ref4'];
	$worksheet_ref5 = $row['worksheet_ref5'];
	$worksheet_ref6 = $row['worksheet_ref6'];
	$service_ref1 = $row['service_ref1'];
	$service_ref2 = $row['service_ref2'];
	$service_ref3 = $row['service_ref3'];
	$service_ref4 = $row['service_ref4'];
	$service_ref5 = $row['service_ref5'];
	$service_ref6 = $row['service_ref6'];
	$charge_as = $row['charge_as'];
	$specific_location_from = '';//$row['specific_location_from'];
	$specific_location_to = '';//$row['specific_location_to'];
	$quantity = $row['quantity'];

	$customer = $row["customer"];
	$erp_customer = $row["erp_customer"];
	$transport_from = $row["position"];//$row["transport_from"];
	$transport_to = '';//$row["transport_to"];
	$contract_no = $row["contract_no"];
	$position = $row["position"];

	if (is_null($row['start_date'])) 
		$nameOfday = '';
	else 
		$nameOfday = date('D', strtotime(date_format($row['start_date'],'m/d/Y')));

	$aQuery = "select normal, after_normal, s_normal, s_after_normal, minimum_charge,sunday from contract_hourly_rate where customer = '$customer' and position = '$position' and contract_no = '$contract_no' ";
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
	
	$uom = $row['uom_desc'];
	$department = $row['department'];
	$cost_center = $row['cost_center']; 
	$vehicle_erp_id = '';//$row['vehicle_id_erp'];
	$contract_number = $row['contract_no'];
	$customer = $row['customer'];
	$customer_ref = $row['customer_ref'];

	$serverNamex = '192.168.10.4';
	$connectionInfox = array( 'Database'=>'AAL Live (01,Aug,2015)', 'UID'=>'sa', 'PWD'=>'amarit@2019', 'MultipleActiveResultSets'=>true,'CharacterSet'  => 'UTF-8');
	$connx = sqlsrv_connect( $serverNamex, $connectionInfox);
	$value = " VALUES ('$service_id', '$service_type', '$worksheet_date', '$worksheet_id', '$worksheet_ref1', '$worksheet_ref2', '$worksheet_ref3', '$worksheet_ref4', '$worksheet_ref5', '$worksheet_ref6', '$service_ref1', '$service_ref2', '$service_ref3', '$service_ref4', '$service_ref5', '$service_ref6', '$charge_as', '$specific_location_from', '$specific_location_to',  $quantity, $amount, '$uom', '$department', '$cost_center', '$vehicle_erp_id', '$contract_number', '$erp_customer', '$customer_ref', '$actual_start_date', '$opr_inform_cs', '$rcvd_date', '$manpower_name', '$position', '$start_time', '$end_time', 0, 0) ";
	$fQuery = ' INSERT INTO [AAL LIVE (NEW)$worksheet] (service_id, service_type ,worksheet_date, worksheet_id, worksheet_ref1, worksheet_ref2, worksheet_ref3, worksheet_ref4, worksheet_ref5, worksheet_ref6, service_ref1, service_ref2, service_ref3, service_ref4, service_ref5, service_ref6, charge_as, specific_location_from, specific_location_to, quantity, amount, uom, department, cost_center, vehicle_erp_id, contract_number, customer, customer_ref, actual_start_date, opr_inform_cs, rcvd_date, manpower_name, position, start_time, end_time, invoice, transport_solution) '.$value;
	$result_skill = sqlsrv_query($connx, $fQuery);

	$iquery = "UPDATE worksheet SET worksheet_status = 'Send to NAV' WHERE worksheet_id = '$worksheet_id' ";
	$stmt = sqlsrv_query($conn, $iquery);

}

$aQuery = " select 'IMMIGRATION' as service_type,a.worksheet_id, w.worksheet_date,a.immigration_id,a.agreement_number, a.contract_line
, w.ref1 as worksheet_ref1, w.ref2 as worksheet_ref2, w.ref3 as worksheet_ref3, w.ref4 as worksheet_ref4, w.ref5 as worksheet_ref5, w.ref6 as worksheet_ref6, a.ref1 as service_ref1, a.ref2 as service_ref2, a.ref3 as service_ref3, a.ref4 as service_ref4, a.ref5 as service_ref5, a.ref6 as service_ref6, uom.description as uom_desc
, a.department, a.cost_center,a.quantity,u.erp_id as customer, a.line_status,w.contract,w.customer_ref
, a.service as specific_location_from, w.rcvd_date as rcvd_date, a.end_date

from worksheet_immigration a 
left join customer u on u.customer_id = a.customer 
left join worksheet w on w.worksheet_id = a.worksheet_id
left join subject s on s.code = w.subject
left join customer_contract co on co.contract_no = a.agreement_number
left join uom on uom.code = a.uom
WHERE a.immigration_id = '$service_id' 
and w.worksheet_status = '$worksheet_status' ";
$result = sqlsrv_query($conn, $aQuery);

//$Data["msg"] = $fQuery;

while($row = sqlsrv_fetch_array( $result, SQLSRV_FETCH_ASSOC)){
	$service_type = $row['service_type'];
	$worksheet_date = date_format($row['end_date'],'m/d/Y');
	//$actual_start_date = date_format($row['worksheet_date'],'m/d/Y');
	//$opr_inform_cs = date_format($row['worksheet_date'],'m/d/Y');
	$actual_start_date = date_format($row['end_date'],'m/d/Y');
	$opr_inform_cs = date_format($row['end_date'],'m/d/Y');
	$rcvd_date = date_format($row['rcvd_date'],'m/d/Y');
	$start_time = date_format($row['start_time'],'H:i');
	$end_time = date_format($row['end_time'],'H:i');
	$worksheet_id = $row['worksheet_id'];
	$worksheet_ref1 = $row['worksheet_ref1'];
	$worksheet_ref2 = $row['worksheet_ref2'];
	$worksheet_ref3 = $row['worksheet_ref3'];
	$worksheet_ref4 = $row['worksheet_ref4'];
	$worksheet_ref5 = $row['worksheet_ref5'];
	$worksheet_ref6 = $row['worksheet_ref6'];
	$service_ref1 = $row['service_ref1'];
	$service_ref2 = $row['service_ref2'];
	$service_ref3 = $row['service_ref3'];
	$service_ref4 = $row['service_ref4'];
	$service_ref5 = $row['service_ref5'];
	$service_ref6 = $row['service_ref6'];
	$charge_as = '';//$row['charge_as'];
	$specific_location_from = $row['specific_location_from'];
	$specific_location_to = '-';//$row['specific_location_to'];
	$quantity = $row['quantity'];

	$customer = $row["customer"];
	$transport_from = '-';//$row["transport_from"];
	$transport_to = '-';//$row["transport_to"];
	$contract_no = $row["agreement_number"];
	$aQuery = "select unit_price from contract_immigration where customer = '$customer' and description = '$specific_location_from' and contract_no = '$contract_no' ";
		$resultamount = sqlsrv_query($conn, $aQuery);
		$amount = 0;
		while($rowamount = sqlsrv_fetch_array( $resultamount, SQLSRV_FETCH_ASSOC)){
			$amount = $rowamount['unit_price'];
		}

	$uom = $row['uom_desc'];
	$department = $row['department'];
	$cost_center = $row['cost_center']; 
	$vehicle_erp_id = '';//$row['vehicle_id_erp'];
	$contract_number = $row['agreement_number'];
	$customer = $row['customer'];
	$customer_ref = $row['customer_ref'];
	$manpower_name = '-';
	$position = '-';

	$serverNamex = '192.168.10.4';
	$connectionInfox = array( 'Database'=>'AAL Live (01,Aug,2015)', 'UID'=>'sa', 'PWD'=>'amarit@2019', 'MultipleActiveResultSets'=>true,'CharacterSet'  => 'UTF-8');
	$connx = sqlsrv_connect( $serverNamex, $connectionInfox);
	$value = " VALUES ('$service_id', '$service_type', '$worksheet_date', '$worksheet_id', '$worksheet_ref1', '$worksheet_ref2', '$worksheet_ref3', '$worksheet_ref4', '$worksheet_ref5', '$worksheet_ref6', '$service_ref1', '$service_ref2', '$service_ref3', '$service_ref4', '$service_ref5', '$service_ref6', '$charge_as', '$specific_location_from', '$specific_location_to',  $quantity, $amount, '$uom', '$department', '$cost_center', '$vehicle_erp_id', '$contract_number', '$customer', '$customer_ref', '$actual_start_date', '$opr_inform_cs', '$rcvd_date', '$manpower_name', '$position', '$start_time', '$end_time', 0, 0) ";
	$fQuery = ' INSERT INTO [AAL LIVE (NEW)$worksheet] (service_id, service_type ,worksheet_date, worksheet_id, worksheet_ref1, worksheet_ref2, worksheet_ref3, worksheet_ref4, worksheet_ref5, worksheet_ref6, service_ref1, service_ref2, service_ref3, service_ref4, service_ref5, service_ref6, charge_as, specific_location_from, specific_location_to, quantity, amount, uom, department, cost_center, vehicle_erp_id, contract_number, customer, customer_ref, actual_start_date, opr_inform_cs, rcvd_date, manpower_name, position, start_time, end_time, invoice, transport_solution) '.$value;
	$result_skill = sqlsrv_query($connx, $fQuery);

	$iquery = "UPDATE worksheet SET worksheet_status = 'Send to NAV' WHERE worksheet_id = '$worksheet_id' ";
	$stmt = sqlsrv_query($conn, $iquery);
	
}

$aQuery = " select 'PERSONNEL TRANSPORT' as service_type, a.worksheet_id, w.worksheet_date, a.taxi_service_id, v.registration_no, o.name,a.transport_from, a.transport_to, a.charge_as, a.outsource_charge_as, a.contract_no, a.contract_line, a.department, a.cost_center,a.start_date,a.start_time,a.end_date,a.end_time,a.quantity,a.uom,u.erp_id as customer_erp, a.customer , a.specific_location_from, a.specific_location_to, a.cancel_reason, uom.description as uom_desc, w.ref1 as worksheet_ref1, w.ref2 as worksheet_ref2, w.ref3 as worksheet_ref3, w.ref4 as worksheet_ref4, w.ref5 as worksheet_ref5, w.ref6 as worksheet_ref6, a.ref1 as service_ref1, a.ref2 as service_ref2, a.ref3 as service_ref3, a.ref4 as service_ref4, a.ref5 as service_ref5, a.ref6 as service_ref6, rcvd_date, vehicle_id_erp

from worksheet_taxi a 
left join vehicle v on v.vehicle_id = a.vehicle 
left join operator o on o.operator_id = a.operator
left join customer u on u.customer_id = a.customer
left join worksheet w on w.worksheet_id = a.worksheet_id
left join uom on uom.code = a.uom
WHERE a.taxi_service_id = '$service_id' 
and w.worksheet_status = '$worksheet_status' ";
$result = sqlsrv_query($conn, $aQuery);

while($row = sqlsrv_fetch_array( $result, SQLSRV_FETCH_ASSOC)){
	$service_type = $row['service_type'];
	$worksheet_date = date_format($row['end_date'],'m/d/Y');
	$actual_start_date = date_format($row['end_date'],'m/d/Y');
	$opr_inform_cs = date_format($row['end_date'],'m/d/Y');
	$rcvd_date = date_format($row['rcvd_date'],'m/d/Y');
	$start_time = date_format($row['start_time'],'H:i');
	$end_time = date_format($row['end_time'],'H:i');
	$worksheet_id = $row['worksheet_id'];
	$worksheet_ref1 = $row['worksheet_ref1'];
	$worksheet_ref2 = $row['worksheet_ref2'];
	$worksheet_ref3 = $row['worksheet_ref3'];
	$worksheet_ref4 = $row['worksheet_ref4'];
	$worksheet_ref5 = $row['worksheet_ref5'];
	$worksheet_ref6 = $row['worksheet_ref6'];
	$service_ref1 = $row['service_ref1'];
	$service_ref2 = $row['service_ref2'];
	$service_ref3 = $row['service_ref3'];
	$service_ref4 = $row['service_ref4'];
	$service_ref5 = $row['service_ref5'];
	$service_ref6 = $row['service_ref6'];
	$charge_as = $row['charge_as'];
	$specific_location_from = $row['specific_location_from'];
	$specific_location_to = $row['specific_location_to'];
	$quantity = $row['quantity'];
	$customer_erp = $row["customer_erp"];

	$customer = $row["customer"];
	$transport_from = $row["transport_from"];
	$transport_to = $row["transport_to"];
	$contract_no = $row["contract_no"];
	//$amount = 0;

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
	
	$uom = $row['uom_desc'];
	$department = $row['department'];
	$cost_center = $row['cost_center']; 
	$vehicle_erp_id = $row['vehicle_id_erp'];
	$contract_number = $row['contract_no'];
	$customer = $row['customer'];
	$customer_ref = $row['customer_ref'];
	$manpower_name = '-';
	$position = '-';

	// $serverNamex = '192.168.10.4'; //Test_AAL_04FEB22 //AAL Live (01,Aug,2015)
	// $connectionInfox = array( 'Database'=>'AAL Live (01,Aug,2015)', 'UID'=>'sa', 'PWD'=>'amarit@2019', 'MultipleActiveResultSets'=>true,'CharacterSet'  => 'UTF-8');
	// $connx = sqlsrv_connect( $serverNamex, $connectionInfox);
	// $value = " VALUES ('$service_id', '$service_type', '$worksheet_date', '$worksheet_id', '$worksheet_ref1', '$worksheet_ref2', '$worksheet_ref3', '$worksheet_ref4', '$worksheet_ref5', '$worksheet_ref6', '$service_ref1', '$service_ref2', '$service_ref3', '$service_ref4', '$service_ref5', '$service_ref6', '$charge_as', '$specific_location_from', '$specific_location_to',  $quantity, $amount, '$uom', '$department', '$cost_center', '$vehicle_erp_id', '$contract_number', '$customer_erp', '$customer_ref', '$actual_start_date', '$opr_inform_cs', '$rcvd_date', '$manpower_name', '$position', '$start_time', '$end_time', 0, 0) ";
	// $fQuery = ' INSERT INTO [AAL LIVE (NEW)$worksheet] (service_id, service_type ,worksheet_date, worksheet_id, worksheet_ref1, worksheet_ref2, worksheet_ref3, worksheet_ref4, worksheet_ref5, worksheet_ref6, service_ref1, service_ref2, service_ref3, service_ref4, service_ref5, service_ref6, charge_as, specific_location_from, specific_location_to, quantity, amount, uom, department, cost_center, vehicle_erp_id, contract_number, customer, customer_ref, actual_start_date, opr_inform_cs, rcvd_date, manpower_name, position, start_time, end_time, invoice, transport_solution) '.$value;
	// $result_skill = sqlsrv_query($connx, $fQuery);

	$iquery = "UPDATE worksheet SET worksheet_status = 'Send to NAV' WHERE worksheet_id = '$worksheet_id' ";
	$stmt = sqlsrv_query($conn, $iquery);
	
}

$aQuery = " select 'SERVICE - OTHER' as service_type, a.worksheet_id, w.worksheet_date, a.cargo_service_id, v.registration_no, o.name,a.transport_from,
 a.transport_to, a.department, a.cost_center,a.start_date,a.start_time,a.end_date,a.end_time,a.quantity,a.uom,u.erp_id as customer_erp, a.customer ,
  a.cancel_reason, uom.description as uom_desc, w.ref1 as worksheet_ref1, w.ref2 as worksheet_ref2, w.ref3 as worksheet_ref3, w.ref4 as worksheet_ref4,
   w.ref5 as worksheet_ref5, w.ref6 as worksheet_ref6, a.ref1 as service_ref1, a.ref2 as service_ref2, a.ref3 as service_ref3, a.ref4 as service_ref4,
    a.ref5 as service_ref5, a.ref6 as service_ref6, rcvd_date, vehicle_id_erp
, a.amount
from worksheet_service a
left join contract_location c on c.location = a.transport_from
left join location l on l.code = c.universal_location
left join vehicle v on v.vehicle_id = a.vehicle
left join vehicle_owner vo on vo.code = v.vehicle_owner
left join operator o on o.operator_id = a.operator
left join customer u on u.customer_id = a.customer 
left join worksheet w on w.worksheet_id = a.worksheet_id
left join subject s on s.code = w.subject
left join uom on uom.code = a.uom
WHERE a.cargo_service_id = '$service_id' 
and w.worksheet_status = '$worksheet_status'
and a.no_charge = 0 ";
$result = sqlsrv_query($conn, $aQuery);

while($row = sqlsrv_fetch_array( $result, SQLSRV_FETCH_ASSOC)){
	$service_type = $row['service_type'];
	$worksheet_date = date_format($row['end_date'],'m/d/Y');
	$actual_start_date = date_format($row['end_date'],'m/d/Y');
	$opr_inform_cs = date_format($row['end_date'],'m/d/Y');
	$rcvd_date = date_format($row['rcvd_date'],'m/d/Y');
	$start_time = date_format($row['start_time'],'H:i');
	$end_time = date_format($row['end_time'],'H:i');
	$worksheet_id = $row['worksheet_id'];
	$worksheet_ref1 = $row['worksheet_ref1'];
	$worksheet_ref2 = $row['worksheet_ref2'];
	$worksheet_ref3 = $row['worksheet_ref3'];
	$worksheet_ref4 = $row['worksheet_ref4'];
	$worksheet_ref5 = $row['worksheet_ref5'];
	$worksheet_ref6 = $row['worksheet_ref6'];
	$service_ref1 = $row['service_ref1'];
	$service_ref2 = $row['service_ref2'];
	$service_ref3 = $row['service_ref3'];
	$service_ref4 = $row['service_ref4'];
	$service_ref5 = $row['service_ref5'];
	$service_ref6 = $row['service_ref6'];
	$charge_as = '';//$row['charge_as'];
	$specific_location_from = '';//$row['specific_location_from'];
	$specific_location_to = '';//$row['specific_location_to'];
	$quantity = $row['quantity'];
	$customer_erp = $row["customer_erp"];

	$customer = $row["customer"];
	$transport_from = $row["transport_from"];
	$transport_to = $row["transport_to"];
	$contract_no = $row["contract_no"];
	$amount = $row["amount"];

	$uom = $row['uom_desc'];
	$department = $row['department'];
	$cost_center = $row['cost_center']; 
	$vehicle_erp_id = $row['vehicle_id_erp'];
	$contract_number = $row['contract_no'];
	$customer = $row['customer'];
	$customer_ref = $row['customer_ref'];
	$manpower_name = '-';
	$position = '-';

	 $serverNamex = '192.168.10.4'; //Test_AAL_04FEB22 //AAL Live (01,Aug,2015)
	 $connectionInfox = array( 'Database'=>'AAL Live (01,Aug,2015)', 'UID'=>'sa', 'PWD'=>'amarit@2019', 'MultipleActiveResultSets'=>true,'CharacterSet'  => 'UTF-8');
	 $connx = sqlsrv_connect( $serverNamex, $connectionInfox);
	 $value = " VALUES ('$service_id', '$service_type', '$worksheet_date', '$worksheet_id', '$worksheet_ref1', '$worksheet_ref2', '$worksheet_ref3', '$worksheet_ref4', '$worksheet_ref5', '$worksheet_ref6', '$service_ref1', '$service_ref2', '$service_ref3', '$service_ref4', '$service_ref5', '$service_ref6', '$charge_as', '$specific_location_from', '$specific_location_to',  $quantity, $amount, '$uom', '$department', '$cost_center', '$vehicle_erp_id', '$contract_number', '$customer_erp', '$customer_ref', '$actual_start_date', '$opr_inform_cs', '$rcvd_date', '$manpower_name', '$position', '$start_time', '$end_time', 0, 0) ";
	 $fQuery = ' INSERT INTO [AAL LIVE (NEW)$worksheet] (service_id, service_type ,worksheet_date, worksheet_id, worksheet_ref1, worksheet_ref2, worksheet_ref3, worksheet_ref4, worksheet_ref5, worksheet_ref6, service_ref1, service_ref2, service_ref3, service_ref4, service_ref5, service_ref6, charge_as, specific_location_from, specific_location_to, quantity, amount, uom, department, cost_center, vehicle_erp_id, contract_number, customer, customer_ref, actual_start_date, opr_inform_cs, rcvd_date, manpower_name, position, start_time, end_time, invoice, transport_solution) '.$value;
	 $result_skill = sqlsrv_query($connx, $fQuery);

	$iquery = "UPDATE worksheet SET worksheet_status = 'Send to NAV' WHERE worksheet_id = '$worksheet_id' ";
	$stmt = sqlsrv_query($conn, $iquery);
	
}


}


//if($result == false){
//		$Data["Status"] = "Error";
//		$Data["msg"] = "มีข้อมูลซ้ำกับที่มีอยู่แล้ว";
//	}else{
		$Data["Status"] = "Success";
		//$Data["msg"] = "Data already send to NAV";
//	}

echo json_encode($Data);

sqlsrv_close($conn);

?>