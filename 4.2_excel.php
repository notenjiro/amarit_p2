<?php 
	require_once 'config_db.php';
	require_once 'utils/helper.php';
	define('FPDF_FONTPATH','font/');
    require('fpdf182/fpdf.php'); 
    $output = '';  
	
	if( $conn ) {
		$from_date = $_GET['from_date'];
        $to_date = $_GET['to_date'];
		$output.= '
        <table class="table" bordered="1">
            <tr>
                <th>No.</th>
				<th>Date</th>
                <th>Day type</th>
                <th>Work type</th>
				<th>Start time</th>
                <th>End time</th>
                <th>Vehicle</th>
                <th>Operator/Manpower</th>
                <th>Position</th>
				<th>Vehicle Type</th>
				<th>Total hrs.</th>
				<th>OT 1</th>
				<th>OT 1.5</th>
				<th>OT 2</th>
				<th>OT 3</th>
				<th>Charge</th>
				<th>Name</th>
                <th>Sub type 1</th>
				<th>Sub type 2</th>
				<th>Sub type 3</th>
				<th>Sub type 4</th>
            </tr>
        ';

	$fQuery = "select a.[start_date],'(R)','Workday',a.start_time,a.end_time,v.registration_no,o.name,p.description as position,t.description as vehicle_type,a.no_charge,
n.description as group_name,b.branch,case when v.outsource = 1 then '13' else '12' end as ttype,t1.description as type1,t2.description as type2,t3.description as type3,t4.description as type4
, a.group_name+'-'+b.branch+'-'+c.universal_location+'-'+case when v.outsource = 1 then '13' else '12' end+'-'+a.type1+'-'+a.type2+'-'+a.type3+'-'+a.type4 as barcode,'' as start_ship,'' as start_break,'' as end_ship
from worksheet_cargo_transport a left join worksheet b on b.worksheet_id = a.worksheet_id
left join contract_location c on c.location = a.transport_from
left join vehicle v on v.vehicle_id = a.vehicle 
left join operator o on o.operator_id = a.operator
left join position p on p.code = o.position 
left join vehicle_type t on t.code = a.vehicle_type
left join group_name n on n.code = a.group_name
left join type_1 t1 on t1.code = a.type1
left join type_2 t2 on t2.code = a.type2
left join type_3 t3 on t3.code = a.type3
left join type_4 t4 on t4.code = a.type4
WHERE a.[start_date] >= '$from_date' AND a.[start_date] <= '$to_date'
union 

select a.[start_date],'(R)','Workday',a.start_time,a.end_time,'',v.name,p.description as position,'',0,
n.description as group_name,b.branch,case when v.outsource = 1 then '13' else '12' end as ttype,t1.description as type1,t2.description as type2,t3.description as type3,t4.description as type4
, a.group_name+'-'+b.branch+'-'+c.universal_location+'-'+case when v.outsource = 1 then '13' else '12' end+'-'+a.type1+'-'+a.type2+'-'+a.type3+'-'+a.type4 as barcode, ch.start_ship as start_ship, ch.start_break as start_break, ch.end_ship as end_ship
from worksheet_manpower a left join worksheet b on b.worksheet_id = a.worksheet_id
left join contract_location c on c.location = a.location
left join manpower v on v.manpower_id = a.labor
left join position p on p.code = v.position
left join group_name n on n.code = a.group_name
left join type_1 t1 on t1.code = a.type1
left join type_2 t2 on t2.code = a.type2
left join type_3 t3 on t3.code = a.type3
left join type_4 t4 on t4.code = a.type4 
left join contract_hourly_rate ch on ch.position = a.position
WHERE a.[start_date] >= '$from_date' AND a.[start_date] <= '$to_date'
union 

select a.[start_date],'(R)','Workday',a.start_time,a.end_time,v.registration_no,o.name,p.description as position,'',0,
n.description as group_name,b.branch,case when v.outsource = 1 then '13' else '12' end as ttype,t1.description as type1,t2.description as type2,t3.description as type3,t4.description as type4
, a.group_name+'-'+b.branch+'-'+c.universal_location+'-'+case when v.outsource = 1 then '13' else '12' end+'-'+a.type1+'-'+a.type2+'-'+a.type3+'-'+a.type4 as barcode,'' as start_ship,'' as start_break,'' as end_ship
from worksheet_cargo_handling a left join worksheet b on b.worksheet_id = a.worksheet_id
left join contract_location c on c.location = a.transport_from
left join vehicle v on v.vehicle_id = a.vehicle
left join operator o on o.operator_id = a.operator
left join position p on p.code = o.position
left join group_name n on n.code = a.group_name
left join type_1 t1 on t1.code = a.type1
left join type_2 t2 on t2.code = a.type2
left join type_3 t3 on t3.code = a.type3
left join type_4 t4 on t4.code = a.type4
WHERE a.[start_date] >= '$from_date' AND a.[start_date] <= '$to_date' ";
   
	$result = sqlsrv_query($conn, $fQuery);
	$x = 0;
	while($row = sqlsrv_fetch_array( $result, SQLSRV_FETCH_ASSOC)){
		$x = $x+1;
		$datetime1 = $row['end_time'];
		$datetime2 = $row['start_time'];
		$start_break = $row['start_break'];
		$interval = $datetime1->diff($datetime2);
		$totalhrs = $interval->format('%h').'.'.$interval->format('%i');
		if ($row['no_charge']) {
			$ch = 'No Charge';
		} else {
			$ch = 'Charge';
		}
        $output.='<tr>
					<td>'.$x.'</td>
                    <td>'.date_format($row['start_date'],'d/m/Y').'</td>
                    <td>'.'(R)'.'</td>
                    <td>'.'Workday'.'</td>
                    <td>'.date_format($row['start_time'],'H:i').'</td>
                    <td>'.date_format($row['end_time'],'H:i').'</td>
                    <td>'.$row['registration_no'].'</td>
                    <td>'.$row['name'].'</td>
					<td>'.$row['position'].'</td>
					<td>'.$row['vehicle_type'].'</td>
					<td>'.$totalhrs.'</td>
					<td>'.'0'.'</td>
                    <td>'.'0'.'</td>
                    <td>'.'0'.'</td>
					<td>'.'0'.'</td>
                    <td>'.$ch.'</td>
                    <td>'.$row['group_name'].'</td>
                    <td>'.$row['type1'].'</td>
                    <td>'.$row['type2'].'</td>
					<td>'.$row['type3'].'</td>
					<td>'.$row['type4'].'</td>
                  </tr>';  
	}
	$output.= '</table>';
    header("content-type: application/xls");
    header("content-disposition: attachment; filename=Timesheet.xls");
	
    echo $output;       
}
?>