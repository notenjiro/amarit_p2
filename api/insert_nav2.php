<?php
//error_reporting(0);
require_once '../config_db.php';
require_once '../utils/helper.php';

$json = file_get_contents('php://input');
$data = json_decode($json);

foreach($data as $val){

$aQuery = " select 'Cargo Transport' as service_type, a.worksheet_id, b.worksheet_date, a.transport_id, v.registration_no, o.name,a.transport_from, a.transport_to, a.contact1, a.contact2, a.charge_as, a.outsource_charge_as, a.contract_no, a.contract_line, a.remark, a.ref1, a.ref2, a.department, a.cost_center, l.description as u_from, ll.description as u_to, a.mileage_start, a.mileage_end, a.[start_date],a.start_time,a.end_date,a.end_time,a.quantity,a.uom,a.customer,u.name as customer_name,a.line_status,w.contract,w.customer_ref,s.description as subject,
a.group_name,b.branch,case when v.outsource = 1 then '13' else '12' end as ttype,a.type1,a.type2,a.type3,a.type4
, a.group_name+'-'+a.branch+'-00-'+case when v.outsource = 1 then '13' else '12' end+'-'+a.type1+'-'+a.type2+'-'+a.type3+'-'+a.type4+'-'+c.universal_location+'-'+cc.universal_location as barcode,
n.description as group_name,t1.description as type1_desc,t2.description as type2_desc,t3.description as type3_desc,t4.description as type4_desc

,w.contract, w.remark, w.worksheet_status, w.request_method, w.request_to, w.client_inform_amarit_date, w.client_inform_amarit_time, w.cs_inform_opr_date, w.cs_inform_opr_time, w.opr_inform_cs_date, w.opr_inform_cs_time, w.cs_inform_client_date, w.cs_inform_client_time, w.rcvd_date

, a.specific_location_from, a.specific_location_to, a.diesel_rate, a.no_charge, a.consolidate, a.vehicle_switch, a.cancel_reason, a.cargo_type, a.cargo_qty, a.cargo_weight, a.dimension, a.actual_start_date, a.actual_start_time, a.actual_finish_date, a.actual_finish_time
, w.ref1 as worksheet_ref1, w.ref2 as worksheet_ref2, w.ref3 as worksheet_ref3, w.ref4 as worksheet_ref4, w.ref5 as worksheet_ref5, w.ref6 as worksheet_ref6, a.ref1 as service_ref1, a.ref2 as service_ref2, a.ref3 as service_ref3, a.ref4 as service_ref4, a.ref5 as service_ref5, a.ref6 as service_ref6, v.vehicle_id_erp, co.customer_ref, uom.description as uom_desc, w.opr_inform_cs_date 
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
WHERE a.transport_id = '$val' ";
$result = sqlsrv_query($conn, $aQuery);

while($row = sqlsrv_fetch_array( $result, SQLSRV_FETCH_ASSOC)){
	$service_type = $row['service_type'];
	$worksheet_date = date_format($row['worksheet_date'],'d/m/Y');
	$actual_start_date = date_format($row['actual_start_date'],'d/m/Y');
	$opr_inform_cs = date_format($row['opr_inform_cs_date'],'d/m/Y');
	$rcvd_date = date_format($row['rcvd_date'],'d/m/Y');
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

	$customer = $row["customer"];
	$transport_from = $row["transport_from"];
	$transport_to = $row["transport_to"];
	$contract_no = $row["contract_no"];
	$aQuery = "select a.transportation_rate, a.diesel_baht_to, c.diesel2, a.total_km from contract_transportation_rate a left join customer_contract c on c.contract_no = a.contract_no where a.customer = '$customer' and a.transportation_from = '$transport_from' and a.transportation_to = '$transport_to' and a.contract_no = '$contract_no' ";
		$resultamount = sqlsrv_query($conn, $aQuery);
		$amount = 0;
		while($rowamount = sqlsrv_fetch_array( $resultamount, SQLSRV_FETCH_ASSOC)){
			$amount = $rowamount['transportation_rate'];
			$total_km = $rowamount['total_km'];
			if ($row['diesel_rate'] > $rowamount['diesel_baht_to']) {
				$amount =  $rowamount['transportation_rate'] * (round($row['diesel_rate']-$rowamount['diesel_baht_to'], 0) * $rowamount['diesel2']+100) / 100;
			}
		}
	$uom = $row['uom_desc'];
	$department = $row['department'];
	$cost_center = $row['cost_center']; 
	$vehicle_erp_id = $row['vehicle_id_erp'];
	$contract_number = $row['contract_no'];
	$customer = $row['customer'];
	$customer_ref = $row['customer_ref'];

	$serverNamex = '192.168.10.4';
	$connectionInfox = array( 'Database'=>'Test_AAL_04FEB22', 'UID'=>'sa', 'PWD'=>'amarit1982', 'MultipleActiveResultSets'=>true,'CharacterSet'  => 'UTF-8');
	$connx = sqlsrv_connect( $serverNamex, $connectionInfox);
	$value = " VALUES ('$service_id', '$service_type', '$worksheet_date', '$worksheet_id', '$worksheet_ref1', '$worksheet_ref2', '$worksheet_ref3', '$worksheet_ref4', '$worksheet_ref5', '$worksheet_ref6', '$service_ref1', '$service_ref2', '$service_ref3', '$service_ref4', '$service_ref5', '$service_ref6', '$charge_as', '$specific_location_from', '$specific_location_to',  '$quantity', '$amount', '$uom', '$department', '$cost_center', '$vehicle_erp_id', '$contract_number', '$customer', '$customer_ref', '$actual_start_date', '$opr_inform_cs', '$rcvd_date') ";
	$fQuery = ' INSERT INTO [Test_AAL$worksheet] (service_id, service_type ,worksheet_date, worksheet_id, worksheet_ref1, worksheet_ref2, worksheet_ref3, worksheet_ref4, worksheet_ref5, worksheet_ref6, service_ref1, service_ref2, service_ref3, service_ref4, service_ref5, service_ref6, charge_as, specific_location_from, specific_location_to, quantity, amount, uom, department, cost_center, vehicle_erp_id, contract_number, customer, customer_ref, actual_start_date, opr_inform_cs, rcvd_date) '.$value;
	$result_skill = sqlsrv_query($connx, $fQuery);

	//if($result_skill == false){
	//	$Data["Status"] = "Error";
	//	$Data["msg"] = "มีข้อมูลซ้ำกับที่มีอยู่แล้ว";
	//}else{
	//	$Data["Status"] = "Success";
	//	$Data["msg"] = "Data has been updated";
	//}

}

$aQuery = " select 'Manpower' as service_type, a.worksheet_id,b.worksheet_date,a.labor_service_id,'',v.name,a.[location],'', '', '', a.charge_as, a.outsource_charge_as, a.contract_no, a.contract_line, a.remark, a.ref1, a.ref2, a.department, a.cost_center,l.description as u_from,'',0,0,
a.start_date,start_time,end_date,end_time,quantity,uom,a.customer,u.name as customer_name,a.line_status,w.contract,w.customer_ref,s.description as subject,
a.group_name,b.branch,case when v.outsource = 1 then '13' else '12' end as ttype,a.type1,a.type2,a.type3,a.type4
, a.group_name+'-'+a.branch+'-'+c.sub_location+'-'+case when v.outsource = 1 then '13' else '12' end+'-'+a.type1+'-'+a.type2+'-'+a.type3+'-'+a.type4+'-00-00' as barcode,
n.description as group_name,t1.description as type1_desc,t2.description as type2_desc,t3.description as type3_desc,t4.description as type4_desc

,w.contract, w.remark, w.worksheet_status, w.request_method, w.request_to, w.client_inform_amarit_date, w.client_inform_amarit_time, w.cs_inform_opr_date, w.cs_inform_opr_time, w.opr_inform_cs_date, w.opr_inform_cs_time, w.cs_inform_client_date, w.cs_inform_client_time

, '', '', 0, 0, 0, 0, a.cancel_reason, '', 0, 0, '', '', '', '', '', w.ref1 as worksheet_ref1, w.ref2 as worksheet_ref2, w.ref3 as worksheet_ref3, w.ref4 as worksheet_ref4, w.ref5 as worksheet_ref5, w.ref6 as worksheet_ref6, a.ref1 as service_ref1, a.ref2 as service_ref2, a.ref3 as service_ref3, a.ref4 as service_ref4, a.ref5 as service_ref5, a.ref6 as service_ref6, uom.description as uom_desc

from worksheet_manpower a left join worksheet b on b.worksheet_id = a.worksheet_id
left join contract_location c on c.location = a.location
left join location l on l.code = c.universal_location
left join manpower v on v.manpower_id = a.labor
left join customer u on u.customer_id = a.customer 
left join worksheet w on w.worksheet_id = a.worksheet_id
left join subject s on s.code = w.subject
left join group_name n on n.code = a.group_name
left join type_1 t1 on t1.code = a.type1
left join type_2 t2 on t2.code = a.type2
left join type_3 t3 on t3.code = a.type3
left join type_4 t4 on t4.code = a.type4
left join uom on uom.code = a.uom
WHERE a.labor_service_id = '$val' ";
$result = sqlsrv_query($conn, $aQuery);

while($row = sqlsrv_fetch_array( $result, SQLSRV_FETCH_ASSOC)){
	$service_type = $row['service_type'];
	$worksheet_date = date_format($row['worksheet_date'],'d/m/Y');
	$start_date = date_format($row['start_date'],'d/m/Y');
	//$start_date = date_format($row['start_date'],'d/m/Y');
	$rcvd_date = date_format($row['rcvd_date'],'d/m/Y');
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
	$transport_from = '';//$row["transport_from"];
	$transport_to = '';//$row["transport_to"];
	$contract_no = $row["contract_no"];
	$aQuery = "select a.transportation_rate, a.diesel_baht_to, c.diesel2, a.total_km from contract_transportation_rate a left join customer_contract c on c.contract_no = a.contract_no where a.customer = '$customer' and a.transportation_from = '$transport_from' and a.transportation_to = '$transport_to' and a.contract_no = '$contract_no' ";
		$resultamount = sqlsrv_query($conn, $aQuery);
		$amount = 0;
		while($rowamount = sqlsrv_fetch_array( $resultamount, SQLSRV_FETCH_ASSOC)){
			$amount = $rowamount['transportation_rate'];
			$total_km = $rowamount['total_km'];
			if ($row['diesel_rate'] > $rowamount['diesel_baht_to']) {
				$amount =  $rowamount['transportation_rate'] * (round($row['diesel_rate']-$rowamount['diesel_baht_to'], 0) * $rowamount['diesel2']+100) / 100;
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
	$connectionInfox = array( 'Database'=>'Test_AAL_04FEB22', 'UID'=>'sa', 'PWD'=>'amarit1982', 'MultipleActiveResultSets'=>true,'CharacterSet'  => 'UTF-8');
	$connx = sqlsrv_connect( $serverNamex, $connectionInfox);
	$value = " VALUES ('$service_id', '$service_type', '$worksheet_date', '$worksheet_id', '$worksheet_ref1', '$worksheet_ref2', '$worksheet_ref3', '$worksheet_ref4', '$worksheet_ref5', '$worksheet_ref6', '$service_ref1', '$service_ref2', '$service_ref3', '$service_ref4', '$service_ref5', '$service_ref6', '$charge_as', '$specific_location_from', '$specific_location_to',  '$quantity', '$amount', '$uom', '$department', '$cost_center', '$vehicle_erp_id', '$contract_number', '$customer', '$customer_ref', '$start_date', '$start_date', '$rcvd_date') ";
	$fQuery = ' INSERT INTO [Test_AAL$worksheet] (service_id, service_type ,worksheet_date, worksheet_id, worksheet_ref1, worksheet_ref2, worksheet_ref3, worksheet_ref4, worksheet_ref5, worksheet_ref6, service_ref1, service_ref2, service_ref3, service_ref4, service_ref5, service_ref6, charge_as, specific_location_from, specific_location_to, quantity, amount, uom, department, cost_center, vehicle_erp_id, contract_number, customer, customer_ref, actual_start_date, opr_inform_cs, rcvd_date) '.$value;
	$result_skill = sqlsrv_query($connx, $fQuery);

	//if($result_skill == false){
	//	$Data["Status"] = "Error";
	//	$Data["msg"] = "มีข้อมูลซ้ำกับที่มีอยู่แล้ว";
	//}else{
	//	$Data["Status"] = "Success";
	//	$Data["msg"] = "Data has been updated";
	//}

}
}

if($result == false){
		$Data["Status"] = "Error";
		$Data["msg"] = "มีข้อมูลซ้ำกับที่มีอยู่แล้ว";
	}else{
		$Data["Status"] = "Success";
		$Data["msg"] = $val;//"Data has been updated";
	}

echo json_encode($Data);

sqlsrv_close($conn);

?>