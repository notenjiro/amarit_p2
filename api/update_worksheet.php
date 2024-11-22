<?php
error_reporting(0);
require_once '../config_db.php';
require_once '../utils/helper.php';

$worksheet_id = $_POST['worksheet_id'];
$branch = $_POST['branch'];
$worksheet_date = $_POST['worksheet_date'];
$subject = $_POST['subject'];
$customer = $_POST['customer'];
$contact = $_POST['contact'];
$customer_ref = $_POST['customer_ref'];
$worksheet_status = $_POST['worksheet_status'];


$send_date = null_val($_POST['send_date']);
$send_time = null_val($_POST['send_time']);
$rcvd_date = null_val($_POST['rcvd_date']);
$rcvd_time = null_val($_POST['rcvd_time']);
$close_date = null_val($_POST['close_date']);
$close_time = null_val($_POST['close_time']);
$cancel_reason = null_val($_POST['cancel_reason']);
$remark = $_POST['worksheet_remark'];

$request_method = $_POST['request_method'];
$request_to = $_POST["request_to"];
$client_inform_amarit_date = null_val($_POST['client_inform_amarit_date']);
$client_inform_amarit_time = null_val($_POST['client_inform_amarit_time']);
$cs_inform_opr_date = null_val($_POST['cs_inform_opr_date']);
$cs_inform_opr_time = null_val($_POST['cs_inform_opr_time']);
$opr_inform_cs_date = null_val($_POST['opr_inform_cs_date']);
$opr_inform_cs_time = null_val($_POST['opr_inform_cs_time']);
$cs_inform_client_date = null_val($_POST['cs_inform_client_date']);
$cs_inform_client_time = null_val($_POST['cs_inform_client_time']);
$ref1 = $_POST['worksheet_ref1'];
$ref2 = $_POST['worksheet_ref2'];
$ref3 = $_POST['worksheet_ref3'];
$ref4 = $_POST['worksheet_ref4'];
$ref5 = $_POST['worksheet_ref5'];
$ref6 = $_POST['worksheet_ref6'];
$reject_reason = $_POST['reject_reason'];
$count = 0;

//new
$date_in_vendor_invoice = null_val($_POST['invoice_date']);
$date_vendor_submit_to_amarit = null_val($_POST['submitinvoice_date']);
$vendor_invoice_number = null_val($_POST['vendor_number']);
$vendor_invoice_value = null_val($_POST['vendor_value']);
$vendor_invoice_due_date = null_val($_POST['invoice_due_date']);
$expense_sub_date = null_val($_POST['submission_date']);
$date_job_ws_sent_to_manage = null_val($_POST['date_review']);
$date_job_ws_received_back = null_val($_POST['date_back']);
$job_ws_mailing_list_ref = null_val($_POST['mailing_list']);

