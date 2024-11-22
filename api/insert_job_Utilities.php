<?php
// error_reporting(0);
error_reporting(E_ALL);
require_once '../config_db.php';
require_once '../utils/helper.php';

$job_id = $_GET['job_id'];

$customer = $_GET['customer'];

$utilities_id = $_POST['Utilities_id'];
$branch = $_POST['branchUT'];
$location = $_POST['locationUT'];
$line_status = $_POST['Utilities_line_status'];

$start_date = null_val($_POST['Utilities_start_date']);
$start_time = null_val($_POST['Utilities_start_time']);
$end_date = null_val($_POST['Utilities_end_date']);
$end_time = null_val($_POST['Utilities_end_time']);
$quantity = null_decimal($_POST['Utilities_quantity']);
$uom = $_POST['Utilities_uom'];

$description = $_POST['Utilities_Descript'];
$charge_as = $_POST['Utilities_ChargeAs'];
$outsource_charge_as = $_POST['out_Utilities_ChargeAs'];
$contract = $_POST['Utilities_CNumber'];

$remark = $_POST['Utilities_remark'];
$promotion = $_POST['Utilities_promotion'];
$contract_line = $_POST['Utilities_CLNumber'];
$department = $_POST['Utilities_department'];
$cost_center = $_POST['Utilities_cost_center'];

$outsource_vendor = $_POST['Utilities_group_name'];
$expende_date = null_val($_POST['Utilities_expense_sub_date']);
$no_charge = isset($_POST['Utilities_no_charge']) ? $_POST['Utilities_no_charge'] : false;
$reimbursment = isset($_POST['Utilities_reimbursment']) ? $_POST['Utilities_reimbursment'] : false;
$lumpsum_charge = isset($_POST['Utilities_Lump_sum_charge']) ? $_POST['Utilities_Lump_sum_charge'] : false;


$outsource_bill_sub_date = null_val($_POST['Utilities_bill_submission_date']);
$cancel_reason = $_POST['Utilities_cancel_reason'];
$reason_outsource = $_POST['Utilities_outsource_reason'];

$iou_date = null_val($_POST['Utilities_IOU_date']);
$iou_num = $_POST['Utilities_IOU_number'];
$iou_amount = $_POST['Utilities_IOU_Amount'];



$cheque_remark = $_POST['Utilities_Cheque_Remark'];
$cheque_amount = null_val($_POST['Utilities_Cheque_Amount']);


$date_in_vendor_invoice = null_val($_POST['Utilities_vendor_invoice_date']);
$date_vendor_submit_date = null_val($_POST['Utilities_vendor_Submit_date']);
$vendor_invoice_no = $_POST['Utilities_VInvoice_No'];
$vendor_invoice_value = $_POST['Utilities_VInvoice_Value'];
$vendor_due_date = null_val($_POST['Utilities_vendor_Due_date']);


// diff zone
$type = $_POST['Utilities_typeC'];
$type1 = $_POST['Utilities_type1'];



// $immigration_number = $_POST['immigration_number'];

// $expat_name = $_POST['immigration_expat_name'];
// $amount = 0;//null_decimal($_POST['immigration_amount']);
// $agreement_number = $_POST['immigration_agreement_number'];

$ref1 = $_POST['Utilities_ref1'];
$ref2 = $_POST['Utilities_ref2'];
$ref3 = $_POST['Utilities_ref3'];
$ref4 = $_POST['Utilities_ref4'];
$ref5 = $_POST['Utilities_ref5'];
$ref6 = $_POST['Utilities_ref6'];

if ($customer == 'CL0423' or $uom == 'EM/TP')
    $no_charge = 1;

    
// $_date = $_POST['WarehousingSpace_start_date'];//date('Y-m-d');
// $y = date('Y', strtotime($_date)) - 2000;
// $num = "IM".$y;

