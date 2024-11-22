<?php
//error_reporting(0);
require_once '../config_db.php';
require_once '../utils/helper.php';

$copy_id = $_GET['copy_id'];
$copy_num = $_GET['copy_num'];
$copy_date = $_GET['copy_date'];

while($copy_num > 0){
	$_date = $copy_date;//date('Y-m-d');
	$y = date('Y', strtotime($_date)) - 2000;

	$num = "TP".$y;

	//$date_start = '2023-01-01';//date('Y-m-01', strtotime($_date));
	//$date_end = '2023-12-31';//date('Y-m-t', strtotime($_date));
	$date_start = date('Y-01-01', strtotime($_date));
	$date_end = date('Y-12-31', strtotime($_date));

	$fQuery = "SELECT count(1) as num FROM worksheet_cargo_transport where start_date between '$date_start' and '$date_end'";

	$result = sqlsrv_query($conn, $fQuery);
	$row = sqlsrv_fetch_array( $result, SQLSRV_FETCH_ASSOC);
	$count_num = $row['num'] +1;

	if($count_num  < 10)
		$count = "0000".$count_num;
	else if($count_num  < 100)
		$count = "000".$count_num;
	else if($count_num  < 1000)
		$count = "00".$count_num ;
	else if($count_num  < 10000)
		$count = "0".$count_num ;
	else
		$count = $count_num ;
	$transport_id = $num.$count;


	$value = " select [worksheet_id] ,[customer] ,'$transport_id' ,[vehicle] ,[operator] ,[transport_from] ,[transport_to] ,[route] ,[start_date] ,[start_time] ,[end_date] ,[end_time] ,[quantity] ,[uom] ,[actual_finish_date] ,[actual_finish_time] ,[mileage_start] ,[mileage_end] ,[backhaul] ,[no_charge] ,[diesel_rate] ,[trip_type1] ,[charge_type1] ,[additional_charge1] ,[quantity1] ,[uom1] ,[trip_type2] ,[charge_type2] ,[additional_charge2] ,[quantity2] ,[uom2] ,[trip_type3] ,[charge_type3] ,[additional_charge3] ,[quantity3] ,[uom3] ,[miledge_check_in] ,[consolidate] ,[contract_no] ,[vehicle_type] ,[charge_as] ,[outsource] ,[vendor] ,[actual_start_date] ,[actual_start_time] ,[line_status] ,[cancel_reason] ,[remark] ,[ref1] ,[ref2] ,[vehicle_switch] ,[cargo_type] ,[cargo_qty], [cargo_weight] ,[group_name] ,[type1] ,[type2] ,[type3] ,[type4] ,[type5] ,[branch] ,[outsource_charge_as] ,[contract_line] ,[contact1] ,[contact2] ,[dimension] ,[department] ,[cost_center] ,[specific_location_from] ,[specific_location_to] ,[ref3] ,[ref4] ,[ref5] ,[ref6] ,[group_name_desc] ,[type_1_desc] ,[type_2_desc] ,[type_3_desc] ,[type_4_desc] ,[promotion_code] ,[confirm_contract] ,[standby_charge] ,[transport_solution] ,[outsource_reason] ,[round_trip] ,[lumsum_charge] ,[create_date] ,[modify_date] from worksheet_cargo_transport where transport_id = '$copy_id'";
	$iquery = ' INSERT INTO worksheet_cargo_transport ([worksheet_id] ,[customer] ,[transport_id] ,[vehicle] ,[operator] ,[transport_from] ,[transport_to] ,[route] ,[start_date] ,[start_time] ,[end_date] ,[end_time] ,[quantity] ,[uom] ,[actual_finish_date] ,[actual_finish_time] ,[mileage_start] ,[mileage_end] ,[backhaul] ,[no_charge] ,[diesel_rate] ,[trip_type1] ,[charge_type1] ,[additional_charge1] ,[quantity1] ,[uom1] ,[trip_type2] ,[charge_type2] ,[additional_charge2] ,[quantity2] ,[uom2] ,[trip_type3] ,[charge_type3] ,[additional_charge3] ,[quantity3] ,[uom3] ,[miledge_check_in] ,[consolidate] ,[contract_no] ,[vehicle_type] ,[charge_as] ,[outsource] ,[vendor] ,[actual_start_date] ,[actual_start_time] ,[line_status] ,[cancel_reason] ,[remark] ,[ref1] ,[ref2] ,[vehicle_switch] ,[cargo_type] ,[cargo_qty] ,[cargo_weight] ,[group_name] ,[type1] ,[type2] ,[type3] ,[type4] ,[type5] ,[branch] ,[outsource_charge_as] ,[contract_line] ,[contact1] ,[contact2] ,[dimension] ,[department] ,[cost_center] ,[specific_location_from] ,[specific_location_to] ,[ref3] ,[ref4] ,[ref5] ,[ref6] ,[group_name_desc] ,[type_1_desc] ,[type_2_desc] ,[type_3_desc] ,[type_4_desc] ,[promotion_code] ,[confirm_contract] ,[standby_charge] ,[transport_solution] ,[outsource_reason] ,[round_trip] ,[lumsum_charge] ,[create_date] ,[modify_date]) '.$value;
	$stmt = sqlsrv_query($conn, $iquery);

	$copy_num = $copy_num-1;
}

