<?php
require_once '../config_db.php';
require_once '../utils/helper.php';

$from_date = $_GET["from_date"];
$to_date = $_GET["to_date"];
$employee = $_GET["operator"];

if ($employee == '')
$fQuery = "select YEAR(a.actual_start_date) as yrecdate, MONTH(a.actual_start_date) as mrecdate, DAY(a.actual_start_date) as drecdate,a.actual_start_date, a.end_date, b.start_time, b.actual_finish_time, b.name+' '+b.lastname as full_name, c.description as position_name, d.vehicle_id_erp, a.charge_as, d.vehicle_type, 
e.name as customer_name,'TRANSPORT' as service_type, a.no_charge, a.transport_id, a.operator,
a.transport_from, a.transport_to,a.specific_location_from, a.specific_location_to, b.position as position_code
, b.branch as operator_branch, f.branch as worksheet_branch, a.remark as worksheet_remark,DAY(a.end_date)-DAY(a.actual_start_date)+1 as qty, a.mileage_end-a.mileage_start as total_miledge, a.customer, a.worksheet_id, 0 as ontime  
from worksheet_cargo_transport a
left join operator b
on b.operator_id = a.operator
left join position c
on c.code = b.position
left join vehicle d
on d.vehicle_id = a.vehicle
left join customer e
on e.customer_id = a.customer
left join worksheet f
on f.worksheet_id = a.worksheet_id
where a.[actual_start_date] >= '$from_date' AND a.[actual_start_date] <= '$to_date'

union 

select YEAR(a.actual_start_date) as yrecdate, MONTH(a.actual_start_date) as mrecdate, DAY(a.actual_start_date) as drecdate,a.actual_start_date, a.end_date, start_time, end_time as actual_finish_time, b.name+' '+b.lastname as full_name, c.description as position_name, '' as vehicle_id_erp, a.charge_as, d.vehicle_type, 
e.name as customer_name,'MANPOWER' as service_type, a.no_charge, a.labor_service_id as transport_id, a.labor as operator, a.location as transport_from, '' as transport_to,'' as specific_location_from, '' as specific_location_to, b.position as position_code
, '' as operator_branch, '' as worksheet_branch, a.remark as worksheet_remark,DAY(a.end_date)-DAY(a.actual_start_date)+1 as qty, 0 as total_miledge, a.customer, a.worksheet_id, 0 as ontime     
from worksheet_manpower a
left join operator b
on b.operator_id = a.labor
left join position c
on c.code = b.position
left join customer e
on e.customer_id = a.customer
where a.[actual_start_date] >= '$from_date' AND a.[actual_start_date] <= '$to_date' 
order by full_name, yrecdate asc, mrecdate asc, drecdate asc  ";
else
$fQuery = "select YEAR(a.actual_start_date) as yrecdate, MONTH(a.actual_start_date) as mrecdate, DAY(a.actual_start_date) as drecdate, a.actual_start_date, a.end_date, b.start_time, b.actual_finish_time, b.name+' '+b.lastname as full_name, c.description as position_name, d.vehicle_id_erp, a.charge_as, d.vehicle_type, 
e.name as customer_name,'TRANSPORT' as service_type, a.no_charge, a.transport_id, a.operator,
a.transport_from, a.transport_to,a.specific_location_from, a.specific_location_to, b.position as position_code 
, g.description as operator_branch, f.branch as worksheet_branch, a.remark as worksheet_remark,a.quantity as qty, a.mileage_end-a.mileage_start as total_miledge, a.customer, a.worksheet_id         
, a.round_trip, a.standby_charge, a.uom, 0 as ontime
from worksheet_cargo_transport a
left join operator b
on b.operator_id = a.operator
left join position c
on c.code = b.position
left join vehicle d
on d.vehicle_id = a.vehicle
left join vehicle_type vt
on vt.code = d.vehicle_type
left join customer e
on e.customer_id = a.customer
left join worksheet f
on f.worksheet_id = a.worksheet_id
left join location g
on g.code = b.branch
where a.[actual_start_date] >= '$from_date' AND a.[actual_start_date] <= '$to_date' and a.operator = '$employee'
and a.line_status <> 'Cancelled'
and a.mileage_end is not null
and vt.block_allowance <> 1
union

select YEAR(a.start_date) as yrecdate, MONTH(a.start_date) as mrecdate, DAY(a.start_date) as drecdate, a.start_date as actual_start_date, a.end_date, start_time, end_time as actual_finish_time, b.name+' '+b.lastname as full_name, c.description as position_name, '' as vehicle_id_erp, a.charge_as, '' as vehicle_type, 
e.name as customer_name,'MANPOWER' as service_type, a.no_charge, a.labor_service_id as transport_id, a.labor as operator, a.location as transport_from, '' as transport_to,'' as specific_location_from, '' as specific_location_to, b.position as position_code 
, '' as operator_branch, '' as worksheet_branch, a.remark as worksheet_remark,DAY(a.end_date)-DAY(a.start_date)+1 as qty, 1 as total_miledge, a.customer, a.worksheet_id       
, '' as round_trip, '' as standby_charge, a.uom, 0 as ontime
from worksheet_manpower a
left join operator b
on b.operator_id = a.labor
left join position c
on c.code = b.position
left join customer e
on e.customer_id = a.customer
where a.[start_date] >= '$from_date' AND a.[start_date] <= '$to_date' and a.labor = '$employee'
and a.line_status <> 'Cancelled'

union
select YEAR(a.start_date) as yrecdate, MONTH(a.start_date) as mrecdate, DAY(a.start_date) as drecdate, a.start_date as actual_start_date, a.end_date, start_time, end_time as actual_finish_time, b.name+' '+b.lastname as full_name, c.description as position_name, d.vehicle_id_erp, a.charge_as, d.vehicle_type, 
e.name as customer_name,'Cargo handling' as service_type, a.no_charge,a.cargo_service_id as transport_id, a.operator,
a.transport_from, '' as transport_to,'' as specific_location_from, '' as specific_location_to, b.position as position_code 
, g.description as operator_branch, f.branch as worksheet_branch, a.remark as worksheet_remark,DAY(a.end_date)-DAY(a.start_date)+1 as qty,0 as total_miledge, a.customer, a.worksheet_id         
,0 as round_trip,0 as standby_charge, a.uom, a.ontime
from worksheet_cargo_handling a
left join operator b
on b.operator_id = a.operator
left join position c
on c.code = b.position
left join vehicle d
on d.vehicle_id = a.vehicle
left join vehicle_type vt
on vt.code = d.vehicle_type
left join customer e
on e.customer_id = a.customer
left join worksheet f
on f.worksheet_id = a.worksheet_id
left join location g
on g.code = b.branch
where a.[start_date] >= '$from_date' AND a.[start_date] <= '$to_date' and a.operator = '$employee'
and a.line_status <> 'Cancelled'
and f.worksheet_status <> 'Cancelled'
and vt.block_allowance <> 1

order by yrecdate asc, mrecdate asc, drecdate asc ";
//if($user_role != 'supervisor'){
//    $fQuery .= " WHERE user_id = '$user_name'";
// where a.[start_date] >= '$from_date' AND a.[start_date] <= '$to_date'
//}
//$result = sqlsrv_query($conn, $fQuery);
//rig
$result = sqlsrv_query($conn_erp, $fQuery);
$raw['data'] = array();
$temp_start_date = '';
$temp_remark = '';
$sp = 0;
$temp_totalhrs =0;
$tempnocharge = 0;

