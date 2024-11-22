<?php
session_start();
error_reporting(0);
require_once '../config_db.php';
require_once '../utils/helper.php';

$job_id = $_POST['worksheet_id'];
$branch = $_POST['branch'];
$job_date = $_POST['worksheet_date'];
$subject = $_POST['subject'];
$customer = $_POST['customer'];
$contact = $_POST['contact'];
$customer_ref = $_POST['customer_ref'];
$job_status = $_POST['worksheet_status'];
$send_date = null_val($_POST['send_date']);
$send_time = null_val($_POST['send_time']);
$rcvd_date = null_val($_POST['rcvd_date']);
$rcvd_time = null_val($_POST['rcvd_time']);
$close_date = null_val($_POST['close_date']);
$close_time = null_val($_POST['close_time']);
$cancel_reason = $_POST['cancel_reason'];
$user_name = $_SESSION["user_name"];
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
$date_in_vendor_invoice = null_val($_POST['invoice_date']);
$date_vendor_submit_to_amarit = null_val($_POST['submitinvoice_date']);
$vendor_invoice_number = null_val($_POST['vendor_number']);
$vendor_invoice_value = null_val($_POST['vendor_value']);
$vendor_invoice_due_date = null_val($_POST['invoice_due_date']);
$expense_sub_date = null_val($_POST['submission_date']);
$date_job_ws_sent_to_manage = null_val($_POST['date_review']);
$date_job_ws_received_back = null_val($_POST['date_back']);
$job_ws_mailing_list_ref = null_val($_POST['mailing_list']);

// if(isset($_POST['worksheet_date']) && $_POST['worksheet_date'] != '')
//     $_date = $_POST['worksheet_date'];
// else
//     $_date = date('Y-m-d');
// $y = date('Y', strtotime($_date)) - 2000;
// $m = date('m', strtotime($_date));


//start
$maxIdQuery = "SELECT MAX(job_id) AS max_id FROM job";
$maxIdStmt = sqlsrv_query($conn, $maxIdQuery);
if ($maxIdStmt === false) {
    die("Error in fetching maximum job_id: " . print_r(sqlsrv_errors(), true));
}
$maxIdRow = sqlsrv_fetch_array($maxIdStmt, SQLSRV_FETCH_ASSOC);
$maxId = $maxIdRow['max_id'];


//$num = "SO".$y;
// $currentYearSuffix = date('y');
// $currentMonthSuffix = date('m');
// $nextNumber = intval(substr($maxId, 5)) + 1;
// $job_id = 'JS' . $currentYearSuffix . $currentMonthSuffix . str_pad($nextNumber, 5, '0', STR_PAD_LEFT);
//endhere


// $num = "WS".$y.$m;

// $date_start = date('Y-m-01', strtotime($_date));
// $date_end = date('Y-m-t', strtotime($_date));
// $fQuery = "SELECT count(1) as num FROM worksheet where worksheet_date between '$date_start' and '$date_end'";

// $result = sqlsrv_query($conn, $fQuery);
// $row = sqlsrv_fetch_array( $result, SQLSRV_FETCH_ASSOC);
// $count_num = $row['num'] +1;

// if($count_num  < 10)
//     $count = "0000".$count_num;
// else if($count_num  < 100)
//     $count = "000".$count_num;
// else if($count_num  < 1000)
//     $count = "00".$count_num ;
// else if($count_num  < 10000)
//     $count = "0".$count_num ;
// else
//     $count = $count_num ;
// $worksheet_id = $num.$count;

if ($user_name <> '') {
    // $date_in_vendor_invoice = null_val($_POST['invoice_date']);
    // $date_vendor_submit_to_amarit = null_val($_POST['submitinvoice_date']);
    // $vendor_invoice_number = null_val($_POST['vendor_number']);
    // $vendor_invoice_value = null_val($_POST['vendor_value']);
    // $vendor_invoice_due_date = null_val($_POST['invoice_due_date']);
    // $expense_sub_date = null_val($_POST['submission_date']);
    // $date_job_ws_sent_to_manage = null_val($_POST['date_review']);
    // $date_job_ws_received_back = null_val($_POST['date_back']);
    // $job_ws_mailing_list_ref = null_val($_POST['mailing_list']);


    $iquery = "INSERT INTO job (job_id, branch, job_date, subject, customer, contract, customer_ref, job_status, user_id, send_date, send_time, rcvd_date, rcvd_time, close_date, close_time, cancel_reason, request_method, request_to, client_inform_amarit_date, client_inform_amarit_time, cs_inform_opr_date, cs_inform_opr_time, opr_inform_cs_date, opr_inform_cs_time, cs_inform_client_date, cs_inform_client_time, ref1, ref2, ref3, ref4, ref5, ref6, remark, create_date,date_in_vendor_invoice , date_vendor_submit_to_amarit, vendor_invoice_number , vendor_invoice_value ,vendor_invoice_due_date , expense_sub_date , date_job_ws_sent_to_manage , date_job_ws_received_back , job_ws_mailing_list_ref) VALUES ('$job_id', '$branch','$job_date', '$subject', '$customer', '$contact', '$customer_ref', '$job_status', '$user_name', $send_date, $send_time, $rcvd_date, $rcvd_time, $close_date, $close_time, '$cancel_reason', '$request_method', '$request_to', $client_inform_amarit_date, $client_inform_amarit_time, $cs_inform_opr_date, $cs_inform_opr_time, $opr_inform_cs_date, $opr_inform_cs_time, $cs_inform_client_date, $cs_inform_client_time, '$ref1', '$ref2', '$ref3', '$ref4', '$ref5', '$ref6', '$remark', getdate(),$date_in_vendor_invoice , $date_vendor_submit_to_amarit, $vendor_invoice_number , $vendor_invoice_value ,$vendor_invoice_due_date,$expense_sub_date,$date_job_ws_sent_to_manage,$date_job_ws_received_back,$job_ws_mailing_list_ref)";

    $stmt = sqlsrv_query($conn, $iquery);

    //if($stmt === false){
    //	$Data["Status"] = "Error";
    //	$Data["msg"] = $iquery;//"มีข้อมูลซ้ำกับที่มีอยู่แล้ว";
    //}else{
    //	$Data["Status"] = "Success";
    //	$Data["msg"] = "Data has been updated";
    //}
} else {
    $Data["Status"] = "Error";
    $Data["msg"] = "session error please re login system.";
}

if ($stmt === false) {
    $Data["Status"] = "Error";
    $Data["msg"] = $iquery;//"มีข้อมูลซ้ำกับที่มีอยู่แล้ว";
} else {
    $Data["Status"] = "Success";
    $Data["msg"] = "Data has been updated";
    $Data["worksheet_id"] = $job_id;
}

echo json_encode($Data);

sqlsrv_close($conn);

?>