$copy_num = $_GET['copy_num'];

while($copy_num > 0){
	$_date = $copy_date;//date('Y-m-d');
	$y = date('Y', strtotime($_date)) - 2000;

	$num = "LS".$y;

	//$date_start = '2023-01-01';//date('Y-m-01', strtotime($_date));
	//$date_end = '2023-12-31';//date('Y-m-t', strtotime($_date));
	$date_start = date('Y-01-01', strtotime($_date));
	$date_end = date('Y-12-31', strtotime($_date));

	$fQuery = "SELECT count(1) as num FROM worksheet_manpower where start_date between '$date_start' and '$date_end'";

	$result = sqlsrv_query($conn, $fQuery);
	$row = sqlsrv_fetch_array( $result, SQLSRV_FETCH_ASSOC);
	$count_num = $row['num'] +1;

	if($count_num  < 10)
		$count = "0000".$count_num;
	else if($count_num  < 100)
		$count = "000".$count_num;
	else if($count_num  < 1000)
		$count = "00".$count_num ;
	else if($count_num  < 10000)
		$count = "0".$count_num ;
	else
		$count = $count_num ;
	$transport_id = $num.$count;


	$value = " select [worksheet_id] ,[customer] ,'$transport_id' ,[timesheet_no] ,[position] ,[labor] ,[location] ,[start_date] ,[start_time] ,[end_date] ,[end_time] ,[quantity] ,[uom] ,[remark] ,[line_status] ,[cancel_reason] ,[timesheet_issue_date] ,[timesheet_return_date] ,[group_name] ,[type1] ,[type2] ,[type3] ,[type4] ,[type5] ,[on_time] ,[cost_type] ,[task_list] ,[branch] ,[ref1] ,[ref2] ,[contact] ,[charge_as] ,[outsource_charge_as] ,[department] ,[cost_center] ,[contract_no] ,[contract_line] ,[ref3] ,[ref4] ,[ref5] ,[ref6] ,[group_name_desc] ,[type_1_desc] ,[type_2_desc] ,[type_3_desc] ,[type_4_desc] ,[promotion_code] ,[confirm_contract] ,[ot] ,[create_date] ,[modify_date] ,[no_charge] from worksheet_manpower where labor_service_id = '$copy_id'";
	$iquery = ' INSERT INTO worksheet_manpower ([worksheet_id] ,[customer] ,[labor_service_id] ,[timesheet_no] ,[position] ,[labor] ,[location] ,[start_date] ,[start_time] ,[end_date] ,[end_time] ,[quantity] ,[uom] ,[remark] ,[line_status] ,[cancel_reason] ,[timesheet_issue_date] ,[timesheet_return_date] ,[group_name] ,[type1] ,[type2] ,[type3] ,[type4] ,[type5] ,[on_time] ,[cost_type] ,[task_list] ,[branch] ,[ref1] ,[ref2] ,[contact] ,[charge_as] ,[outsource_charge_as] ,[department] ,[cost_center] ,[contract_no] ,[contract_line] ,[ref3] ,[ref4] ,[ref5] ,[ref6] ,[group_name_desc] ,[type_1_desc] ,[type_2_desc] ,[type_3_desc] ,[type_4_desc] ,[promotion_code] ,[confirm_contract] ,[ot] ,[create_date] ,[modify_date] ,[no_charge]) '.$value;
	$stmt = sqlsrv_query($conn, $iquery);

	$copy_num = $copy_num-1;
}

$copy_num = $_GET['copy_num'];