// //$date_start = '2023-01-01';//date('Y-m-01', strtotime($_date));
// //$date_end = '2023-12-31';//date('Y-m-t', strtotime($_date));
// $date_start = date('Y-01-01', strtotime($_date));
// $date_end = date('Y-12-31', strtotime($_date));

// $fQuery = "SELECT count(1) as num FROM worksheet_immigration where start_date between '$date_start' and '$date_end'";

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
// $immigration_id = $num.$count;

//start
$maxIdQuery = "SELECT MAX(utilities_id) AS max_id FROM job_utilities";
$maxIdStmt = sqlsrv_query($conn, $maxIdQuery);
if ($maxIdStmt === false) {
    die("Error in fetching maximum job_id: " . print_r(sqlsrv_errors(), true));
}
$maxIdRow = sqlsrv_fetch_array($maxIdStmt, SQLSRV_FETCH_ASSOC);
$maxId = $maxIdRow['max_id'];

$filePath = "axQuery.txt";

    // Write the query to the file
    file_put_contents($filePath, "x");
//$num = "SO".$y;
$currentYearSuffix = date('y');
$nextNumber = intval(substr($maxId, 4)) + 1;
$utilities_id = 'UT' . $currentYearSuffix . str_pad($nextNumber, 5, '0', STR_PAD_LEFT);
//endhere

$iquery = "INSERT INTO job_utilities (job_id, customer, utilities_id, branch, location, line_status, start_date, start_time, end_date, end_time, quantity, uom, description, charge_as, outsource_charge_as, contract, remark, promotion_code, contract_line, department, cost_center, outsource, expense_sub_date, no_charge, reimbursment, lumpsum_charge, outsource_billing_sub_date, cancel_reason, outsource_reason, type, iou_date, iou_number, iou_amount, type1, cheque_remark, cheque_amount, date_in_vendor_invoice_doc, date_vendor_submit_invoice_to_amarit, vendor_invoice_number, vendor_invoice_value, vendor_invoice_due_date, ref1, ref2, ref3, ref4, ref5, ref6) 
VALUES ('$job_id', '$customer', '$utilities_id', '$branch', '$location', '$line_status', $start_date, $start_time, $end_date, $end_time, $quantity, '$uom', '$description', '$charge_as', '$outsource_charge_as', '$contract', '$remark', '$promotion', '$contract_line', '$department', '$cost_center', '$outsource_vendor', $expende_date, '$no_charge', '$reimbursment', '$lumpsum_charge', $outsource_bill_sub_date, '$cancel_reason', '$reason_outsource', '$type', $iou_date, '$iou_num', '$iou_amount', '$type1', '$cheque_remark', $cheque_amount, $date_in_vendor_invoice, $date_vendor_submit_date, '$vendor_invoice_no', '$vendor_invoice_value', $vendor_due_date, '$ref1', '$ref2', '$ref3', '$ref4', '$ref5', '$ref6')
";
$stmt = sqlsrv_query($conn, $iquery);

    // write message to the log file
    $filePath = "aQuery.txt";

    // Write the query to the file
    file_put_contents($filePath, $iquery);

if ($stmt === false) {
    $Data["Status"] = "Error";
    $Data["msg"] = $iquery;//"มีข้อมูลซ้ำกับที่มีอยู่แล้ว";
    $errors = sqlsrv_errors(SQLSRV_ERR_ERRORS);
    
    // Construct a string to represent the error information
    $errorInfo = "";
    foreach ($errors as $error) {
        $errorInfo .= "SQLSTATE: " . $error['SQLSTATE'] . "\n";
        $errorInfo .= "Code: " . $error['code'] . "\n";
        $errorInfo .= "Message: " . $error['message'] . "\n";
        $errorInfo .= "------------------------\n";
    }

    // Specify the file path where you want to save the error information
    $filePath = "aerror_log.txt";

    // Write the error information to the file
    file_put_contents($filePath, $errorInfo);
} else {
    $Data["Status"] = "Success";
    $Data["msg"] = "Data job has been updated";
}

echo json_encode($Data);

sqlsrv_close($conn);

?>