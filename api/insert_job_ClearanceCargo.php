<?php
// error_reporting(0);
error_reporting(E_ALL);
require_once '../config_db.php';
require_once '../utils/helper.php';

$job_id = $_GET['job_id'];


$customer = $_GET['customer'];

$clearance_cargo_id = $_POST['ClearanceCargo_id'];
$branch = $_POST['ClearanceCargo_branch'];
$location = $_POST['ClearanceCargo_location'];
$line_status = $_POST['ClearanceCargo_line_status'];

$start_date = null_val($_POST['ClearanceCargo_start_date']);
$start_time = null_val($_POST['ClearanceCargo_start_time']);
$end_date = null_val($_POST['ClearanceCargo_end_date']);
$end_time = null_val($_POST['ClearanceCargo_end_time']);
$quantity = null_decimal($_POST['ClearanceCargo_quantity']);
$uom = $_POST['ClearanceCargo_uom'];

$description = $_POST['ClearanceCargo_Descript'];
$charge_as = $_POST['ClearanceCargo_ChargeAs'];
$outsource_charge_as = $_POST['out_ClearanceCargo_ChargeAs'];
$contract = $_POST['ClearanceCargo_CNumber'];

$remark = $_POST['ClearanceCargo_remark'];
$promotion = $_POST['ClearanceCargo_promotion'];
$contract_line = $_POST['ClearanceCargo_CLNumber'];
$department = $_POST['ClearanceCargo_department'];
$cost_center = $_POST['ClearanceCargo_cost_center'];

$outsource_vendor = $_POST['ClearanceCargo_group_name'];
$expende_date = null_val($_POST['ClearanceCargo_expense_sub_date']);
$no_charge = isset($_POST['ClearanceCargo_no_charge']) ? $_POST['ClearanceCargo_no_charge'] : false;
$reimbursment = isset($_POST['ClearanceCargo_reimbursment']) ? $_POST['ClearanceCargo_reimbursment'] : false;
$lumpsum_charge = isset($_POST['ClearanceCargo_Lump_sum_charge']) ? $_POST['ClearanceCargo_Lump_sum_charge'] : false;


$outsource_bill_sub_date = null_val($_POST['ClearanceCargo_bill_submission_date']);
$cancel_reason = $_POST['ClearanceCargo_cancel_reason'];
$reason_outsource = $_POST['ClearanceCargo_outsource_reason'];

$iou_date = null_val($_POST['ClearanceCargo_IOU_date']);
$iou_num = $_POST['ClearanceCargo_IOU_number'];
$iou_amount = $_POST['ClearanceCargo_IOU_Amount'];



$cheque_remark = $_POST['ClearanceCargo_Cheque_Remark'];
$cheque_amount = null_val($_POST['ClearanceCargo_Cheque_Amount']);


$date_in_vendor_invoice = null_val($_POST['ClearanceCargo_vendor_invoice_date']);
$date_vendor_submit_date = null_val($_POST['ClearanceCargo_vendor_Submit_date']);
$vendor_invoice_no = $_POST['ClearanceCargo_VInvoice_No'];
$vendor_invoice_value = $_POST['ClearanceCargo_VInvoice_Value'];
$vendor_due_date = null_val($_POST['ClearanceCargo_vendor_Due_date']);


// diff zone


$type = $_POST['ClearanceCargo_typeC'];
$type1 = $_POST['ClearanceCargo_Stype1'];
$type2 = $_POST['ClearanceCargo_Stype2'];
$type3 = $_POST['ClearanceCargo_Stype3'];
$type4 = $_POST['ClearanceCargo_Stype4'];
$type5 = $_POST['ClearanceCargo_Stype5'];
$type6 = $_POST['ClearanceCargo_Stype6'];
$custom_entry_form_number = $_POST['ClearanceCargo_Entry_No'];