while($copy_num > 0){
	$_date = $copy_date;//date('Y-m-d');
	$y = date('Y', strtotime($_date)) - 2000;

	$num = "CH".$y;

	//$date_start = '2023-01-01';//date('Y-m-01', strtotime($_date));
	//$date_end = '2023-12-31';//date('Y-m-t', strtotime($_date));
	$date_start = date('Y-01-01', strtotime($_date));
	$date_end = date('Y-12-31', strtotime($_date));

	$fQuery = "SELECT count(1) as num FROM worksheet_cargo_handling where start_date between '$date_start' and '$date_end'";

	$result = sqlsrv_query($conn, $fQuery);
	$row = sqlsrv_fetch_array( $result, SQLSRV_FETCH_ASSOC);
	$count_num = $row['num'] +1;

	if($count_num  < 10)
		$count = "0000".$count_num;
	else if($count_num  < 100)
		$count = "000".$count_num;
	else if($count_num  < 1000)
		$count = "00".$count_num ;
	else if($count_num  < 10000)
		$count = "0".$count_num ;
	else
		$count = $count_num ;
	$transport_id = $num.$count;

	$value = " select [worksheet_id] ,[customer] ,'$transport_id' ,[vehicle] ,[operator] ,[transport_from] ,[transport_to] ,[start_date] ,[start_time] ,[end_date] ,[end_time] ,[trip_type] ,[charge_type] ,[additional_charge] ,[quantity] ,[uom] ,[remark] ,[cargo_type] ,[cargo_qty] ,[weight] ,[line_status] ,[cancel_reason] ,[group_name] ,[type1] ,[type2] ,[type3] ,[type4] ,[type5] ,[branch] ,[ref1] ,[ref2] ,[unit_price] ,[charge_as] ,[outsource_charge_as] ,[contact] ,[cost_center] ,[contract_no] ,[contract_line] ,[diesel_rate] ,[ref3] ,[ref4] ,[ref5] ,[ref6] ,[group_name_desc] ,[type_1_desc] ,[type_2_desc] ,[type_3_desc] ,[type_4_desc] ,[promotion_code] ,[confirm_contract] ,[ot] ,[create_date] ,[modify_date] ,[no_charge] from worksheet_cargo_handling where cargo_service_id = '$copy_id'";
	$iquery = ' INSERT INTO worksheet_cargo_handling ([worksheet_id] ,[customer] ,[cargo_service_id] ,[vehicle] ,[operator] ,[transport_from] ,[transport_to] ,[start_date] ,[start_time] ,[end_date] ,[end_time] ,[trip_type] ,[charge_type] ,[additional_charge] ,[quantity] ,[uom] ,[remark] ,[cargo_type] ,[cargo_qty] ,[weight] ,[line_status] ,[cancel_reason] ,[group_name] ,[type1] ,[type2] ,[type3] ,[type4] ,[type5] ,[branch] ,[ref1] ,[ref2] ,[unit_price] ,[charge_as] ,[outsource_charge_as] ,[contact] ,[cost_center] ,[contract_no] ,[contract_line] ,[diesel_rate] ,[ref3] ,[ref4] ,[ref5] ,[ref6] ,[group_name_desc] ,[type_1_desc] ,[type_2_desc] ,[type_3_desc] ,[type_4_desc] ,[promotion_code] ,[confirm_contract] ,[ot] ,[create_date] ,[modify_date] ,[no_charge]) '.$value;
	$stmt = sqlsrv_query($conn, $iquery);

	$copy_num = $copy_num-1;
}

$copy_num = $_GET['copy_num'];

