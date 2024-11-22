<?php
// error_reporting(0);
error_reporting(E_ALL);
require_once '../config_db.php';
require_once '../utils/helper.php';

$job_id = $_GET['job_id'];


$customer = $_GET['customer'];

$rental_id = $_POST['Rental_id'];
$branch = $_POST['Rental_branch'];
$location = $_POST['Rental_location'];
$line_status = $_POST['Rental_line_status'];

$start_date = null_val($_POST['Rental_start_date']);
$start_time = null_val($_POST['Rental_start_time']);
$end_date = null_val($_POST['Rental_end_date']);
$end_time = null_val($_POST['Rental_end_time']);
$quantity = null_decimal($_POST['Rental_quantity']);
$uom = $_POST['Rental_uom'];

$description = $_POST['Rental_Descript'];
$charge_as = $_POST['Rental_ChargeAs'];
$outsource_charge_as = $_POST['out_Rental_ChargeAs'];
$contract = $_POST['Rental_CNumber'];

$remark = $_POST['Rental_remark'];
$promotion = $_POST['Rental_promotion'];
$contract_line = $_POST['Rental_CLNumber'];
$department = $_POST['Rental_department'];
$cost_center = $_POST['Rental_cost_center'];

$outsource_vendor = $_POST['Rental_group_name'];
$expende_date = null_val($_POST['Rental_expense_sub_date']);
$no_charge = isset($_POST['Rental_no_charge']) ? $_POST['Rental_no_charge'] : false;
$reimbursment = isset($_POST['Rental_reimbursment']) ? $_POST['Rental_reimbursment'] : false;
$lumpsum_charge = isset($_POST['Rental_Lump_sum_charge']) ? $_POST['Rental_Lump_sum_charge'] : false;


$outsource_bill_sub_date = null_val($_POST['Rental_bill_submission_date']);
$cancel_reason = $_POST['Rental_cancel_reason'];
$reason_outsource = $_POST['Rental_outsource_reason'];

$iou_date = null_val($_POST['Rental_IOU_date']);
$iou_num = $_POST['Rental_IOU_number'];
$iou_amount = $_POST['Rental_IOU_Amount'];



$cheque_remark = $_POST['Rental_Cheque_Remark'];
$cheque_amount = null_val($_POST['Rental_Cheque_Amount']);


$date_in_vendor_invoice = null_val($_POST['Rental_vendor_invoice_date']);
$date_vendor_submit_date = null_val($_POST['Rental_vendor_Submit_date']);
$vendor_invoice_no = $_POST['Rental_VInvoice_No'];
$vendor_invoice_value = $_POST['Rental_VInvoice_Value'];
$vendor_due_date = null_val($_POST['Rental_vendor_Due_date']);


// diff zone
$VEID = $_POST['Rental_V_ID'];
$owner = $_POST['Rental_Owner'];
$type = $_POST['Rental_typeC'];
$type2 = $_POST['Rental_type2'];
$type3 = $_POST['Rental_type3'];
$client_ref = $_POST['Rental_CR_CC'];



// $immigration_number = $_POST['immigration_number'];

// $expat_name = $_POST['immigration_expat_name'];
// $amount = 0;//null_decimal($_POST['immigration_amount']);
// $agreement_number = $_POST['immigration_agreement_number'];

$ref1 = $_POST['Rental_ref1'];
$ref2 = $_POST['Rental_ref2'];
$ref3 = $_POST['Rental_ref3'];
$ref4 = $_POST['Rental_ref4'];
$ref5 = $_POST['Rental_ref5'];
$ref6 = $_POST['Rental_ref6'];

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
$maxIdQuery = "SELECT MAX(rental_veh_heavy_id) AS max_id FROM job_rental_veh_heavy";
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
$rental_id = 'RT' . $currentYearSuffix . str_pad($nextNumber, 5, '0', STR_PAD_LEFT);
//endhere

$iquery = "INSERT INTO job_rental_veh_heavy (job_id, customer, rental_veh_heavy_id, branch, location, line_status, start_date, start_time, end_date, end_time, quantity, uom, description, charge_as, outsource_charge_as, contract, remark, promotion_code, contract_line, department, cost_center, outsource, expense_sub_date, no_charge, reimbursment, lumpsum_charge, outsource_billing_sub_date, cancel_reason, outsource_reason, iou_date, iou_number, iou_amount, cheque_remark, cheque_amount, date_in_vendor_invoice_doc, date_vendor_submit_invoice_to_amarit, vendor_invoice_number, vendor_invoice_value, vendor_invoice_due_date, ref1, ref2, ref3, ref4, ref5, ref6, veh_equipment_id, owner, type, type2, type3, client_ref ) 
VALUES ('$job_id', '$customer', '$rental_id', '$branch', '$location', '$line_status', $start_date, $start_time, $end_date, $end_time, $quantity, '$uom', '$description', '$charge_as', '$outsource_charge_as', '$contract', '$remark', '$promotion', '$contract_line', '$department', '$cost_center', '$outsource_vendor', $expende_date, '$no_charge', '$reimbursment', '$lumpsum_charge', $outsource_bill_sub_date, '$cancel_reason', '$reason_outsource', $iou_date, '$iou_num', '$iou_amount', '$cheque_remark', $cheque_amount, $date_in_vendor_invoice, $date_vendor_submit_date, '$vendor_invoice_no', '$vendor_invoice_value', $vendor_due_date, '$ref1', '$ref2', '$ref3', '$ref4', '$ref5', '$ref6', '$VEID', '$owner','$type', '$type2', '$type3', '$client_ref')
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