while($row = sqlsrv_fetch_array( $result, SQLSRV_FETCH_ASSOC)){
	if (is_null($row['start_time'])) {
		$start_time = '';
	} else {
		$start_time = date_format($row['start_time'],'H:i');
	}
	$operator = $row['operator'];
	$position_code = $row['position_code'];
	$vehicle_type = $row['charge_as'];
	$v_type = $row['vehicle_type'];
	$operator_branch = $row['operator_branch'];
	$worksheet_branch = $row['worksheet_branch'];
	$total_miledge = $row['total_miledge'];
	$location_from = $row['transport_from'];
	$location_to = $row['transport_to'];
	$customer = $row['customer'];
	$allowance = 0;
	$allowance2 = 0;
	$food_allowance = 0;
	$position_allowance = 0;
	$deligence_allowance = 0;
	$ontime = $row['ontime'];
	$datetime1 = $row['actual_finish_time'];
	$datetime2 = $row['start_time'];
	$qty = $row['qty'];
	//$start_break = $row['start_break'];
	$interval = $datetime1->diff($datetime2);
	$totalhrs = $interval->format('%h').'.'.$interval->format('%i');
	if ($totalhrs >= 9)
		$totalhrs = $totalhrs-1;

	$fQuery = " select top 1 miledge_to from miledge_calc order by miledge_from ";
	$result3 = sqlsrv_query($conn, $fQuery);
	while($rowtrip = sqlsrv_fetch_array( $result3, SQLSRV_FETCH_ASSOC)){
		$miledge_to = $rowtrip['miledge_to'];
	}

	//if ($temp_start_date <> date_format($row['start_date'],'d/m/Y')){
	//	$temp_remark = '';
	//	$tempnocharge = 0;
	//}
	

	if ($row['no_charge']) {
		$ch = 'No Charge';
		$remark = '';
		$tempnocharge = 1;
		if ($ontime == 1) {
			$tQuery = "select * from allowance_setup a left join branch b on b.code = a.branch left join operator c on c.cost_center = a.branch where benefit_type = 'Diligence allowance' and a.branch = 'RNG' and operator_id = '$operator' ";
			$result1st = sqlsrv_query($conn, $tQuery);
			while($row1st = sqlsrv_fetch_array( $result1st, SQLSRV_FETCH_ASSOC)){				
					//if ($totalhrs >= $row1st['minimum_hours'])
				$deligence_allowance = $row1st['amount'];
			}
			$tQuery = "select * from allowance_setup a left join branch b on b.code = a.branch left join operator c on c.cost_center = a.branch where benefit_type = 'Diligence allowance' and a.branch = 'RNG' and client = '$customer' and operator_id = '$operator' ";
			$result1st = sqlsrv_query($conn, $tQuery);
			while($row1st = sqlsrv_fetch_array( $result1st, SQLSRV_FETCH_ASSOC)){				
					//if ($totalhrs >= $row1st['minimum_hours'])
				$deligence_allowance = $row1st['amount'];
			}
		}
		$tQuery = "select * from allowance_setup a left join branch b on b.code = a.branch left join operator c on c.cost_center = a.branch where a.position = '01' and  benefit_type = 'Main allowance' and a.branch = 'SKL' and operator_id = '$operator' and c.position = '01' ";
			$result1st = sqlsrv_query($conn, $tQuery);
			while($row1st = sqlsrv_fetch_array( $result1st, SQLSRV_FETCH_ASSOC)){				
				//if ($totalhrs >= $row1st['minimum_hours'])
					$position_allowance = $row1st['amount'];
					//$allowance = $row1st['amount'];
			}
			
			//if($temp_remark == '1st trip'){
			//	$temp_remark = '';
			//}
		
	} else {
		$ch = 'Charge';
		////////////////////

		///////////////////
		if ($temp_start_date <> date_format($row['actual_start_date'],'d/m/Y')){
			$remark = '1st trip';
			$temp_remark = $remark;
			$tempnocharge = 0;
			//$tQuery = "select * from allowance_setup where position = '$position_code' and vehicle_type = '$vehicle_type' and allowance_type = 'Allowance for trip' and trip = '1st' ";
			$tQuery = "select * from allowance_setup a left join branch b on b.code = a.branch where position = '$position_code' and allowance_type = 'Allowance for shorthaul' and trip = '1st' and province = '$operator_branch' and location_from = '$location_from' ";
			$result1st = sqlsrv_query($conn, $tQuery);
			while($row1st = sqlsrv_fetch_array( $result1st, SQLSRV_FETCH_ASSOC)){
				$allowance = $row1st['amount'];
				if ($row['round_trip'] == 1){
				    $tQuery2 = "select * from allowance_setup a left join branch b on b.code = a.branch where position = '$position_code' and allowance_type = 'Allowance for shorthaul' and trip = '2nd' and province = '$operator_branch' ";
					$result1st2 = sqlsrv_query($conn, $tQuery2);
					while($row1st2 = sqlsrv_fetch_array( $result1st2, SQLSRV_FETCH_ASSOC)){				
						$allowance = $allowance+$row1st2['amount'];
						$temp_remark = '2nd trip';
					}
				}

				if ($total_miledge > $miledge_to)
					$allowance = $row1st['amount'];//+150;
				$temp_remark = $remark;
				

			}

			if ($allowance == 0 and $total_miledge <= $miledge_to) {
				$tQuery = "select * from allowance_setup a left join branch b on b.code = a.branch where position = '$position_code' and allowance_type = 'Allowance for shorthaul' and trip = '1st' and province = '$operator_branch' and location_from = '' and location_to = '' and benefit_type <> 'Food allowance' ";
				$result1st = sqlsrv_query($conn, $tQuery);
				while($row1st = sqlsrv_fetch_array( $result1st, SQLSRV_FETCH_ASSOC)){
					$allowance = $row1st['amount'];
					$allowance2 = $row1st['amount2'];
					if ($row['round_trip'] == 1){
						$tQuery2 = "select * from allowance_setup a left join branch b on b.code = a.branch where position = '$position_code' and allowance_type = 'Allowance for shorthaul' and trip = '2nd' and province = '$operator_branch' ";
						$result1st2 = sqlsrv_query($conn, $tQuery2);
						while($row1st2 = sqlsrv_fetch_array( $result1st2, SQLSRV_FETCH_ASSOC)){				
							$allowance = $allowance+$row1st2['amount'];
							$temp_remark = '2nd trip';
						}
					}
					if ($total_miledge > $miledge_to)
						$allowance = $row1st['amount'];//+150;
				}
			}

			if ($allowance == 0) {
				$tQuery = "select * from allowance_setup a left join branch b on b.code = a.branch where position = '$position_code' and allowance_type = 'Allowance for longhaul' and trip = '1st' and province = '$operator_branch' and location_from = '' and location_to = '' and benefit_type <> 'Food allowance' ";
				$result1st = sqlsrv_query($conn, $tQuery);
				while($row1st = sqlsrv_fetch_array( $result1st, SQLSRV_FETCH_ASSOC)){
					$allowance = $row1st['amount'];
					$allowance2 = $row1st['amount2'];
					if ($row['round_trip'] == 1){
						$tQuery2 = "select * from allowance_setup a left join branch b on b.code = a.branch where position = '$position_code' and allowance_type = 'Allowance for longhaul' and trip = '2nd' and province = '$operator_branch' ";
						$result1st2 = sqlsrv_query($conn, $tQuery2);
						while($row1st2 = sqlsrv_fetch_array( $result1st2, SQLSRV_FETCH_ASSOC)){				
							//$allowance = $allowance+$row1st2['amount'];
							$temp_remark = '2nd trip';
						}
					}
					//if ($total_miledge > 300)
					//	$allowance = $row1st['amount']+150;
				}
			}
			$tQuery = "select * from allowance_setup a left join branch b on b.code = a.branch left join operator c on c.cost_center = a.branch where client = '$customer' and benefit_type = 'Food allowance' and a.branch = 'SKL' and operator_id = '$operator' ";
			$result1st = sqlsrv_query($conn, $tQuery);
			while($row1st = sqlsrv_fetch_array( $result1st, SQLSRV_FETCH_ASSOC)){				
				//if ($totalhrs >= $row1st['minimum_hours'])
					$food_allowance = $row1st['amount'];
			}
			if ($ontime == 1) {
				$tQuery = "select * from allowance_setup a left join branch b on b.code = a.branch left join operator c on c.cost_center = a.branch where benefit_type = 'Diligence allowance' and a.branch = 'RNG' and operator_id = '$operator' ";
				$result1st = sqlsrv_query($conn, $tQuery);
				while($row1st = sqlsrv_fetch_array( $result1st, SQLSRV_FETCH_ASSOC)){				
					//if ($totalhrs >= $row1st['minimum_hours'])
					$deligence_allowance = $row1st['amount'];
				}
				$tQuery = "select * from allowance_setup a left join branch b on b.code = a.branch left join operator c on c.cost_center = a.branch where benefit_type = 'Diligence allowance' and a.branch = 'RNG' and client = '$customer' and operator_id = '$operator' ";
				$result1st = sqlsrv_query($conn, $tQuery);
				while($row1st = sqlsrv_fetch_array( $result1st, SQLSRV_FETCH_ASSOC)){				
					//if ($totalhrs >= $row1st['minimum_hours'])
					$deligence_allowance = $row1st['amount'];
				}
			}
			$tQuery = "select * from allowance_setup a left join branch b on b.code = a.branch left join operator c on c.cost_center = a.branch where a.position = '01' and  benefit_type = 'Main allowance' and a.branch = 'SKL' and operator_id = '$operator' and c.position = '01' ";
			$result1st = sqlsrv_query($conn, $tQuery);
			while($row1st = sqlsrv_fetch_array( $result1st, SQLSRV_FETCH_ASSOC)){				
				//if ($totalhrs >= $row1st['minimum_hours'])
					$position_allowance = $row1st['amount'];
					//$allowance = $row1st['amount'];
			}
		} else if ($temp_start_date == date_format($row['actual_start_date'],'d/m/Y') and $temp_remark == '') {
			if ($tempnocharge == 1){
				$remark = '1st trip ';
				$tempnocharge = 0;
				$temp_remark = $remark;
				$tQueryxx = "select * from allowance_setup a left join branch b on b.code = a.branch where position = '$position_code' and allowance_type = 'Allowance for shorthaul' and trip = '1st' and province = '$operator_branch' and benefit_type = 'Trip allowance' ";
				$result1stx = sqlsrv_query($conn, $tQueryxx);
				while($row1stx = sqlsrv_fetch_array( $result1stx, SQLSRV_FETCH_ASSOC)){				
					$allowance = $row1stx['amount'];
					if ($row['round_trip'] == 1){
						$tQuery2 = "select * from allowance_setup a left join branch b on b.code = a.branch where position = '$position_code' and allowance_type = 'Allowance for shorthaul' and trip = '2nd' and province = '$operator_branch' ";
						$result1st2 = sqlsrv_query($conn, $tQuery2);
						while($row1st2 = sqlsrv_fetch_array( $result1st2, SQLSRV_FETCH_ASSOC)){				
							$allowance = $allowance+$row1st2['amount'];
							$temp_remark = '2nd trip';
						}
					}
				}
			}		
			
		} else if ($temp_start_date == date_format($row['actual_start_date'],'d/m/Y') and $temp_remark == '1st trip') {
			$remark = '2nd trip';
			$temp_remark = $remark;
			//$tQuery = "select * from allowance_setup where position = '$position_code' and vehicle_type = '$vehicle_type' and allowance_type = 'Allowance for trip' and trip = '2nd' ";
			$tQuery = "select * from allowance_setup a left join branch b on b.code = a.branch where position = '$position_code' and allowance_type = 'Allowance for shorthaul' and trip = '2nd' and province = '$operator_branch' and benefit_type = 'Trip allowance' ";
			$result1st = sqlsrv_query($conn, $tQuery);
			while($row1st = sqlsrv_fetch_array( $result1st, SQLSRV_FETCH_ASSOC)){				
				$allowance = $row1st['amount'];
				if ($row['round_trip'] == 1){
					$tQuery2 = "select * from allowance_setup a left join branch b on b.code = a.branch where position = '$position_code' and allowance_type = 'Allowance for shorthaul' and trip = '3rd' and province = '$operator_branch' ";
					$result1st2 = sqlsrv_query($conn, $tQuery2);
					while($row1st2 = sqlsrv_fetch_array( $result1st2, SQLSRV_FETCH_ASSOC)){				
						$allowance = $allowance+$row1st2['amount'];
						$temp_remark = '3rd trip';
					}
				}
			}
			if ($tempnocharge == 1){
				$remark = '1st trip ';
				$tempnocharge = 0;
				$temp_remark = $remark;
				$tQueryx2 = "select * from allowance_setup a left join branch b on b.code = a.branch where position = '$position_code' and allowance_type = 'Allowance for shorthaul' and trip = '1st' and province = '$operator_branch' and benefit_type = 'Trip allowance' ";
				$result1stx2 = sqlsrv_query($conn, $tQueryx2);
				while($row1stx2 = sqlsrv_fetch_array( $result1stx2, SQLSRV_FETCH_ASSOC)){				
					$allowance = $row1stx2['amount'];
					if ($row['round_trip'] == 1){
						$tQuery2 = "select * from allowance_setup a left join branch b on b.code = a.branch where position = '$position_code' and allowance_type = 'Allowance for shorthaul' and trip = '2nd' and province = '$operator_branch' ";
						$result1st2 = sqlsrv_query($conn, $tQuery2);
						while($row1st2 = sqlsrv_fetch_array( $result1st2, SQLSRV_FETCH_ASSOC)){				
							$allowance = $allowance+$row1st2['amount'];
							$temp_remark = '2nd trip';
						}
					}
				}
			}		
		} else if ($temp_start_date == date_format($row['actual_start_date'],'d/m/Y') and $temp_remark == '1st trip ') {
			$remark = '2nd trip';
			$temp_remark = $remark;
			//$tQuery = "select * from allowance_setup where position = '$position_code' and vehicle_type = '$vehicle_type' and allowance_type = 'Allowance for trip' and trip = '2nd' ";
			$tQuery = "select * from allowance_setup a left join branch b on b.code = a.branch where position = '$position_code' and allowance_type = 'Allowance for shorthaul' and trip = '2nd' and province = '$operator_branch' and benefit_type = 'Trip allowance' ";
			$result1st = sqlsrv_query($conn, $tQuery);
			while($row1st = sqlsrv_fetch_array( $result1st, SQLSRV_FETCH_ASSOC)){				
				$allowance = $row1st['amount'];
				if ($row['round_trip'] == 1){
					$tQuery2 = "select * from allowance_setup a left join branch b on b.code = a.branch where position = '$position_code' and allowance_type = 'Allowance for shorthaul' and trip = '3rd' and province = '$operator_branch' ";
					$result1st2 = sqlsrv_query($conn, $tQuery2);
					while($row1st2 = sqlsrv_fetch_array( $result1st2, SQLSRV_FETCH_ASSOC)){				
						$allowance = $allowance+$row1st2['amount'];
						$temp_remark = '3rd trip';
					}
				}
			}		
			
		} else if ($temp_start_date == date_format($row['actual_start_date'],'d/m/Y') and $temp_remark == '2nd trip') {
			$remark = '3rd trip';
			$temp_remark = $remark;
			//$tQuery = "select * from allowance_setup where position = '$position_code' and vehicle_type = '$vehicle_type' and allowance_type = 'Allowance for trip' and trip = '2nd' ";
			$tQuery = "select * from allowance_setup a left join branch b on b.code = a.branch where position = '$position_code' and allowance_type = 'Allowance for shorthaul' and trip = '3rd' and province = '$operator_branch' ";
			$result1st = sqlsrv_query($conn, $tQuery);
			while($row1st = sqlsrv_fetch_array( $result1st, SQLSRV_FETCH_ASSOC)){
				$allowance = $row1st['amount'];
				if ($row['round_trip'] == 1){
					$tQuery2 = "select * from allowance_setup a left join branch b on b.code = a.branch where position = '$position_code' and allowance_type = 'Allowance for shorthaul' and trip = '4th' and province = '$operator_branch' ";
					$result1st2 = sqlsrv_query($conn, $tQuery2);
					while($row1st2 = sqlsrv_fetch_array( $result1st2, SQLSRV_FETCH_ASSOC)){				
						$allowance = $allowance+$row1st2['amount'];
					}
				}
			}
			
		} else if ($temp_start_date == date_format($row['actual_start_date'],'d/m/Y') and $temp_remark == '3rd trip') {
			$remark = '4th trip';
			$temp_remark = $remark;
			//$tQuery = "select * from allowance_setup where position = '$position_code' and vehicle_type = '$vehicle_type' and allowance_type = 'Allowance for trip' and trip = '2nd' ";
			$tQuery = "select * from allowance_setup a left join branch b on b.code = a.branch where position = '$position_code' and allowance_type = 'Allowance for shorthaul' and trip = '4th' and province = '$operator_branch' ";
			$result1st = sqlsrv_query($conn, $tQuery);
			while($row1st = sqlsrv_fetch_array( $result1st, SQLSRV_FETCH_ASSOC)){
				$allowance = $row1st['amount'];
			}
			if ($tempnocharge == 1){
				$remark = '1st trip ';
				$tempnocharge = 0;
				$temp_remark = $remark;
				$tQueryx2 = "select * from allowance_setup a left join branch b on b.code = a.branch where position = '$position_code' and allowance_type = 'Allowance for shorthaul' and trip = '1st' and province = '$operator_branch' and benefit_type = 'Trip allowance' ";
				$result1stx2 = sqlsrv_query($conn, $tQueryx2);
				while($row1stx2 = sqlsrv_fetch_array( $result1stx2, SQLSRV_FETCH_ASSOC)){				
					$allowance = $row1stx2['amount'];
					if ($row['round_trip'] == 1){
						$tQuery2 = "select * from allowance_setup a left join branch b on b.code = a.branch where position = '$position_code' and allowance_type = 'Allowance for shorthaul' and trip = '2nd' and province = '$operator_branch' ";
						$result1st2 = sqlsrv_query($conn, $tQuery2);
						while($row1st2 = sqlsrv_fetch_array( $result1st2, SQLSRV_FETCH_ASSOC)){				
							$allowance = $allowance+$row1st2['amount'];
							$temp_remark = '2nd trip';
						}
					}
				}
			}
		} else if ($temp_start_date == date_format($row['actual_start_date'],'d/m/Y') and $temp_remark == '4th trip') {
			$remark = '5th trip';
			$temp_remark = $remark;
			//$tQuery = "select * from allowance_setup where position = '$position_code' and vehicle_type = '$vehicle_type' and allowance_type = 'Allowance for trip' and trip = '2nd' ";
			$tQuery = "select * from allowance_setup a left join branch b on b.code = a.branch where position = '$position_code' and allowance_type = 'Allowance for shorthaul' and trip = '5th' and province = '$operator_branch' ";
			$result1st = sqlsrv_query($conn, $tQuery);
			while($row1st = sqlsrv_fetch_array( $result1st, SQLSRV_FETCH_ASSOC)){
				$allowance = $row1st['amount'];
			}
			if ($tempnocharge == 1){
				$remark = '1st trip ';
				$tempnocharge = 0;
				$temp_remark = $remark;
				$tQueryx2 = "select * from allowance_setup a left join branch b on b.code = a.branch where position = '$position_code' and allowance_type = 'Allowance for shorthaul' and trip = '1st' and province = '$operator_branch' and benefit_type = 'Trip allowance' ";
				$result1stx2 = sqlsrv_query($conn, $tQueryx2);
				while($row1stx2 = sqlsrv_fetch_array( $result1stx2, SQLSRV_FETCH_ASSOC)){				
					$allowance = $row1stx2['amount'];
					if ($row['round_trip'] == 1){
						$tQuery2 = "select * from allowance_setup a left join branch b on b.code = a.branch where position = '$position_code' and allowance_type = 'Allowance for shorthaul' and trip = '2nd' and province = '$operator_branch' ";
						$result1st2 = sqlsrv_query($conn, $tQuery2);
						while($row1st2 = sqlsrv_fetch_array( $result1st2, SQLSRV_FETCH_ASSOC)){				
							$allowance = $allowance+$row1st2['amount'];
							$temp_remark = '2nd trip';
						}
					}
				}
			}	
			
		} else if ($temp_start_date == date_format($row['actual_start_date'],'d/m/Y') and $temp_remark == '5th trip') {
			$remark = '6th trip';
			$temp_remark = $remark;
			//$tQuery = "select * from allowance_setup where position = '$position_code' and vehicle_type = '$vehicle_type' and allowance_type = 'Allowance for trip' and trip = '2nd' ";
			$tQuery = "select * from allowance_setup a left join branch b on b.code = a.branch where position = '$position_code' and allowance_type = 'Allowance for shorthaul' and trip = '6th' and province = '$operator_branch' ";
			$result1st = sqlsrv_query($conn, $tQuery);
			while($row1st = sqlsrv_fetch_array( $result1st, SQLSRV_FETCH_ASSOC)){
				$allowance = $row1st['amount'];
			}
		} else 
			$remark = '';        

		//$temp_start_date = date_format($row['start_date'],'d/m/Y');
		
	}

	//$temp_start_date = date_format($row['start_date'],'d/m/Y');
	
	//if ($tempnocharge == 1){
	//	if($temp_remark == '1st trip'){
	//		$temp_remark = '';
	//		$tempnocharge = 0;
	//	}
	//}
	 

	if (is_null($row['actual_finish_time'])) {
		$end_time = '';
	} else {
		$end_time = date_format($row['actual_finish_time'],'H:i');
	}
	//$datetime1 = $row['end_time'];
	//$datetime2 = $row['start_time'];
	//$interval = $datetime1->diff($datetime2);
    //$totalhrs = $interval->format('%h').'.'.$interval->format('%i');
	//if ($totalhrs > 8)
		//$totalhrs = 8;
	//if ($datetime1 < $start_break) {
		//$totalhrs = $totalhrs - $datetime1->diff($start_break)
	//}

	
	$ot1 = 0;
	$ot15 = 0;
	$ot2 = 0;
	$ot3 = 0;

	$transport_id = $row['transport_id'];
	$operator = $row['operator'];
	$day_type = '(R)';
	$day_type_desc = 'Workday';	

	$newDate = date('l', strtotime(date_format($row['actual_start_date'],'Y/m/d')));

	if ($newDate == 'Sunday'){
		$fQuery = " select * from operator where sunday = 1 and operator_id = '$operator' ";	
	}
	if ($newDate == 'Monday'){
		$fQuery = " select * from operator where monday = 1 and operator_id = '$operator' ";	
	}
	if ($newDate == 'Tuesday'){
		$fQuery = " select * from operator where tuesday = 1 and operator_id = '$operator' ";	
	}
	if ($newDate == 'Wednesday'){
		$fQuery = " select * from operator where wednesday = 1 and operator_id = '$operator' ";	
	}
	if ($newDate == 'Thursday'){
		$fQuery = " select * from operator where thursday = 1 and operator_id = '$operator' ";	
	}
	if ($newDate == 'Friday'){
		$fQuery = " select * from operator where friday = 1 and operator_id = '$operator' ";	
	}
	if ($newDate == 'Saturday'){
		$fQuery = " select * from operator where saturday = 1 and operator_id = '$operator' ";	
	}
	$result3 = sqlsrv_query($conn, $fQuery);
	while($rowdayoff = sqlsrv_fetch_array( $result3, SQLSRV_FETCH_ASSOC)){
		$day_type = '(O)';
		$day_type_desc = 'Day off';
		if ($location_from == 'Bangkok')
			$ot1 = 8;
	}

	$fQuery = " select * from worksheet_cargo_transport where actual_start_date in (select non_working_date from calendar_public_holiday) and transport_id = '$transport_id' ";
	$result2 = sqlsrv_query($conn, $fQuery);
	while($rowholiday = sqlsrv_fetch_array( $result2, SQLSRV_FETCH_ASSOC)){
		if ($day_type == '(O)') {
			$day_type = '(O),(H)';
			$day_type_desc = 'Day off, Holiday';
			$ot2 = 8;
			$ot1 = 0;
		} else {
			$day_type = '(H)';
			$day_type_desc = 'Holiday';
			$ot2 = 0;
			$ot1 = 8;
		}
		
	}
	$fQuery = " select * from worksheet_cargo_handling where start_date in (select non_working_date from calendar_public_holiday) and cargo_service_id = '$transport_id' ";
	$result2 = sqlsrv_query($conn, $fQuery);
	while($rowholiday = sqlsrv_fetch_array( $result2, SQLSRV_FETCH_ASSOC)){
		if ($day_type == '(O)') {
			$day_type = '(O),(H)';
			$day_type_desc = 'Day off, Holiday';
			$ot2 = 8;
			$ot1 = 0;
		} else {
			$day_type = '(H)';
			$day_type_desc = 'Holiday';
			$ot2 = 0;
			$ot1 = 8;
		}
		
	}

	if ($remark <> '1st trip'){
		$ot1 = 0;
		$ot2 = 0;
	}


	//$row['customer_name']

	//$qty = 1;
	//if ($total_miledge > 300 and $total_miledge < 700)
	//	$qty = 2;
	//else if ($total_miledge > 700 and $total_miledge < 1200)
	//	$qty = 3;
	//else if ($total_miledge > 1200)
	//	$qty = 3;
	if ($row['round_trip'] == 1)
		$fQuery = " select * from miledge_calc where miledge_from <= $total_miledge and miledge_to >= $total_miledge and round_trip =1 ";
	else
		$fQuery = " select * from miledge_calc where miledge_from <= $total_miledge and miledge_to >= $total_miledge and round_trip =0 ";
	$result3 = sqlsrv_query($conn, $fQuery);
	while($rowtrip = sqlsrv_fetch_array( $result3, SQLSRV_FETCH_ASSOC)){
		$qty = $rowtrip['qty'];
	}
	//if ($total_miledge > 300) {
	//	$allowance = 350;
	//}	



if ($row['no_charge'] == 0 or $position_code == '01') {
	if ($remark == '1st trip'){
		$fQuery = " select description,follow_vehicle from operator a left join location b on b.code = a.branch where operator_id = '$operator' ";
		$result3 = sqlsrv_query($conn, $fQuery);
		while($rowoperator = sqlsrv_fetch_array( $result3, SQLSRV_FETCH_ASSOC)){
			if ($rowoperator['follow_vehicle'] == 1){
				$tQuery = "select * from allowance_setup a left join branch b on b.code = a.branch where vehicle_type = '$v_type' and trip = '1st' and b.province = '$operator_branch' and allowance_type = 'Allowance for longhaul' ";
				$resultrate = sqlsrv_query($conn, $tQuery);
				while($rowrate = sqlsrv_fetch_array( $resultrate, SQLSRV_FETCH_ASSOC)){
					$allowance = $rowrate['amount'];
				}	
			}
		}
	}
	if ($remark == '1st trip' and $total_miledge <= $miledge_to){
		$fQuery = " select description,follow_vehicle from operator a left join location b on b.code = a.branch where operator_id = '$operator' ";
		$result3 = sqlsrv_query($conn, $fQuery);
		while($rowoperator = sqlsrv_fetch_array( $result3, SQLSRV_FETCH_ASSOC)){
			$branch1 = $rowoperator['description'];
			$aQuery = "select district1 from contract_location_master a left join post_code b on b.post_code = a.post_code where location = '$location_from'  ";
			$resulta = sqlsrv_query($conn, $aQuery);
			while($rowa = sqlsrv_fetch_array( $resulta, SQLSRV_FETCH_ASSOC)){
				if (($rowa['district1'] <> $branch1) and ($location_from <> 'Bangkok')){
					//$tQuery = "select * from allowance_setup a left join branch b on b.code = a.branch where position = '$position_code' and allowance_type = 'Allowance for longhaul' and province = '$branch1' ";
					//$resultrate = sqlsrv_query($conn, $tQuery);
					//while($rowrate = sqlsrv_fetch_array( $resultrate, SQLSRV_FETCH_ASSOC)){
						$allowance = $allowance2;//$rowrate['amount'];
					//}
				}
			}
			$aQuery = "select district1 from contract_location_master a left join post_code b on b.post_code = a.post_code where location = '$location_to'  ";
			$resulta = sqlsrv_query($conn, $aQuery);
			while($rowa = sqlsrv_fetch_array( $resulta, SQLSRV_FETCH_ASSOC)){
				if (($rowa['district1'] <> $branch1) and ($location_to <> 'Bangkok')){
					//$tQuery = "select * from allowance_setup a left join branch b on b.code = a.branch where position = '$position_code' and allowance_type = 'Allowance for longhaul' and province = '$branch1' ";
					//$resultrate = sqlsrv_query($conn, $tQuery);
					//while($rowrate = sqlsrv_fetch_array( $resultrate, SQLSRV_FETCH_ASSOC)){
						$allowance = $allowance2;//$rowrate['amount'];
					//}
				}
			}

			if ($rowoperator['follow_vehicle'] == 1){
				$tQuery = "select * from allowance_setup a left join branch b on b.code = a.branch where vehicle_type = '$v_type' and trip = '1st' and b.province = '$operator_branch' and allowance_type = 'Allowance for shorthaul' ";
				$resultrate = sqlsrv_query($conn, $tQuery);
				while($rowrate = sqlsrv_fetch_array( $resultrate, SQLSRV_FETCH_ASSOC)){
					if ($location_from == 'Bangkok' or $location_to == 'Bangkok' or $location_from == 'Klongtoey Port')
						$allowance = $rowrate['amount'];
					else
						$allowance = $rowrate['amount2'];
					//if(($location_to == 'Sattahip' or $location_to == 'Phitsanulok') and $position_code = 10)
					//	$allowance = 200;
					//if(($location_to == 'Sattahip' or $location_to == 'Phitsanulok' or $location_to == 'Nakhon Nayok') and $position_code = 12)
					//	$allowance = 250;
				}	
			}
		}
	}
	if ($remark == '2nd trip' and $total_miledge <= $miledge_to){
		$fQuery = " select description,follow_vehicle from operator a left join location b on b.code = a.branch where operator_id = '$operator' ";
		$result3 = sqlsrv_query($conn, $fQuery);
		while($rowoperator = sqlsrv_fetch_array( $result3, SQLSRV_FETCH_ASSOC)){
			if ($rowoperator['follow_vehicle'] == 1){
				$tQuery = "select * from allowance_setup a left join branch b on b.code = a.branch where vehicle_type = '$vehicle_type' and trip = '2nd' and b.province = '$operator_branch' and allowance_type = 'Allowance for shorthaul' ";
				$resultrate = sqlsrv_query($conn, $tQuery);
				while($rowrate = sqlsrv_fetch_array( $resultrate, SQLSRV_FETCH_ASSOC)){
					//$allowance = $rowrate['amount'];
					if ($location_from == 'Bangkok' or $location_to == 'Bangkok')
						$allowance = $rowrate['amount'];
					else
						$allowance = $rowrate['amount2']; 
				}	
			}
		}
	}
	if ($remark == '3rd trip' and $total_miledge >= $miledge_to){
		$fQuery = " select description,follow_vehicle from operator a left join location b on b.code = a.branch where operator_id = '$operator' ";
		$result3 = sqlsrv_query($conn, $fQuery);
		while($rowoperator = sqlsrv_fetch_array( $result3, SQLSRV_FETCH_ASSOC)){
			if ($rowoperator['follow_vehicle'] == 1){
				$tQuery = "select * from allowance_setup a left join branch b on b.code = a.branch where vehicle_type = '$vehicle_type' and trip = '3rd' and b.province = '$operator_branch' and allowance_type = 'Allowance for longhaul' ";
				$resultrate = sqlsrv_query($conn, $tQuery);
				while($rowrate = sqlsrv_fetch_array( $resultrate, SQLSRV_FETCH_ASSOC)){
					$allowance = $rowrate['amount2'];
				}	
			}
		}
	}

	if ($remark == '2nd trip' and $total_miledge >= $miledge_to){
		$tQuery = "select * from allowance_setup a left join branch b on b.code = a.branch where position = '$position_code' and trip = '2nd' and b.province = '$operator_branch' and allowance_type = 'Allowance for longhaul' ";
		$resultrate = sqlsrv_query($conn, $tQuery);
		while($rowrate = sqlsrv_fetch_array( $resultrate, SQLSRV_FETCH_ASSOC)){
			$allowance = $rowrate['amount2'];
		}	
	}

	if ($remark == '' and $total_miledge >= $miledge_to){
		$tQuery = "select * from allowance_setup a left join branch b on b.code = a.branch where position = '$position_code' and trip = '1st' and b.province = '$operator_branch' and allowance_type = 'Allowance for longhaul' ";
		$resultrate = sqlsrv_query($conn, $tQuery);
		while($rowrate = sqlsrv_fetch_array( $resultrate, SQLSRV_FETCH_ASSOC)){
			$allowance = $rowrate['amount2'];
		}	
	}

}





	if ($row['round_trip'] == 1){
		$fQuery = " select * from miledge_calc where round_trip = 1 and miledge_from <= $total_miledge and miledge_to >= $total_miledge ";
		$result3 = sqlsrv_query($conn, $fQuery);
		while($rowtrip = sqlsrv_fetch_array( $result3, SQLSRV_FETCH_ASSOC)){
			$qty = $rowtrip['qty'];
		}
		$fQuery = " select description,follow_vehicle from operator a left join location b on b.code = a.branch where operator_id = '$operator' ";
		$result3 = sqlsrv_query($conn, $fQuery);
		while($rowoperator = sqlsrv_fetch_array( $result3, SQLSRV_FETCH_ASSOC)){
			if ($rowoperator['follow_vehicle'] == 1){
				$tQuery = "select * from allowance_setup a left join branch b on b.code = a.branch where vehicle_type = '$vehicle_type' and b.province = '$operator_branch' and trip = '1st' and allowance_type = 'Allowance for longhaul'";
				$resultrate = sqlsrv_query($conn, $tQuery);
				while($rowrate = sqlsrv_fetch_array( $resultrate, SQLSRV_FETCH_ASSOC)){
					$allowance = $rowrate['amount'];
				}
			}
		}
		//$allowance = $allowance+30;	
	}

	if ($row['round_trip'] == 0){
		$fQuery = " select * from miledge_calc where round_trip = 0 and miledge_from <= $total_miledge and miledge_to >= $total_miledge ";
		$result3 = sqlsrv_query($conn, $fQuery);
		while($rowtrip = sqlsrv_fetch_array( $result3, SQLSRV_FETCH_ASSOC)){
			$qty = $rowtrip['qty'];
		}
		
		//$allowance = $allowance+30;	
	}

	if ($row['standby_charge'] == 1){
		$remark = 'Standby';
		$fQuery = " select description,follow_vehicle from operator a left join location b on b.code = a.branch where operator_id = '$operator' ";
		$result3 = sqlsrv_query($conn, $fQuery);
		while($rowoperator = sqlsrv_fetch_array( $result3, SQLSRV_FETCH_ASSOC)){
			$tQuery = "select * from allowance_setup a left join branch b on b.code = a.branch where position = '$position_code' and allowance_type = 'Standby charge' and b.province = '$operator_branch'";
			//$tQuery = "select * from allowance_setup a left join branch b on b.code = a.branch where position = '$position_code' and allowance_type = 'Standby charge' ";
			$resultrate = sqlsrv_query($conn, $tQuery);
			while($rowrate = sqlsrv_fetch_array( $resultrate, SQLSRV_FETCH_ASSOC)){
				$allowance = $rowrate['amount2'];
			}
			if ($rowoperator['follow_vehicle'] == 1){
				$tQuery = "select * from allowance_setup a left join branch b on b.code = a.branch where vehicle_type = '$vehicle_type' and allowance_type = 'Standby charge' and b.province = '$operator_branch'";
				$resultrate = sqlsrv_query($conn, $tQuery);
				while($rowrate = sqlsrv_fetch_array( $resultrate, SQLSRV_FETCH_ASSOC)){
					$allowance = $rowrate['amount2'];
				}
			}
		}		

	}

	//Special
	if ($temp_start_date != date_format($row['actual_start_date'],'d/m/Y')){
		$sp = 0;
		$temp_totalhrs =0;
	}

	if ($temp_start_date == date_format($row['actual_start_date'],'d/m/Y') and $remark == '3rd trip' and  $sp == 1) {
		$tQuery = "select * from allowance_setup a left join branch b on b.code = a.branch where position = '$position_code' and allowance_type = 'Allowance for shorthaul' and trip = '2nd' and province = '$operator_branch' ";
		$result1st = sqlsrv_query($conn, $tQuery);
		while($row1st = sqlsrv_fetch_array( $result1st, SQLSRV_FETCH_ASSOC)){
			$allowance = $row1st['amount'];
		}
	}

	if ($temp_start_date == date_format($row['actual_start_date'],'d/m/Y') and $remark == '1st trip' and  $sp == 0) {
		$tQuery = "select * from allowance_setup where benefit_type = 'Special allowance' and location_from = '$location_from' ";
		$result1st = sqlsrv_query($conn, $tQuery);
		while($row1st = sqlsrv_fetch_array( $result1st, SQLSRV_FETCH_ASSOC)){
			$allowance = $row1st['amount'];
			$sp = 1;
		}
	}
	if ($temp_start_date == date_format($row['actual_start_date'],'d/m/Y') and $remark == '1st trip' and  $sp == 0) {
		$tQuery = "select * from allowance_setup where benefit_type = 'Special allowance' and location_from = '$location_to' ";
		$result1st = sqlsrv_query($conn, $tQuery);
		while($row1st = sqlsrv_fetch_array( $result1st, SQLSRV_FETCH_ASSOC)){
			$allowance = $row1st['amount'];
			$sp = 1;
		}
	}

	//if ($temp_start_date == date_format($row['start_date'],'d/m/Y') and $remark == '2nd trip' and  $sp == 0) {
	//	$tQuery = "select * from allowance_setup where benefit_type = 'Special allowance' and location_from = '$location_from' ";
	//	$result1st = sqlsrv_query($conn, $tQuery);
	//	while($row1st = sqlsrv_fetch_array( $result1st, SQLSRV_FETCH_ASSOC)){
	//		$allowance = $row1st['amount'];
	//		$sp = 1;
	//	}
	//}
	if ($temp_start_date == date_format($row['actual_start_date'],'d/m/Y') and $remark == '3rd trip' and  $sp == 0) {
		$tQuery = "select * from allowance_setup where benefit_type = 'Special allowance' and location_from = '$location_to' ";
		$result1st = sqlsrv_query($conn, $tQuery);
		while($row1st = sqlsrv_fetch_array( $result1st, SQLSRV_FETCH_ASSOC)){
			$allowance = $row1st['amount'];
			$sp = 1;
		}
	}

	if ($ontime == 1 && $remark == '') {
		$tQuery = "select * from allowance_setup a left join branch b on b.code = a.branch left join operator c on c.cost_center = a.branch where benefit_type = 'Diligence allowance' and a.branch = 'RNG' and operator_id = '$operator' ";
		$result1st = sqlsrv_query($conn, $tQuery);
		while($row1st = sqlsrv_fetch_array( $result1st, SQLSRV_FETCH_ASSOC)){				
				//if ($totalhrs >= $row1st['minimum_hours'])
			$deligence_allowance = $row1st['amount'];
		}
		$tQuery = "select * from allowance_setup a left join branch b on b.code = a.branch left join operator c on c.cost_center = a.branch where benefit_type = 'Diligence allowance' and a.branch = 'RNG' and client = '$customer' and operator_id = '$operator' ";
		$result1st = sqlsrv_query($conn, $tQuery);
		while($row1st = sqlsrv_fetch_array( $result1st, SQLSRV_FETCH_ASSOC)){				
				//if ($totalhrs >= $row1st['minimum_hours'])
			$deligence_allowance = $row1st['amount'];
		}
	}

	$total_allowance = $allowance*$qty;
	if ($row['uom'] == 'Hour') {
		if ($totalhrs == 0.59)
			$qty = 1;
		else if ($totalhrs == 6.59)
			$qty = 7;
		else
			$qty = $totalhrs;
		if ($qty < 8)
			$food_allowance = 0;
			$total_allowance = $allowance;

	}
	if ($row['uom'] == 'Day') {
		$qty = intval($row['qty']);
		$total_allowance = $allowance*$qty;
	}

	if ($totalhrs <8)
		$food_allowance = 0;

	
	$fQuery = " select ot_staff,branch,position from operator where operator_id = '$operator' and ot_staff = 1 ";
	$resultot = sqlsrv_query($conn, $fQuery);
	while($rowoperator = sqlsrv_fetch_array( $resultot, SQLSRV_FETCH_ASSOC)){
		$aQuery = "	select top 1 * from contract_location_master where location = '$location_from' ";
		$resula = sqlsrv_query($conn, $aQuery);
		while($rowa = sqlsrv_fetch_array( $resula, SQLSRV_FETCH_ASSOC)){
			if ($totalhrs > 8 && $day_type == '(R)' and $rowoperator['branch'] == $rowa['universal_location']){
				if ($totalhrs > 8 && $day_type == '(R)')
					$ot15 = 0;//round($totalhrs-8);
				else if ($totalhrs > 8 && $day_type == '(O)' and $rowoperator['branch'] <> '004')
					$ot3 = round($totalhrs-8);
			}
			if ($totalhrs > 8 && $day_type == '(R)' and $rowoperator['position'] == '02'){
				if ($totalhrs > 8 && $day_type == '(R)')
					$ot15 = round($totalhrs-8,2);
			}
			if ($totalhrs > 8 && $day_type == '(O)' and $rowoperator['position'] == '02'){
				if ($totalhrs > 8 && $day_type == '(O)')
					$ot1 = 8;
					$ot3 = round($totalhrs-8);
			}

		}
	}

	$fQuery = " select ot_staff,branch,branch4,employment_type from operator where operator_id = '$operator' and ot_staff = 1 and manpower = 1 ";
	$resultot = sqlsrv_query($conn, $fQuery);
	while($rowoperator = sqlsrv_fetch_array( $resultot, SQLSRV_FETCH_ASSOC)){
		$aQuery = "	select top 1 * from contract_location_master where location = '$location_from' ";
		$resula = sqlsrv_query($conn, $aQuery);
		while($rowa = sqlsrv_fetch_array( $resula, SQLSRV_FETCH_ASSOC)){
			if ($totalhrs > 8 and $rowoperator['branch4'] == $rowa['universal_location']){
				if ($totalhrs > 8 && $day_type == '(R)' and $start_time < '8:30')
					$ot15 = 8.7-floatval(date_format($row['start_time'],'H'));
				if ($totalhrs > 8 and $day_type == '(R)' and $start_time < '8:30' and $end_time > '17:30') 
					$ot15 = 8.7-floatval(date_format($row['start_time'],'H')) + (floatval(date_format($row['actual_finish_time'],'H')) - 17.5);
				if ($totalhrs > 8 && $day_type == '(O)' and $start_time < '8:30'){
					$ot1 = 8;
					$ot3 = 8.5-floatval(date_format($row['start_time'],'H'));
				}
				if ($totalhrs > 8 and $day_type == '(O)' and $start_time < '8:30' and $end_time > '17:30') {
					$ot1 = 8;
					$ot3 = 8.5-floatval(date_format($row['start_time'],'H')) + (floatval(date_format($row['actual_finish_time'],'H')) - 17.5);
				}
			}
			if($rowoperator['employment_type'] == 'Wage'){
				if ($totalhrs > 8 && $day_type == '(R)' and $start_time < '8:30'){
					$ot1 = 0;
					$ot15 = 8.7-floatval(date_format($row['start_time'],'H'));
				}
				if ($totalhrs > 8 and $day_type == '(R)' and $start_time < '8:30' and $end_time > '17:30') {
					$ot1 = 0;
					$ot15 = 8.7-floatval(date_format($row['start_time'],'H')) + (floatval(date_format($row['actual_finish_time'],'H')) - 17.5);
				}
				if ($totalhrs > 8 and $day_type == '(R)' and $end_time > '17:30') {
					$ot1 = 0;
					$ot15 = floatval(date_format($row['actual_finish_time'],'H')) - 17.5;
				}
				if ($totalhrs > 8 && $day_type == '(O)' and $start_time < '8:30'){
					$ot2 = 8;
					$ot3 = 8.5-floatval(date_format($row['start_time'],'H'));
				}
				if ($totalhrs > 8 and $day_type == '(O)' and $start_time < '8:30' and $end_time > '17:30') {
					$ot2 = 8;
					$ot3 = 8.5-floatval(date_format($row['start_time'],'H')) + (floatval(date_format($row['actual_finish_time'],'H')) - 17.5);
				}
				if ($totalhrs > 8 and $day_type == '(O)' and $end_time > '17:30') {
					$ot2 = 8;
					$ot3 = floatval(date_format($row['actual_finish_time'],'H')) - 17.5;
				}
			}
			if($rowoperator['employment_type'] == 'Salary'){
				if ($day_type == '(R)' and $start_time < '8:30'){
					$ot1 = 0;
					$ot15 = 8.7-floatval(date_format($row['start_time'],'H'));
				}
				if ($day_type == '(R)' and $start_time < '8:30' and $end_time > '17:30') {
					$ot1 = 0;
					$ot15 = 8.7-floatval(date_format($row['start_time'],'H')) + (floatval(date_format($row['actual_finish_time'],'H')) - 17.5);
				}
				if ($day_type == '(R)' and $end_time > '17:30') {
					$ot1 = 0;
					$ot15 = floatval(date_format($row['actual_finish_time'],'H')) - 17.5;
				}
				if ($day_type == '(O)' and $start_time < '8:30'){
					$ot1 = 8;
					$ot3 = 8.5-floatval(date_format($row['start_time'],'H'));
				}
				if ($day_type == '(O)' and $start_time < '8:30' and $end_time > '17:30') {
					$ot1 = 8;
					$ot3 = 8.5-floatval(date_format($row['start_time'],'H')) + (floatval(date_format($row['actual_finish_time'],'H')) - 17.5);
				}
				if ($day_type == '(O)' and $end_time > '17:30') {
					$ot1 = 8;
					$ot3 = floatval(date_format($row['actual_finish_time'],'H')) - 17.5;
				}
			}
		}	
	}

	if($temp_start_date == date_format($row['actual_start_date'],'d/m/Y')){
		$ot15 = $totalhrs+$temptotalhrs;
		$temptotalhrs = $totalhrs+$temptotalhrs;
		$fQuery = " select ot_staff,branch,position from operator where operator_id = '$operator' and ot_staff = 1 ";
		$resultot = sqlsrv_query($conn, $fQuery);
		while($rowoperator = sqlsrv_fetch_array( $resultot, SQLSRV_FETCH_ASSOC)){
			$aQuery = "	select top 1 * from contract_location_master where location = '$location_from' ";
			$resula = sqlsrv_query($conn, $aQuery);
			while($rowa = sqlsrv_fetch_array( $resula, SQLSRV_FETCH_ASSOC)){
				if ($temptotalhrs > 8 && $day_type == '(R)' and $rowoperator['branch'] == $rowa['universal_location']){
					if ($temptotalhrs > 8 && $day_type == '(R)')
						$ot15 = round($totalhrs-8,2);
					else if ($temptotalhrs > 8 && $day_type == '(O)' and $rowoperator['branch'] <> '004')
						$ot3 = round($temptotalhrs-8);
				}
				if ($temptotalhrs > 8 && $day_type == '(R)' and $rowoperator['position'] == '02'){
					if ($temptotalhrs > 8 && $day_type == '(R)')
						$ot15 = round($temptotalhrs-8,2);
				}
				if ($temptotalhrs > 8 && $day_type == '(O)' and $rowoperator['position'] == '02'){
					if ($temptotalhrs > 8 && $day_type == '(O)')
						$ot1 = 8;
						$ot3 = round($temptotalhrs-8);
				}
				if ($temptotalhrs < 8)
					$ot15 = 0;
			}
		}
	}

	$temptotalhrs = $totalhrs;

	if($totalhrs >=4 && $totalhrs <8 && $deligence_allowance > 0){
		$deligence_allowance = $deligence_allowance/2;
	}

if ($position_code == '01'){
	$fQuery = " select lumpsum_ot,branch from operator where operator_id = '$operator' and lumpsum_ot = 1 ";
	$resultot = sqlsrv_query($conn, $fQuery);
	while($rowoperator = sqlsrv_fetch_array( $resultot, SQLSRV_FETCH_ASSOC)){
			if ($totalhrs > 8 && $day_type == '(R)')
				$ot15 = round($totalhrs-8,2);
			else if ($totalhrs > 0 && $day_type == '(O)' and $rowoperator['branch'] <> '004'){
				if ($totalhrs > 8 ){
					$ot3 = round($totalhrs-8);
					$ot1 = 8;
				}
			}
		
			$temp_totalhrs = $temp_totalhrs+$totalhrs;
			if ($temp_totalhrs  > 8 and $temp_start_date == date_format($row['actual_start_date'],'d/m/Y') and $day_type <> '(R)')
				$ot3 = round($temp_totalhrs -8);

	}
} else {
		$fQuery = " select lumpsum_ot,branch from operator where operator_id = '$operator' and lumpsum_ot = 1 ";
		$resultot = sqlsrv_query($conn, $fQuery);
		while($rowoperator = sqlsrv_fetch_array( $resultot, SQLSRV_FETCH_ASSOC)){
		if($day_type <> '(R)' and $temp_start_date <> date_format($row['actual_start_date'],'d/m/Y') and $rowoperator['branch'] <> '004')
			$ot1 = 8;
		if($temp_start_date == date_format($row['actual_start_date'],'d/m/Y'))
			$ot1 = 0;
	}
}

	$fQuery = " select no_ot_long from operator where operator_id = '$operator' and no_ot_long = 1 ";
	$resultot = sqlsrv_query($conn, $fQuery);
	while($rowoperator = sqlsrv_fetch_array( $resultot, SQLSRV_FETCH_ASSOC)){
		if ($total_miledge > $miledge_to) {
			$ot1 = 0;
			$ot15 = 0;
		}
	}

	$fQuery = " select no_ot_long from operator where operator_id = '$operator' and branch = '004' ";
	$resultot = sqlsrv_query($conn, $fQuery);
	while($rowoperator = sqlsrv_fetch_array( $resultot, SQLSRV_FETCH_ASSOC)){
		if($location_from == 'Bangkok' or $location_to == 'Bangkok' or $location_from == 'Klongtoey Port'){
			if ($day_type == '(R)' and $start_time < '8:30') {
				$ot15 = round(8.3-floatval(date_format($row['start_time'],'H')),2);
			}
			if ($day_type == '(R)' and $start_time < '8:30' and $end_time > '17:30') {
				$ot15 = 8.3-floatval(date_format($row['start_time'],'H')) + (floatval(date_format($row['actual_finish_time'],'H')) - 17.5);
			}
		}
	}

	//$fQuery = " select ot8 from operator where operator_id = '$operator' and ot8 = 1 ";
	//$resultot = sqlsrv_query($conn, $fQuery);
	//while($rowoperator = sqlsrv_fetch_array( $resultot, SQLSRV_FETCH_ASSOC)){
	//	if($day_type == '(O)')
	//		$ot3 = round($totalhrs-8);
	//}


	$temp_start_date = date_format($row['actual_start_date'],'d/m/Y');

	if ($position_allowance > 0 && $allowance == 0){
		$allowance = $position_allowance;
		$position_allowance = 0;
	}

	$fQuery = " select double_allowance from operator where operator_id = '$operator' and double_allowance = 1 ";
	$resultot2 = sqlsrv_query($conn, $fQuery);
	while($rowoperator = sqlsrv_fetch_array( $resultot2, SQLSRV_FETCH_ASSOC)){
		if ($day_type <> '(R)'){
			$allowance = $allowance*2;
			//$total_allowance*2;
		}
		$total_allowance = $allowance;
	}

	$tQuery = "select * from allowance_setup  where position = '01' and  benefit_type = 'Position allowance' and vehicle_type = '$v_type' and client = '$customer' ";
	$result1st = sqlsrv_query($conn, $tQuery);
	while($row1st = sqlsrv_fetch_array( $result1st, SQLSRV_FETCH_ASSOC)){				
		$position_allowance = $row1st['amount']*$totalhrs;
	}
	if($row['service_type']=='MANPOWER'){
		$tQuery = "select * from allowance_setup  where position = '01' and  benefit_type = 'Position allowance' and vehicle_type = '$v_type' ";
		$result1st = sqlsrv_query($conn, $tQuery);
		while($row1st = sqlsrv_fetch_array( $result1st, SQLSRV_FETCH_ASSOC)){				
			$position_allowance = $row1st['amount']*$totalhrs;
		}
	}

	if($totalhrs == 9.30)
		$totalhrs = 9.5;
	if($ot15 < 0 or $ot15 > 8)
		$ot15 = 0;


    $data = [$row['mrecdate'],date_format($row['actual_start_date'],'d/m/Y'), date_format($row['end_date'],'d/m/Y'), $day_type, $day_type_desc, $newDate, $row['worksheet_id'], $transport_id, $start_time, $end_time, $row['transport_from'],$row['specific_location_from'], $row['transport_to'], $row['specific_location_to'], $row['total_miledge'], $row['worksheet_remark'], $row['vehicle_id_erp'], $row['full_name'], $row['position_name'], $row['charge_as'],number_format($totalhrs,2),number_format($ot1,2),number_format($ot15,2),number_format($ot2,2),number_format($ot3,2), $row['customer_name'], $row['service_type'], $ch,$remark,number_format($allowance,0),$qty, $row['uom'],number_format($total_allowance,0),number_format($food_allowance,0),0,0,number_format($position_allowance,0),number_format($deligence_allowance,0)];
    array_push($raw['data'],$data);
}

echo json_encode($raw);
sqlsrv_close($conn);
?>