while($copy_num > 0){
	$_date = $copy_date;//date('Y-m-d');
	$y = date('Y', strtotime($_date)) - 2000;

	$num = "SO".$y;

	//$date_start = '2023-01-01';//date('Y-m-01', strtotime($_date));
	//$date_end = '2023-12-31';//date('Y-m-t', strtotime($_date));
	$date_start = date('Y-01-01', strtotime($_date));
	$date_end = date('Y-12-31', strtotime($_date));

	$fQuery = "SELECT count(1) as num FROM worksheet_service where start_date between '$date_start' and '$date_end'";

	$result = sqlsrv_query($conn, $fQuery);
	$row = sqlsrv_fetch_array( $result, SQLSRV_FETCH_ASSOC);
	$count_num = $row['num'] +1;

	if($count_num  < 10)
		$count = "0000".$count_num;
	else if($count_num  < 100)
		$count = "000".$count_num;
	else if($count_num  < 1000)
		$count = "00".$count_num ;
	else if($count_num  < 10000)
		$count = "0".$count_num ;
	else
		$count = $count_num ;
	$transport_id = $num.$count;

	$value = " select [worksheet_id] ,[customer] ,'$transport_id' ,[vehicle] ,[operator] ,[transport_from] ,[transport_to] ,[start_date] ,[start_time] ,[end_date] ,[end_time] ,[trip_type] ,[charge_type] ,[additional_charge] ,[quantity] ,[uom] ,[remark] ,[line_status] ,[group_name] ,[type1] ,[type2] ,[type3] ,[type4] ,[type5] ,[cancel_reason] ,[branch] ,[ref1] ,[ref2] ,[service_number] ,[description] ,[description2] ,[amount] ,[agreement_number] ,[department] ,[cost_center] ,[contact] ,[ref3] ,[ref4] ,[ref5] ,[ref6] ,[group_name_desc] ,[type_1_desc] ,[type_2_desc] ,[type_3_desc] ,[type_4_desc] ,[promotion_code] ,[confirm_contract] ,[create_date] ,[modify_date] from worksheet_service where cargo_service_id = '$copy_id'";
	$iquery = ' INSERT INTO worksheet_service ([worksheet_id] ,[customer] ,[cargo_service_id] ,[vehicle] ,[operator] ,[transport_from] ,[transport_to] ,[start_date] ,[start_time] ,[end_date] ,[end_time] ,[trip_type] ,[charge_type] ,[additional_charge] ,[quantity] ,[uom] ,[remark] ,[line_status] ,[group_name] ,[type1] ,[type2] ,[type3] ,[type4] ,[type5] ,[cancel_reason] ,[branch] ,[ref1] ,[ref2] ,[service_number] ,[description] ,[description2] ,[amount] ,[agreement_number] ,[department] ,[cost_center] ,[contact] ,[ref3] ,[ref4] ,[ref5] ,[ref6] ,[group_name_desc] ,[type_1_desc] ,[type_2_desc] ,[type_3_desc] ,[type_4_desc] ,[promotion_code] ,[confirm_contract] ,[create_date] ,[modify_date]) '.$value;
	$stmt = sqlsrv_query($conn, $iquery);

	$copy_num = $copy_num-1;
}

$copy_num = $_GET['copy_num'];

while($copy_num > 0){
	$_date = $copy_date;//date('Y-m-d');
	$y = date('Y', strtotime($_date)) - 2000;

	$num = "TX".$y;

	//$date_start = '2023-01-01';//date('Y-m-01', strtotime($_date));
	//$date_end = '2023-12-31';//date('Y-m-t', strtotime($_date));
	$date_start = date('Y-01-01', strtotime($_date));
	$date_end = date('Y-12-31', strtotime($_date));

	$fQuery = "SELECT count(1) as num FROM worksheet_taxi where start_date between '$date_start' and '$date_end'";

	$result = sqlsrv_query($conn, $fQuery);
	$row = sqlsrv_fetch_array( $result, SQLSRV_FETCH_ASSOC);
	$count_num = $row['num'] +1;

	if($count_num  < 10)
		$count = "0000".$count_num;
	else if($count_num  < 100)
		$count = "000".$count_num;
	else if($count_num  < 1000)
		$count = "00".$count_num ;
	else if($count_num  < 10000)
		$count = "0".$count_num ;
	else
		$count = $count_num ;
	$transport_id = $num.$count;

	$value = " select [worksheet_id] ,[customer] ,'$transport_id' ,[vehicle] ,[operator] ,[transport_from] ,[transport_to] ,[start_date] ,[start_time] ,[end_date] ,[end_time] ,[trip_type] ,[charge_type] ,[additional_charge] ,[quantity] ,[uom] ,[remark] ,[line_status] ,[group_name] ,[type1] ,[type2] ,[type3] ,[type4] ,[type5] ,[cancel_reason] ,[branch] ,[ref1] ,[ref2] ,[service_number] ,[description] ,[description2] ,[amount] ,[agreement_number] ,[department] ,[cost_center] ,[contact] ,[contract_no] ,[contract_line] ,[actual_start_date] ,[actual_start_time] ,[actual_finish_date] ,[actual_finish_time] ,[mileage_start] ,[mileage_end] ,[ref3] ,[ref4] ,[ref5] ,[ref6] ,[specific_location_from] ,[specific_location_to] ,[charge_as] ,[outsource_charge_as] ,[group_name_desc] ,[type_1_desc] ,[type_2_desc] ,[type_3_desc] ,[type_4_desc] ,[diesel_rate] ,[create_date] ,[modify_date] from worksheet_taxi where taxi_service_id = '$copy_id'";
	$iquery = ' INSERT INTO worksheet_taxi ([worksheet_id] ,[customer] ,[taxi_service_id] ,[vehicle] ,[operator] ,[transport_from] ,[transport_to] ,[start_date] ,[start_time] ,[end_date] ,[end_time] ,[trip_type] ,[charge_type] ,[additional_charge] ,[quantity] ,[uom] ,[remark] ,[line_status] ,[group_name] ,[type1] ,[type2] ,[type3] ,[type4] ,[type5] ,[cancel_reason] ,[branch] ,[ref1] ,[ref2] ,[service_number] ,[description] ,[description2] ,[amount] ,[agreement_number] ,[department] ,[cost_center] ,[contact] ,[contract_no] ,[contract_line] ,[actual_start_date] ,[actual_start_time] ,[actual_finish_date] ,[actual_finish_time] ,[mileage_start] ,[mileage_end] ,[ref3] ,[ref4] ,[ref5] ,[ref6] ,[specific_location_from] ,[specific_location_to] ,[charge_as] ,[outsource_charge_as] ,[group_name_desc] ,[type_1_desc] ,[type_2_desc] ,[type_3_desc] ,[type_4_desc] ,[diesel_rate] ,[create_date] ,[modify_date]) '.$value;
	$stmt = sqlsrv_query($conn, $iquery);

	$copy_num = $copy_num-1;
}