if (substr($worksheet_id, 0,1) == 'J' ){
	$job_id = $worksheet_id;
	$job_date = $worksheet_date;
	$job_status = $worksheet_status;

}
if ($_POST['worksheet_status'] <> 'Open' and $_POST['worksheet_status'] <> 'Cancelled' and $_POST['worksheet_status'] <> 'Reject by A/R') {
//if ($_POST['worksheet_status'] == 'Closed' ) {
	$iquery = "select * from worksheet_cargo_transport a
	left join worksheet b on b.worksheet_id = a.worksheet_id
	WHERE a.worksheet_id = '$worksheet_id' and
	a.no_charge = '0' ";
	$stmt = sqlsrv_query($conn, $iquery);

	while($row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC)){
		if ($row["cost_center"] == '' || $row["department"] == '' || $row["contract_no"] == '' || $row["mileage_start"] == null || $row["mileage_end"] == null || $row["contract_no"] == null || $row["actual_start_date"] == null || $row["actual_finish_date"] == null || $row["mileage_start"] > $row["mileage_end"] || $row["actual_start_date"] > $row["actual_finish_date"] || $row["vehicle"] == '' || $row["operator"] == '' || $row["contact1"] == '' || $row["contact2"] == '' || $row["diesel_rate"] == 0 || $row["actual_start_time"] == null|| $row["actual_finish_time"] == null || $row["start_date"] == null || $row["end_date"] == null || $row["start_date"] > $row["end_date"]) {
			$Data["Status"] = "Error";
			$Data["msg"] = "Data in Cargo transport line are not complete ".$row["transport_id"];
			$count = 1;
		}
	}
	$iquery = "select * from worksheet_cargo_handling a
	left join worksheet b on b.worksheet_id = a.worksheet_id
	WHERE a.worksheet_id = '$worksheet_id' and line_status <> 'Cancelled' ";
	$stmt = sqlsrv_query($conn, $iquery);
	
	while($row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC)){
		if ($row["cost_center"] == '' || $row["department"] == '' || $row["contract_no"] == '' || $row["contract_no"] == null || $row["start_date"] == null || $row["end_date"] == null || $row["start_date"] > $row["end_date"] || $row["vehicle"] == '' || $row["operator"] == '' || $row["end_date"] == null || $row["end_time"] == null || $row["diesel_rate"] == 0)
			{
			$Data["Status"] = "Error";
			$Data["msg"] = "Data in Cargo handling line are not complete ".$row["cargo_service_id"];
			$count = 1;
		}
	}
	$iquery = "select * from worksheet_immigration a
	left join worksheet b on b.worksheet_id = a.worksheet_id
	WHERE a.worksheet_id = '$worksheet_id' ";
	$stmt = sqlsrv_query($conn, $iquery);
	
	while($row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC)){
		if ($row["agreement_number"] == '' || $row["department"] == '' || $row["cost_center"] == '' || $row["agreement_number"] == null || $row["start_date"] > $row["end_date"] || $row["end_date"] == null || $row["start_date"] == null )
			{
			$Data["Status"] = "Error";
			$Data["msg"] = "Data in Immigration line are not complete ".$row["immigration_id"];
			$count = 1;
		}
	}
	$iquery = "select * from worksheet_manpower a
	left join worksheet b on b.worksheet_id = a.worksheet_id
	WHERE a.worksheet_id = '$worksheet_id' ";
	$stmt = sqlsrv_query($conn, $iquery);
	
	while($row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC)){
		if ($row["contract_no"] == '' || $row["department"] == '' || $row["cost_center"] == '' || $row["contract_no"] == null || $row["labor"] == null || $row["end_time"] == null || $row["start_date"] == null || $row["start_date"] > $row["end_date"])
			{
			$Data["Status"] = "Error";
			$Data["msg"] = "Data in Manpower line are not complete ".$row["labor_service_id"];
			$count = 1;
		}
	}
	$iquery = "select * from worksheet_service a
	left join worksheet b on b.worksheet_id = a.worksheet_id
	WHERE a.worksheet_id = '$worksheet_id' and line_status <> 'Cancelled' ";
	$stmt = sqlsrv_query($conn, $iquery);
	
	while($row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC)){
		if ($row["agreement_number"] == '' || $row["department"] == '' || $row["cost_center"] == '' || $row["agreement_number"] == null || $row["vehicle"] == '' || $row["operator"] == '' || $row["end_date"] == null || $row["end_time"] == null || $row["amount"] == 0 || $row["agreement_number"] == '' || $row["amount"] == null || $row["start_date"] > $row["end_date"])
			{
			$Data["Status"] = "Error";
			$Data["msg"] = "Data in Service other line are not complete ".$row["cargo_service_id"];
			$count = 1;
		}
	}
	$iquery = "select * from worksheet_taxi a
	left join worksheet b on b.worksheet_id = a.worksheet_id
	WHERE a.worksheet_id = '$worksheet_id' ";
	$stmt = sqlsrv_query($conn, $iquery);
	
	while($row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC)){
		if ($row["contract_no"] == '' || $row["department"] == '' || $row["cost_center"] == '' || $row["contract_no"] == null || $row["vehicle"] == '' || $row["operator"] == '' || $row["end_date"] == null || $row["end_time"] == null || $row["actual_start_date"] == null || $row["actual_finish_date"] == null || $row["actual_start_date"] > $row["actual_finish_date"] || $row["diesel_rate"] == 0 || $row["start_date"] > $row["end_date"])
			{
			$Data["Status"] = "Error";
			$Data["msg"] = "Data in Taxi service line are not complete ".$row["taxi_service_id"];
			$count = 1;
		}
	}
	
	if ($count == 0 ){
		if ($_POST['worksheet_status'] == 'Closed'){
			$iquery = "UPDATE worksheet SET branch='$branch', worksheet_date='$worksheet_date', subject='$subject', customer = '$customer', customer_ref = '$customer_ref', contract = '$contact', worksheet_status = '$worksheet_status', send_date = $send_date, send_time = $send_time, rcvd_date = $rcvd_date, rcvd_time = $rcvd_time, close_date = $close_date, close_time = $close_time, cancel_reason = $cancel_reason, request_method = '$request_method', request_to = '$request_to', client_inform_amarit_date = $client_inform_amarit_date, client_inform_amarit_time = $client_inform_amarit_time, cs_inform_opr_date = $cs_inform_opr_date, cs_inform_opr_time = $cs_inform_opr_time, opr_inform_cs_date = $opr_inform_cs_date, opr_inform_cs_time = $opr_inform_cs_time, cs_inform_client_date = $cs_inform_client_date, cs_inform_client_time = $cs_inform_client_time, remark = '$remark', ref1 = '$ref1', ref2 = '$ref2', ref3 = '$ref3', ref4 = '$ref4', ref5 = '$ref5', ref6 = '$ref6', reject_reason = '$reject_reason', modify_date = getdate() WHERE worksheet_id = '$worksheet_id'";
		} else {
			$iquery = "UPDATE worksheet SET branch='$branch', worksheet_date='$worksheet_date', subject='$subject', customer = '$customer', customer_ref = '$customer_ref', contract = '$contact', worksheet_status = '$worksheet_status', send_date = $send_date, send_time = $send_time, rcvd_date = $rcvd_date, rcvd_time = $rcvd_time, cancel_reason = $cancel_reason, request_method = '$request_method', request_to = '$request_to', client_inform_amarit_date = $client_inform_amarit_date, client_inform_amarit_time = $client_inform_amarit_time, cs_inform_opr_date = $cs_inform_opr_date, cs_inform_opr_time = $cs_inform_opr_time, opr_inform_cs_date = $opr_inform_cs_date, opr_inform_cs_time = $opr_inform_cs_time, cs_inform_client_date = $cs_inform_client_date, cs_inform_client_time = $cs_inform_client_time, remark = '$remark', ref1 = '$ref1', ref2 = '$ref2', ref3 = '$ref3', ref4 = '$ref4', ref5 = '$ref5', ref6 = '$ref6', reject_reason = '$reject_reason', modify_date = getdate() WHERE worksheet_id = '$worksheet_id'";
		}
		$stmt = sqlsrv_query($conn, $iquery);
		$Data["Status"] = "Success";
		$Data["msg"] = "Data has been updated";
	}
} else {
	if (substr($worksheet_id, 0,1) == 'J' ){
		$iquery = "UPDATE job SET branch='$branch', job_date='$job_date', subject='$subject', customer = '$customer', customer_ref = '$customer_ref', contract = '$contact', job_status = '$job_status', send_date = $send_date, send_time = $send_time, rcvd_date = $rcvd_date, rcvd_time = $rcvd_time, close_date = $close_date, close_time = $close_time, cancel_reason = $cancel_reason, request_method = '$request_method', request_to = '$request_to', client_inform_amarit_date = $client_inform_amarit_date, client_inform_amarit_time = $client_inform_amarit_time, cs_inform_opr_date = $cs_inform_opr_date, cs_inform_opr_time = $cs_inform_opr_time, opr_inform_cs_date = $opr_inform_cs_date, opr_inform_cs_time = $opr_inform_cs_time, cs_inform_client_date = $cs_inform_client_date, cs_inform_client_time = $cs_inform_client_time, remark = '$remark', ref1 = '$ref1', ref2 = '$ref2', ref3 = '$ref3', ref4 = '$ref4', ref5 = '$ref5', ref6 = '$ref6', reject_reason = '$reject_reason', modify_date = getdate() , date_in_vendor_invoice = $date_in_vendor_invoice, date_vendor_submit_to_amarit = $date_vendor_submit_to_amarit,vendor_invoice_number = $vendor_invoice_number, vendor_invoice_value = $vendor_invoice_value , vendor_invoice_due_date = $vendor_invoice_due_date, expense_sub_date = $expense_sub_date, date_job_ws_sent_to_manage = $date_job_ws_sent_to_manage, date_job_ws_received_back =$date_job_ws_received_back, job_ws_mailing_list_ref=$job_ws_mailing_list_ref  WHERE job_id = '$job_id'";
		$stmt = sqlsrv_query($conn, $iquery);
	
	}else{

	
		$iquery = "UPDATE worksheet SET branch='$branch', worksheet_date='$worksheet_date', subject='$subject', customer = '$customer', customer_ref = '$customer_ref', contract = '$contact', worksheet_status = '$worksheet_status', send_date = $send_date, send_time = $send_time, rcvd_date = $rcvd_date, rcvd_time = $rcvd_time, close_date = $close_date, close_time = $close_time, cancel_reason = $cancel_reason, request_method = '$request_method', request_to = '$request_to', client_inform_amarit_date = $client_inform_amarit_date, client_inform_amarit_time = $client_inform_amarit_time, cs_inform_opr_date = $cs_inform_opr_date, cs_inform_opr_time = $cs_inform_opr_time, opr_inform_cs_date = $opr_inform_cs_date, opr_inform_cs_time = $opr_inform_cs_time, cs_inform_client_date = $cs_inform_client_date, cs_inform_client_time = $cs_inform_client_time, remark = '$remark', ref1 = '$ref1', ref2 = '$ref2', ref3 = '$ref3', ref4 = '$ref4', ref5 = '$ref5', ref6 = '$ref6', reject_reason = '$reject_reason', modify_date = getdate() WHERE worksheet_id = '$worksheet_id'";
		$stmt = sqlsrv_query($conn, $iquery);

		$iquery = "UPDATE worksheet_cargo_transport SET customer = '$customer' WHERE worksheet_id = '$worksheet_id' ";
		$stmt = sqlsrv_query($conn, $iquery);

		$iquery = "UPDATE worksheet_manpower SET customer = '$customer' WHERE worksheet_id = '$worksheet_id' ";
		$stmt = sqlsrv_query($conn, $iquery);

		$iquery = "UPDATE worksheet_cargo_handling SET customer = '$customer' WHERE worksheet_id = '$worksheet_id' ";
		$stmt = sqlsrv_query($conn, $iquery);

		$iquery = "UPDATE worksheet_service SET customer = '$customer' WHERE worksheet_id = '$worksheet_id' ";
		$stmt = sqlsrv_query($conn, $iquery);

		$iquery = "UPDATE worksheet_immigration SET customer = '$customer' WHERE worksheet_id = '$worksheet_id' ";
		$stmt = sqlsrv_query($conn, $iquery);

		$iquery = "UPDATE worksheet_taxi SET customer = '$customer' WHERE worksheet_id = '$worksheet_id' ";
		$stmt = sqlsrv_query($conn, $iquery);

		//$iquery = "UPDATE worksheet_cargo_transport SET line_status='$worksheet_status' WHERE worksheet_id = '$worksheet_id' and line_status <> 'Cancelled' ";
		//$stmt = sqlsrv_query($conn, $iquery);

		//$iquery = "UPDATE worksheet_manpower SET line_status='$worksheet_status' WHERE worksheet_id = '$worksheet_id' and line_status <> 'Cancelled' ";
		//$stmt = sqlsrv_query($conn, $iquery);

		//$iquery = "UPDATE worksheet_cargo_handling SET line_status='$worksheet_status' WHERE worksheet_id = '$worksheet_id' and line_status <> 'Cancelled' ";
		//$stmt = sqlsrv_query($conn, $iquery);

		//$iquery = "UPDATE worksheet_service SET line_status='$worksheet_status' WHERE worksheet_id = '$worksheet_id' and line_status <> 'Cancelled' ";
		//$stmt = sqlsrv_query($conn, $iquery);

		//$iquery = "UPDATE worksheet_immigration SET line_status='$worksheet_status' WHERE worksheet_id = '$worksheet_id' and line_status <> 'Cancelled' ";
		//$stmt = sqlsrv_query($conn, $iquery);

		//$iquery = "UPDATE worksheet_taxi SET line_status='$worksheet_status' WHERE worksheet_id = '$worksheet_id' and line_status <> 'Cancelled' ";
		//$stmt = sqlsrv_query($conn, $iquery);
	}

	
}
if($stmt === false){
	$Data["Status"] = "Error";
	$Data["msg"] = $iquery;//"มีข้อมูลซ้ำกับที่มีอยู่แล้ว";
	$Data["sql"] = $iquery;
}else{ 
	$Data["Status"] = "Success";
	$Data["msg"] = "Data has been updated";
}

//if (count == 1){
//	$Data["Status"] = "Error";
//	$Data["msg"] = "Cargo transport data is not complete";
//}
//if($stmt === false){
//    $Data["Status"] = "Error";
//    $Data["msg"] = "มีข้อมูลซ้ำกับที่มีอยู่แล้ว";
//    $Data["sql"] = $iquery;
//}else{ 
//    $Data["Status"] = "Success";
//    $Data["msg"] = "Data has been updated";
//}

echo json_encode($Data);

sqlsrv_close($conn);

?>