$cargo_total_weight = $_POST['ClearanceCargo_TTW'];
$original_country = $_POST['ClearanceCargo_OGC'];
$poe = $_POST['ClearanceCargo_POE'];
$pod = $_POST['ClearanceCargo_POD'];
$eta_date = null_val($_POST['ClearanceCargo_ETA']);
$ata_date = null_val($_POST['ClearanceCargo_ATA']);
$etd_date = null_val($_POST['ClearanceCargo_ETD']);
$atd_date = null_val($_POST['ClearanceCargo_ATD']);
$do_release_date = null_val($_POST['ClearanceCargo_DO_re_date']);
$container_open_date = null_val($_POST['ClearanceCargo_ConOpen_date']);
$cheque_received_date = null_val($_POST['ClearanceCargo_Cheque_date']);
$total_duty_n_tax_amount = $_POST['ClearanceCargo_Duty_Tax'];
$awb_bl_num = $_POST['ClearanceCargo_AWB_BL'];
$cipl_number = $_POST['ClearanceCargo_CIPL_Number'];
$cipl_value = $_POST['ClearanceCargo_CIPL_Value'];




// $immigration_number = $_POST['immigration_number'];

// $expat_name = $_POST['immigration_expat_name'];
// $amount = 0;//null_decimal($_POST['immigration_amount']);
// $agreement_number = $_POST['immigration_agreement_number'];

$ref1 = $_POST['ClearanceCargo_ref1'];
$ref2 = $_POST['ClearanceCargo_ref2'];
$ref3 = $_POST['ClearanceCargo_ref3'];
$ref4 = $_POST['ClearanceCargo_ref4'];
$ref5 = $_POST['ClearanceCargo_ref5'];
$ref6 = $_POST['ClearanceCargo_ref6'];

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
$maxIdQuery = "SELECT MAX(clearance_cargo_id) AS max_id FROM job_clearance_cargo";
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
$clearance_cargo_id = 'CC' . $currentYearSuffix . str_pad($nextNumber, 5, '0', STR_PAD_LEFT);
//endhere

$iquery = "INSERT INTO job_clearance_cargo (job_id, customer, clearance_cargo_id, branch, location, line_status, start_date, start_time, end_date, end_time, quantity, uom, description, charge_as, outsource_charge_as, contract, remark, promotion_code, contract_line, department, cost_center, outsource, expense_sub_date, no_charge, reimbursment, lumpsum_charge, outsource_billing_sub_date, cancel_reason, outsource_reason, iou_date, iou_number, iou_amount, cheque_remark, cheque_amount, date_in_vendor_invoice_doc, date_vendor_submit_invoice_to_amarit, vendor_invoice_number, vendor_invoice_value, vendor_invoice_due_date, ref1, ref2, ref3, ref4, ref5, ref6, type, type1, type2, type3, type4, type5, type6, custom_entry_form_number, cargo_total_weight, original_country, poe, pod, eta_date, ata_date, etd_date, atd_date, do_release_date, container_open_date, cheque_received_date, total_duty_n_tax_amount, awb_bl_num, cipl_number, cipl_value) 
VALUES ('$job_id', '$customer', '$clearance_cargo_id', '$branch', '$location', '$line_status', $start_date, $start_time, $end_date, $end_time, $quantity, '$uom', '$description', '$charge_as', '$outsource_charge_as', '$contract', '$remark', '$promotion', '$contract_line', '$department', '$cost_center', '$outsource_vendor', $expende_date, '$no_charge', '$reimbursment', '$lumpsum_charge', $outsource_bill_sub_date, '$cancel_reason', '$reason_outsource', $iou_date, '$iou_num', '$iou_amount', '$cheque_remark', $cheque_amount, $date_in_vendor_invoice, $date_vendor_submit_date, '$vendor_invoice_no', '$vendor_invoice_value', $vendor_due_date, '$ref1', '$ref2', '$ref3', '$ref4', '$ref5', '$ref6', '$type', '$type1', '$type2', '$type3', '$type4', '$type5', '$type6', '$custom_entry_form_number', '$cargo_total_weight', '$original_country', '$poe', '$pod', $eta_date, $ata_date, $etd_date, $atd_date, $do_release_date, $container_open_date, $cheque_received_date, '$total_duty_n_tax_amount', '$awb_bl_num', '$cipl_number', '$cipl_value' )
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