$copy_num = $_GET['copy_num'];

while($copy_num > 0){
	$_date = $copy_date;//date('Y-m-d');
	$y = date('Y', strtotime($_date)) - 2000;

	$num = "IM".$y;

	//$date_start = '2023-01-01';//date('Y-m-01', strtotime($_date));
	//$date_end = '2023-12-31';//date('Y-m-t', strtotime($_date));
	$date_start = date('Y-01-01', strtotime($_date));
	$date_end = date('Y-12-31', strtotime($_date));

	$fQuery = "SELECT count(1) as num FROM worksheet_immigration where start_date between '$date_start' and '$date_end'";

	$result = sqlsrv_query($conn, $fQuery);
	$row = sqlsrv_fetch_array( $result, SQLSRV_FETCH_ASSOC);
	$count_num = $row['num'] +1;

	if($count_num  < 10)
		$count = "0000".$count_num;
	else if($count_num  < 100)
		$count = "000".$count_num;
	else if($count_num  < 1000)
		$count = "00".$count_num ;
	else if($count_num  < 10000)
		$count = "0".$count_num ;
	else
		$count = $count_num ;
	$transport_id = $num.$count;

	$value = " select [worksheet_id] ,[customer] ,'$transport_id' ,[start_date] ,[start_time] ,[end_date] ,[end_time] ,[quantity] ,[uom] ,[remark] ,[line_status] ,[group_name] ,[type1] ,[type2] ,[type3] ,[type4] ,[type5] ,[cancel_reason] ,[branch] ,[ref1] ,[ref2] ,[immigration_number] ,[expat_name] ,[description] ,[amount] ,[agreement_number] ,[department] ,[cost_center] ,[contract_line] ,[service] ,[ref3] ,[ref4] ,[ref5] ,[ref6] ,[group_name_desc] ,[type_1_desc] ,[type_2_desc] ,[type_3_desc] ,[type_4_desc] ,[create_date] ,[modify_date] from worksheet_immigration where immigration_id = '$copy_id'";
	$iquery = ' INSERT INTO worksheet_immigration ([worksheet_id] ,[customer] ,[immigration_id] ,[start_date] ,[start_time] ,[end_date] ,[end_time] ,[quantity] ,[uom] ,[remark] ,[line_status] ,[group_name] ,[type1] ,[type2] ,[type3] ,[type4] ,[type5] ,[cancel_reason] ,[branch] ,[ref1] ,[ref2] ,[immigration_number] ,[expat_name] ,[description] ,[amount] ,[agreement_number] ,[department] ,[cost_center] ,[contract_line] ,[service] ,[ref3] ,[ref4] ,[ref5] ,[ref6] ,[group_name_desc] ,[type_1_desc] ,[type_2_desc] ,[type_3_desc] ,[type_4_desc] ,[create_date] ,[modify_date]) '.$value;
	$stmt = sqlsrv_query($conn, $iquery);

	$copy_num = $copy_num-1;
}

$Data["Status"] = "Success";
$Data["msg"] = "Copy Success";

echo json_encode($Data);

sqlsrv_close($conn);

?>